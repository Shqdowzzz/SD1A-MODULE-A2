<?php
include "backup.php";
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Mijn website</title>
</head>
<body>

<h1>Mijn website</h1>

<a href="opdracht1.php?controller=home">Home</a> |
<a href="opdracht1.php?controller=page1">Page 1</a> |
<a href="opdracht1.php?controller=page2">Page 2</a>

<hr>

<?php include $bestand; ?>

</body>
</html>






