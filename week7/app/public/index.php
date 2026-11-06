<?php
ob_start();
session_start();

require_once __DIR__ . '/../core/database.php';

$controller = $_GET['controller'] ?? 'fruit';

echo "<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css'>";

echo "<nav>";
echo "<a href='?controller=fruit'>Fruit</a> ";

if (empty($_SESSION['login'])) {
    echo "<a href='?controller=login'>Inloggen</a> ";
    echo "<a href='?controller=register'>Registreren</a>";
} else {
    echo "<span>Ingelogd als " . htmlspecialchars($_SESSION['login']) . "</span>";
}

echo "</nav>";

echo "<article>";

if ($controller == 'fruit') {
    require_once __DIR__ . '/../controllers/fruit.php';
    fruit($conn);

} elseif ($controller == 'delete') {
    include __DIR__ . '/../controllers/delete.php';

} elseif ($controller == 'toevoegen') {
    include __DIR__ . '/../controllers/toevoegen.php';

} elseif ($controller == 'bewerk') {
    include __DIR__ . '/../controllers/bewerk.php';

} elseif ($controller == 'login') {
    include __DIR__ . '/../controllers/login.php';

} elseif ($controller == 'register') {
    include __DIR__ . '/../controllers/register.php';

} else {
    echo "Deze pagina bestaat niet.";
}

echo "</article>";
?>
