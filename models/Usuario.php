<?php
//EN ESTE ACRHIVO VALIDAMOS LA CREACION DE USUARIOS Y MOSTRAMOS LAS ALERTAS

namespace Model; //creacion de namespace de Model

//Herededamos de Active Record
class Usuario extends ActiveRecord {
//Base de Dtos

//Llenamos las variables heredadas de active record
protected static $tabla = 'usuarios'; 
protected static $columnasDB = ['id','nombre','apellido','email','password','telefono','admin','confirmado','token'];

//creando las variables
public $id;
public $nombre;
public $apellido;
public $email;
public $password;
public $telefono;
public $admin;
public $confirmado;
public $token;


//CREACION DE LA FUNCION CONSTRUCTOR
public function __construct($args = [] ) // decimos que la variable args es u  arreglo vacio
{

    //accediendo a cada uno de los elemenos y llenando args 
    $this->id = $args['id'] ?? null; // en caso de estar vacio retornara un string vacio
    $this->nombre = $args['nombre'] ?? ''; // en caso de estar vacio retornara un string vacio
    $this->apellido = $args['apellido'] ?? ''; // en caso de estar vacio retornara un string vacio
    $this->email = $args['email'] ?? ''; // en caso de estar vacio retornara un string vacio
    $this->password = $args['password'] ?? ''; // en caso de estar vacio retornara un string vacio
    $this->telefono = $args['telefono'] ?? ''; // en caso de estar vacio retornara un string vacio
    $this->admin = $args['admin'] ?? '0'; // en caso de estar vacio retornara null
    $this->confirmado = $args['confirmado'] ?? '0'; // en caso de estar vacio retornara un null
    $this->token = $args['token'] ?? ''; // en caso de estar vacio retornara un string vacio
}

//MENSAJES DE VALIDACION PARA LA CREACION DE UNA CUENTA
public function validarNuevaCuenta(){ // creacion de funcion validar nueva cuenta

    //En caso de que el campo de Nombre este vacio se mostrara el siguiente mensaje
if(!$this->nombre){ // con this hago referencia al objeto nombre
    self::$alertas['error'][] = 'El nombre es obligatorio'; //self hace referencia a la clase actual

}
 //En caso de que el campo de apellido este vacio se mostrara el siguiente mensaje
if(!$this->apellido){ // con this hago referencia al objeto nombre

    self::$alertas['error'][] = 'El apellido es obligatorio'; //self hace referencia a la clase actual

}

if(!$this->telefono){ // con this hago referencia al objeto nombre

    self::$alertas['error'][] = 'El telefono es obligatorio'; //self hace referencia a la clase actual

}

if(!$this->email){ // con this hago referencia al objeto nombre

    self::$alertas['error'][] = 'El email es obligatorio'; //self hace referencia a la clase actual

}



if(!$this->password){ // con this hago referencia al objeto nombre

    self::$alertas['error'][] = 'La contraseña es obligatoria'; //self hace referencia a la clase actual

}

if(strlen($this->password ) < 6){ //validar que la contrasenia tenga al menos 6 caracteres/ strlen nos devuelve la longitud del objeto
    self::$alertas['error'][] = 'La contraseña debe tener al menos 6 caracteres';
}


return self::$alertas; //retornamos las alertas 
}


//funcion para validar login de usuario
public function validarLogin(){
    if(!$this->email){  //validamos si el email es igual
        self::$alertas['error'][]= 'El email es obligatorio'; //validamos que se ingrese un correo
    }

    if(!$this->password){ //validamos si el password es igual
        self::$alertas['error'][]= 'El password es obligatorio'; //validamos que se ingrese el password
    }

    return self::$alertas; // retornamos las alertas
}

public function validarEmail(){
    if(!$this->email){  //validamos que el usuario escriba un email
        self::$alertas['error'][]= 'El email es obligatorio'; //validamos que se ingrese un correo
    }

    return self::$alertas; //retornamos las alertas
}

public function validarPassword(){
    
    if(!$this->password){  //validamos que el usuario escriba un email
        self::$alertas['error'][]= 'El password es obligatorio'; //validamos que se ingrese un corre
}

if(strlen($this->password ) < 6){ //validar que la contrasenia tenga al menos 6 caracteres/ strlen nos devuelve la longitud del objeto
    self::$alertas['error'][] = 'La contraseña debe tener al menos 6 caracteres';
}

 return self::$alertas; //retornamos las alertas
}


//Revisa si el usuario ya existe
public function existeUsuario() {

    $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1"; //consulta a los email de la tabla suuarios

    $resultado = self::$db->query($query); //le pasamos la query


    if($resultado->num_rows){ //accedemos al obejo num_rows que nos muestra si encuentra reultados iguales de email
        self::$alertas['error'][]= 'El usuario ya esta registrado';
    }
    
    return $resultado; // retornamos el resultado
}

//Hasheando el password
public function hashPassword(){
    $this->password= password_hash($this->password, PASSWORD_BCRYPT);  //hash del password

}

//funcion que crea el token de usuario
public function crearToken(){
    $this->token = uniqid(); // creacion de un token de usuario de 13 digitos con uniqid
}



public function comprobarPasswordAndVerificado($password){
    $resultado = password_verify($password, $this->password); //comparamos el passsword escrito por el usuario contra el que esta en la bd


     if(!$resultado || !$this->confirmado){ //validacion si el usuario esta confirmado o no
         self::$alertas['error'][]= 'Contraseña incorrecta o tu cuenta no esta confirmada.';

     }
     else {
        return true;
     }


}

}