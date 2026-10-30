<?php

function fruit($conn)
{
    $find = $_GET['find'] ?? '';

    echo "<h1>Fruit overzicht</h1>";

    echo "<form method='GET'>";
    echo "<input type='text' name='find' placeholder='Zoek fruit...' value='" . htmlspecialchars($find) . "'>";
    echo "<button type='submit'>Zoeken</button>";
    echo "</form>";

    $sql = "SELECT * FROM fruits WHERE name LIKE ? ORDER BY name ASC";

    $stmt = mysqli_prepare($conn, $sql);

    $zoek = "%" . $find . "%";

    mysqli_stmt_bind_param($stmt, "s", $zoek);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    echo "<table border='1' cellpadding='8'>";
    echo "<tr>
            <th>ID</th>
            <th>Name</th>
            <th>Color</th>
            <th>Sweetness</th>
            <th>Bekijken</th>
          </tr>";

    $aantal = 0;

    while ($row = mysqli_fetch_assoc($result)) {
        $aantal++;

        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['color']) . "</td>";
        echo "<td>" . htmlspecialchars($row['sweetness']) . "</td>";
        echo "<td><a href='index.php?controller=fruitshow&id=" . $row['id'] . "'><i class='fa-solid fa-eye'></i></a></td>";
        echo "</tr>";
    }

    echo "</table>";
    echo "<p>Aantal resultaten: $aantal</p>";

    mysqli_stmt_close($stmt);
}


function fruitshow($conn)
{
    $id = $_GET['id'] ?? 0;

    $sql = "SELECT * FROM fruits WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        echo "<h1>Fruit details</h1>";
        echo "<p>ID: " . $row['id'] . "</p>";
        echo "<p>Name: " . htmlspecialchars($row['name']) . "</p>";
        echo "<p>Color: " . htmlspecialchars($row['color']) . "</p>";
        echo "<p>Sweetness: " . htmlspecialchars($row['sweetness']) . "</p>";
    } else {
        echo "<p>Fruit niet gevonden.</p>";
    }

    echo "<a href='index.php'>Terug naar overzicht</a>";

    mysqli_stmt_close($stmt);
}


