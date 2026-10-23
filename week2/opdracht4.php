<?php
$aantalkeer = 0;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $aantalkeer = (int) $_POST["aantalkeer"];
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Sterretjes</title>
</head>
<body>

    <h1>Sterretjes maken</h1>

    <form method="post">
        <label for="aantalkeer">Hoeveel regels met sterretjes?</label>
        <input type="number" id="aantalkeer" name="aantalkeer"
               min="1" max="100" required>
        <button type="submit">Toon sterretjes</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if ($aantalkeer >= 1 && $aantalkeer <= 100) {
            for ($i = 1; $i <= $aantalkeer; $i++) {
                echo str_repeat("*", $i) . "<br>";
            }
        } else {
            echo "<p>Vul een getal tussen 1 en 100 in.</p>";
        }
    }
    ?>

</body>
</html>