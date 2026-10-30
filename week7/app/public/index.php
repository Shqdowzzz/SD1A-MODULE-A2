
<?php

require_once __DIR__ . '/../core/database.php';
require_once __DIR__ . '/../controllers/fruit.php';

$controller = $_GET['controller'] ?? 'fruit';
echo "<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css'>";
echo "<article>";

if ($controller === 'fruit') {
    fruit($conn);
} elseif ($controller === 'fruitshow') {
    fruitshow($conn);
} else {
    echo "<p>Deze pagina bestaat niet.</p>";
}

echo "</article>";
