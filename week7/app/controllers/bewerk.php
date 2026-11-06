<?php

$id = $_GET['id'] ?? '';

if (isset($_POST['update'])) {

    $name = $_POST['name'];
    $color = $_POST['color'];
    $sweetness = $_POST['sweetness'];
    $herkomst = $_POST['herkomst'];

    $sql = "UPDATE fruits SET name=?, color=?, sweetness=?, Herkomst=? WHERE id=?";
    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "ssisi", $name, $color, $sweetness, $herkomst, $id);
    mysqli_stmt_execute($stmt);

    header("Location: index.php?controller=fruit");
    exit;
}

$sql = "SELECT * FROM fruits WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$fruit = mysqli_fetch_assoc($result);

if (!$fruit) {
    echo "Fruit niet gevonden.";
    exit;
}

?>

<h1>Fruit bewerken</h1>

<form method="post">
    Naam:
    <input name="name" value="<?= htmlspecialchars($fruit['name']) ?>"><br>

    Kleur:
    <input name="color" value="<?= htmlspecialchars($fruit['color']) ?>"><br>

    Zoetheid:
    <input type="number" name="sweetness" value="<?= htmlspecialchars($fruit['sweetness']) ?>"><br>

    Herkomst:
    <input name="herkomst" value="<?= htmlspecialchars($fruit['herkomst']) ?>"><br>

    <button type="submit" name="update">Opslaan</button>
</form>
