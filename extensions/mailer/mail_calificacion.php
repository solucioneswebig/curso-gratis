<?php
if($_POST['enviar_cal'] == "si" and $_POST['coment'] != "" and $_POST['correo'] and $_POST['califca'] != "" and $_POST['dd'] != "")
{
	$comentario=utf8_decode($_POST['coment']);
	$correo=$_POST['correo'];
	$n_calif=array(5 => "Excelente (5)", 4 => "Bueno (4)", 3 => "Aceptable (3)", 2 => "Regular (2)", 1 => "Malo (1)");
	$calificacion=$_POST['califca'];
	$nombre_calificacion=$n_calif[$calificacion];
	$dd=$_POST['dd'];
	$casilla="";
	if($_POST['cas'] == TRUE or $_POST['cas'] == 1){ $casilla=1; }
	
	require("class.phpmailer.php");  
	$mail = new PHPMailer();  
	$mail->From = "calificacion_noreenviar@robot.com";  
	$mail->FromName = "Directorio El Regional";  
	$mail->AddAddress($correo, "Destino");  
	$mail->AddReplyTo($correo, "Information");  
	$mail->WordWrap = 50;   
	$mail->IsHTML(true);                                   
	$mail->Subject = "Gracias por calificar. Directorio El Regional";  
	$mail->Body = utf8_decode('
	
	<p style=" text-align: left; font-size: 11px; font-family: Arial, Gotham, Helvetica, sans-serif;">Correo enviado desde directorioautlense.com<br />
	Recibió este correo por que usted o alguien calificó un negocio
	del DIRECTORIO EL REGIONAL.</p>
	
	<div style="padding: 3px 6px;">
	<p style=" text-align: left; font-size: 14px; font-family: Arial, Gotham, Helvetica, sans-serif;">
	Gracias por calificar el negocio seleccionado.<br />
	Para completar la calificación, presione el boton <i>Enviar Calificación</i>.<br />
	Si le aparece una ventana de confirmación de envio de datos, seleccione <i>Aceptar</i>.
	<br />
	<br />
	<strong>Calificación:</strong> ').$nombre_calificacion.' 
	<br />
	<br />
	<strong>Comentario:</strong><br /> 
	'.$comentario.'<br />
	</p>
	<a style="background: #258BC2; color: #FFF; border: 0px; padding: 4px 10px; cursor: pointer; text-decoration: none;" 
	href="http://directorioelregional.com/calificacion_gracias.php?enviar=si&email='.$correo.'&coment='.$comentario.'&nombre_calif='.$nombre_calificacion.'&calif='.$calificacion.'&dd='.$dd.'&cas='.$casilla.'"
	target="_blank">'.utf8_decode('Enviar Calificación').'</a>
	</div>
	';  
	$mail->AltBody = "Error. Su cliente de correo no acepta HTML";  
	if(!$mail->Send())  
	{  
	header("Location: ../directorio_detalles.php?s=".$dd."&coment=nosent"); 
	}
	else
	{  
	header("Location: ../directorio_detalles.php?s=".$dd."&coment=sent");
	}
}
else
{
	header("Location: ../directorio_detalles.php?s=".$_POST['dd']."");
}
?>