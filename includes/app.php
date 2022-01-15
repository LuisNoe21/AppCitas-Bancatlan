<?php 

require 'funciones.php'; //iporto funciones.php
require 'database.php'; // importo db.php
require __DIR__ . '/../vendor/autoload.php'; //accedo al autoload de vendor

// Conectarnos a la base de datos
use Model\ActiveRecord; //importo active record
ActiveRecord::setDB($db);  //uso la funcion setDB creada en active record