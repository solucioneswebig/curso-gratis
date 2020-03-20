<?php


/*AÑADIR*/
if(isset($_POST['add_menu'])):

$guardado = 0;

$data = [

	"id_menu" => 0,
	"string_menu" => $_POST["string_menu"],
	"slug_menu"  => $_POST["slug_menu"],
	"position_menu" => $_POST["position_menu"],
	"estatus_menu" => 1
];

$guardar = insert("iqos_menu",$data);

if($guardar){
	$guardado = 1;
	header("Location: ".$url_sitio."admin-menu");
}

endif;
/*AÑADIR*/


/*Eliminar*/
if(isset($_POST['delete_menu'])):

$where = [

	"id_menu" => $_POST['id_menu']

];

$borrar = delete("iqos_menu", $where);

if($borrar){
	header("Location: ".$url_sitio."admin-menu");
}
endif;
/*Eliminar*/


/*Actualizar ESTATUS*/
if(isset($_POST['update_estatus'])):

$data = [

	"estatus_menu" => $_POST['valor_estatus']

];

$where = [

	"id_menu" => $_POST['id_menu']

];

$actualizar = update("iqos_menu", $where,$data);

if($actualizar){
	header("Location: ".$url_sitio."admin-menu");
}
endif;
/*Actualizar ESTATUS*/

/*Actualizar DATOS*/
if(isset($_POST['edit_menu'])):

$guardado = 0;

$data = [

	"string_menu" => $_POST["string_menu"],
	"slug_menu"  => $_POST["slug_menu"],
	"position_menu" => $_POST["position_menu"],
	"estatus_menu" => 1
];

$where = [

	"id_menu" => $_POST["id_menu"]

];

$guardar = update("iqos_menu",$where,$data);

if($guardar){
	$guardado = 1;
	header("Location: ".$url_sitio."admin-menu");
}

endif;
/*Actualizar DATOS*/