<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>PHPMailer - mail() test</title>
</head>
<body>
<?php
require '../class.phpmailer.php';

//Create a new PHPMailer instance
$mail = new PHPMailer();
//Set who the message is to be sent from
$mail->SetFrom('origen@example.com', 'el origen');
//Set an alternative reply-to address
$mail->AddReplyTo('luisreplly@picdddxe-software.com','reply a responder');
//Set who the message is to be sent to
$mail->AddAddress('luis@pice-software.com', 'John Doe o Mi');
//Set the subject line
$mail->Subject = 'PHPMailer mail() test';
//Read an HTML message body from an external file, convert referenced images to embedded, convert HTML into a basic plain-text alternative body
$mail->MsgHTML(file_get_contents('contents.html'), dirname(__FILE__));
//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';
//Attach an image file
$mail->AddAttachment('images/phpmailer_mini.gif');

//Send the message, check for errors
if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "Message sent!";
}
?>
</body>
</html>
