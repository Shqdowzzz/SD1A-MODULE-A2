<?php

$programmeertalen = ["PHP", "C#", "HTML", "JavaScript", "Java", "C++", "C"];

$programmeertalen[] = "Python";
$programmeertalen[] = "Swift";

sort($programmeertalen);

foreach ($programmeertalen as $taal) {
    echo $taal . "<br>";
}

echo "<br>Aantal programmeertalen: " . count($programmeertalen);

?>