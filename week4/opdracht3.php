<?php
$pizzaPrijzen = [
    "margherita" => 10,
    "salami" => 12.50,
    "hawai" => 13.50
];

if (isset($_POST["pizza"]) && isset($pizzaPrijzen[$_POST["pizza"]])) {
    $pizza = $_POST["pizza"];
    $totaal = $pizzaPrijzen[$pizza];

    echo "<h2>Jouw bestelling</h2>";
    echo "Pizza: " . ucfirst($pizza) . "<br>";

    if (isset($_POST["olijven"])) {
        $totaal += 2.50;
        echo "Extra olijven: € 2,50<br>";
    }

    if (isset($_POST["kaas"])) {
        $totaal += 1.50;
        echo "Extra kaas: € 1,50<br>";
    }

    if (isset($_POST["bezorgen"])) {
        $totaal += 3.50;
        echo "Bezorging: € 3,50<br>";
    } else {
        echo "Zelf ophalen<br>";
    }

    echo "Totaalprijs: € " . number_format($totaal, 2, ",", ".");
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Pizzeria</title>
</head>
<body>

<h1>Pizzeria</h1>

<h2>Onze pizza's</h2>

<img src="images/margherita.jpg" width="200" alt="Margherita pizza">
<p>Margherita - € 10,00</p>

<img src="images/salami.jpg" width="200" alt="Salami pizza">
<p>Salami - € 12,50</p>

<img src="images/hawai.jpg" width="200" alt="Hawaï pizza">
<p>Hawaï - € 13,50</p>

<h2>Plaats je bestelling</h2>

<form method="post">
    <label>Kies je pizza:</label>
    <select name="pizza">
        <option value="margherita">Margherita (€ 10,00)</option>
        <option value="salami">Salami (€ 12,50)</option>
        <option value="hawai">Hawaï (€ 13,50)</option>
    </select>

    <br><br>

    <input type="checkbox" name="olijven">Extra olijven (€ 2,50)
    <br>
    <input type="checkbox" name="kaas">Extra kaas (€ 1,50)
    <br>
    <input type="checkbox" name="bezorgen">Bezorgen (€ 3,50)

    <br><br>
    <button type="submit">Bestellen</button>
</form>

</body>
</html>


