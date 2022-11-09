<?php 

namespace MVC;

use GuzzleHttp\Psr7\Header;

class Router {
   
    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url,$fn){
        $this->rutasGET[$url] = $fn;
    }

    public function post($url,$fn){
        $this->rutasPOST[$url] = $fn;
    }

    public function comprobarRutas(){
        session_start();
        $auth = $_SESSION['login'] ?? null;

        //Areglo de rutas protegidas
        $rutasProtegidas = ['/admin','/propiedades/crear','/propiedades/actualizar','/propiedades/eliminar',
        '/vendedores/crear','/vendedores/actualizar','/vendedores/borrar'];


        $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        $metodo = $_SERVER['REQUEST_METHOD'];

        if($metodo === 'GET'){
            $fn = $this->rutasGET[$urlActual] ?? null;
        } else {
            $fn = $this->rutasPOST[$urlActual] ?? null;
        }

        //Proteger las rutas
        if(in_array($urlActual, $rutasProtegidas) && !$auth){
                header('Location: /');
                return;
        }

        if($fn){
            //La URL existe
            call_user_func($fn,$this);
        }else{
            echo "Pagina no encontrada";
        }

    }
    
    //Muestra una vista 
    public function render($view,$datos = []) {

        foreach($datos as $key => $value){
            $$key = $value;
        }

        ob_start(); //Almacena en memoria durante un momento...
        include __DIR__ . './views/'. $view . '.php';

        $contenido = ob_get_clean(); //Limpia el buffer

        include __DIR__ . "./views/layout.php";
        
    }
}
