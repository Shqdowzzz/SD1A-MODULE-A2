
<?php

function home()
{
    return '
        <h1>Home</h1>
        <p>Welkom op mijn website!</p>
        <a href="?controller=page1">Pagina 1</a>
        <br>
        <a href="?controller=page2&id=99">Pagina 2</a>
    ';
}

function page1()
{
    return '
        <h1>Pagina 1</h1>
        <p>Dit is de eerste pagina.</p>
        <a href="?">Home</a>
        <br>
        <a href="?controller=page2&id=99">Pagina 2</a>
    ';
}

function page2($id)
{
    $id = htmlspecialchars((string) $id, ENT_QUOTES, "UTF-8");

    return '
        <h1>Pagina 2</h1>
        <p>Dit is de tweede pagina.</p>
        <p>ID: ' . $id . '</p>
        <a href="?">Home</a>
        <br>
        <a href="?controller=page1">Pagina 1</a>
    ';
}

$controller = $_GET["controller"] ?? "home";

if ($controller == "home") {
    $content = home();
} elseif ($controller == "page1") {
    $content = page1();
} elseif ($controller == "page2") {
    $id = $_GET["id"] ?? "";
    $content = page2($id);
} else {
    http_response_code(404);
    $content = '<h1>Pagina niet gevonden</h1><a href="?">Terug naar home</a>';
}

?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mijn website</title>
</head>
<body>

<?php echo $content; ?>

</body>
</html>
