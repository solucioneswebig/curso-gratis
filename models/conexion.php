<?php 
/**
 * 
 *  CONEXION SERVIDOR
 *
 */

class Conexionother extends PDO { 
	private $tipo_de_base = 'mysql';
	private $host = 'localhost';
	private $nombre_de_base = 'director_directorio';
	private $usuario = 'director_admon';
	private $contrasena = 'Qls%jZ5VnKg5'; 
	public function __construct() {
	  //Sobreescribo el método constructor de la clase PDO.
	  try{
		 parent::__construct("{$this->tipo_de_base}:dbname={$this->nombre_de_base};host={$this->host};charset=utf8", $this->usuario, $this->contrasena);
	  }catch(PDOException $e){
		 echo 'Ha surgido un error y no se puede conectar a la base de datos. Detalle: ' . $e->getMessage();
		 exit;
	  }
	} 
}      

/**
 * 
 * CONEXION LOCAL
 */
/*
class Conexion extends PDO { 
	private $tipo_de_base = 'mysql';
	private $host = 'localhost';
	private $nombre_de_base = 'iqos_base';
	private $usuario = 'root';
	private $contrasena = ''; 
	public function __construct() {
	  //Sobreescribo el método constructor de la clase PDO.
	  try{
		 parent::__construct("{$this->tipo_de_base}:dbname={$this->nombre_de_base};host={$this->host};charset=utf8", $this->usuario, $this->contrasena);
	  }catch(PDOException $e){
		 echo 'Ha surgido un error y no se puede conectar a la base de datos. Detalle: ' . $e->getMessage();
		 exit;
	  }
	} 
} 
*/
//fin de la clase Conexion