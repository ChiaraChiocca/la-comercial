<?php
require_once('config.php'); // Requerimos el archivo config.php

/* Definimos la clase principal */
class Modelo {
    // Definimos la propiedad de db
    protected $db;
    // Creamos el constructor con la conexión a la BD
    public function __construct() 
    {
       $this->db = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
       // Si se produce un error de conexión, muestra el error
       if($this->db->connect_errno) {
        echo "Fallo al conectar a MySQL: " .$this->db->connect_error;
        return;
       } 
       // Establecemos el conjunto de caracteres a utf8
       $this->db->set_charset(DB_CHARSET);
       $this->db->query('SET NAMES "UTF8"');
    }
}
/* Fin de la clase principal */

/* Clase ModeloABM basada en la clase modelo */
class ModeloABM extends Modelo {
    // Propiedades
    private $tabla;
    private $id = 0;
    private $criterio = '';
    private $campos = '*';
    private $orden = 'id';
    private $limit = 0;

    // Método constructor
    public function __construct($t) 
    {
        parent:: __construct(); // Ejecutamos el constructor de la clase padre
        $this->tabla = $t; // Asignamos a $tabla el parámetro $t
    }

    /* GETTER */
    public function get_tabla() {
        return $this->tabla;
    }
    public function get_id() {
        return $this->id;
    }
    public function get_criterio() {
        return $this->criterio;
    }
    public function get_campos() {
        return $this->campos;
    }
    public function get_orden() {
        return $this->orden;
    }
    public function get_limit() {
        return $this->limit;
    }

    /* SETTER */
    public function set_tabla($tabla) {
        $this->tabla = $tabla;
    }
    public function set_id($id) {
        $this->id = $id;
    }
    public function set_criterio($criterio) {
        $this->criterio = $criterio;
    }
    public function set_campos($campos) {
        $this->campos = $campos;
    }
    public function set_orden($orden) {
        $this->orden = $orden;
    }
    public function set_limit($limit) {
        $this->limit = $limit;
    }

    /**
     * Selecciona datos de una tabla
     */
    public function seleccionar() {
        // SELECT * FROM productos WHERE id=3 ORDER BY id LIMIT 10

        // Guardamos en $sql la instrucción SELECT
        $sql = "SELECT $this->campos FROM $this->tabla";
        // Si el criterio NO es igual a NADA
        if($this->criterio != '') {
            // Agregamos el criterio
            $sql .= " WHERE $this->criterio";
        }
        // Agregamos el orden
        $sql .= " ORDER BY $this->orden";
        // Si el limite es mayor que cero
        if($this->limit > 0) {
            $sql .= " LIMIT $this->limit";
        }
        echo $sql. "<br />"; // Mostramos la instrucción SQL
        // Ejecutamos la consulta y la guardamos en $resultado
        $resultado = $this->db->query($sql); 
        // Guardamos los datos en el array asociativo
        $datos = $resultado->fetch_all(MYSQLI_ASSOC);
        // Convertimos los datos en formato JSON
        $datos_json = json_encode($datos);
        // Retornamos los datos en formato JSON
        return $datos_json;
    }
}
?>