<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php

    $polomer = intval($_POST["polomer"]); // px
    $barva = ($_POST["barva"]);

    ?>

    <svg height="<?= $polomer * 2 ?>" width="<?= $polomer * 2 ?>" xmlns="http://www.w3.org/2000/svg">
        <circle r="<?= $polomer ?>" cx="<?= $polomer ?>" cy="<?= $polomer ?>" fill="<?= $barva ?>"></circle>
    </svg>

    <?php
    echo "<br>";
    $strana = sqrt(($polomer * $polomer) / 2);
    ?>


    <svg width="<?= $strana ?>" height="<?= $strana ?>" xmlns="http://www.w3.org/2000/svg">
        <rect width="<?= $strana ?>" height="<?= $strana ?>" x="0" y="0"
            style="fill:<?= $barva ?>;stroke-width:1;stroke:black" />
    </svg>

</body>

</html>