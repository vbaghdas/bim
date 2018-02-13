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
$mail->addAddress('bimchirola@gmail.com', 'Second Recipient');
$mail->addReplyTo($visitor_email);                          
$mail->isHTML(true);

$message  = "<html><body>";
$message .= "<table width='100%' bgcolor='#e0e0e0' cellpadding='0' cellspacing='0' border='0'>";
$message .= "<tr><td>";
$message .= "<table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' style='max-width:650px; background-color:#fff; font-family:Verdana, Geneva, sans-serif;'>";
$message .= "<thead>
                <tr height='80'>
                <th colspan='4' style='background-color:#f5f5f5; border-bottom:solid 1px #bdbdbd;' >
                    <img src='http://www.bimhealthcenter.com/img/logo_black.png' style='width: 45%;'/>
                </th>
                </tr>
             </thead>";
    
$message .= "<tbody>
                <tr align='center' height='50' style='font-family:Verdana, Geneva, sans-serif; background: linear-gradient(45deg, #0B4182 1%, #1e88e5 64%, #40BAF5 97%);'>
                        <td colspan='4'></td>
                </tr>
                
                <tr>
                <td colspan='4' style='padding:15px 30px; color: #333;'>
                <p style='font-size: 14px; color: #333;'><strong>Dear ".$name.",</strong></p>
                <p style='font-size: 14px; color: #333;'>Thank you for opting in for your voucher.</p>
                <p style='font-size: 14px; color: #333;'>Due to the limited number of vouchers available, they will be redeemable on a first-call basis so call to book your appointment today!</p>
                <hr/>
                <p style='font-size: 14px; color: #333;'>BONUS! Call to schedule now and get 4 adjustments for only <strong>$79!</strong></p>
                <p style='font-size: 14px; color: #333;'>CALL NOW: (818) 782-2225</p>
                <p style='font-size: 14px; color: #333;'>Voucher Code to redeem offer is BIMChiro.</p>
                <img src='http://www.bimhealthcenter.com/img/service_1.jpg' style='width: 100%;' />
                </td>
                </tr>
                
                <tr height='80'>
                <td colspan='4' align='center' style='background-color:#f5f5f5; border-top:dashed #00a2d1 2px; font-size:14px;'>
                <label>Back In Motion on Facebook. Check us out! 
                        <a href='https://www.facebook.com/Back-in-Motion-Health-Center-1019144851564532/' target='_blank'><img style='vertical-align:middle' src='https://cdnjs.cloudflare.com/ajax/libs/webicons/2.0.0/webicons/webicon-facebook-m.png' /></a>
                </label>
                </td>
                </tr>
                
            </tbody>";
    
$message .= "</table>";
$message .= "</td></tr>";
$message .= "</table>";
$message .= "</body></html>";

$mail->Subject = $subject;
$mail->Body    = $message;

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}

?>