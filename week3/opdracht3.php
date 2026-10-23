
<?php
if (isset($_POST["bereken"])) {
    $namen = explode(",", $_POST["namen"]);

    for ($i = 0; $i < count($namen); $i++) {
        echo trim($namen[$i]) . "<br>";
    }
}
?>

<form method="post">
    Typ namen:
    <input type="text" name="namen">

    <button type="submit" name="bereken">Toon namen</button>
</form>
