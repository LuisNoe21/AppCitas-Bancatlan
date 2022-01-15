<?php

$db = mysqli_connect('localhost', 'root', '', 'appsalon_mvc'); // pasandole los argumentos para la conexion a a base de datos

// $db = mysqli_connect('162.241.2.36', 'blogluis_luisnoe', '12345', 'blogluis_appsalon_mvc');
// si los argumentos son diferentes se ejecutara esto
if (!$db) {
    echo "Error: No se pudo conectar a MySQL.";
    echo "errno de depuración: " . mysqli_connect_errno(); //expecificacion del error
    echo "error de depuración: " . mysqli_connect_error(); //expecificacion del error
    exit; //salimos
}
