<h1>Výpočet obsahu a obvodu kruhu</h1>

<?php

$display = isset($_GET['radius']);
$radius = intval($_GET['radius'] ?? 0);

$area = round($radius * $radius * pi(), 2);
$circumference = round(2 * $radius * pi(), 2);

?>


<? if ($display) { ?>
    <div>
        <p>Obsah kruhu je <?= $area ?>cm²</p>
        <p>Obvod kruhu je <?= $circumference ?>cm</p>
    </div>
<? } ?>

<form action="<?= $task['url'] ?>" method="get">

    <input type="text" name="radius" value="<?= $radius ?>" placeholder="Poloměr kruhu" class="mr-2">
    <button variant="primary" type="submit">Vypočítat</button>

</form>