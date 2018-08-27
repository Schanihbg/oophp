<?php
require "header.php";
?>

<form method="post">
    <fieldset>
    <legend>Ändra</legend>
    <input type="hidden" name="movieId" value="<?= $movie->id ?>"/>

    <p>
        <label>Title:<br> 
        <input type="text" name="movieTitle" value="<?= $movie->title ?>" autocomplete="off" required/>
        </label>
    </p>

    <p>
        <label>Year:<br> 
        <input type="number" name="movieYear" value="<?= $movie->year ?>" autocomplete="off" required/>
    </p>

    <p>
        <label>Image:<br> 
        <input type="text" name="movieImage" value="<?= $movie->image ?>" autocomplete="off" required/>
        </label>
    </p>

    <p>
        <input type="submit" name="doSave" value="Save">
        <input type="reset" value="Reset">
    </p>
    </fieldset>
</form>
