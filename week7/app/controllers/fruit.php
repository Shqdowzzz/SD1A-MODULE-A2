<?php

function fruit($conn)
{
    $sql = "SELECT id, name, color, sweetness
            FROM fruits
            ORDER BY name ASC";

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
          </tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['color']) . "</td>";
        echo "<td>" . htmlspecialchars($row['sweetness']) . "</td>";
        echo "</tr>";
    }

    echo "</table>";
}