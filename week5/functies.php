<?php

function versleutel(string $tekst): string {
    $letters = [
        "a" => "b",
        "b" => "d",
        "c" => "f"
    ];

    $nieuw = "";

    for ($i = 0; $i < strlen($tekst); $i++) {
        $letter = strtolower($tekst[$i]);

        if (isset($letters[$letter])) {
            $nieuw .= $letters[$letter];
        } else {
            $nieuw .= $tekst[$i];
        }
    }

    return $nieuw;
}