<?php 
session_start();
include "../../models/ruta.models.php";
include "../../models/funciones-bd.php";
include "../../../../models/mails.models.php";

$url_sitio    = "https://webx.mx/curso-gratis/";



/**
* 
* REGISTRAR INTEGRANTE BANDA
* 
*/
if(isset($_POST["name"])){

        $id_registrocurso = id_registro("id_registrocurso","tb_registro_curso");

        date_default_timezone_set('America/Mexico_City');

        $date = date("Y-m-d H:i:s");

        if(isset($_POST["check_cliente"])){
            $cliente = 1;
        }else{
            $cliente = 0;
        }

        $code = generarCodigo(7).$id_registrocurso."x";

        $data = [
            "id_registrocurso"       => $id_registrocurso,
            "name_registrocurso"     => $_POST["name"],
            "negocio_registrocurso"  => $_POST["negocio"],
            "email_registrocurso"    => $_POST["email"],
            "code_registrocurso"     => $code,
            "view_registrocurso"     => 0,
            "cliente_registrocurso"  => $cliente,
            "estatus_registrocurso"  => 1,
            "date_registrocurso"     => $date,
            "date_modified"          => "0000-00-00 00:00:00"
        ];
    

        $guardar = insert("tb_registro_curso",$data);

        $date = "0000-00-00 00:00:00";

        $data = [
            "id_funnels"                      => 0,
            "id_registrocurso"                => $id_registrocurso,
            "nro_veces_visto_funnels"         => 0,
            "segundos_funnels"                => 0,
            "click_comprar_funnels"           => 0,
            "fecha_primera_vista_funnels"     => $date,
            "fecha_update_funnels"            => $date
        ];

        $actualizar = insert("tb_curso_funnels",$data);

        if($guardar):
            
            $cabecera = '<h3>Hola '.$_POST["name"].'</h3>
            <p style="text-align:left;">Muchas gracias por solicitar acceso al CURSO ONLINE</p> <h3>"Las 3 estrategias para promocionar mi Negocio en Facebook y poder aumentar las ventas en 2020".</h3>
            <p style="text-align:left;">Para acceder al CURSO primero necesitamos que confirmes tu dirección de correo electrónico y hagas clic en el siguiente botón:</p>';

            $boton = '<a href="'.$url_sitio.'video/'.$code.'" style="font-size:20px;padding:15px 20px;border:2px solid orange;color:#fff;background:orange;width: 90% !important;display: block;text-align: center;text-decoration:none;">Confirmo y quiero acceder al CURSO ahora >> </a>';


            $piecorreo = '<p style="text-align:left;">Hay veces que la gente se apunta a los sitios con correos falsos y esto es una medida para evitar el spam.</p> 
            <p style="text-align:center;"><i>Si crees que esto es un error y no pretendías suscribirte a esta lista, puedes ignorar este mensaje y no sucederá nada más.</i></p>';


            $data = [
                "cabecera"  => $cabecera,
                "mensaje"   => "",
                "boton"     => $boton,
                "piecorreo" => $piecorreo,
                "correo"    => $_POST["email"]

            ];

           $correo = enviar_correo($data);

            if($correo){
                echo 1;
            }else{
                echo 0;
            }


        else:
            echo 0;
        endif;


}



if(isset($_POST["guardar_video"])){

  
    date_default_timezone_set('America/Mexico_City');
    $date = date("Y-m-d H:i:s");

    $data = [
        "view_registrocurso" => $_POST["view_registrocurso"],
        "date_modified"      => $date
    ];

    $where = [
        "id_registrocurso" => $_POST["id_registrocurso"]
    ];

    $actualizar = update('tb_registro_curso',$where,$data);
    
    if($actualizar){
        echo 1;
    }else{
        echo 0;
    }


    $buscar_info = select_one("SELECT * FROM tb_curso_funnels WHERE id_registrocurso =".$_POST["id_registrocurso"]."");

    if($buscar_info["segundos_funnels"] != ""){

        date_default_timezone_set('America/Mexico_City');
        $date = date("Y-m-d H:i:s");

        if($_POST["segundos_funnels"] > $buscar_info["segundos_funnels"]){
            $segundos = $_POST["segundos_funnels"];
        }else{
            $segundos = $buscar_info["segundos_funnels"];
        }

        if($buscar_info["click_comprar_funnels"] == 1){
            $click = 1;
        }else{
            $click = $_POST["click_comprar_funnels"];
        }

        if($buscar_info["fecha_primera_vista_funnels"]  == "0000-00-00 00:00:00"){
            $date_new = $date;
        }else{
            $date_new = $buscar_info["fecha_primera_vista_funnels"];
        }
        

        $data = [
            "nro_veces_visto_funnels"     => $_POST["nro_veces_visto_funnels"],
            "segundos_funnels"            => $segundos,
            "click_comprar_funnels"       => $click,
            "fecha_primera_vista_funnels" => $date_new,
            "fecha_update_funnels"        => $date
        ];

        $where = [
            "id_registrocurso" => $_POST["id_registrocurso"]
        ];

        $actualizar = update("tb_curso_funnels",$where,$data);
        
    if($actualizar){
        echo 1;
    }else{
        echo 0;
    }
    }else{
        
        if($_POST["segundos_funnels"]>$buscar_info["segundos_funnels"]){
            $segundos = $_POST["segundos_funnels"];
        }else{
            $segundos = $buscar_info["segundos_funnels"];
        }

        if($buscar_info["click_comprar_funnels"] == 1){
            $click = 1;
        }else{
            $click = $_POST["click_comprar_funnels"];
        }
        

        $data = [
            "id_funnels"                      => 0,
            "id_registrocurso"                => $_POST["id_registrocurso"],
            "nro_veces_visto_funnels"         => $_POST["nro_veces_visto_funnels"],
            "segundos_funnels"                => $segundos,
            "click_comprar_funnels"           => $click,
            "fecha_primera_vista_funnels"     => $date,
            "fecha_update_funnels"            => $date
        ];

        $actualizar = insert("tb_curso_funnels",$data);
        
    if($actualizar){
        echo 1;
    }else{
        echo 0;
    }

    }

    
    
}

/* Verificar celular */
if(isset($_POST["verificar_correo"])){

    $buscar_numero_igual = select_one("SELECT * FROM tb_registro_curso where email_registrocurso ='".$_POST['verificar_correo']."'");

    if($buscar_numero_igual){

        echo 1;
    }else{
        echo 0;
    }

}

function generarCodigo($longitud) {
	$key = '';
	$pattern = '1234567890ABCDEFGHIJKLMNOPQRSTUCWXYZabcdefghijklmnopqrstuvwxyz';
	$max = strlen($pattern)-1;
	for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
	return $key;
   }
