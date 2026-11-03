<?php
ob_start();
require_once __DIR__ . '/../core/database.php';
require_once __DIR__ . '/../controllers/fruit.php';
require_once __DIR__ . '/../controllers/dbquery.php';

$controller = $_GET['controller'] ?? 'fruit';

echo "<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css'>";

echo "<article>";

if ($controller == 'fruit') {
    fruit($conn);
} elseif ($controller == 'delete') {
    include '../controllers/delete.php';
} elseif ($controller == 'toevoegen') {
    include '../controllers/toevoegen.php';
} else {
    echo "Deze pagina bestaat niet.";
}

echo "</article>";
