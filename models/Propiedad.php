<?php

/** Todo lo que este como pubilic, hago referencia a el com $this
 * Todo lo que este como static, hago referencia a el como self::
 */

namespace Model;



class Propiedad extends ActiveRecord {
    protected static $tabla = 'propiedades';
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 
    'estacionamiento', 'creado', 'vendedorId'];
   
    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedorId;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedorId = $args['vendedorId'] ?? '';
    }

    public function validar() {
        if (!$this->titulo) {
            self::$errores[] = "Debes añadir un titulo";
        }


        if (!$this->precio) {
            self::$errores[] = "El precio debe ser obligatorio";
        }
        if (strlen($this->descripcion) < 50) {
            self::$errores[] = "La descripcion es obligatoria y debe de tener al menos 50 caracteres";
        }

        if (!$this->habitaciones) {
            self::$errores[] = "El numero de habitaciones es obligatorio";
        }

        if (!$this->wc) {
            self::$errores[] = "El número de baños es obligatorio";
        }

        if (!$this->estacionamiento) {
            self::$errores[] = "El número de lugares de estacionamiento es obligatorio";
        }

        if (!$this->vendedorId) {
            self::$errores[] = "Elige un vendedor";
        }

         if(!$this->imagen){
             self::$errores[] = "La imagen de la propiedad es obligatoria"; 
         }



        return self::$errores;
    }
}
