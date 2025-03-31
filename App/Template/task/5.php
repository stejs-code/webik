<h1>Nakresli čtverec nebo kruh</h1>

<form method="get">
    <p>Výběr obrazce:</p>
    <input type="radio" name="tvar" value="kruh" checked> kruh
    <input type="radio" name="tvar" value="ctverec"> čtverec
    <br><br>

    <label>Poloměr kruhu / polovina úhlopříčky čtverce:</label>
    <input type="number" name="velikost" value="100" required>
    <br><br>

    <label>Výběr barvy obrazce:</label>
    <select name="barva">
        <option value="red">Červená</option>
        <option value="green">Zelená</option>
        <option value="blue">Modrá</option>
        <option value="yellow">Žlutá</option>
        <option value="orange">Oranžová</option>
        <option value="purple">Fialová</option>
        <option value="pink">Růžová</option>
        <option value="black">Černá</option>
    </select>
    <br><br>

    <label>Vlastní barva:</label>
    <input type="color" name="vlastni_barva">
    <br><br>

    <button type="submit" variant="primary" class="mb-4">Vykresli!</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $tvar = $_GET["tvar"] ?? "kruh";
    $velikost = $_GET["velikost"] ?? 100;
    $barva = $_GET["barva"] ?? "red";

    // Použij vlastní barvu, pokud byla zadána
    if (!empty($_GET["vlastni_barva"])) {
        $barva = $_GET["vlastni_barva"];
    }

    // Začátek SVG
    $svg_content = '<?xml version="1.0" encoding="UTF-8" standalone="no"?>';
    $svg_content .= '<svg width="400" height="400" xmlns="http://www.w3.org/2000/svg">';

    if ($tvar == "kruh") {
        $svg_content .= sprintf(
            '<circle cx="%d" cy="%d" r="%d" fill="%s" stroke="black"/>',
            200,
            200,
            $velikost,
            $barva
        );
    } else {

        $strana = round($velikost * sqrt(2));
        $x = 200 - $strana / 2;
        $y = 200 - $strana / 2;
        $svg_content .= sprintf(
            '<rect x="%d" y="%d" width="%d" height="%d" fill="%s" stroke="black"/>',
            $x,
            $y,
            $strana,
            $strana,
            $barva
        );
    }

    $svg_content .= '</svg>';

    echo '<h2>Vykreslení obrazce</h2>';
    echo $svg_content;


}
?>