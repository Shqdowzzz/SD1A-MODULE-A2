
<?php
if (isset($_POST["bereken"])) {
    $aantal = $_POST["aantal"];

    if ($aantal < 1 || $aantal > 10 || $aantal != (int)$aantal) {
        echo "Ongeldig aantal. Vul een geheel getal van 1 t/m 10 in.";
    } else {
        $over = 10 - $aantal;

        echo "Je gooit $aantal knikker(s) op. Er blijven $over knikker(s) over.";
    }
}
?>

<form method="post">
    Hoeveel knikkers gooi je op?
    <input type="number" name="aantal">

    <button type="submit" name="bereken">Bereken</button>
</form>
