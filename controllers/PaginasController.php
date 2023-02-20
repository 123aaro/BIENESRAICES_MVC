<?php

namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController {
    public static function index( Router $router ) {

        $propiedades = Propiedad::get(3);

        $router->render('paginas/index', [
            'inicio' => true,
            'propiedades' => $propiedades
        ]);
    }

    public static function nosotros( Router $router ) {
        $router->render('paginas/nosotros', []); // Se puede dejar un arreglo vacio "[]" o se puede no poner nada
    }

    public static function propiedades( Router $router ) {

        $propiedades = Propiedad::all();

        $router->render('paginas/propiedades', [
            'propiedades' => $propiedades
        ]);
    }

    public static function propiedad(Router $router) {
        $id = validarORedireccionar('/propiedades');

        // Obtener los datos de la propiedad
        $propiedad = Propiedad::find($id);

        $router->render('paginas/propiedad', [
            'propiedad' => $propiedad
        ]);
    }

    public static function blog( Router $router ) {

        $router->render('paginas/blog');
    }

    public static function entrada( Router $router ) {
        $router->render('paginas/entrada');
    }


    public static function contacto( Router $router ) {
        $mensaje = null;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {


            // Validar 
            $respuestas = $_POST['contacto'];
        
            // create a new object
            $mail = new PHPMailer();
            // Configurar SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username = 'cb3b81f0d8e6eb';
            $mail->Password = '3e05c8555f93c0';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 2525;

            // Configurar el contenido del mail
            $mail->setFrom('admin@bienesraices.com', $respuestas['nombre']);
            $mail->addAddress('admin@bienesraices.com', 'BienesRaices.com');
            $mail->Subject = 'Tienes un Nuevo Email';
           
            // Habilitar HTML 
            $mail->isHTML(TRUE);
            $mail->CharSet = 'UTF-8'; 

            // Definir el contenido
            $contenido = '<html>';
            $contenido .= "<p><strong>Has Recibido un nuevo mensaje:</strong></p>";
            $contenido .= "<p>Nombre: " . $respuestas['nombre'] . "</p>";

            // Enviar de forma condicional algunos campos de email o télefono
            if($respuestas['contacto'] === 'telefono') {
                $contenido .= "<p>Eligió ser Contactado por Teléfono:</p>";
                $contenido .= "<p>Su teléfono es: " .  $respuestas['telefono'] ." </p>";
                $contenido .= "<p>En la Fecha y hora: " . $respuestas['fecha'] . " - " . $respuestas['hora']  . " Horas</p>";
            } else {
                $contenido .= "<p>Eligio ser Contactado por Email:</p>";
                $contenido .= "<p>Su Email  es: " .  $respuestas['email'] ." </p>";
            }
            $contenido .= "<p>Mensaje: " . $respuestas['mensaje'] . "</p>";
            $contenido .= "<p>Vende o Compra: " . $respuestas['opciones'] . "</p>";
            $contenido .= "<p>Presupuesto o Precio: $" . $respuestas['presupuesto'] . "</p>";
            $contenido .= '</html>';

            $mail->Body = $contenido;
            $mail->AltBody = 'Esto es texto alternativo';

            

            // Enviar el mail
            if(!$mail->send()){
                $mensaje = 'Hubo un Error... intente de nuevo';
            } else {
                $mensaje = 'Email Enviado Correctamente';
            }

        }
        
        $router->render('paginas/contacto', [
            'mensaje' => $mensaje
        ]);
    }
}