<?php
namespace Schanihbg\Dice;

if ($this->di->get("request")->getPost("gameStatus") == "game") {
    $session->set("player", $player);
    $session->set("computer", $computer);
} elseif ($session->get("gameStatus") == "game") {
    $player = $session->get("player");
    $computer = $session->get("computer");

    $histogramPlayer->injectData($player);
    $histogramComputer->injectData($computer);

    $player->roll();
}

// Save player score
if ($session->get("gameStatus") == "game") {
    if ($this->di->get("request")->getPost("playerAction") == "save") {
        $player->setScore($player->getScore() + $this->di->get("request")->getPost("playerRoundScore"));
        $player->addAllTurns(json_decode($this->di->get("request")->getPost("playerTurnDiceValues")));
        $session->set("playTurn", "computer");
        $this->di->get("response")->redirect($this->di->get("url")->create("dice"));
    }

    if ($this->di->get("request")->getPost("playerAction") == "continue" || $this->di->get("request")->getPost("changeTurn")) {
        $player->addAllTurns(json_decode($this->di->get("request")->getPost("playerTurnDiceValues")));
    }
}

// Score is over 100, someone won.
if ($session->get("gameStatus") == "game" && ($player->getScore() >= 100 || $computer->getScore() >= 100)) {
    $session->set("gameStatus", "end");
}

if ($session->get("gameStatus") == "game" && $this->di->get("request")->getPost("changeTurn") == "change") {
    if ($session->get("playTurn") == "player") {
        $session->set("playTurn", "computer");
    } elseif ($session->get("playTurn") == "computer") {
        $session->set("playTurn", "player");
    }

    $this->di->get("response")->redirect($this->di->get("url")->create("dice"));
}

if ($this->di->get("request")->getPost("gameStatus") == "pre") {
    $session->set("gameStatus", $this->di->get("request")->getPost("gameStatus"));
} elseif ($this->di->get("request")->getPost("gameStatus") == "game" && $this->di->get("request")->getPost("playTurn")) {
    $session->set("gameStatus", $this->di->get("request")->getPost("gameStatus"));
    $session->set("playTurn", $this->di->get("request")->getPost("playTurn"));
}
?>

<?php if ($session->has("numberOfDices")) : ?>
    <h1>Du mot datorn i tärningsspel</h1>

    <!-- New game -->
    <?php if ($session->get("gameStatus") == "new") : ?>
        <p>Klicka på knappen för att se vem som startar</p>
        <form method="POST">
            <input type="hidden" name="gameStatus" value="pre">
            <div class="input-group mb-3">
                <button type="submit" class="btn btn-success" value="start">Rulla en tärning</button>
            </div>
        </form>
    <?php endif; ?>

    <!-- See who will begin the game -->
    <?php if ($session->get("gameStatus") == "pre") : ?>
        <p>Du slog: <?= $player->values()[0] ?></p>
        <p>Dator slog: <?= $computer->values()[0] ?></p>

        <?php
        $starter = null;
        $starterText = null;

        if ($player->values()[0] == $computer->values()[0]) {
            $this->di->get("response")->redirect($this->di->get("url")->create("dice"));
        } elseif ($player->values()[0] < $computer->values()[0]) {
            $starter = "computer";
            $starterText = "Dator";
        } elseif ($player->values()[0] > $computer->values()[0]) {
            $starter = "player";
            $starterText = "Du";
        }
        ?>

        <p><?= $starterText ?> börjar spelet.</p>

        <form method="POST">
            <input type="hidden" name="gameStatus" value="game">
            <input type="hidden" name="playTurn" value="<?= $starter ?>">

            <div class="input-group mb-3">
                <button type="submit" class="btn btn-success" value="start">Börja spelet</button>
            </div>
        </form>
    <?php endif; ?>

    <!-- Game play -->
    <?php if ($session->get("gameStatus") == "game") : ?>
        <div class="d-flex flex-row">
            <div class="flex-fill">
                <h4>Du</h4>

                <p>Din poäng: <?= $player->getScore() ?></p>
                <pre><?= $histogramPlayer->getAsText() ?></pre>
                <div class="d-flex flex-row">
                    <div>
                        <p class="dice">
                        <?php foreach ($player->values() as $value) : ?>
                            <i class="dice-<?= $value ?>"></i>
                        <?php endforeach; ?>
                        </p>
                    </div>
                </div>
                <?php if ($session->get("playTurn") == "player") : ?>
                    <?php if (in_array(1, $player->values())) : ?>
                        <p>Du fick en 1:a, inga poäng sparas.</p>
                        <form method="POST">
                            <input type="hidden" name="playerTurnDiceValues" value="<?= json_encode($player->values()) ?>">
                            <div class="input-group mb-3">
                                <button name="changeTurn" type="submit" class="btn btn-success" value="change">Låt datorn spela</button>
                            </div>
                        </form>
                    <?php else : ?>
                        <p>Poäng denna rundan: <?= $player->sum() ?>.</p>

                        <form method="POST">
                            <input type="hidden" name="playerTurnDiceValues" value="<?= json_encode($player->values()) ?>">
                            <input type="hidden" name="playerRoundScore" value="<?= $player->sum() ?>">

                            <div class="input-group mb-3">
                                <button name="playerAction" type="submit" class="btn btn-success" value="save">Spara poäng</button>
                                <button name="playerAction" type="submit" class="btn btn-warning" value="continue">Kasta igen</button>
                            </div>
                        </form>
                    <?php endif; ?>
                <?php elseif ($session->get("playTurn") == "computer") : ?>
                    <?php
                        $computer = $computer->computerPlayRound($computer->getScore());

                        $session->set("computer", $computer);
                        $session->set("playTurn", "player");
                        $this->di->get("response")->redirect($this->di->get("url")->create("dice"));
                    ?>
                <?php endif; ?>
            </div>

            <div class="flex-fill">
                <h4>Dator</h4>

                <p>Dator poäng: <?= $computer->getScore() ?></p>
                <pre><?= $histogramComputer->getAsText() ?></pre>
            </div>
        </div>
    <?php endif; ?>

    <!-- Game won -->
    <?php if ($session->get("gameStatus") == "end") : ?>
        <?php
        $winner = "Dator";
        if ($player->getScore() > $computer->getScore()) {
            $winner = "Du";
        }
        ?>
        <p>Spelet är över!</p>
        <p>Vinnaren är: <?= $winner ?>!</p>
    <?php endif; ?>

    <hr>

    <div class="input-group mb-3">
        <a href="<?= $this->di->get("url")->create("dice/reset") ?>"><button type="button" class="btn btn-link">Starta nytt spel</button></a>
    </div>
<?php else : ?>
    <?= $this->di->get("response")->redirect($this->di->get("url")->create("dice/new")); ?>
<?php endif; ?>
