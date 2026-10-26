
<?php

$pizza = "";
$extraOlijven = false;
$extraKaas = false;
$bezorgen = false;
$totaal = 0;
$resultaat = "";

$pizzaPrijzen = [
    "margherita" => 10.00,
    "salami" => 12.50,
    "hawai" => 13.50
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["pizza"]) && isset($pizzaPrijzen[$_POST["pizza"]])) {
        $pizza = $_POST["pizza"];
        $totaal = $pizzaPrijzen[$pizza];

        $extraOlijven = isset($_POST["olijven"]);
        $extraKaas = isset($_POST["kaas"]);
        $bezorgen = isset($_POST["bezorgen"]);

        $resultaat = "Pizza: " . ucfirst($pizza) . "<br>";

        if ($extraOlijven) {
            $totaal += 2.50;
            $resultaat .= "Olijven: € 2,50<br>";
        }

        if ($extraKaas) {
            $totaal += 1.50;
            $resultaat .= "Extra kaas: € 1,50<br>";
        }

        if ($bezorgen) {
            $totaal += 3.50;
            $resultaat .= "Bezorging: € 3,50<br>";
            $resultaat .= "Je bestelling wordt bezorgd.<br>";
        } else {
            $resultaat .= "Je haalt de bestelling zelf op.<br>";
        }

        $resultaat .= "Totaalprijs: € " . number_format($totaal, 2, ",", ".");
    } else {
        $resultaat = "Kies een geldige pizza.";
    }
}

?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizzeria Circulare Delicioso</title>
</head>
<body>

<h1>Pizzeria Circulare Delicioso</h1>

<h2>Onze pizza's</h2>

<img src="images/margherita.jpg" alt="Margherita pizza" width="200">
<p>Margherita - € 10,00</p>

<img src="images/salami.jpg" alt="Salami pizza" width="200">
<p>Salami - € 12,50</p>

<img src="images/hawai.jpg" alt="Hawaï pizza" width="200">
<p>Hawaï - € 13,50</p>

<h2>Plaats je bestelling</h2>

<form method="post" action="">
    <label for="pizza">Kies je pizza:</label>

    <select name="pizza" id="pizza" required>
        <option value="">Kies een pizza</option>
        <option value="margherita" <?php if ($pizza == "margherita") echo "selected"; ?>>Margherita (€ 10,00)</option>
        <option value="salami" <?php if ($pizza == "salami") echo "selected"; ?>>Salami (€ 12,50)</option>
        <option value="hawai" <?php if ($pizza == "hawai") echo "selected"; ?>>Hawaï (€ 13,50)</option>
    </select>

    <br><br>

    <input type="checkbox" name="olijven" id="olijven" <?php if ($extraOlijven) echo "checked"; ?>>
    <label for="olijven">Extra olijven (€ 2,50)</label>

    <br>

    <input type="checkbox" name="kaas" id="kaas" <?php if ($extraKaas) echo "checked"; ?>>
    <label for="kaas">Extra kaas (€ 1,50)</label>

    <br>

    <input type="checkbox" name="bezorgen" id="bezorgen" <?php if ($bezorgen) echo "checked"; ?>>
    <label for="bezorgen">Bezorgen (€ 3,50)</label>

    <br><br>

    <button type="submit">Bestellen</button>
</form>

<?php if ($resultaat != "") { ?>
    <h2>Jouw bestelling</h2>
    <p><?php echo $resultaat; ?></p>
<?php } ?>

</body>
</html>
