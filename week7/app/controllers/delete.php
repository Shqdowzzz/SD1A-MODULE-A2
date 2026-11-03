<?php
$con = mysqli_connect("localhost", "root", "", "fruits");

if (!$con) {
    die("Database fout");
}

$id = $_GET['id'];

$sql = "DELETE FROM fruits WHERE id = $id";
mysqli_query($con, $sql);

header("Location: fruit.php");
exit; 