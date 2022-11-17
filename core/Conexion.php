<?php
/*
Este archivo corresponde a la clase Conexión, la cual permitirá la creación de una conexión a la base de datos del servidor de MySQL.
*/

class Conexion {
    private $driver;
    private $host;
    private $user;
    private $pass;
    private $database;
    private $charset;
    
    public function __construct() {
        require_once("config/database.php"); //Se incluye el archivo que contiene todos los valores de las constantes que utilizaremos para la conexión a la base de datos.
        $this->driver = db_driver; 
        $this->host = db_host;
        $this->user = db_user;
        $this->pass = db_pass;
        $this->database = db_name;
        $this->charset = db_charset;
    }
    
    public function conexion() { //Este método permitirá la creación a la base de datos con los datos asignados en el constructor a cada una de las variables de la clase.
        $conexion = null;
        try { // Se declara un bloque try-catch para el manejo de errores
            $conexion = new PDO($this->driver.":host=".$this->host.";dbname=".$this->database.";charset=".$this->charset, $this->user, $this->pass);
        }catch (PDOException $e) {
            throw new Exception("No se pudo establecer la conexión"); //Se lanza una excepción en caso de que no se pueda realizar una conexión a la base de datos
        }
        return $conexion; //Se retorna la variable que contiene el objeto PDO de la conexión realizada
    }
}

?>