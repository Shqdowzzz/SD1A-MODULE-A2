<?php
$diameter = "";
$omtrek = null;
$oppervlakte = null;
$fout = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $diameter = str_replace(",", ".", trim($_POST["diameter"] ?? ""));

    if ($diameter === "" || !is_numeric($diameter) || (float)$diameter <= 0) {
        $fout = "Vul een geldig getal groter dan 0 in.";
    } else {
        $diameter = (float)$diameter;
        $straal = $diameter / 2;

        $omtrek = 2 * pi() * $straal;
        $oppervlakte = pi() * pow($straal, 2);
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cirkel berekenen</title>
</head>
<body>

    <h1>Cirkel berekenen</h1>

    <form method="post">
        <label for="diameter">Voer de diameter van de cirkel in:</label>
        <input
            type="number"
            id="diameter"
            name="diameter"
            step="any"
            min="0.01"
            required
            value="<?= htmlspecialchars((string)$diameter) ?>"
        >
        <button type="submit">Bereken</button>
    </form>

    <?php if ($fout !== ""): ?>
        <p><?= htmlspecialchars($fout) ?></p>
    <?php endif; ?>

    <?php if ($omtrek !== null && $oppervlakte !== null): ?>
        <h2>Resultaten</h2>
        <p>Diameter: <?= $diameter ?></p>
        <p>Straal: <?= round($diameter / 2, 2) ?></p>
        <p>Omtrek: <?= round($omtrek, 2) ?></p>
        <p>Oppervlakte: <?= round($oppervlakte, 2) ?></p>
    <?php endif; ?>

</body>
</html>