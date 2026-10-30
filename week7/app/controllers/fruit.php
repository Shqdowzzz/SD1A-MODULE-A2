
<?php

function fruit($conn)
{
    $sql = "SELECT id, name, color, sweetness FROM fruits ORDER BY name ASC";

    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Query mislukt: " . mysqli_error($conn));
    }

    echo "<h1>Fruit overzicht</h1>";
    echo "<table border='1' cellpadding='8'>";
    echo "<tr>
            <th>ID</th>
            <th>Name</th>
            <th>Color</th>
            <th>Sweetness</th>
            <th>Bekijken</th>
          </tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['color']) . "</td>";
        echo "<td>" . htmlspecialchars($row['sweetness']) . "</td>";
        echo "<td><a href='index.php?controller=fruitshow&id=" . (int)$row['id'] . "'><i class='fa-solid fa-eye'></i></a></td>";
        echo "</tr>";
    }

    echo "</table>";
}


function fruitshow($conn)
{
    // Controleer het ID
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

    if ($id === false || $id === null || $id < 1) {
        echo "<p>Ongeldig of ontbrekend fruit-ID.</p>";
        return;
    }

    // Zoek één fruitrecord veilig op
    $sql = "SELECT id, name, color, sweetness FROM fruits WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        die("Query mislukt: " . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        echo "<p>Dit fruit bestaat niet.</p>";
        mysqli_stmt_close($stmt);
        return;
    }

    // Toon het fruit
    echo "<h1>Fruit details</h1>";
    echo "<p>ID: " . htmlspecialchars($row['id']) . "</p>";
    echo "<p>Name: " . htmlspecialchars($row['name']) . "</p>";
    echo "<p>Color: " . htmlspecialchars($row['color']) . "</p>";
    echo "<p>Sweetness: " . htmlspecialchars($row['sweetness']) . "</p>";

    echo "<p><a href='index.php'>Terug naar overzicht</a></p>";

    mysqli_stmt_close($stmt);
}
