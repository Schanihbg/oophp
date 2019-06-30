<?php
if (!$resultset) {
    return;
}
?>

<table class="table table-striped">
    <a href="<?= $this->di->get("url")->create("blog/add") ?>">Lägg till content</a>
    <tr class="first">
        <th>Id</th>
        <th>Title</th>
        <th>Type</th>
        <th>Published</th>
        <th>Created</th>
        <th>Updated</th>
        <th>Deleted</th>
        <th>Edit</th>
        <th>Remove</th>
    </tr>
<?php $id = 0; foreach ($resultset as $row) :
    $id++;

    $title = ($row->type == "post" ? sprintf('<a href="%s">%s</a>', $this->di->get("url")->create("blog/{$row->slug}"), $row->title) : sprintf('<a href="%s">%s</a>', $this->di->get("url")->create("blog/page/{$row->path}"), $row->title));
    ?>

    <tr>
        <td><?= $row->id ?></td>
        <td><?= $title ?></td>
        <td><?= $row->type ?></td>
        <td><?= $row->published ?></td>
        <td><?= $row->created ?></td>
        <td><?= $row->updated ?></td>
        <td><?= $row->deleted ?></td>
        <td><a href="<?= $this->di->get("url")->create("blog/edit/{$row->id}") ?>">Edit</a></td>
        <td><a href="<?= $this->di->get("url")->create("blog/remove/{$row->id}") ?>">Remove</a></td>
    </tr>
<?php endforeach; ?>
</table>
