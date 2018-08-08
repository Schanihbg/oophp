<h1>Starta nytt spel</h1>
<p>Endast två spelare, du mot datorn</p>

<form method="POST" action="<?= $this->di->get("url")->create("dice/register") ?>">
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <label class="input-group-text" for="numberOfDicesLabel">Tärningar</label>
        </div>
        <select name="numberOfDices" class="custom-select" id="numberOfDicesLabel">
            <option value="1" selected>1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
        </select>
    </div>

    <input type="hidden" name="gameStatus" value="new">
    <div class="input-group mb-3">
        <button type="submit" class="btn btn-success" value="start">Start</button>
    </div>
</form>
