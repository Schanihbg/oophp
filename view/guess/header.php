<h4>Navigation</h4>
<ul>
    <li><a href="<?= $this->di->get("url")->create("gissa") ?>">Index</a></li>
    <li><a href="<?= $this->di->get("url")->create("gissa/get") ?>">Index-get</a></li>
    <li><a href="<?= $this->di->get("url")->create("gissa/post") ?>">Index-post</a></li>
    <li><a href="<?= $this->di->get("url")->create("gissa/session") ?>">Index-session</a></li>
</ul>
<?php

if (basename($_SERVER['PHP_SELF']) !== "index.php") {
    echo "<h1>".$title."</h1>";
}
