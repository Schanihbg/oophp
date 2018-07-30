<?php
require "header.php";
?>

<?= $answer ?>
<p>Guess a number between 1 and 100, you have <?= $savedGuesses; ?> tries left.</p>

<form method="POST">
    <input type="hidden" name="savedValue" value="<?= $savedValue ?>">
    <input type="hidden" name="savedGuesses" value="<?= $savedGuesses ?>">
    <input type="number" name="guessValue" min="1" max="100" required />
    <input type="submit"/>
</form>

<a href="?reset">Reset game</a>
