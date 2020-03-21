<?php 
session_start();
include "../../models/ruta.models.php";
include "../../models/funciones-bd.php";

$url_sitio    = ctrRuta();


/**
 * 
 * REGISTRAR INTEGRANTE BANDA
 * 
 */



        if(isset($_POST["name"])){


   
                $date = date("Y-m-d H:m:s");

                if(isset($_POST["check_cliente"])){
                    $cliente = 1;
                }else{
                    $cliente = 0;
                }

                $data = [
                    "id_registrocurso"       => 0,
                    "name_registrocurso"     => $_POST["name"],
                    "negocio_registrocurso"  => $_POST["negocio"],
                    "email_registrocurso"    => $_POST["email"],
                    "code_registrocurso"     => generarCodigo(8),
                    "view_registrocurso"     => 0,
                    "cliente_registrocurso"  => $cliente,
                    "estatus_registrocurso"  => 1,
                    "date_registrocurso"     => $date
                ];
            

                $guardar = insert("tb_registro_curso",$data);

                if($guardar):
                    echo 1;
                else:
                    echo 0;
                endif;
      
        
        }

