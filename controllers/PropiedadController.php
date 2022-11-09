<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

class PropiedadController
{

    public static function index(Router $router)
    {

        $propiedades = Propiedad::all();
        $mensaje = $_GET['mensaje'] ?? null;
        $vendedores = Vendedor::all();
        

        $router->render('propiedades/admin', [
            'propiedades' => $propiedades,
            'mensaje' => $mensaje,
            'vendedores' => $vendedores
            
        ]);
    }

    public static function crear(Router $router)
    {
        $propiedad01 = new Propiedad();
        $vendedores = Vendedor::all();

        $errores = Propiedad::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            //Crea una nueva instancioa
            $propiedad01 = new Propiedad($_POST['propiedad']);


            //Genera un nombre unico
            $RutaImagen = md5(uniqid(rand(), true)) . ".jpg";

            //Setea la imagen
            //Realiza un resize a la imagen con  intervention
            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                $imagen = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
                $propiedad01->setImage($RutaImagen);
            }


            // Validar
            $errores = $propiedad01->validar();

            if (empty($errores)) {

                // Crear la carpeta para subir imagenes
                if (!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }

                // Guarda la imagen en el servidor
                $imagen->save(CARPETA_IMAGENES . $RutaImagen);

                // Guarda en la base de datos
                $propiedad01->guardar();
            }
        }

        $router->render('propiedades/crear', [
            'propiedad01' => $propiedad01,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }

    public static function actualizar(Router $router)
    {

        $id = validarORedireccionar('/admin');
        $propiedad01 = Propiedad::find($id);
        $vendedores = Vendedor::all();
        $errores = Propiedad::getErrores();


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            //Asignar los atributos
            $args = $_POST['propiedad'];
        
            $propiedad01->sincronizar($args);
        
            //Validacion
            $errores = $propiedad01->validar();
        
            //Genera un nombre unico
            $imagePath = md5(uniqid(rand(), true)) . ".jpg";
        
            //Subida de archivos
            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
                $propiedad01->setImage($imagePath);
            }
        
        
            // El array de errores esta vacio
            if(empty($errores)) {
                // Almacenar la imagen
                if($_FILES['propiedad']['tmp_name']['imagen']) {
                    $image->save(CARPETA_IMAGENES . $imagePath);
                }
        
                $propiedad01->guardar();
            }
        }

        $router->render('/propiedades/actualizar',[
            'propiedad01' => $propiedad01,
            'errores' => $errores,
            'vendedores' => $vendedores
        ]);
    }

    public static function eliminar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            //Validar Id
            // Sanitizar número entero
            $id = $_POST['id_eliminar'];
            $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        
            if ($id) {
        
                $tipo = $_POST['tipo'];
        
        
                if (validarContenido($tipo)) {
                    //Obtener los datos de la propiedad
                    $propiedad01 =  Propiedad::find($id);
                    $propiedad01->eliminar();
                }
            }
         }
    }

   
}