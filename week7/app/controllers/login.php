<?php

if (empty($_SESSION['login'])) {

    if (!empty($_POST['email']) && !empty($_POST['pass'])) {

        $email = $_POST['email'];
        $password = $_POST['pass'];

        $sql = "SELECT * FROM users WHERE email = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($user = $result->fetch_assoc()) {

            if (password_verify($password, $user['password'])) {

                $_SESSION['login'] = $user['email'];

                echo "Je bent succesvol ingelogd!";

            } else {
                echo "Verkeerd e-mailadres of wachtwoord.";
            }

        } else {
            echo "Verkeerd e-mailadres of wachtwoord.";
        }

        $stmt->close();
    }

} else {
    echo "Je bent al ingelogd als " . htmlspecialchars($_SESSION['login']);
}
?>

<h1>Inloggen</h1>

<form method="post">
    <input type="email" name="email" placeholder="E-mailadres" required><br>
    <input type="password" name="pass" placeholder="Wachtwoord" required><br>
    <button type="submit">Inloggen</button>
</form>
