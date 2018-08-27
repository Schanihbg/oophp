<?php
require "header.php";
?>

<form method="get">
    <fieldset>
    <legend>Sök via år</legend>
    <p>
        <label>Skapad mellan: 
        <input type="number" name="year1" value="<?= $year1 ?: 1900 ?>" min="1900" max="2100"/>
        - 
        <input type="number" name="year2" value="<?= $year2  ?: 2100 ?>" min="1900" max="2100"/>
        </label>
    </p>
    <p>
        <input type="submit" name="doSearch" value="Search">
    </p>
    </fieldset>
</form>

<?php
require "show-all.php";
?>
