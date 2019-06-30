<?php
require "header.php";
?>

<form method="post">
    <fieldset>
    <legend>Lägg till</legend>

    <p>
        <label>Titel:<br> 
        <input type="text" name="contentTitle" value="" autocomplete="off" required/>
        </label>
    </p>

    <p>
        <input type="submit" name="add" value="Save">
        <input type="reset" value="Reset">
    </p>
    </fieldset>
</form>
