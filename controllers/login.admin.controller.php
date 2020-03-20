<?php

session_start();


/*ACCEDER*/
if (isset($_POST['access_admin'])){

$mail = $_POST['mail_admin'];
$obtener_datos = select_one("SELECT * FROM iqos_useradmin WHERE mail_admin ='".$mail."'");

  if(password_verify($_POST['pass_admin'], $obtener_datos['pass_admin'])) {
  $_SESSION['user_admin']  = $obtener_datos['id_useradmin'];
  }


}
/*ACCEDER*/

/*REGISTRAR*/
if (isset($_POST['register_admin'])){
$data = [
	"id_useradmin"   => 0,
	"name_admin"      => "Alexander",
	"mail_admin"      => "alexanderr677@gmail.com",
	"pass_admin"     => encriptar("Ale1234"),
	"role_admin"      => 1,
	"estatus_admin"   => 1
];
$guardar = insert("iqos_useradmin",$data);
}
/*REGISTRAR*/
