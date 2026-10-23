<!DOCTYPE html>
<html lang="nl">
<body>

<form action="" method="post">
    <label>Kies een auto:</label>

    <select name="cars">
        <option value="audi">Audi</option>
        <option value="mercedes">Mercedes</option>
        <option value="ford">Ford</option>
        <option value="bmw">BMW</option>
        <option value="toyota">Toyota</option>
    </select>

    <br><br>
    <input type="submit" value="Verzenden">
</form>

<?php
if (isset($_POST["cars"])) {
    $car = $_POST["cars"];

    echo "<h3>$car</h3>";
    echo "<img src='img/" . $car . ".webp' alt='$car afbeelding 1' width='200'>";
    echo "<img src='img/" . $car . ".webp' alt='$car afbeelding 2' width='200'>";
}
?>

</body>
</html>