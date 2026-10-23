
<?php
if (isset($_POST["bereken"])) {
    $hout = $_POST["hout"];
    $vorm = $_POST["vorm"];

    if ($hout == "berken") {
        $prijs = 9.50;
    } elseif ($hout == "grenen") {
        $prijs = 8.50;
    } else {
        $prijs = 11.50;
    }

    if ($vorm == "rechthoek") {
        $oppervlakte = ($_POST["lengte"] / 1000) * ($_POST["breedte"] / 1000);
    } else {
        $straal = $_POST["diameter"] / 2000;
        $oppervlakte = pi() * $straal * $straal;
    }

    if ($oppervlakte <= 0) {
        echo "Vul geldige maten groter dan 0 in.";
    } else {
        $totaal = $oppervlakte * $prijs;
        echo "Oppervlakte: " . round($oppervlakte, 3) . " m²<br>";
        echo "Totaalprijs: €" . number_format($totaal, 2, ",", ".");
    }
}
?>

<form method="post">
    Houtsoort:
    <select name="hout">
    <option value="berken">Berken</option>
    <option value="grenen">Grenen</option>
    <option value="hardhout">Hardhout</option>
    </select>

    <br><br>

    Vorm:
    <select name="vorm">
    <option value="rechthoek">Rechthoek</option>
    <option value="rond">Rond</option>
    </select>

    <br><br>

    Lengte (mm): <input type="number" name="lengte">
    <br><br>
    Breedte (mm): <input type="number" name="breedte">
    <br><br>
    Diameter (mm): <input type="number" name="diameter">
    <br><br>

    <button type="submit" name="bereken">Bereken</button>
</form>
