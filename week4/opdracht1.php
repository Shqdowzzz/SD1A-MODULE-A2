<?php

$kleur = "white";

if (isset($_POST["kleur"])) {
    $kleuren = ["white", "lightblue", "lightgreen", "lightyellow", "pink"];

    if (in_array($_POST["kleur"], $kleuren)) {
        $kleur = $_POST["kleur"];
    }
}

?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Kleurkiezer</title>
</head>
<body style="background-color: <?php echo $kleur; ?>;">

<h1>Kies een achtergrondkleur</h1>

<form method="post">
    <select name="kleur">
        <option value="white" <?php if ($kleur == "white") echo "selected"; ?>>Wit</option>
        <option value="lightblue" <?php if ($kleur == "lightblue") echo "selected"; ?>>Lichtblauw</option>
        <option value="lightgreen" <?php if ($kleur == "lightgreen") echo "selected"; ?>>Lichtgroen</option>
        <option value="lightyellow" <?php if ($kleur == "lightyellow") echo "selected"; ?>>Lichtgeel</option>
        <option value="pink" <?php if ($kleur == "pink") echo "selected"; ?>>Roze</option>
    </select>

    <button type="submit">Verander kleur</button>
</form>

</body>
</html>