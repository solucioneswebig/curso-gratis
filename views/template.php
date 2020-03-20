<?php

$url_sitio    = ctrRuta();
$url_servidor = ctrRuta(); 


$title = "CURSO ONLINE GRATUITO";

include "includes/header.php";

if(!isset($_COOKIE['acepta_iqos_cookies'])){
	include "includes/cookies.php";
}


if(isset($_GET["slug"])){

	$rutas = explode("/", $_GET["slug"]);


}else{


		include "modules/home.php";
	
}

include "includes/footer.php";