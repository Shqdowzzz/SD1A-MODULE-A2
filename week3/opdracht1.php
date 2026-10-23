<?php
$prijs = 12;
$resultaat = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $leeftijd = (int) $_POST["leeftijd"];

    if ($leeftijd < 0) {
        $resultaat = "Ongeldige leeftijd.";
    } elseif ($leeftijd < 3) {
        $prijs = 0;
        $resultaat = "Je mag gratis mee!";
    } elseif ($leeftijd <= 16) {
        $prijs = 12 * 0.5;
        $resultaat = "Je krijgt 50% korting.";
    } elseif ($leeftijd >= 65) {
        $prijs = 12 * 0.75;
        $resultaat = "Je krijgt 25% korting.";
    } else {
        $prijs = 12;
        $resultaat = "Je betaalt de standaardprijs.";
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Boottocht op de Seine</title>
</head>
<body>

    <h1>Boottocht op de Seine</h1>

    <form method="post">
        <label for="leeftijd">Vul je leeftijd in:</label>
        <input type="number" id="leeftijd" name="leeftijd"
               min="0" required>
        <button type="submit">Bereken prijs</button>
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] === "POST"): ?>
        <h2><?php echo htmlspecialchars($resultaat); ?></h2>

        <?php if ((int) $_POST["leeftijd"] >= 0): ?>
            <p>Ticketprijs: € <?php echo number_format($prijs, 2, ',', '.'); ?></p>
        <?php endif; ?>
    <?php endif; ?>

</body>
</html>