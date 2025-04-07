<?php


function renderItem(string $name, string $label, int $price, bool $checked = false)
{
    ?>
    <div class="flex gap-x-2">
        <input type="checkbox" name="<?= $name ?>" id="<?= $name ?>" class="focus:ring-0" <?= $checked ? "checked" : "" ?>>
        <label for="<?= $name ?>"><?= $label ?></label>

        <span class="flex-1 border-dotted  border-gray-500 border-b-2">

        </span>

        <span><?= $price ?> Kč</span>
    </div>


    <?php
}

?>

<h1 class="">Jídelna</h1>
<h2 class="mb-4">Objednej si jídlo</h2>
<form action="" method="get">
    <div class="flex flex-col gap-2">

        <? foreach ($menu as $item) { ?>
            <? renderItem($item["name"], $item["label"], $item["price"], isset($order[$item["name"]])) ?>
        <? } ?>
    </div>
    <button class="mt-4" type="submit" variant="primary">Objednat</button>
</form>


<h2 class="mt-8">Tvá objednávka</h2>

<ul class="list-disc list-inside my-4">

    <? foreach ($order as $item) { ?>

        <li class="">
            <span><?= $item["label"] ?> (<?= $item["price"] ?> Kč)</span>
        </li>
    <? } ?>
</ul>
<p>Celková cena: <?= $total ?> Kč</p>