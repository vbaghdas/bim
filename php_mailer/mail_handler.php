<?php

require_once('email_config.php');
require('phpmailer/PHPMailer/PHPMailerAutoload.php');

$name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
$visitor_email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
$subject = filter_var($_POST["subject"], FILTER_SANITIZE_STRING);
$message = filter_var($_POST["message"], FILTER_SANITIZE_STRING);

$mail = new PHPMailer;
$mail->Host = 'smtp.gmail.com';
$mail->isSMTP();
$mail->SMTPAuth = true;         
$mail->Username = EMAIL_USER;
$mail->Password = EMAIL_PASS;
$mail->SMTPSecure = 'tls';    
$mail->Port = 587;
$mail->smtpConnect($options);
$mail->isHTML(true);


$mail->From = $visitor_email; // Sender's email address (shows in "From" field)
$mail->FromName = $name; // Sender's name (shows in "From" field)

// Add a recipient
$mail->addAddress('outlawstatus2@gmail.com', 'First Recipient');
$mail->addReplyTo($visitor_email);                          
$mail->Subject = $subject;
$mail->Body    = $message;

// Send an email
if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
    $automail = new PHPMailer(true);
    $automail->IsSMTP();               // set mailer to use SMTP
    $automail->Host = "smtp.gmail.com";  // specify main and backup server or localhost
    $automail->SMTPAuth = true;     // turn on SMTP authentication
    $automail->Username = EMAIL_USER;  // SMTP username
    $automail->Password = EMAIL_PASS; // SMTP password
    $automail->SMTPSecure = 'tls';    
    $automail->Port = 587;
    $automail->smtpConnect($options);
    $automail->isHTML(true);
    $automail->From = "bimchirola@gmail.com";
    $automail->FromName = "Back In Motion | Health Center";
    $automail->AddAddress(visitor_email, $name);
    $automail->Subject = "Autoresponse: We received your submission";
    $automail->Body = "We received your submission. We will contact you soon ...";
    $autoemail->send();
}

?>