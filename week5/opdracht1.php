<?php
include __DIR__ . "/functies.php";

$tekst = "";
$versleuteld = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tekst = $_POST["tekst"];
    $versleuteld = versleutel($tekst);
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Geheimschrift</title>
</head>
<body>

<h1>Mijn geheimschrift</h1>

<p>a → b, b → d, c → f</p>

<form method="post">
    <label>Voer tekst in:</label>
    <input type="text" name="tekst">
    <button type="submit">Versleutel</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<p>Originele tekst: " . htmlspecialchars($tekst) . "</p>";
    echo "<p>Versleutelde tekst: " . htmlspecialchars($versleuteld) . "</p>";
}
?>

</body>
</html>
