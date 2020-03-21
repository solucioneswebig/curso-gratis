<?php 
session_start();
include "../../models/ruta.models.php";
include "../../models/funciones-bd.php";
include "../../../../models/mails.models.php";

$url_sitio    = "https://webx.mx/";


/**
* 
* REGISTRAR INTEGRANTE BANDA
* 
*/
if(isset($_POST["name"])){

        $id_registrocurso = id_registro("id_registrocurso","tb_registro_curso");

        $date = date("Y-m-d H:m:s");

        if(isset($_POST["check_cliente"])){
            $cliente = 1;
        }else{
            $cliente = 0;
        }

        $code = generarCodigo(14);

        $data = [
            "id_registrocurso"       => $id_registrocurso,
            "name_registrocurso"     => $_POST["name"],
            "negocio_registrocurso"  => $_POST["negocio"],
            "email_registrocurso"    => $_POST["email"],
            "code_registrocurso"     => $code,
            "view_registrocurso"     => 0,
            "cliente_registrocurso"  => $cliente,
            "estatus_registrocurso"  => 1,
            "date_registrocurso"     => $date
        ];
    

        $guardar = insert("tb_registro_curso",$data);

        if($guardar):
            
            $cabecera = '<h3>Hola '.$_POST["name"].'<h3>
            <p style="text-align:justify;">Muchas gracias por solicitar acceso al CURSO ONLINE "Las 3 estrategias para promocionar mi Negocio en Facebook y poder aumentar las ventas en 2020".
            Para acceder al CURSO primero necesitamos que confirmes tu dirección de correo electrónico y hagas clic en el siguiente botón:</p>
            ';

            $boton = '<a href="'.$url_sitio.'video-curso/'.$code.'" style="font-size:20px;padding:15px 20px;border:2px solid #999;color:#999;">Confirmo y quiero acceder al CURSO ahora >> </a>';


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

