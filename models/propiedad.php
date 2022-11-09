<?php

namespace Model;

class Propiedad extends ActiveRecord
{

    protected static $tabla = 'propiedades';
    protected static $columnas = [
        'id', 'titulo', 'imagen', 'precio', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'estacionamiento', 'vendedorId', 'creado'
    ];

    public $id;
    public $titulo;
    public $imagen;
    public $precio;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $vendedorId;
    public $creado;

    public function __construct($agrs = [])
    {
        $this->id = $agrs['id'] ?? null;
        $this->titulo = $agrs['titulo'] ?? '';
        $this->imagen = $agrs['imagen'] ?? '';
        $this->precio = $agrs['precio'] ?? '';
        $this->descripcion = $agrs['descripcion'] ?? '';
        $this->habitaciones = $agrs['habitaciones'] ?? '';
        $this->wc = $agrs['wc'] ?? '';
        $this->estacionamiento = $agrs['estacionamiento'] ?? '';
        $this->vendedorId = $agrs['vendedorId'] ?? '';
        $this->creado = date('Y/m/d');
    }

    public function validar()
      {
  
          if (!$this->titulo) {
              self::$errores[] = 'Debes añadir un Titulo';
          }
          if (!$this->precio) {
              self::$errores[] = 'El Precio es Obligatorio';
          }
          if (strlen($this->descripcion) < 50) {
              self::$errores[] = 'La Descripción es obligatoria y debe tener al menos 50 caracteres';
          }
          if (!$this->habitaciones) {
              self::$errores[] = 'La Cantidad de Habitaciones es obligatoria';
          }
          if (!$this->wc) {
              self::$errores[] = 'La cantidad de WC es obligatoria';
          }
          if (!$this->estacionamiento) {
              self::$errores[] = 'La cantidad de lugares de estacionamiento es obligatoria';
          }
          if (!$this->vendedorId) {
              self::$errores[] = 'Elige un vendedor';
          }
  
          if (!$this->imagen) {
              self::$errores[] = 'Imagen no válida';
          }
          
          return self::$errores;
      }
}
