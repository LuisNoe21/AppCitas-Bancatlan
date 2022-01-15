<?php 
//EN ESTE ARCHIVO CREAMOS LAS PETECIONES GET Y POST DE LAS RUTAS DEL PROYECTO

require_once __DIR__ . '/../includes/app.php'; /// importando el app.php de la carpeta innclude

use Controllers\CitaController;
use Controllers\LoginController; //exportando Login Controller
use Controllers\PaginasController;
use MVC\Router; //exportando Router
$router = new Router(); //asigando el router() a la variable router

//Iniciar Sesion
$router->get('/', [LoginController::class, 'login']); //Aqui instanciamos la funcion get creada en Router donde a esta se le mandan 2 parametros: 1 es la url y 2 la funcion
//Mando llamar el Login controller de Controller y el nombre del metodo de la clase que en este caso es login
$router->post('/', [LoginController::class, 'login']); // el post si utilizara para enviar la informacion despues de llenar el formulario
//CERRAR SESION
$router->get('/logout', [LoginController::class, 'logout']); 

//RECUPERAR PASSWORD
$router->get('/olvide', [LoginController::class, 'olvide']); //Me lleva a formulario de recuperacion de password
$router->post('/olvide', [LoginController::class, 'olvide']); //para enviar la informacion para poder recuperar la cuenta
$router->get('/recuperar', [LoginController::class, 'recuperar']);// Luego de enviar la informacion desde olvide me mostrara otro formulario donde podre ingresar una nueva password // Luego de enviar la informacion desde olvide me mostrara otro formulario donde podre ingresar una nueva password
$router->post('/recuperar', [LoginController::class, 'recuperar']); //Para enviar la nueva password y la insertara en el usuario validado anteriormente

//CREAR CUENTA
$router->get('/crear-cuenta', [LoginController::class, 'crear']); //Para que el usuario llene sus datos y poder crear su cuenta
$router->post('/crear-cuenta', [LoginController::class, 'crear']); //Para enviar la informacion requerida al usuario para crear su cuenta


$router->get('/contacto', [PaginasController::class, 'contacto']); //Para que el usuario llene sus datos y poder crear su cuenta
$router->post('/contacto', [PaginasController::class, 'contacto']);

//CONFIRMAR CUENTA
$router->get('/confirmar-cuenta', [LoginController::class, 'confirmar']); //me lleva a la vista donde confirmo la cuennta
$router->get('/mensaje', [LoginController::class, 'mensaje']); // me lleva a la vista donde se ve el mensaje que se muestra despues de crear la cuenta
$router->get('/mensaje-restablecer', [LoginController::class, 'mensajerestablecer']);
$router->get('/mensaje-recuperar', [LoginController::class, 'mensajererecuperar']);

//AREA PRIVADA
$router->get('/cita',[CitaController::class, 'index']);








// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();