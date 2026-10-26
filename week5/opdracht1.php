
<?php

function geheimschrijven($tekst)
{
    $letters = [
        "a" => "b",
        "b" => "c",
        "c" => "d",
        "d" => "e",
        "e" => "f",
        "f" => "g",
        "g" => "h",
        "h" => "i",
        "i" => "j",
        "j" => "k",
        "k" => "l",
        "l" => "m",
        "m" => "n",
        "n" => "o",
        "o" => "p",
        "p" => "q",
        "q" => "r",
        "r" => "s",
        "s" => "t",
        "t" => "u",
        "u" => "v",
        "v" => "w",
        "w" => "x",
        "x" => "y",
        "y" => "z",
        "z" => "a"
    ];

    $resultaat = "";
    $tekst = strtolower($tekst);

    for ($i = 0; $i < strlen($tekst); $i++) {
        $letter = $tekst[$i];

        if (isset($letters[$letter])) {
            $resultaat .= $letters[$letter];
        } else {
            $resultaat .= $letter;
        }
    }

    return $resultaat;
}

$tekst = "";
$versleuteld = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tekst = $_POST["tekst"] ?? "";
    $versleuteld = geheimschrijven($tekst);
}

?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Geheimschrijver</title>
</head>
<body>

<h1>Mijn geheimschrijver</h1>

<p>Elke letter wordt vervangen door de volgende letter van het alfabet.</p>

<form method="post">
    <label for="tekst">Voer je tekst in:</label>
    <br>
    <input type="text" id="tekst" name="tekst" required>
    <br><br>
    <button type="submit">Versleutelen</button>
</form>

<?php if ($_SERVER["REQUEST_METHOD"] == "POST") { ?>

    <h2>Resultaat</h2>

    <p>Originele tekst:
        <?php echo htmlspecialchars($tekst, ENT_QUOTES, "UTF-8"); ?>
    </p>

    <p>Versleutelde tekst:
        <?php echo htmlspecialchars($versleuteld, ENT_QUOTES, "UTF-8"); ?>
    </p>

<?php } ?>

</body>
</html>
