<?php

$page = $_GET["controller"] ?? "home";
$fout = false;

if ($page == "home") {
    $bestand = __DIR__ . "/pages/home.php";
} elseif ($page == "page1") {
    $bestand = __DIR__ . "/pages/page1.php";
} elseif ($page == "page2") {
    $bestand = __DIR__ . "/pages/page2.php";

    $id = $_GET["id"] ?? "";

    if (!is_numeric($id) || $id < 1 || $id != (int)$id) {
        $fout = true;
    }
} else {
    $fout = true;
}

if ($fout) {
    http_response_code(404);
    $bestand = __DIR__ . "/pages/error.php";
}
?>



