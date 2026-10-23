<?php 
    if (isset($_GET["kleuren"])) {
        $kleur = $_GET["kleuren"];
        //echo $kleur;

        echo "<p style='background-color: $kleur'> het kleur is $kleur</p>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>

<body style='background-color: <?php echo $kleur; ?>'>
<form action="" method="GET">
    <select name="kleuren">
        <option value=" Blue">Blue</option>
        <option value=" Red">Red</option>
        <option value=" Yellow">Yellow</option>
        <option value=" Purple">Purple</option>
    </select>
    <input type="submit">
</form>

</body>
</html>