<?php
    require("header.php");
    $textfilter = new \Schanihbg\TextFilter\MyTextFilter();
    $text = $textfilter->parse($content->data, ["bbcode","markdown","link"]);
?>

<article>
    <header>
        <h1><?= esc($content->title) ?></h1>
        <p><i>Latest update: <time datetime="<?= esc($content->modified_iso8601) ?>" pubdate><?= esc($content->modified) ?></time></i></p>
    </header>
    <?= $text->text ?>
</article>
