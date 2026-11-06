<?php

if (!empty($_POST['email']) && !empty($_POST['pass'])) {

    $email = $_POST['email'];
    $password = password_hash($_POST['pass'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (email, password) VALUES (?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $password);

    if ($stmt->execute()) {
        echo "Account aangemaakt!";
    } else {
        echo "Dit e-mailadres bestaat al.";
    }
}
?>

<h1>Account aanmaken</h1>

<form method="post">
    <input type="email" name="email" placeholder="E-mailadres" required><br>
    <input type="password" name="pass" placeholder="Wachtwoord" required><br>
    <button type="submit">Registreren</button>
</form>