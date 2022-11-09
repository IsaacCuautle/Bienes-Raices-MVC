<?php 

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController{

    public static function index(Router $router){

        $propiedad01 = Propiedad::get(3);

        $inicio = true;

        $auth = null;

        $router->render('/paginas/index',[
            'propiedad01' => $propiedad01,
            'inicio' => $inicio,
            'auth' => $auth
        ]);

    }

    public static function nosotros(Router $router){
        $router->render('/paginas/nosotros');
    }

    public static function propiedades(Router $router){

        $propiedad01 = Propiedad::all();

        $router->render('/paginas/propiedades',[
            'propiedad01' => $propiedad01
        ]);
    }

    public static function propiedad(Router $router){
        
        $id =  validarORedireccionar('/propiedades');
        
        $propiedad = Propiedad::find($id);

        $router->render('/paginas/propiedad',[
            'propiedad' => $propiedad,
        ]);
    }
    public static function blog(Router $router){
        $router->render('/paginas/blog');
    }

    public static function entrada(Router $router){
        $router->render('/paginas/entrada');
    }

    public static function contacto(Router $router){

        $mensaje = null;

        if($_SERVER['REQUEST_METHOD']==='POST'){
            $respuestas = $_POST['contacto'];

            //Crear una instacia de PHPMailer
            $mail = new PHPMailer();

            //Configurar SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username ='00b7e2e9cf6fe4';
            $mail->Password ='747d6435f5075a';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 2525;

            //Configurar el contenido del mail
            $mail->setFrom('admin@binesraices.com');
            $mail->addAddress('admin@bienesraices.com','BienesRaices.com');
            $mail->Subject = 'Tienes un nuevo mensaje';

            //Habiitar HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            //Definir el contenido
            $contenido = '<html>';
            $contenido .= '<h1><p>Tienes un nuevo mensaje</p></h1>';
            $contenido .= '<p>Nombre: ' . $respuestas['nombre'] . '</p>';
            
            //Enviar de forma condicional algunos campos de email o telefono
            if($respuestas['contacto'] === 'telefono'){
                //Agrega los campos de telefono
                $contenido .= '<p>Elijio ser contactado por: '.$respuestas['contacto'].'</p>';
                $contenido .= '<p>Telefono: ' . $respuestas['telefono'] . '</p>';
                $contenido .= '<p>Fecha de contacto: ' . $respuestas['fecha'] . '</p>';
                $contenido .= '<p>Hora de contacto: ' . $respuestas['hora'] . '</p>';
                
            }else{
                //Agrega el campo de email
                $contenido .= '<p>Elijio ser contactado por: '.$respuestas['contacto'].'</p>';
                $contenido .= '<p>Email: ' . $respuestas['email'] . '</p>';
            }

            $contenido .= '<p>Mensaje: ' . $respuestas['mensaje'] . '</p>';
            $contenido .= '<p>Vende o Compra: ' . $respuestas['tipo'] . '</p>';
            $contenido .= '<p>Precio o Presupuesto: $' . $respuestas['precio'] . '</p>';
            $contenido .= '</html>';

            $mail->Body = $contenido;
            $mail->AltBody ='Esto es texto alternativo sin HTML';

            //Enviar el email
            if($mail->send()){
                
                $mensaje = 'El mensaje se envio correctamente';
            }else{
                $mensaje = 'El mensaje no pudo ser envio';
            }
        }

        $router->render('/paginas/contacto',[
            'mensaje' => $mensaje
        ]);
    }
}

