<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mensen";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM personen ";
$result = mysqli_query($conn, $sql);

echo "<table>";
echo "<tr><th>voornaam</th><th>achternaam</th></tr>";

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    echo "id: " . $row["id"]. " - Name: " . $row["voornaam"]. " " . $row["achternaam"]. "<br>";
  }
} else {
  echo "0 results";
}

mysqli_close($conn);
?>