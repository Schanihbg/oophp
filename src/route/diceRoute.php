<?php
/**
 * Dice game specific routes.
 */

namespace Schanihbg\Dice;

/**
 * Dice Main game.
 */
$app->router->any(["GET", "POST"], "dice", function () use ($app) {
    $session = $app->session;

    if ($session->get("gameStatus") == "new") {
        $player = new DiceHand(1);
        $computer = new DiceHand(1);
    } else {
        $player = new DiceHand($session->get("numberOfDices"));
        $computer = new DiceHand($session->get("numberOfDices"));
    }

    $histogramPlayer = new Histogram();
    $histogramComputer = new Histogram();

    $data = [
        "title" => "Losningen | Tärningsspel 100",
        "session" => $session,
        "player" => $player,
        "histogramPlayer" => $histogramPlayer,
        "computer" => $computer,
        "histogramComputer" => $histogramComputer,
    ];

    $app->view->add("dice/game", $data);

    $app->page->render($data);
});

/**
 * Dice New game.
 */
$app->router->any(["GET", "POST"], "dice/new", function () use ($app) {
    $session = $app->session;

    $data = [
        "title" => "Losningen | Tärningsspel 100",
        "session" => $session,
    ];

    $app->view->add("dice/new", $data);

    $app->page->render($data);
});

/**
 * Dice Register game.
 */
$app->router->post("dice/register", function () use ($app) {
    $session = $app->session;

    $data = [
        "title" => "Losningen | Tärningsspel 100",
    ];

    $session->set("numberOfDices", $app->request->getPost("numberOfDices"));
    $session->set("gameStatus", $app->request->getPost("gameStatus"));

    $app->response->redirect($app->url->create("dice"));
});

/**
 * Dice Reset game.
 */
$app->router->get("dice/reset", function () use ($app) {
    $session = $app->session;

    $data = [
        "title" => "Losningen | Tärningsspel 100",
    ];

    $session->delete("player");
    $session->delete("computer");
    $session->delete("numberOfDices");
    $session->delete("gameStatus");
    $session->delete("turnScore");
    $session->delete("turnDices");
    $session->delete("playTurn");

    $app->response->redirect($app->url->create("dice/new"));
});
