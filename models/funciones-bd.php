<?php
require_once "conexion.php";
/*FUNCION SELECCIONAR VARIOS*/

function select_all($sql){
			$conexion = new Conexion();
			$stmt = $conexion->prepare($sql);
            $stmt->execute();  
            $datos = $stmt->fetchAll();
			$stmt = null;
			return $datos;
}
/*FUNCION SELECCIONAR VARIOS FIN*/
/*FUNCION SELECCIONAR UNO*/
function select_one($sql){
			$conexion = new Conexion();
			$stmt = $conexion->prepare($sql);
            $stmt->execute();  
            $datos = $stmt->fetch();
			$stmt = null;
			return $datos;
}
/*FUNCION SELECCIONAR UNO FIN*/
/*FUNCION INSERTAR*/
function insert($bd,$data){
$data_one = "";
$data_two = "";
$contador = count($data);
$i = 1;
foreach ($data as $key => $value) {
		if($i < $contador){
			$data_one .= $key.",";
			$data_two .= ":".$key.",";
		}else{
			$data_one .= $key;
			$data_two .= ":".$key;
		}
		$i++;
}
 $sql = "INSERT INTO ".$bd." (".$data_one.") VALUES (".$data_two.")";
$conexion = new Conexion();
$stmt= $conexion->prepare($sql);
$dato = $stmt->execute($data);
//$stmt = null;
return $dato;
}
/*FUNCION INSERTAR FIN*/
/*FUNCION BORRAR*/
function delete($bd,$where){
foreach ($where as $key => $value) {
	$campo = $key;
	$value_campo = $value;
}
$sql = "DELETE FROM ".$bd."
WHERE ".$campo." = ".$value_campo."";
$conexion = new Conexion();
$stmt= $conexion->prepare($sql);
$dato = $stmt->execute();
$stmt = null;
return $dato;
}
/*FUNCION BORRAR FIN*/
/*FUNCION ACTUALIZAR*/
function update($bd,$where,$data){
$data_one = "";
$contador = count($data);
$i = 1;
foreach ($data as $key => $value) {

		if($i < $contador){
			$data_one .= $key."=:".$key.",";
		}else{
			$data_one .= $key."=:".$key;
		}
		$i++;
}
foreach ($where as $key => $value) {
	$campo_where = $key;
	$value_where = $value;
}
 $sql = "UPDATE ".$bd." SET ".$data_one." WHERE ".$campo_where."=".$value_where."";
 $conexion = new Conexion();
$stmt= $conexion->prepare($sql);
$dato =  $stmt->execute($data);
$stmt = null;
return $dato;
}
/*FUNCION ACTUALIZAR FIN*/

/*LAST ID*/

function last_id(){
	$conexion = new Conexion();	
	$link = $conexion;
	return $link->lastInsertId();
}

/*LAST ID FIN*/

function id_registro($campo,$tabla){

$sql = "SELECT MAX(".$campo.") FROM ".$tabla."";
$conexion = new Conexion();
$stmt= $conexion->prepare($sql);
$stmt->execute();
$datos = $stmt->fetch();
$stmt = null;
return $datos[0]+1;

}
/**
 * 
 *  FIN FUNCIONES BD 
 * 
 */
/**
 *  ////////////////////////////////////////////////////////////////////////////////////////////////////////////
 *  ///////////////////////////////////////////////////////////////////////////////////////////////////////////
 *  ///////////////////////////////////////////////////////////////////////////////////////////////////////////
 */

/**
 * 
 *  COMIENZO FUNCIONES EXTRAS
 * 
 */

 /**
 * 
 *  FUNCION URL AMIGABLE
 * 
 */

function format_uri( $string, $separator = '-' )
{
    $accents_regex = '~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i';
    $special_cases = array( '&' => 'and', "'" => '');
    $string = mb_strtolower( trim( $string ), 'UTF-8' );
    $string = str_replace( array_keys($special_cases), array_values( $special_cases), $string );
    $string = preg_replace( $accents_regex, '$1', htmlentities( $string, ENT_QUOTES, 'UTF-8' ) );
    $string = preg_replace("/[^a-z0-9]/u", "$separator", $string);
    $string = preg_replace("/[$separator]+/u", "$separator", $string);
    return $string;
}

/**
 * 
 *  FUNCION TRAER TOTAL REGISTROS DE UNA TABLA
 * 
 */

 function total_registros($tabla,$campo){
	$total = select_all("SELECT * FROM ".$tabla." where ".$campo." = 1");
	return $total = count($total);
}

/**
 * 
 *  FUNCION TRAER TOTAL PUNTAJE DE LA BANDA
 * 
 */

tiempo_puntaje_banda_auto();

function tiempo_puntaje_banda_auto(){
	$total = select_all("SELECT * FROM iqos_banda WHERE estatus_banda = '1' and banda_ganador = '0'");

	foreach ($total as $key):
		
		$total_tiempo = score_banda_tiempo($key['id_banda']);
		$total_score = score_banda_puntaje($key['id_banda']);

		$data = [
			"score_banda" => $total_score,
			"tiempo_banda"   => $total_tiempo
		];
	
		$where = [
			"id_banda" => $key['id_banda']
		];

		$guardar = update("iqos_banda",$where,$data);

	endforeach;

}

function score_banda_puntaje($id_banda){
  $total = select_all("SELECT * FROM iqos_banda as banda 
  JOIN iqos_integrante as integrante on banda.id_banda = integrante.id_banda 
  JOIN iqos_respuestas as respuesta on integrante.id_integrante = respuesta.id_participante
  and banda.id_banda =".$id_banda."");
  $puntaje_total = 0;
  foreach($total as $key):
	$puntaje_total += $key["respuesta_puntaje"];
  endforeach;

  return $puntaje_total;
}

/*
 * 
 *  FUNCION TRAER TOTAL TIEMPO DE LA BANDA
 * 
 */

function score_banda_tiempo($id_banda){
	$total = select_all("SELECT * FROM iqos_banda as banda 
	JOIN iqos_integrante as integrante on banda.id_banda = integrante.id_banda 
	JOIN iqos_respuestas as respuesta on integrante.id_integrante = respuesta.id_participante
	and banda.id_banda =".$id_banda."");
	$tiempo_total = 0;
	foreach($total as $key):
	  $tiempo_total += $key["respuesta_segundos"];
	endforeach;
	
	return $tiempo_total;
  }

  /*
 * 
 *  COMIENZO VALIDAR RECAPCHA DE GOOGLE
 * 
 */
function post_captcha($user_response) {
    $fields_string = '';
    $fields = array(
        'secret' => '6LcbFuEUAAAAAILVdCO0EDzHN7qB7xWtKlX66K5P',
        'response' => $user_response
    );
    foreach($fields as $key=>$value)
    $fields_string .= $key . '=' . $value . '&';
    $fields_string = rtrim($fields_string, '&');

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
    curl_setopt($ch, CURLOPT_POST, count($fields));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);

    $result = curl_exec($ch);
    curl_close($ch);

    return json_decode($result, true);
}
/*
 * 
 *  FIN VALIDAR RECAPCHA DE GOOGLE
 * 
 */