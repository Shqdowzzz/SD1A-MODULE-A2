<?php
if (isset($_POST["bereken"])) {
    $getal = $_POST["getal"];
    $getaly = $_POST["getaly"];

    if ($getaly == 0) {
        echo "Je kan niet delen door 0";
    } elseif ($getal % $getaly == 0) {
        echo "$getal is deelbaar door $getaly";
    } else {
        echo "$getal is niet deelbaar door $getaly";
    }
}
?>

<form method="post">
Geef een getal:
<input type="number" name="getal">

<br><br>

Geef een tweede getal:
<input type="number" name="getaly">

<br><br>

<button type="submit" name="bereken">Bereken</button>
</form>

