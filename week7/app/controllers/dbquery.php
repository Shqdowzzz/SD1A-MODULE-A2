<?php

function dbquery($conn, $sql, $zoek)
{
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt == false) {
        return false;
    }

    mysqli_stmt_bind_param($stmt, "s", $zoek);

    if (mysqli_stmt_execute($stmt) == true) {
        return mysqli_stmt_get_result($stmt);
    } else {
        return false;
    }
}