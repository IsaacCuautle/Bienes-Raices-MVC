<?php 

namespace Model;

class ActiveRecord {
      //Base de datos
      protected static $db;
      protected static $columnas = [];
      
      protected static $tabla = "";
  
      //Validacion 
      protected static $errores = [];
  
  
      
  
      //Definir la conecxion a la base de datos
      public static function setDB($datbase)
      {
          self::$db = $datbase;
      }
  
     
  
      public function guardar(){
  
          if(!is_null($this->id)){
              //Actualizar
  
              $this->actualizar();
  
          }else{
  
          //Creando un nuevo registro 
          $this->crear();
          }
      }
      
  
      public function crear()
      {
          //Sanitizar la entrada de datos
          $atributos = $this->Sanitizar();
  
  
          //Insertar en la vbase de datos 
          $query = "INSERT INTO ". static::$tabla." ( ";
          $query .= join(', ', array_keys($atributos));
          $query .= " ) VALUES (' ";
          $query .= join(" ', '", array_values($atributos));
          $query .= " ')";
  
          $resultado = self::$db->query($query);
  
          if ($resultado) {
              header('Location: /admin?mensaje=1');
          }

  
      }
  
      public function actualizar(){
          //Sanitizar la entrada de datos
          $atributos = $this->Sanitizar();
      
          $valores=[];
          foreach($atributos as $key => $value){
              $valores[] = "{$key} = '{$value}'";
          }
  
          $query = join(', ' ,$valores);
  
          $query = "UPDATE ". static::$tabla ." SET ";
          $query .= join(', ' ,$valores);
          $query .= "WHERE id = ' ". self::$db->escape_string($this->id) ."' ";
          $query .= "LIMIT 1";
  
          $resultado = self::$db->query($query);
  
          
          if ($resultado) {
              header('location: /admin?mensaje=2');
          }
      }
  
      //Eliminar un registro
      public function eliminar(){ 
          $query = "DELETE FROM " .static::$tabla. " WHERE id =" . self::$db->escape_string($this->id) . " LIMIT 1";
  
          $resultado = self::$db->query($query);
  
          if ($resultado) {
              $this->borrarImagen(); 
              header('Location: /admin?mensaje=3');
          }
      }
  
      public function atributos()
      {
          $atributos = [];
          foreach (static::$columnas as $columna) {
              if ($columna === 'id') continue;
              $atributos[$columna] = $this->$columna;
          }
          return $atributos;
      }
  
      public function sanitizar()
      {
          $atributos = $this->atributos();
          $sanitizado = [];
  
  
          foreach ($atributos as $key => $value) {
  
              $sanitizado[$key] = self::$db->escape_string($value);
          }
  
          return $sanitizado;
      }
  
      //Subida de Archivos
      public function setImage($imagen)
      {
          //Asignar al atributo de la imagen el nombre de la imagen
          if(!is_null($this->id)){
  
          $this->borrarImagen();
          
          }
  
          if ($imagen) {
              $this->imagen = $imagen;
          }
  
      }
  
      //Elimina el archivo
  
      public function borrarImagen(){
          
              //comprobar si existe archivo
              $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
              if($existeArchivo) {
              unlink(CARPETA_IMAGENES . $this->imagen);
              }
          
      }
  
      //Validacion
      public static function getErrores()
      {
          return static::$errores;
      }
  
      public function validar()
      {
        static::$errores  = [];
        return static::$errores;
      }
  
      //Lista de todas la propiedades
      public static function all()
      {
          $query = "SELECT * FROM ". static::$tabla;
          $resltado = static::consultarSQL($query);
  
          return $resltado;
      }

      //Obtiene determinado numero de registros
      public static function get($cantidad)
      {
          $query = "SELECT * FROM ". static::$tabla . " LIMIT " . $cantidad;
          $resltado = static::consultarSQL($query);
          
          return $resltado;
      }
  
      //Busca una Propiedad por su ID
      public static function find($id){
          $query = "SELECT * FROM ".static::$tabla." WHERE id = ${id}";
          $resultado = self::consultarSQL($query);
  
          return array_shift($resultado);
      }
  
      public static function consultarSQL($query)
      {
          //Consultar la base de datos 
          $resultado = self::$db->query($query);
  
          //Iterar los resultados
          $array = [];
          while ($registro = $resultado->fetch_assoc()) {
              $array[] = static::crearObjeto($registro);
          }
  
  
          //Liberar la memoria
          $resultado->free();
  
          //Retornar los resultados
          return $array;
      }
  
      protected static function crearObjeto($registro)
      {
          $objeto = new static;
  
          foreach ($registro as $key => $value) {
              if (property_exists($objeto, $key)) {
  
                  $objeto->$key = $value;
              }
          }
  
          return $objeto;
      }
  
      //Sincroniza el objeto en memoria con los cambios realizados por el usuario
      public function sincronizar($args = []){
          foreach($args as $key => $value){
              if(property_exists($this, $key) && !is_null($value)){
                  $this->$key = $value;
              }
          }
      }
}
