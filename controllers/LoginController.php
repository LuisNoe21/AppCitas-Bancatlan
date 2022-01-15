<?php
//EN ESTE ARCHIVO CONFIGURAMOS EL ACCESO A TODAS LAS RUTAS DEL PROYECTO  y RENDERIZAMOS SU CONTENIDO

//creacion de namespace Controller
namespace Controllers;

use Classes\Email; // importacion de la clase email
use Model\Usuario; //importacion del modelo de usuario
use MVC\Router; //importacion del MVC router


class LoginController //creacion  de clase login controller
{
    /* Estoy instanciando el router de las rutas de index.php */
    public static function login(Router $router) //creamos la varabe router a la que le asignamos router()
    {

        
        $alertas = []; // Arreglo vacio de alertas
        // $auth = new Usuario;


        if ($_SERVER['REQUEST_METHOD'] === 'POST') { //validamos que el metodo sea post
            $auth = new Usuario($_POST); // le pasamos los datos que escribe el usuario


            $alertas = $auth->validarLogin(); //le pasamos los reultados de la funcion validar login a las alertas

            if (empty($alertas)) { // verificamos si las alertas estan vacias o no
                // Comprobar que exista el usuario

                $usuario = Usuario::where('email', $auth->email); // si estan vacias espor que se ingreso un correo, entnces hacemos la busqueda de ese correo en la bd

                if ($usuario) {
                    //verificar el password

                    if($usuario->comprobarPasswordAndVerificado($auth->password) ) { // pasamos el password que el usuario escribio en el formulario
                        //autenticar el usuario

                        session_start(); //inicimamos una sesion nueva

                        $_SESSION['id']= $usuario->id; //la session toma el id del usuario
                        $_SESSION['nombre']= $usuario->nombre ." ". $usuario->apellido; //la session toma el nombre y apellido del usuario
                        $_SESSION['email']= $usuario->email; //la session toma el email del usuario
                        $_SESSION['login']= TRUE; // session en true

                        //redireccionamiento
                        if($usuario->admin === "1"){ //validaos si el usuario es adminitrador
                            header('Location: /admin'); // de ser admin lo redireccionamos aca
                            $_SESSION['admin']= $usuario->admin ?? null; //validamos que el usuario sea admin o null
                        }
                        else{
                            header('Location: /cita'); // si no es admin lo redireccionamos aca
                        }
                        
                    } 
                }
                else{ 
                    Usuario::setAlerta('error', 'Usuario no Encontrado'); // si no lo encuentra lanza el sig mensaje
                }
            }
        }

        $alertas = Usuario::getAlertas(); //obtencion de las vistas

        //Este render nos permitira renderizar los archivos dentro de la carpeta view
        $router->render('auth/login', [
            'alertas' => $alertas
            // 'auth' => $auth
        ]); //renderizo la vista de login que se encuentra en views/auth
    }

    public static function logout() //creacion de funcion logout
    {
        echo "Desde Logout";
    }

    public static function olvide(Router $router) //creacion de funcion olvide mi password
    {

        $usuario = new Usuario(); //nuevo objeto de usuario

        $alertas = []; //arrgelo vacio de alertas
        if ($_SERVER['REQUEST_METHOD'] === 'POST') { //validamos que el metodo sea post
            $auth = new Usuario($_POST); //le pasamos los datos que escribe el usuario
           $alertas = $auth -> validarEmail(); // llenamos las alertas

            if(empty($alertas)){ //validamos si las alertas estan o no vacias
                $usuario = Usuario::where('email', $auth->email);  // si estan vacias hacemos una busuqeda del email

                if($usuario && $usuario->confirmado === "1"){ // si el usuario existe y esta confirmado
                    //Generar token

                    $usuario->crearToken(); //llmado del metodo que genera un token
                    $usuario->guardar();  //gurdamos el nuevo token creado

                    // ENVIAR EL EMAIL
$email = new Email($usuario->email, $usuario->nombre, $usuario->token);
$email -> enviarInstrucciones(); // LE PASO la funcion de enviar instrucciones

header('Location: /mensaje-recuperar');
                    // Usuario::setAlerta('exito', 'Revisa tu Correo'); //muestra alerta exitosa
                }
                else{
                    Usuario::setAlerta('error', 'El usuario no existe o no esta confirmado'); //muestra alerta de error
                    
                }
            
        }

    }
    $alertas = Usuario::getAlertas(); //obtiene las alertas 
        $router->render('auth/olvide-password', [
            'alertas' => $alertas //pasamos las alertas a la vista
        ]); //renderizo la vista de olvide mi password que se encuentra en views/auth
    
    }
    public static function recuperar(Router $router) //creacion de funcion recuperar password y le pasamos el router
    {
$alertas = []; //arreglo vacio de alertas
$error = false;


$token = s($_GET['token']); //obtencion del token

//Buscar usuario por su token
$usuario = Usuario::where('token', $token); //busca el token

if(empty($usuario)){ //revisamos si el usuario esta vacio o no
    Usuario::setAlerta('error', 'Token no valido'); // mensaje de alerta en caso de no encontrar nada

    $error= true; // error cambia true en caso de no hallar nada
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') { //verifica si el metodo es POST

    $password = new Usuario($_POST); //sincronizamos Con los datos del POST
   $alertas = $password -> validarPassword(); //le pasamos el metodo que valida el password

   if(empty($alertas)){ //VALIDAMOS SI LAS ALERTAS ESTAN VACIAS
       $usuario->password = ''; //vaciamos el password
       $usuario->password =   $password->password; //le pasamos el nuevo password
       $usuario->hashPassword(); //hash del password
       $usuario->token = ''; //vaciamos el token

       $resultado= $usuario->guardar();

       if($resultado){
        //    header('Location: /');
        header('Location: /mensaje-restablecer'); 
       }
      
   }

}



// debuguear($usuario);

$alertas = Usuario::getAlertas(); //obtenemos las alertas
       $router->render('auth/recuperar-password', [ //renderizacion de las vistas
        //le pasamos las alertas a la visa
           'alertas' => $alertas, 
           'error' => $error

       ]);


       
    }

    //Nos permite visualizar la vista de crear cuenta
    public static function crear(Router $router) //creacion de funcion crear cuenta
    {

        $usuario = new Usuario; //asignando la clase Usuario de usuarios.php a la variable usuarios
        //Alertas Vacias
        $alertas =  []; //declarando alertas como un arreglo vacio


        //revisa que el metodo sea post
        if ($_SERVER['REQUEST_METHOD'] === 'POST') { //verifica si el metodo es POST

            $usuario->sincronizar($_POST); //sincroniza con los datos de post
            $alertas =  $usuario->validarNuevaCuenta(); //si el metodo requeste es post entonces alertas sera igual a lo contenido dentro de la funcion validar nueva cuenta de usuarios.php

            //REVISAR QUE ALERTAS ESTE VACIO
            if (empty($alertas)) { //verificamos si las alertas estan vacias o no

                $resultado =  $usuario->existeUsuario(); //pasamos el metodo que valida si existe un usuario o no
                if ($resultado->num_rows) { //valida si hay usuarios
                    $alertas = Usuario::getAlertas(); //en caso de haber resultados llena alertas y lo manda hacia la vista
                } else {

                    $usuario->hashPassword(); //instanciando funcion que hashea el password

                    //generar un token unico
                    $usuario->crearToken(); //llamado de la funcion que crea el token de usuario


                    //Enviar el email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);

                    $email->enviarConfirmacion(); //funcion que envia el correo 

                    //CREAR EL USUARIO
                    $resultado = $usuario->guardar(); //gurdado de los datos de usuario
                    if ($resultado) {
                        header('Location: /mensaje'); // si resultados se llena, me redirecciona a /mensaje
                    }
                }
            }
        }

        //renderizo la vista de crear cuenta que se encuentra en views/auth
        $router->render('auth/crear-cuenta', [

            //el nombre de la izquierda es el que se da en el value del input de crear cuenta
            'usuario' =>  $usuario, //pasamos variable de usuario a la vista
            'alertas' => $alertas //mostrar las alertas en la vista

        ]); //Aqui especificamos donde se encuentra la vista
    }

    //funcion que muestra el mensaje de instrucciones enviadas luego de crear cuenta
    public static function mensaje(Router $router)
    {

        $alertas = []; // arreglo vacio de alertas

        Usuario::setAlerta('notificacion', 'Hemos enviado las intrucciones para confirmar tu cuenta, a tu email.');

        $alertas = Usuario::getAlertas(); //obtencion de las alertas 

        $router->render('auth/mensaje',[
            'alertas' => $alertas //pasamos las alertas a la vista
        ]); // renderizacion de la vista del mensaje
    }


    //funcion que muestra el mensaje de contasenia restablecida
    public static function mensajerestablecer(Router $router)
    {

        $alertas = []; //arreglo vacio de alertas

        Usuario::setAlerta('exito', 'Contraseña restablecida con exito'); //mensaje de exito de contrasenia restablecida con exito

        $alertas = Usuario::getAlertas(); //obtenemos las alertas

        $router->render('auth/mensaje-restablecer',[
            'alertas' => $alertas // pasamos las alertas a la vista
        ]); 
    }

    //funcion que muestra mensaje despues de ingresar el email para restablecer password
    public static function mensajererecuperar(Router $router)
    {

        $alertas = []; //arreglo vacio de alertas

        Usuario::setAlerta('exito', 'Hemos enviado las intrucciones para restablecer tu contraseña, a tu correo.'); //mostramos alertas de exito

        $alertas = Usuario::getAlertas(); //obtencion de las alertas

        $router->render('auth/mensaje-recuperar',[
            'alertas' => $alertas
        ]); // renderizacion de la vista del mensaje
    }


    //funcion para confirmar el usuario mediante el token
    public static function confirmar(Router $router)
    {
        $alertas = []; // las alertas se guardan en un arreglo vacio
        $token = s($_GET['token']); // obtiene el tokrn
        $usuario = Usuario::where('token', $token); // query que me busca el token especifico



        if (empty($usuario)) { //si el usuario esta vacio arroja mensaje de token no valido
            Usuario::setAlerta('error', 'Token No Valido'); //alerta de tipo error
        } else {
            $usuario->confirmado = "1"; // si hay algo en el usuario entonces lo cambia de 0 a 1
            $usuario->token = ''; // elimina el token y o deja vacio, use esto POR QUE NULL NO ME FUNCIONO
            $usuario->guardar(); //funcion que guarda o actualiza registros por id
            Usuario::setAlerta('exito', 'Cuenta Confirmada Exitosamente!!');  //alerta de tipo exito
        }

        //renderizado de las alertas
        $alertas = Usuario::getAlertas(); //me guarda las alertas que obtiene en el arreglo vacio de las alertas
        $router->render('auth/confirmar-cuenta', [
            'alertas' => $alertas //pasamos las alertas a la vista
        ]);
    }



}

