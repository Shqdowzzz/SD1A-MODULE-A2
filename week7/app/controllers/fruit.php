<?php
include 'dbquery.php';
function fruit($conn)
{
    $id = $_GET['id'] ?? '';
    $find = $_GET['find'] ?? '';

    if ($id != '') {
        $sql = "SELECT * FROM fruits WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);

        if ($row) {
            echo "<h1>" . $row['name'] . "</h1>";
            echo "Kleur: " . $row['color'] . "<br>";
            echo "Zoetheid: " . $row['sweetness'] . "<br>";
            echo "Herkomst: " . $row['Herkomst'] . "<br>";
        } else {
            echo "Fruit niet gevonden";
        }

        echo "<a href='index.php?controller=fruit'>Terug</a>";
        return;
    }

    echo "<h1>Fruit overzicht</h1>";

    echo "<form method='GET'>
        <input type='hidden' name='controller' value='fruit'>
        <input name='find' value='$find' placeholder='Zoek fruit'>
        <button>Zoeken</button>
    </form>";

    $result = dbquery($conn, "SELECT * FROM fruits WHERE name LIKE ? ORDER BY name", "%$find%");

    if ($result) {
        echo "<table border='1'>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Color</th>
            <th>Sweetness</th>
            <th>Bekijken</th>
            <th>Verwijderen</th>
        </tr>";

        $aantal = 0;

        while ($row = mysqli_fetch_assoc($result)) {
            $aantal++;

            echo "<tr>
    <td>" . $row['id'] . "</td>
    <td>" . $row['name'] . "</td>
    <td>" . $row['color'] . "</td>
    <td>" . $row['sweetness'] . "</td>
    <td>
        <a href='index.php?controller=fruit&id=" . $row['id'] . "'>
            <i class='fa-solid fa-eye'></i>
        </a>
    </td>
    <td>
        <a href='index.php?controller=delete&id=" . $row['id'] . "'>
            <i class='fa-solid fa-trash'></i>
        </a>
    </td>
</tr>";
        }

        echo "</table>";
        echo "Aantal resultaten: " . $aantal;
    }
}



