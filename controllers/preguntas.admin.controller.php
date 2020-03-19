 <?php


/*AÑADIR*/
if(isset($_POST['add_questions'])):

$guardado = 0;

$data = [
	"id_question" => 0,
	"pregunta_question"  => $_POST["pregunta_question"],
	"puntaje_question"   => $_POST["puntaje_question"],
	"respuesta_question" => $_POST["respuesta_question"],
	"position_questions" => $_POST["position_questions"],
	"estatus_questions"       => 1
];

$guardar = insert("iqos_questions",$data);

if($guardar){
	$guardado = 1;
	header("Location: ".$url_sitio."admin-preguntas");
}

endif;
/*AÑADIR*/


/*Eliminar*/
if(isset($_POST['delete_questions'])):

$where = [

	"id_question" => $_POST['id_question']

];

$borrar = delete("iqos_questions", $where);

if($borrar){
	header("Location: ".$url_sitio."admin-preguntas");
}
endif;
/*Eliminar*/


/*Actualizar ESTATUS*/
if(isset($_POST['update_estatus_questions'])):

$data = [

	"estatus_questions" => $_POST['valor_estatus']

];

$where = [

	"id_question" => $_POST['id_question']

];

$actualizar = update("iqos_questions", $where,$data);

if($actualizar){
	header("Location: ".$url_sitio."admin-preguntas");
}
endif;
/*Actualizar ESTATUS*/

/*Actualizar DATOS*/
if(isset($_POST['update_questions'])):

$guardado = 0;

$data = [
	"pregunta_question"  => $_POST["pregunta_question"],
	"puntaje_question"   => $_POST["puntaje_question"],
	"respuesta_question" => $_POST["respuesta_question"],
	"position_questions" => $_POST["position_questions"]
];

$where = [
	"id_question" => $_POST["id_question"]
];

$guardar = update("iqos_questions",$where,$data);

if($guardar){
	$guardado = 1;
	header("Location: ".$url_sitio."admin-preguntas");
}

endif;
/*Actualizar DATOS*/