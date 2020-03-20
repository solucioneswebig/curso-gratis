<?php
require_once '../class.phpmailer.php';

$mensaje=$_POST['mensaje'];

$elbody="este es el cuerpo enviado usando una <br />variable \\r\\n aaa /n bbb nl2br();
funcionara?, 
no se ";
 
$results_messages = array();
 
$mail = new PHPMailer(true);
$mail->CharSet = 'utf-8';
 
class phpmailerAppException extends phpmailerException {}
 
try {
$to = 'luis@pice-software.com';
if(!PHPMailer::ValidateAddress($to)) {
  throw new phpmailerAppException("Email address " . $to . " is invalid -- aborting!");
}
$mail->IsMail();
$mail->AddReplyTo("otro_13ava_luis@pice-software.com", "DE MI 4ta");
$mail->From       = "otro_13ava_luis@pice-software.com";
$mail->FromName   = "DE MI 13ava";
$mail->AddAddress("luis@pice-software.com", "Luuu");
$mail->Subject  = "prueba 13ava de email SIN usr ni cc ni bbc(PHPMailer test using MAIL)";
$body = "llegara esto al body?".$elbody."<br /><br />".$mensaje."";
$mail->WordWrap = 80;
$mail->MsgHTML($body, dirname(__FILE__), true); //Create message bodies and embed images
$mail->AddAttachment($_FILES["archivo"]["tmp_name"],$_FILES["archivo"]["name"]); 

/*$mail->AddAttachment('images/phpmailer_mini.gif', 'phpmailer_mini.gif');  // optional name
$mail->AddAttachment('images/phpmailer.png', 'phpmailer.png');  // optional name
*/
 
try {
  $mail->Send();
  $results_messages[] = "Message has been sent using MAIL";
}
catch (phpmailerException $e) {
  throw new phpmailerAppException('Unable to send to: ' . $to. ': '.$e->getMessage());
}
}
catch (phpmailerAppException $e) {
  $results_messages[] = $e->errorMessage();
}
 
if (count($results_messages) > 0) {
  echo "<h2>Yea! enviado! prueba 13ava con exito!</h2>\n";
  echo "<ul>\n";
foreach ($results_messages as $result) {
  echo "<li>$result</li>\n";
}
echo "</ul>\n";
}
?>