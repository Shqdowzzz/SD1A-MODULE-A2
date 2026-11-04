<?php

require_once __DIR__ . '/../core/database.php';
require_once __DIR__ . '/../controllers/fruit.php';

    $controllers = [
    'fruit' => 'fruit',
    'fruitshow' => 'fruitshow',
    'fruitadd' => 'fruitadd',
    'fruitdelete' => 'fruitdelete'
    ];
$controller = $_GET['controller'] ?? 'fruit';

$bestaat = array_key_exists($controller, $controllers);

?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Fruit website</title>

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
        <link rel="stylesheet" href="style.css">
</head>

<body>

    <article>

        <?php

        if ($bestaat === true) {
            $functie = $controllers[$controller];
            $functie($conn);
        } else {
            echo "<p>Deze pagina bestaat niet.</p>";
        }

        ?>

    </article>

</body>
</html>