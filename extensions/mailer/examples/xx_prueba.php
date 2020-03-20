<?php
require_once '../class.phpmailer.php';
 
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
$mail->AddReplyTo("otro_5ta_luis@pice-software.com", "DE MI 4ta");
$mail->From       = "otro_5ta_luis@pice-software.com";
$mail->FromName   = "DE MI 5ta";
$mail->AddAddress("luis@pice-software.com", "Luuu");
$mail->Subject  = "prueba 5ta de email SIN usr ni cc ni bbc(PHPMailer test using MAIL)";
$body = <<<'EOT'
cuerpo de prueba de la 5ta
EOT;
$mail->WordWrap = 80;
$mail->MsgHTML($body, dirname(__FILE__), true); //Create message bodies and embed images
$mail->AddAttachment('images/phpmailer_mini.gif', 'phpmailer_mini.gif');  // optional name
$mail->AddAttachment('images/phpmailer.png', 'phpmailer.png');  // optional name
 
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
  echo "<h2>Yea! enviado!</h2>\n";
  echo "<ul>\n";
foreach ($results_messages as $result) {
  echo "<li>$result</li>\n";
}
echo "</ul>\n";
}
?>