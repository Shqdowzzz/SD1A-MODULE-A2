<?php
if (isset($_POST["bereken"])) {
    $leeftijd = $_POST["leeftijd"];
    $prijs = 12;

    if ($leeftijd < 0) {
    echo "Ongeldige leeftijd";
    } elseif ($leeftijd < 3) {
        $prijs = 0;
    echo "Jonger dan 3 jaar: gratis<br>";
    } elseif ($leeftijd <= 16) {
        $prijs = 12 * 0.5;
    echo "3 t/m 16 jaar: 50% korting<br>";
    } elseif ($leeftijd >= 65) {
        $prijs = 12 * 0.75;
    echo "Vanaf 65 jaar: 25% korting<br>";
    } else {
        $prijs = 12;
    echo "Overige leeftijden: €12<br>";
    }

    if ($leeftijd >= 0) {
    echo "De prijs is €" . $prijs;
    }
}
?>

<form method="post">
    Geef je leeftijd:
    <input type="number" name="leeftijd">

    <button type="submit" name="bereken">Bereken</button>
</form>