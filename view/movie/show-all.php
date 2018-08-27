<?php
if (!$resultset) {
    return;
}
?>

<table class="table table-striped">
    <a href="<?= $this->di->get("url")->create("movie/add") ?>">Lägg till film</a>
    <thead class="thead-light">
        <th>#</th>
        <th>Bild</th>
        <th>Titel</th>
        <th>År</th>
        <th>Ändra</th>
        <th>Ta bort</th>
    </thead>
<?php $id = 0; foreach ($resultset as $row) :
    $id++;
?>
    <tr>
        <td><?= $id ?></td>
        <td><img src='<?= $this->di->get("url")->create("image/{$row->image}?w=100") ?>'></td>
        <td><?= $row->title ?></td>
        <td><?= $row->year ?></td>
        <td><a href="<?= $this->di->get("url")->create("movie/edit/{$row->id}") ?>">Ändra</a></td>
        <td><a href="<?= $this->di->get("url")->create("movie/remove/{$row->id}") ?>">Ta bort</a></td>
    </tr>
<?php endforeach; ?>
</table>
