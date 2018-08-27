<?php
/**
 * Show all movies.
 */
$app->router->get("movie", function () use ($app) {
    $app->db->connect();

    $sql = "SELECT * FROM movie;";
    $resultset = $app->db->executeFetchAll($sql);

    $data = [
        "title" => "Filmbibliotek | oophp",
        "resultset" => $resultset
    ];

    $app->view->add("movie/all", $data);
    $app->page->render($data);
});

/**
 * Add a movie.
 */
$app->router->any(["GET", "POST"], "movie/add", function () use ($app) {
    $data = [
        "title" => "Lägg till film | Filmbibliotek | oophp",
    ];

    $app->db->connect();

    if ($app->request->getPost("add")) {
        $sql = "INSERT INTO movie (title, year, image) VALUES (?, ?, ?);";

        $app->db->execute($sql, [
            $app->request->getPost("movieTitle"),
            $app->request->getPost("movieYear"),
            $app->request->getPost("movieImage")
        ]);

        $app->response->redirect($app->url->create("movie"));
    }

    $app->view->add("movie/movie-add", $data);
    $app->page->render($data);
});

/**
 * Edit a movie.
 */
$app->router->any(["GET", "POST"], "movie/edit/{id:digit}", function ($id) use ($app) {
    $app->db->connect();

    $sql = "SELECT * FROM movie WHERE id = ?;";
    $movie = $app->db->executeFetchAll($sql, [$id]);
    $movie = $movie[0];

    $data = [
        "title" => "Ändra film | Filmbibliotek | oophp",
        "movie" => $movie
    ];

    $movieTitle = $app->request->getPost("movieTitle");
    $movieYear  = $app->request->getPost("movieYear");
    $movieImage = $app->request->getPost("movieImage");

    if ($app->request->getPost("doSave")) {
        $sql = "UPDATE movie SET title = ?, year = ?, image = ? WHERE id = ?;";
        $app->db->execute($sql, [$movieTitle, $movieYear, $movieImage, $id]);
        $app->response->redirect($app->url->create("movie/edit/{$id}"));
    }

    $app->view->add("movie/movie-edit", $data);
    $app->page->render($data);
});

/**
 * Delete a movie.
 */
$app->router->get("movie/remove/{id:digit}", function ($id) use ($app) {
    $app->db->connect();

    $sql = "DELETE FROM `movie` WHERE id = ?";
    $app->db->execute($sql, [$id]);
    $app->response->redirect($app->url->create("movie/all"));
});

/**
 * Search by title.
 */
$app->router->get("movie/search/title", function () use ($app) {
    $app->db->connect();

    $resultset = null;

    $searchTitle = $app->request->getGet("searchTitle");

    if ($searchTitle) {
        $sql = "SELECT * FROM movie WHERE title LIKE ?;";
        $resultset = $app->db->executeFetchAll($sql, [$searchTitle]);
    }

    $data = [
        "title" => "Filmbibliotek | oophp",
        "resultset" => $resultset,
        "searchTitle" => $searchTitle
    ];

    $app->view->add("movie/search-title", $data);
    $app->page->render($data);
});

/**
 * Search by year.
 */
$app->router->get("movie/search/year", function () use ($app) {
    $app->db->connect();

    $resultset = null;

    $year1 = $app->request->getGet("year1");
    $year2 = $app->request->getGet("year2");
    if ($year1 && $year2) {
        $sql = "SELECT * FROM movie WHERE year >= ? AND year <= ?;";
        $resultset = $app->db->executeFetchAll($sql, [$year1, $year2]);
    } elseif ($year1) {
        $sql = "SELECT * FROM movie WHERE year >= ?;";
        $resultset = $app->db->executeFetchAll($sql, [$year1]);
    } elseif ($year2) {
        $sql = "SELECT * FROM movie WHERE year <= ?;";
        $resultset = $app->db->executeFetchAll($sql, [$year2]);
    }

    $data = [
        "title" => "Filmbibliotek | oophp",
        "resultset" => $resultset,
        "year1" => $year1,
        "year2" => $year2
    ];

    $app->view->add("movie/search-year", $data);
    $app->page->render($data);
});
