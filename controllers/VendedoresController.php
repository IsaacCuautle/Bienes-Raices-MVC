<?php

namespace Controllers;

use MVC\Router;
use Model\Vendedor;

class VendedoresController
{

    public static function crear(Router $router){
        $vendedores = new Vendedor();

        $errores = Vendedor::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            //Crear un anueva instacio
            $vendedor= new Vendedor($_POST['vendedor']);
        
            //Validar que no halla campos vacios
            $errores = $vendedor->validar();
        
            //No hay errores
            if(empty($errores)){
                $vendedor->guardar();
            }
        
        }

        $router->render('/vendedores/crear',[
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }

    public static function actualizar(Router $router){
    $id = validarORedireccionar('/admin');
    
    //Obtener el arreglo del vendedor
    $vendedores = Vendedor::find($id);

    //Arreglo con mensajes de error
    $errores = Vendedor::getErrores();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //Asignar los valores
    $args = $_POST['vendedor'];

    //Sincronizar objeto en memoria
    $vendedores->sincronizar($args);

    //Validacion
    $errores = $vendedores->validar();

    if (empty($errores)) {
        $vendedores->guardar();
    }
    }
    
        $router->render('/vendedores/actualizar',[
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }

    public static function borrar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            //Validar Id
            // Sanitizar número entero
            $id = $_POST['id_eliminar'];
            $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        
            if ($id) {
        
                $tipo = $_POST['tipo'];
        
        
                if (validarContenido($tipo)) {
                    //Obtener los datos de la propiedad
                    $vendedor =  Vendedor::find($id);
                    $vendedor->eliminar();
                }
            }
         }
    }

}