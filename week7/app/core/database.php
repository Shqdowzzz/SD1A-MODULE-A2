<?php

$conn = mysqli_connect("localhost", "root", "", "fruit");

if (!$conn) {
    die("Verbinding mislukt: " . mysqli_connect_error());
}