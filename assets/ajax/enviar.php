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


   
                echo $date = date("Y-m-d H:m:s");


                /*
                $data = [
                    "id_registrocurso"       => 0,
                    "name_registrocurso"     => $obtener_id_banda[0],
                    "negocio_registrocurso"  => $_POST["nombre_integrante"],
                    "email_registrocurso"    => $_POST["cedula_integrante"],
                    "code_registrocurso"     => $_POST["instagram_integrante"],
                    "view_registrocurso"     => $_POST["celular_integrante"],
                    "cliente_registrocurso"  => 0,
                    "estatus_registrocurso"  => 0,
                    "date_registrocurso"     => 1
                ];
            

                    $guardar = insert("tb_registro_curso",$data);

                    if($guardar):
                        echo 1;
                    else:
                        echo 0;
                    endif;
                
                 */
        
        }

