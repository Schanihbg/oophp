<?php
require "header.php";
?>

<form method="get">
    <fieldset>
    <legend>Sök via titel</legend>
    <p>
        <label>Titel (Använd % för att söka liknande):
            <input type="search" name="searchTitle" value="<?= esc($searchTitle) ?>" autocomplete="off"/>
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
