<?php 

namespace MVC;

class Router{

    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $fn){
        $this->rutasGET[$url] = $fn;
    }
    public function post($url, $fn){
        $this->rutasPOST[$url] = $fn;
    }

    public function comprobarRutas(){

        session_start();
        $auth = $_SESSION['login'] ?? null;


        // Arreglo de rutas protegidas..
        $rutas_protegidas = ['/admin', '/propiedades/crear', '/propiedades/actualizar', '/propiedades/eliminar', '/vendedores/crear', '/vendedores/actualizar', '/vendedores/elminar'];

        $urlActual = $_SERVER['REQUEST_URI'] === '' ? '/' : $_SERVER['REQUEST_URI'];
        $metodo = $_SERVER['REQUEST_METHOD']; 


        if($metodo === 'GET'){
            $fn = $this->rutasGET[$urlActual] ?? null;
        } else {
            $fn = $this->rutasPOST[$urlActual] ?? null;
        }

        // Proteger las rutas 
        if(in_array($urlActual, $rutas_protegidas) && !$auth) {
            header('Location: /');
        }

        if($fn){
            // La url existe y hay una funcion asociada
          
            call_user_func($fn, $this);
        } else {
            echo"pagina no encontrada";
        }
    }

    //  Muestra una vista 
    public function render($view, $datos = []){

        foreach($datos as $key => $value){
            $$key = $value;
        }

        ob_start(); // almacenamiento en memoria durante un minuto 

        include __DIR__ . "/views/$view.php";
        $contenido = ob_get_clean();// limpia el buffer
        include __DIR__ . "/views/layout.php";  
    }
}