<?php

require_once 'app/core/database.php';

$email1 = "test1@gmail.com";
$password1 = password_hash("Test123!", PASSWORD_DEFAULT);

$email2 = "test2@gmail.com";
$password2 = password_hash("Test456!", PASSWORD_DEFAULT);

$sql = "INSERT INTO users (email, password) VALUES (?, ?)";

$stmt = $conn->prepare($sql);

// Eerste gebruiker
$stmt->bind_param("ss", $email1, $password1);
$stmt->execute();

// Tweede gebruiker
$stmt->bind_param("ss", $email2, $password2);
$stmt->execute();

echo "Twee gebruikers zijn aangemaakt!";

$stmt->close();
$conn->close();

?>