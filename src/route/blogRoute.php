<?php
/**
 * Show all blogs.
 */
$app->router->get("blog", function () use ($app) {
    $app->db->connect();

    $sql = <<<EOD
SELECT
    *,
    DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS published_iso8601,
    DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS published
    FROM content
WHERE type=?
ORDER BY published DESC
;
EOD;
    $resultset = $app->db->executeFetchAll($sql, ["post"]);

    $data = [
        "title" => "Blog | oophp",
        "resultset" => $resultset
    ];

    $app->view->add("blog/all", $data);
    $app->page->render($data);
});

/**
 * Admin all blogs.
 */
$app->router->get("blog/admin", function () use ($app) {
    $app->db->connect();

    $sql = "SELECT * FROM content;";
    $resultset = $app->db->executeFetchAll($sql);

    $data = [
        "title" => "Blog | oophp",
        "resultset" => $resultset
    ];

    $app->view->add("blog/admin", $data);
    $app->page->render($data);
});

/**
 * Add a blog.
 */
$app->router->any(["GET", "POST"], "blog/add", function () use ($app) {
    $data = [
        "title" => "Add content | Blog | oophp",
    ];

    $app->db->connect();

    if ($app->request->getPost("add")) {
        $sql = "INSERT INTO content (title) VALUES (?);";

        $app->db->execute($sql, [
            $app->request->getPost("contentTitle"),
        ]);

        $id = $app->db->lastInsertId();

        $app->response->redirect($app->url->create("blog/edit/".$id));
    }

    $app->view->add("blog/blog-add", $data);
    $app->page->render($data);
});

/**
 * Edit a blog.
 */
$app->router->any(["GET", "POST"], "blog/edit/{id:digit}", function ($id) use ($app) {
    $app->db->connect();

    $sql = "SELECT * FROM content WHERE id = ?;";
    $blog = $app->db->executeFetchAll($sql, [$id]);
    $blog = $blog[0];

    $data = [
        "title" => "Edit content | Blog | oophp",
        "content" => $blog
    ];

    $contentSlug_new = $app->request->getPost("contentSlug");

    if (empty($app->request->getPost("contentSlug"))) {
        $contentSlug_new = slugify($app->request->getPost("contentTitle"));
    }

    $contentTitle = $app->request->getPost("contentTitle");
    $contentPath = $app->request->getPost("contentPath");
    $contentSlug = $contentSlug_new;
    $contentData = $app->request->getPost("contentData");
    $contentType = $app->request->getPost("contentType");
    $contentFilter = $app->request->getPost("contentFilter");
    $contentPublish = $app->request->getPost("contentPublish");

    if ($app->request->getPost("doSave")) {
        $sql = "UPDATE content SET title = ?, path = ?, slug = ?, data = ?, type = ?, filter = ?, published = ? WHERE id = ?;";
        $app->db->execute($sql, [$contentTitle,
                                 $contentPath,
                                 $contentSlug,
                                 $contentData,
                                 $contentType,
                                 $contentFilter,
                                 $contentPublish,
                                 $id]);

        $app->response->redirect($app->url->create("blog/edit/{$id}"));
    }

    $app->view->add("blog/blog-edit", $data);
    $app->page->render($data);
});

/**
 * Delete a blog.
 */
$app->router->get("blog/remove/{id:digit}", function ($id) use ($app) {
    $app->db->connect();

    $sql = "UPDATE content SET deleted=NOW() WHERE id = ?";
    $app->db->execute($sql, [$id]);
    $app->response->redirect($app->url->create("blog"));
});

/**
 * View a blog post.
 */
$app->router->get("blog/{path}", function ($path) use ($app) {
    $app->db->connect();

    $sql = <<<EOD
SELECT
    *,
    DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS modified_iso8601,
    DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS modified
FROM content
WHERE 
    slug = ?
    AND type = ?
    AND (deleted IS NULL OR deleted > NOW())
    AND published <= NOW()
ORDER BY published DESC
;
EOD;

    $content = $app->db->executeFetch($sql, [$path, "post"]);

    if (!$content) {
        header("HTTP/1.0 404 Not Found");
        $title = "404";
        $view[] = "view/http_status/404.php";
    }

    $data = [
        "title" => "View content | Blog | oophp",
        "content" => $content
    ];
    $app->view->add("blog/blog-view", $data);
    $app->page->render($data);
});

/**
 * View a page post.
 */
$app->router->get("blog/page/{path}", function ($path) use ($app) {
    $app->db->connect();

    $sql = <<<EOD
    SELECT
        *,
        DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS modified_iso8601,
        DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS modified
    FROM content
    WHERE
        path = ?
        AND type = ?
        AND (deleted IS NULL OR deleted > NOW())
        AND published <= NOW();
EOD;

    $content = $app->db->executeFetch($sql, [$path, "page"]);

    if (!$content) {
        header("HTTP/1.0 404 Not Found");
        $title = "404";
        $view[] = "view/http_status/404.php";
    }

    $data = [
        "title" => "View content | Blog | oophp",
        "content" => $content
    ];
    $app->view->add("blog/blog-view", $data);
    $app->page->render($data);
});
