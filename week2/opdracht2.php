<?php
if (isset($_POST["bereken"])) {
    $x = $_POST["geboortejaar"];
    $y = 2026 - $x;

    echo "Je leeftijd is $y jaar";
}
?>

<form method="post">
    Geef je geboortejaar:
    <input type="number" name="geboortejaar">

    <button type="submit" name="bereken">Bereken</button>
</form>



