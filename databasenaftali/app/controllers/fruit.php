
<?php

function veiligTonen($waarde)
{
    return htmlspecialchars((string) $waarde, ENT_QUOTES, 'UTF-8');
}


// FRUIT OVERZICHT
function fruit($conn)
{
    $find = $_GET['find'] ?? '';

    $sql = "SELECT id, name, color, sweetness, herkomst
            FROM fruits
            WHERE name LIKE ?
            ORDER BY name ASC";

    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt === false) {
        die("Query voorbereiden mislukt.");
    }

    $zoek = "%" . $find . "%";

    mysqli_stmt_bind_param($stmt, "s", $zoek);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $fruits = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $aantal = count($fruits);
?>

<h1>Fruit overzicht</h1>

<p>Bekijk hieronder alle fruitsoorten.</p>

<form method="GET">
    <input type="hidden" name="controller" value="fruit">
    <input type="text" name="find" placeholder="Zoek fruit..."
        value="<?= veiligTonen($find) ?>">
    <button type="submit">Zoeken</button>
</form>

<h3>Aantal resultaten: <?= $aantal ?></h3>

<?php if ($aantal > 0) { ?>

    <?php foreach ($fruits as $row) { ?>

        <hr>

        <h2><?= veiligTonen($row['name']) ?></h2>

        <p><strong>ID:</strong> <?= (int) $row['id'] ?></p>
        <p><strong>Kleur:</strong> <?= veiligTonen($row['color']) ?></p>
        <p><strong>Zoetheid:</strong> <?= veiligTonen($row['sweetness']) ?>/10</p>
        <p><strong>Herkomst:</strong> <?= veiligTonen($row['herkomst']) ?></p>

        <a href="index.php?controller=fruitshow&id=<?= (int) $row['id'] ?>">
            <i class="fa-solid fa-eye"></i> Bekijk fruit
        </a>

        <br><br>

    <?php } ?>

<?php } else { ?>

    <p>Geen fruit gevonden.</p>

<?php } ?>

<?php
    mysqli_stmt_close($stmt);
}


// FRUIT DETAILS
function fruitshow($conn)
{
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

    $geldigeId = ($id !== false && $id !== null && $id > 0);

    $row = null;
    $gevonden = false;

    if ($geldigeId === true) {

        $sql = "SELECT id, name, color, sweetness, herkomst
                FROM fruits
                WHERE id = ?";

        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt === false) {
            die("Query voorbereiden mislukt.");
        }

        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);

        $gevonden = ($row !== null && $row !== false);

        mysqli_stmt_close($stmt);
    }
?>

<h1>Fruit details</h1>

<?php if ($gevonden === true) { ?>

    <h2><?= veiligTonen($row['name']) ?></h2>

    <p><strong>ID:</strong> <?= (int) $row['id'] ?></p>
    <p><strong>Kleur:</strong> <?= veiligTonen($row['color']) ?></p>
    <p><strong>Zoetheid:</strong> <?= veiligTonen($row['sweetness']) ?>/10</p>
    <p><strong>Herkomst:</strong> <?= veiligTonen($row['herkomst']) ?></p>

<?php } else { ?>

    <p>Fruit niet gevonden.</p>

<?php } ?>

<br>

<a href="index.php?controller=fruit">
    <i class="fa-solid fa-arrow-left"></i> Terug naar overzicht
</a>

<?php
}
