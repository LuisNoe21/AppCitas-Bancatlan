<?php

//creacion de funcion paea debuguear variables
function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable); //impresion var_dump de la variable a debuguear
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}
?>