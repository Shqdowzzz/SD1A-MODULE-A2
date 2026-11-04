<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['name'])) {

        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $color = mysqli_real_escape_string($conn, $_POST['color']);
        $sweetness = mysqli_real_escape_string($conn, $_POST['sweetness']);
        $Herkomst = mysqli_real_escape_string($conn, $_POST['Herkomst']);

        $sql = "INSERT INTO fruits (name, color, sweetness, Herkomst)
                VALUES ('$name', '$color', '$sweetness', '$Herkomst')";

        mysqli_query($conn, $sql);

        header("Location: index.php?controller=fruit");
        exit;
    }
}
?>
<h1>Fruit toevoegen</h1>

<form method="post">
    Naam: <input type="text" name="name"><br>
    Kleur: <input type="text" name="color"><br>
    Zoetigheid: <input type="number" name="sweetness"><br>
    Herkomst: <input type="text" name="Herkomst"><br>

    <input type="submit" value="Toevoegen">
</form>


