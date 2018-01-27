<?php

require_once('email_config.php');
require('phpmailer/PHPMailer/PHPMailerAutoload.php');

// Create an instance of php mailer
$mail = new PHPMailer;

// Set a host
$mail->Host = 'smtp.gmail.com';

// Set mailer to use SMTP.
$mail->isSMTP();

// Enable SMTP authentication
$mail->SMTPAuth = true;         

// Contact Form
$name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
$visitor_email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
$subject = filter_var($_POST["subject"], FILTER_SANITIZE_STRING);
$message = filter_var($_POST["message"], FILTER_SANITIZE_STRING);

// Set login details for gmail account
$mail->Username = EMAIL_USER;
$mail->Password = EMAIL_PASS;

// Enable TLS encryption, `ssl` also accepted, but TLS is a newer more-secure encryption
$mail->SMTPSecure = 'tls';    

// TCP port to connect to
$mail->Port = 587;

$mail->smtpConnect($options);
// Sender's email address (shows in "From" field)
$mail->From = $visitor_email;

// Sender's name (shows in "From" field)
$mail->FromName = $name;

// Add a recipient
$mail->addAddress('bimchirola@gmail.com', 'First Recipient');

// Add a reply-to address
$mail->addReplyTo($visitor_email);                          

// Set email format to HTML
$mail->isHTML(true);

$mail->Subject = $subject;
$mail->Body    = $message;

// Send an email
if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}

?>