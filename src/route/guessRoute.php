<?php
namespace Schanihbg\Guess;

/**
 * Guess specific routes.
 */

/**
 * Guess, index.
 */
$app->router->get("gissa", function () use ($app) {
    $data = [
        "title" => "Losningen | Guess games",
    ];

    $app->view->add("guess/index", $data);

    $app->page->render($data);
});

$app->router->get("gissa/get", function () use ($app) {
    $title = "Losningen | Guess games (GET)";
    $answer = "";

    if (isset($_GET['savedValue']) && isset($_GET['savedGuesses'])) {
        $savedValue = $_GET['savedValue'];
        $savedGuesses = $_GET['savedGuesses'];
        $guess = new Guess($savedValue, $savedGuesses);
    } else {
        $guess = new Guess();
        $savedValue = $guess->number();
        $savedGuesses = $guess->tries();
    }

    if (isset($_GET['guessValue'])) {
        if ($guess->tries() == 0) {
            $answer = "<p>You can not guess anymore.</p>";
        } elseif ($guess->tries() > 0) {
            $answer = "<p> Your guess " .
                $_GET['guessValue'] . " is " .
                $guess->makeGuess($_GET['guessValue']) . ".</p>";
            $savedGuesses = $guess->tries();
        }
    }

    $data = [
        "title" => $title,
        "savedValue" => $savedValue,
        "savedGuesses" => $savedGuesses,
        "guess" => $guess,
        "answer" => $answer,
    ];

    $app->view->add("guess/index_get", $data);

    $app->page->render($data);
});

$app->router->any(["GET", "POST"], "gissa/post", function () use ($app) {
    $title = "Losningen | Guess games (POST)";
    $answer = "";

    if (isset($_POST['savedValue']) && isset($_POST['savedGuesses'])) {
        $savedValue = $_POST['savedValue'];
        $savedGuesses = $_POST['savedGuesses'];
        $guess = new Guess($savedValue, $savedGuesses);
    } else {
        $guess = new Guess();
        $savedValue = $guess->number();
        $savedGuesses = $guess->tries();
    }

    if (isset($_POST['guessValue'])) {
        if ($guess->tries() == 0) {
            $answer = "<p>You can not guess anymore.</p>";
        } elseif ($guess->tries() > 0) {
            $answer = "<p> Your guess " .
                $_POST['guessValue'] . " is " .
                $guess->makeGuess($_POST['guessValue']) . ".</p>";
            $savedGuesses = $guess->tries();
        }
    }

    $data = [
        "title" => $title,
        "savedValue" => $savedValue,
        "savedGuesses" => $savedGuesses,
        "guess" => $guess,
        "answer" => $answer,
    ];

    $app->view->add("guess/index_post", $data);

    $app->page->render($data);
});

$app->router->any(["GET", "POST"], "gissa/session", function () use ($app) {
    $title = "Losningen | Guess games (SESSION)";
    $answer = "";

    $session = new \Anax\Session\Session();
    $session->name("losningen-session");
    $session->start();

    if (isset($_GET["reset"])) {
        $session->destroy("index_session.php");
    }

    if ($session->get("savedValue") !== null && $session->get("savedGuesses") !== null) {
        $savedValue = $session->get("savedValue");
        $savedGuesses = $session->get("savedGuesses");
        $guess = new Guess($savedValue, $savedGuesses);
    } else {
        $guess = new Guess();
        $savedValue = $guess->number();
        $savedGuesses = $guess->tries();
    }

    if (isset($_POST['guessValue'])) {
        $session->set("guessValue", $_POST['guessValue']);
        if ($guess->tries() == 0) {
            $answer = "<p>You can not guess anymore.</p>";
        } elseif ($guess->tries() > 0) {
            $answer = "<p> Your guess " .
                $session->get("guessValue") . " is " .
                $guess->makeGuess($session->get("guessValue")) . ".</p>";
            $savedGuesses = $guess->tries();
        }
    }

    $session->set("savedValue", $savedValue);
    $session->set("savedGuesses", $savedGuesses);


    $data = [
        "title" => $title,
        "savedValue" => $savedValue,
        "savedGuesses" => $savedGuesses,
        "guess" => $guess,
        "answer" => $answer,
        "session" => $session,
    ];

    $app->view->add("guess/index_session", $data);

    $app->page->render($data);
});
