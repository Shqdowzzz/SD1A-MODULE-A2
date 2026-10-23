<?php

$fout = "";
$resultaat = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $aantal = $_POST["aantal"];

    if ($aantal === "" || !ctype_digit($aantal) || $aantal < 1 || $aantal > 10) {
        $fout = "Vul een geheel getal van 1 t/m 10 in.";
    } else {
        $over = 10 - $aantal;

        $resultaat = "Je haalt " . $aantal . " knikker(s) uit de zak. Er blijven " . $over . " knikker(s) over.";
    }
}

?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Knikkers</title>
</head>
<body>

<h1>Knikkers berekenen</h1>

<form method="post">
    <label for="aantal">Hoeveel knikkers haal je eruit?</label>
    <input type="number" id="aantal" name="aantal" min="1" max="10" step="1" required>
    <button type="submit">Bereken</button>
</form>

<p><?php echo $fout; ?></p>
<p><?php echo $resultaat; ?></p>

</body>
</html>