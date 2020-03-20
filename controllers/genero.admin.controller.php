<?php


/*AÑADIR GENERO*/
if(isset($_POST['add_gen_genero'])):

$guardado = 0;

$data = [

	"id_gen_genero" => 0,
	"name_gen_genero" => $_POST["name_gen_genero"],
	"number_gen_genero"  => $_POST["number_gen_genero"],
	"estatus_gen_genero" => 1
];

$guardar = insert("iqos_gen_genero",$data);

if($guardar){
	$guardado = 1;
	header("Location: ".$url_sitio."admin-generos");
}

endif;
/*AÑADIR GENERO*/


/*Eliminar*/
if(isset($_POST['delete_genero'])):

$where = [

	"id_gen_genero" => $_POST['id_gen_genero']

];

$borrar = delete("iqos_gen_genero", $where);

if($borrar){
	header("Location: ".$url_sitio."admin-generos");
}
endif;
/*Eliminar*/


/*Actualizar ESTATUS*/
if(isset($_POST['update_estatus_genero'])):

$data = [

	"estatus_gen_genero" => $_POST['valor_estatus']

];

$where = [

	"id_gen_genero" => $_POST['id_gen_genero']

];

$actualizar = update("iqos_gen_genero", $where,$data);

if($actualizar){
	header("Location: ".$url_sitio."admin-generos");
}
endif;
/*Actualizar ESTATUS*/

/*Actualizar DATOS*/
if(isset($_POST['edit_genero'])):

$guardado = 0;

$data = [

	"name_gen_genero" => $_POST["name_gen_genero"]

];

$where = [

	"id_gen_genero" => $_POST["id_gen_genero"]

];

$guardar = update("iqos_gen_genero",$where,$data);

if($guardar){
	$guardado = 1;
	header("Location: ".$url_sitio."admin-generos");
}

endif;
/*Actualizar DATOS*/