
<?php
if (isset($_POST["bereken"])) {
    $getal = $_POST["getal"];
    $begin = $_POST["begin"];
    $eind = $_POST["eind"];

    if ($begin > $eind) {
        echo "Begingetal mag niet groter zijn dan eindgetal";
    } else {
        for ($x = $begin; $x <= $eind; $x++) {
            $uitkomst = $getal * $x;
            echo "$x x $getal = $uitkomst<br>";
        }
    }
}
?>
<form method="post">
Geef een tafelgetal:
<input type="number" name="getal">

<br><br>

Geef een begingetal:
<input type="number" name="begin">

<br><br>

Geef een eindgetal:
<input type="number" name="eind">

<br><br>

<button type="submit" name="bereken">Bereken</button>
</form>
