<?php
require_once('email_config.php');
require('phpmailer/PHPMailer/PHPMailerAutoload.php');

$mail = new PHPMailer;
$mail->Host = 'smtp.gmail.com';
$mail->isSMTP();
$mail->SMTPAuth = true;         

$name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
$visitor_email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
$subject = filter_var($_POST["subject"], FILTER_SANITIZE_STRING);
$message = filter_var($_POST["message"], FILTER_SANITIZE_STRING);

$mail->Username = EMAIL_USER;
$mail->Password = EMAIL_PASS;
$mail->SMTPSecure = 'tls';    
$mail->Port = 587;

$mail->smtpConnect($options);
$mail->From = $visitor_email;
$mail->FromName = $name;
$mail->addAddress($visitor_email, 'First Recipient');
$mail->addAddress('outlawstatus2@gmail.com', 'Second Recipient');
$mail->addReplyTo($visitor_email);                          
$mail->isHTML(true);

$mail->Subject = $subject;
$mail->Body    = $message;

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}

?>