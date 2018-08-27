<?php
require "header.php";
?>

<form method="post">
    <fieldset>
    <legend>Ändra</legend>

    <p>
        <label>Titel:<br> 
        <input type="text" name="movieTitle" value="" autocomplete="off" required/>
        </label>
    </p>

    <p>
        <label>År:<br> 
        <input type="number" name="movieYear" value="" autocomplete="off" required/>
    </p>

    <p>
        <label>Bild:<br> 
        <input type="text" name="movieImage" value="noimage.png" autocomplete="off" required/>
        </label>
    </p>

    <p>
        <input type="submit" name="add" value="Save">
        <input type="reset" value="Reset">
    </p>
    </fieldset>
</form>
