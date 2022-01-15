<?php

namespace Controllers; //creacion de namespace Controller
use MVC\Router; //importacion del Router
use PHPMailer\PHPMailer\PHPMailer;  //importacion de PHPMAILER


//clase de pagina controller
class PaginasController {
 


//creacion de la funcion de contacto
    public static function contacto( Router $router ) {
        $mensaje = null; //declaramos el mensaje nulo por defecto

        if($_SERVER['REQUEST_METHOD'] === 'POST') { //revisamos si el metodo es POST

           


            // Validar 
            $respuestas = $_POST['contacto']; // respuesta sera igual al post del formulario de contacto
        
            // create a new object
            $mail = new PHPMailer();

            // configure an SMTP
            // $mail->isSMTP();
            // $mail->Host = 'smtp.mailtrap.io';
            // $mail->SMTPAuth= true;
            // $mail->Port= 2525;
            // $mail->SMTPSecure = 'tls';
            // $mail->Username= '5d3a70f510233f';
            // $mail->Password= '250aa89e451f1f';

            //CREDENCIALES PARA EL ENVIO DE CORREOS
            $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->Port= 587;
        $mail->SMTPSecure='tls';
        $mail->SMTPAuth= true;
        $mail->Username= 'luisnoe.rodriguez09@gmail.com';
        $mail->Password= 'pxdfjqxywxirotrg';
        
            $mail->setFrom('admin@bienesraices.com', $respuestas['nombre']); // remitente del correo
            $mail->addAddress('luisnoe.rodriguez09@gmail.com', 'BienesRaices.com'); // destinatario del correo
            $mail->Subject = 'Tienes un Nuevo Email'; //encabezado del correo

            // Set HTML 
            $mail->isHTML(TRUE);
            $mail->CharSet = 'UTF-8'; 

            $contenido = '<html>';
            $contenido .= "<p><strong>Nueva Consulta:</strong></p>";
            $contenido .= "<p>Nombre: " . $respuestas['nombre'] . "</p>";
            $contenido .= "<p>Mensaje: " . $respuestas['mensaje'] . "</p>";
            $contenido .= "<p>Dirigido a: " . $respuestas['tipo'] . "</p>";
           

            if($respuestas['contacto'] === 'telefono') {
                $contenido .= "<p>Eligió ser Contactado por Teléfono:</p>";
                $contenido .= "<p>Su teléfono es: " .  $respuestas['telefono'] ." </p>";
                $contenido .= "<p>En la Fecha y hora: " . $respuestas['fecha'] . " - " . $respuestas['hora']  . " Horas</p>";
            } else {
                $contenido .= "<p>Eligio ser Contactado por Email:</p>";
                $contenido .= "<p>Su Email  es: " .  $respuestas['email'] ." </p>";
            }

            $contenido .= '</html>';
            $mail->Body = $contenido;
            $mail->AltBody = 'Esto es texto alternativo';

            

            // send the message
             if(!$mail->send()){ //verificamos si se envia o no el mensaje
                $mensaje = 'Hubo un Error... intente de nuevo';
            } else {
                $mensaje = 'Email enviado Correctamente';
            }

        }
        
        $router->render('paginas/contacto', [
            'mensaje' => $mensaje // mostramos el mensaje en la vista
        ]);
    }
}