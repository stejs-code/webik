<?php

use App\Module\Task;

$tvar ??= $_GET["tvar"] ?? "kruh";
$velikost ??= $_GET["velikost"] ?? 100;
$barva ??= $_GET["barva"] ?? "#000000";
?>
<h1>Nakresli čtverec nebo kruh</h1>

<form method="get">
    <p>Výběr obrazce:</p>
    <input type="radio" name="tvar" value="kruh" <?php echo $tvar === 'kruh' ? 'checked' : ''; ?>> kruh
    <input type="radio" name="tvar" value="ctverec" <?php echo $tvar === 'ctverec' ? 'checked' : ''; ?>> čtverec
    <br><br>

    <label>Poloměr kruhu / polovina úhlopříčky čtverce:</label>
    <input type="number" name="velikost" value="<?php echo $velikost; ?>" required>
    <br><br>

    <label>Barva obrazce:</label>
    <input type="color" name="barva" value="<?php echo $barva; ?>">
    <br><br>

    <button type="submit" variant="primary" class="mb-4">Vykresli!</button>
    <a variant="primary"
        href="<?= $_SERVER['REQUEST_URI'] . (strpos($_SERVER['REQUEST_URI'], '?') !== false ? '&' : '?') . 'file=true' ?>">
        Stáhnout SVG soubor
    </a>
</form>

<h2>Vykreslení obrazce</h2>

<?= Task::renderSvg(); ?>