<?php
if (isset($_POST["diameter"])) {
    $diameter = $_POST["diameter"];
    $straal = $diameter / 2;
    $omtrek = pi() * $diameter;
    $oppervlakte = pi() * $straal * $straal;
}
?>

<!DOCTYPE html>
<html lang="nl">
<body>

<h1>Cirkel berekenen</h1>

<form method="post">
    Diameter:
    <input type="number" name="diameter" step="any" required>
    <button type="submit">Bereken</button>
</form>

<?php
if (isset($_POST["diameter"])) {
    echo "Straal: " . round($straal, 2) . "<br>";
    echo "Omtrek: " . round($omtrek, 2) . "<br>";
    echo "Oppervlakte: " . round($oppervlakte, 2);
}
?>

</body>
</html>