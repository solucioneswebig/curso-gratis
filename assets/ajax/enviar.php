<?php 
session_start();
include "../../models/ruta.models.php";
include "../../models/funciones-bd.php";

$url_sitio    = ctrRuta();

/*
 * 
 *  COMIENZO REGISTRO LIDER DE LA BANDA
 * 
*/

/* Verificar celular */
if(isset($_POST["verificar_celular"])){

    $buscar_numero_igual = select_one("SELECT * FROM iqos_integrante where celular_integrante =".$_POST['verificar_celular']."");

    if($buscar_numero_igual){
        echo 1;
    }else{
        echo 0;
    }

}
/* Verificar celula */
if(isset($_POST["verificar_cedula"])){

    $buscar_numero_igual = select_one("SELECT * FROM iqos_integrante where cedula_integrante =".$_POST['verificar_cedula']."");

    if($buscar_numero_igual){
        echo 1;
    }else{
        echo 0;
    }

}

/* Verificar celula */
if(isset($_POST["verificar_banda"])){

    $buscar_numero_igual = select_one("SELECT id_banda FROM iqos_banda where code_banda ='".$_POST['verificar_banda']."'");

    if($buscar_numero_igual){
        $total = select_all("SELECT * FROM iqos_integrante where id_banda = ".$buscar_numero_igual[0]."");
        $count = count($total);
        if($count<4){
            echo 1;
        }else{
            echo 2;
        }
        
    }else{
        echo 0;
    }

}


/**
 * 
 * REGISTRAR INTEGRANTE BANDA
 * 
 */
if(isset($_POST["g-recaptcha-response"]) && isset($_POST["registrar_integrante"])){

    $res = post_captcha($_POST['g-recaptcha-response']);
    if($res["success"] == true){
        if(isset($_POST["registrar_integrante"])){

            $id_integrante = id_registro("id_integrante","iqos_integrante");
        
            $obtener_id_banda = select_one("SELECT * FROM iqos_banda where code_banda ='".$_POST['codigo_banda']."'");
        
            if($obtener_id_banda){
        
                $_SESSION["id_banda"] = $obtener_id_banda['id_banda'];
                
                $_SESSION["name_completo_banda"] = $obtener_id_banda['name_banda'];
        
                $data = [
                    "id_integrante"        => $id_integrante,
                    "id_banda"             => $obtener_id_banda[0],
                    "nombre_integrante"    => $_POST["nombre_integrante"],
                    "cedula_integrante"    => $_POST["cedula_integrante"],
                    "instagram_integrante" => $_POST["instagram_integrante"],
                    "celular_integrante"   => $_POST["celular_integrante"],
                    "lider_banda"          => 0,
                    "progreso_integrante"  => 0,
                    "estatus_integrante"   => 1
                ];
            
                $filtrar = select_one("SELECT * FROM iqos_integrante WHERE cedula_integrante = ".$_POST["cedula_integrante"]." or celular_integrante = ".$_POST["celular_integrante"]."");
            
                if(!$filtrar){
                    $guardar = insert("iqos_integrante",$data);
                    if($guardar):
            
                        $_SESSION['id_liderbanda'] = $id_integrante;

                        $data = [
                            "progreso_integrante" => "10003"
                        ];
                        
                        $where = [
                            "id_integrante" => $id_integrante
                        ];
                    
                        $guardar = update("iqos_integrante",$where,$data);

                        echo 2;
                    else:
                        echo 3;
                    endif;
                }else{
                    echo 3;
                }
        
            }else{
                echo 3;
            }
        
        
        
        }
    }else{ // valida el capcha
        echo 4;
    }
}  // Validad el dato para el capcha
  



/* Registrar lider de la banda */
if(isset($_POST["g-recaptcha-response"]) && isset($_POST["registrar_liderbanda"])){

$res = post_captcha($_POST['g-recaptcha-response']);
if($res["success"] == true){
if(isset($_POST["registrar_liderbanda"])){

    if(!isset($_SESSION)){
        session_start();
    }

    $id_banda = id_registro("id_banda","iqos_banda");



    $id_liderbanda = id_registro("id_integrante","iqos_integrante");

    $_SESSION["id_banda"] = $id_banda;

    $date = date('Y-m-d H:i:s');
    $data = [
        "id_banda" => $id_banda,
        "id_liderbanda" => $id_liderbanda,
        "score_banda"  => 0,
        "tiempo_banda" => 0,
        "name_banda"   => "",
        "code_banda"   => "",
        "estatus_banda" => 1,
        "banda_ganador" => 0,
        "date_banda" => $date
    ];


    $guardar_banda = insert("iqos_banda",$data);

    if($guardar_banda):
    $data = [
        "id_integrante"        => $id_liderbanda,
        "id_banda"             => $id_banda,
        "nombre_integrante"    => $_POST["nombre_liderbanda"],
        "cedula_integrante"    => $_POST["cedula_liderbanda"],
        "instagram_integrante" => $_POST["instagram_liderbanda"],
        "celular_integrante"   => $_POST["celular_liderbanda"],
        "lider_banda"          => 1,
        "progreso_integrante"  => 0,
        "estatus_integrante"   => 1
    ];

    $filtrar = select_one("SELECT * FROM iqos_integrante WHERE cedula_integrante = ".$_POST["cedula_liderbanda"]." or celular_integrante = ".$_POST["celular_liderbanda"]."");

    if(!$filtrar){
        $guardar = insert("iqos_integrante",$data);
        if($guardar):

            $_SESSION['id_liderbanda'] = $id_liderbanda;
        
            $data = [
                "progreso_integrante" => "10002"
            ];
            
            $where = [
                "id_integrante" => $id_liderbanda
            ];
        
            $guardar = update("iqos_integrante",$where,$data);

            echo 1;
        else:
            echo 0;
        endif;
    }else{
        echo 0;
    }

    endif; //FIN DE GUARDAR BANDA
    
}
}else{ // Valida capcha 
    echo 4;
}
} // fin valida que traiga capcha y lider bnada

/*
 * 
 *  FIN REGISTRO LIDER DE LA BANDA
 * 
*/

if(isset($_POST["traer_nombre_banda"])){

    $nombre_banda = select_one("SELECT name_gen_name FROM iqos_gen_name where number_gen_name =".$_POST['traer_nombre_banda']."");

    if($nombre_banda){
        echo $nombre_banda[0];
    }else{
        echo "";
    }

}
if(isset($_POST["enviar_nombre_banda"])){

    if(!isset($_SESSION)){
        session_start();
    }
    $_SESSION["nombre_banda"] = $_POST["enviar_nombre_banda"];

    if($_SESSION["nombre_banda"] != ""){
        echo $_SESSION["nombre_banda"];
    }else{
        echo "";
    }

}

if(isset($_POST["traer_nombre_genero"])){

    $nombre_genero = select_one("SELECT name_gen_genero FROM iqos_gen_genero where number_gen_genero =".$_POST['traer_nombre_genero']."");

    if($nombre_genero){
        echo $nombre_genero[0];
    }else{
        echo "";
    }

}

if(isset($_POST["enviar_nombre_genero"])){

    

    if(!isset($_SESSION)){
        session_start();
    }
    $_SESSION["nombre_genero"] = $_POST["enviar_nombre_genero"];
    $id_banda = $_SESSION["id_banda"];
    
    $id_liderbanda = $_SESSION['id_liderbanda'];
    $code_banda = $_SESSION["nombre_banda"].$_SESSION["nombre_genero"].$id_banda."x";
    $name_banda = $_SESSION["nombre_banda"]." ".$_SESSION["nombre_genero"];


    $code_banda_limpio = format_uri($code_banda);
    
    $code_banda_limpio = str_replace("-", "", $code_banda_limpio);


    $_SESSION["name_completo_banda"] = $name_banda;
    $_SESSION["code_banda"] = $code_banda_limpio;


    $date = date('Y-m-d H:i:s');

    $data = [
        "id_liderbanda" => $id_liderbanda,
        "name_banda"   => $name_banda,
        "code_banda"   => $code_banda_limpio,
        "estatus_banda" => 1,
        "banda_ganador" => 0,
        "date_banda" => $date
    ];

    $id_banda = $_SESSION["id_banda"];

    $where = [
        "id_banda" => $id_banda
    ];

    $guardar = update("iqos_banda",$where,$data);
    

    if($guardar){

        $id_liderbanda = $_SESSION['id_liderbanda'];

        $data = [
            "progreso_integrante" => "10003"
        ];
        
        $where = [
            "id_integrante" => $id_liderbanda
        ];
    
        $guardar = update("iqos_integrante",$where,$data);


        echo 1;
    }else{
        echo "";
    }

}

/*
 * 
 *  COMIENZO REGISTRO BANDA
 * 
 */

/*
 * 
 *  COMIENZO REGISTRO RESPUESTAS
 * 
 */


if(isset($_POST["respuesta_participante"])){
    $id_respuesta = id_registro("id_respuesta","iqos_respuestas");

    $id_pregunta = $_POST["id_question"];
    $id_participante = $_POST["id_participante"];
    $respuesta_segundos = $_POST["respuesta_segundos"];
    $respuesta_participante = $_POST["respuesta_participante"];
    $posicion_actual = $_POST["posicion_actual_participante"];
    
    $respuesta_segundos = ($respuesta_segundos/100);

    $obtener_datos_pregunta = select_one("SELECT * FROM iqos_questions where id_question = ".$id_pregunta."");

    if ($respuesta_participante == $obtener_datos_pregunta['respuesta_question']) {
        $puntaje = $obtener_datos_pregunta['puntaje_question'];
    } else {
        $puntaje = 0;
    }
    $date = date('Y-m-d H:i:s');
    $data = [
        "id_respuesta" => $id_respuesta,
        "id_question" => $id_pregunta,
        "id_participante" => $id_participante,
        "respuesta_segundos" => $respuesta_segundos,
        "respuesta_puntaje" => $puntaje,
        "respuesta_date" => $date
    ];

    $guardar = insert("iqos_respuestas",$data);

    if($guardar){
        
        $data = [
            "progreso_integrante" => $posicion_actual
        ];
        
        $where = [
            "id_integrante" => $id_participante
        ];
    
        $guardar = update("iqos_integrante",$where,$data);

        echo 1;
    }else{
        echo "";
    }
}

 /*
 * 
 *  GUARDAR PASO INSTAGRAM
 * 
 */
if(isset($_POST["guardar_instagram_paso"])){

    $id_participante = $_SESSION['id_liderbanda'];

    $obtener_dato = select_one("SELECT lider_banda FROM iqos_integrante WHERE id_integrante = ".$id_participante."");

    $data = [
        "progreso_integrante" => "10004"
    ];
    
    $where = [
        "id_integrante" => $id_participante
    ];

    $guardar = update("iqos_integrante",$where,$data);

    if($guardar){
        echo $obtener_dato[0];
    }else{
        echo "";
    }

}
  /*
 * 
 *  FIN GUARDAR PASO INSTAGRAM
 * 
 */

/****
 * *************
 * *********************
 * ******************************
 * *****************************************
 ****/
 /*
 * 
 *  INICIO LOGIN
 * 
 */

if(isset($_POST['acceso_usuario'])){

    $codigo_banda   = $_POST["codigo_banda"];
    $nombre_lider   = $_POST["nombre_lider"];
    $numero_celular = $_POST["numero_celular"];

    $total = total_registros("iqos_questions", "estatus_questions");

    $obtener_id_banda = select_all("SELECT * FROM iqos_banda as banda 
                                    JOIN iqos_integrante as integrante on banda.id_banda = integrante.id_banda 
                                     and integrante.celular_integrante = '".$numero_celular."' and code_banda ='".$codigo_banda."'");

    $obtener_nombre_lider = select_all("SELECT nombre_integrante FROM iqos_integrante where nombre_integrante = '".$nombre_lider."' and lider_banda = '1'");
    
    
    if(count($obtener_nombre_lider) != 0){
    
    if(count($obtener_id_banda) != 0){    
       
    foreach ($obtener_id_banda as $key => $value):


        $_SESSION['id_liderbanda'] = $value["id_integrante"];
        $_SESSION['name_completo_banda'] = $value["name_banda"];
        $_SESSION['code_banda'] = $value["code_banda"];
        $_SESSION['id_banda'] = $value["id_banda"];
        
        
        if($value["progreso_integrante"] == "10002"){
            echo $url =  $url_sitio."paso-5";
        }else if($value["progreso_integrante"] == "10003"){
            echo $url =  $url_sitio."paso-8";
        }else if($value["progreso_integrante"] == "10004"){
        
            echo $url = $url_sitio."puntaje-integrantes";
        
        }else{
            $valor = $value["progreso_integrante"];
            if($valor < $total){
               $index  =  $valor + 1;
               echo $url = $url_sitio."trivia/".$index;
            }else{
               echo $url = $url_sitio."paso-10";
            }

        }
        
    endforeach;
    }else{
        echo "0";
    }

}else{
    echo "0";
}
  

}