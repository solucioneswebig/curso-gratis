<?php


/*AÑADIR GENERO*/
if(isset($_POST['add_gen_name'])):

$guardado = 0;

$data = [

	"id_gen_name" => 0,
	"name_gen_name" => $_POST["name_gen_name"],
	"number_gen_name"  => $_POST["number_gen_name"],
	"estatus_gen_name" => 1
];

$guardar = insert("iqos_gen_name",$data);

if($guardar){
	$guardado = 1;
	header("Location: ".$url_sitio."admin-nombres");
}

endif;
/*AÑADIR GENERO*/


/*Eliminar*/
if(isset($_POST['delete_name'])):

$where = [

	"id_gen_name" => $_POST['id_gen_name']

];

$borrar = delete("iqos_gen_name", $where);

if($borrar){
	header("Location: ".$url_sitio."admin-nombres");
}
endif;
/*Eliminar*/


/*Actualizar ESTATUS*/
if(isset($_POST['update_estatus_name'])):

$data = [

	"estatus_gen_name" => $_POST['valor_estatus']

];

$where = [

	"id_gen_name" => $_POST['id_gen_name']

];

$actualizar = update("iqos_gen_name", $where,$data);

if($actualizar){
	header("Location: ".$url_sitio."admin-nombres");
}
endif;
/*Actualizar ESTATUS*/

/*Actualizar DATOS*/
if(isset($_POST['edit_gen_name'])):

$guardado = 0;

$data = [

	"name_gen_name" => $_POST["name_gen_name"]

];

$where = [

	"id_gen_name" => $_POST["id_gen_name"]

];

$guardar = update("iqos_gen_name",$where,$data);

if($guardar){
	$guardado = 1;
	header("Location: ".$url_sitio."admin-nombres");
}

endif;
/*Actualizar DATOS*/