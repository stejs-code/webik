<h1>Barva pozadí</h1>

<?php

$color = $_GET['color'] ?? 'red';

?>

<style>
    body {
        background-color:
            <?php echo $color; ?>
        ;
    }

    .tm-mavigation {
        background-color: rgba(255, 255, 255, 0.4);
    }
</style>

<form action="">
    <input type="radio" id="red" name="color" value="red" <?= $color == 'red' ? 'checked' : '' ?>>
    <label for="red">Červená</label>
    <input type="radio" id="green" name="color" value="green">
    <label for="green">Zelená</label>
    <input type="radio" id="blue" name="color" value="blue">
    <label for="blue">Modrá</label>
    <button variant="primary" class="ml-2" type="submit">Změnit barvu</button>
</form>