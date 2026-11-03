<?php

$conn = mysqli_connect("localhost", "root", "", "fruit");

$verbonden = ($conn !== false);

if ($verbonden === false) {
    die("Verbinding mislukt: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8mb4");