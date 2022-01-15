<?php 

namespace Controllers; // creacion del namespace de controller
use MVC\Router; //import del router


class CitaController{ //clase de citas

    //funcion de citas
    public static function index (Router $router){
        session_start();
        

        $router->render('cita/index',[ // render de el index o pagina prinicipal de las citas
'nombre' => $_SESSION['nombre'] // tomamos el nomnbre con el que el usuario se registro el usuario y lo almacenamos en la variable nombre para ponerlo en el value de los datos de la cita
        ]);
    }
}