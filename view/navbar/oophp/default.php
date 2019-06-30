<?php

namespace Anax\View;

/**
 * Template file to render a view.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

$navbar = [
    "items" => [
        "home" => [
            "title" => "Hem",
            "route" => "",
        ],
        "report" => [
            "title" => "Redovisning",
            "route" => "redovisning",
        ],
        "about" => [
            "title" => "Om",
            "route" => "om",
        ],
        "guess" => [
            "title" => "Gissa",
            "route" => "gissa",
        ],
        "dice" => [
            "title" => "Tärning",
            "route" => "dice",
        ],
        "movie" => [
            "title" => "Filmer",
            "route" => "movie",
        ],
        "blog" => [
            "title" => "Blogg",
            "route" => "blog",
        ],
        "playground" => [
            "title" => "Lek",
            "route" => "lek",
        ],
        "debug" => [
            "title" => "Debug",
            "route" => "debug",
        ],
    ]
];
?>

<div class="container">
<div class="header">
    <nav class="navbar navbar-dark bg-dark navbar-expand-md rounded">
        <a class="navbar-brand" href="<?= url("") ?>">Lösningen</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#containerNavbar" aria-controls="containerNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="containerNavbar">
            <ul class="navbar-nav mr-auto">
                <?php
                foreach ($navbar["items"] as $key) {
                    echo '<li class="nav-item">';
                    echo '<a class="nav-link ' . ($di->get("request")->getRoute() == $key["route"] ? "active" : "") . '" href="' . $di->get("url")->create($key["route"]) . '">' . $key["title"] . '</a>';
                    echo '</li>';
                }
                ?>
            </ul>
        </div>
    </nav>
</div>
