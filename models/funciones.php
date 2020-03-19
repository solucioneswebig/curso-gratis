<?php 


function encriptar($password){
  return	$clave_cifrada = password_hash($password, PASSWORD_DEFAULT, array("cost"=>15));
}

