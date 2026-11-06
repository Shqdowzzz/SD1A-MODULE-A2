<?php
include 'dbquery.php';

function fruit($conn)
{
    $id = $_GET['id'] ?? '';
    $find = $_GET['find'] ?? '';
    $sort = $_GET['sort'] ?? 'name_asc';

    if ($id != '') {
        $result = dbquery($conn, "SELECT * FROM fruits WHERE id = ?", $id);
        $row = mysqli_fetch_assoc($result);

        if ($row) {
            echo "<h1>" . htmlspecialchars($row['name']) . "</h1>";
            echo "Kleur: " . htmlspecialchars($row['color']) . "<br>";
            echo "Zoetheid: " . htmlspecialchars($row['sweetness']) . "<br>";
            echo "Herkomst: " . htmlspecialchars($row['Herkomst']) . "<br>";
        } else {
            echo "Fruit niet gevonden";
        }

        echo "<a href='index.php?controller=fruit'>Terug</a>";
        return;
    }

    // Sorteermogelijkheden
    switch ($sort) {
        case 'id':
            $order = 'id ASC';
            break;

        case 'sweetness_asc':
            $order = 'sweetness ASC';
            break;

        case 'sweetness_desc':
            $order = 'sweetness DESC';
            break;

        case 'name_desc':
            $order = 'name DESC';
            break;

        default:
            $order = 'name ASC';
            $sort = 'name_asc';
            break;
    }

    echo "<h1>Fruit overzicht</h1>";

    echo "<form method='GET'>
        <input type='hidden' name='controller' value='fruit'>
        <input name='find' value='" . htmlspecialchars($find, ENT_QUOTES) . "' placeholder='Zoek fruit'>

        <select name='sort' onchange='this.form.submit()'>";

    $options = [
        'id' => 'ID (laag naar hoog)',
        'sweetness_asc' => 'Zoetheid (laag naar hoog)',
        'sweetness_desc' => 'Zoetheid (hoog naar laag)',
        'name_asc' => 'Naam (A-Z)',
        'name_desc' => 'Naam (Z-A)'
    ];

    foreach ($options as $value => $label) {
        $selected = ($sort == $value) ? 'selected' : '';
        echo "<option value='$value' $selected>$label</option>";
    }

    echo "</select>
        <button type='submit'>Zoeken</button>
        <a href='index.php?controller=toevoegen'>Toevoegen</a>
    </form>";

    $result = dbquery($conn,
        "SELECT * FROM fruits WHERE name LIKE ? ORDER BY $order",
        "%$find%"
    );

    echo "<table border='1'>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Color</th>
            <th>Sweetness</th>
            <th>Bekijken</th>
            <th>Bewerken</th>
            <th>Verwijderen</th>
        </tr>";

    $aantal = 0;

    while ($row = mysqli_fetch_assoc($result)) {
        $aantal++;
        $id = $row['id'];

        echo "<tr>
            <td>$id</td>
            <td>" . htmlspecialchars($row['name']) . "</td>
            <td>" . htmlspecialchars($row['color']) . "</td>
            <td>{$row['sweetness']}</td>
            <td>
    <a href='index.php?controller=fruit&id={$row['id']}'>
        <i class='fa-solid fa-eye'></i>
    </a>
</td>

<td>
    <a href='index.php?controller=bewerk&id={$row['id']}'>
        <i class='fa-solid fa-pen'></i>
    </a>
</td>

<td>
    <a href='index.php?controller=delete&id={$row['id']}'>
        <i class='fa-solid fa-trash'></i>
    </a>
</td>
        </tr>";
    }
    echo "</table>";
    echo "Aantal resultaten: $aantal";
}

