<?php

$mesic = date('F', time())

    ?>

<h1>Ahoj, <?= $mesic; ?></h1>

<p>
    <?php
    if ($mesic == "July") {
        echo "Protože je červenec, tak je hrozné horko.";
    } else {
        echo "Jelikož není červenec, tak není zas takové horko.";
    }
    ?>
</p>
<p style="font-family: monospace;">

    <?php
    $i = 0;
    while ($i < 10) {
        echo "abc ";
        $i++;
    }
    echo "<br>";

    $i = 0;
    do {
        echo "def ";
        $i++;
    } while ($i < 10);
    echo "<br>";
    for ($i = 0; $i < 10; $i++) {
        echo $i;
    }
    ?>
</p>

<ol>
    <?php
    $alphabet = range('A', 'Z');
    $i = 0;
    while ($i < 6) {
        ?>

        <li><?= $alphabet[$i]; ?></li>

        <?php
        $i++;
    }
    ?>
</ol>


<ul>
    <?php

    $i = 1;
    while ($i <= 12) {
        ?>

        <li><?= $i; ?> * <?= $i; ?> = <?= $i * $i; ?></li>

        <?php
        $i++;
    }
    ?>
</ul>

<table>
    <tbody>
        <?php
        for ($i = 0; $i < 10; $i++) {
            ?>

            <tr>
                <?php
                for ($j = 0; $j < 10; $j++) {
                    ?>
                    <td><?= ($j + 1) * ($i + 1); ?></td>
                    <?php
                }
                ?>
            </tr>

            <?php
        }
        ?>
    </tbody>
</table>