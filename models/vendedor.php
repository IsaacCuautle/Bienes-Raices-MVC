<?php 

namespace Model;

class Vendedor extends ActiveRecord{
    
    protected static $tabla = 'vendedores';
    protected static $columnas = [
        'id', 'nombre', 'apellido', 'telefono'
    ];

    public $id;
    public $nombre;
    public $apellido;
    public $telefono;
    
    public function __construct($agrs = [])
    {
        $this->id = $agrs['id'] ?? null;
        $this->nombre = $agrs['nombre'] ?? '';
        $this->apellido = $agrs['apellido'] ?? '';
        $this->telefono = $agrs['telefono'] ?? '';
    }

    public function validar()
    {

        if (!$this->nombre) {
            self::$errores[] = 'Debes añadir un Nombre';
        }

        if (!$this->apellido) {
            self::$errores[] = 'Debes añadir un Apellido';
        }

        if (!$this->telefono) {
            self::$errores[] = 'Debes añadir un Telefono';
        }

        if(!preg_match('/[0-9]{10}/',$this->telefono)){
            self::$errores[] = 'El Telefono no es valido';
        }
        
        return self::$errores;
    }
}