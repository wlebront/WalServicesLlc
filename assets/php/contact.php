<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

require("../vendor/autoload.php");

use PHPMailer\PHPMailer\PHPMailer;

// ADD your Email and Name
$mail = new PHPMailer(true);
$mail->isSMTP();


$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;

$mail->Username = 'william@walservicesllc.com';
$mail->Password = '163106@Wlt';

$mail->SMTPSecure = 'tls'; // tls o ssl
$mail->Port = 587; // Puerto de SMTP

//Set who the message is to be sent from
$mail->setFrom('william@walservicesllc.com','William');
$mail->CharSet = 'UTF-8';
$mail->isHTML(); 

//collect the posted variables into local variables before calling $mail = new mailer
$clientName = $_POST['contact-name'];
$clientPhone =  $_POST['contact-phone'];
$clientMessage= $_POST['contact-message'];
$clientEmail =   $_POST['contact-email'];
$clientService =   $_POST['contact-service'];

//Set an alternative reply-to address
$mail->addReplyTo($clientEmail,$clientName);

//Set who the message is to be sent to
$mail->addAddress('william@walservicesllc.com', 'Wal Services');

//Set description of the new email
$mail->Subject = mb_convert_encoding('New Message From ' . $clientName, "UTF-8", "auto");

//now make those variables the body of the emails
$message = '<html><body>';
$message .= '<table rules="all" style="border:1px solid #666;width:300px;" cellpadding="10">';
$message .= ($clientName) ? "<tr style='background: #eee;'><td><strong>Name:</strong> </td><td>" . $clientName . "</td></tr>" : '';
$message .= ($clientEmail) ?"<tr><td><strong>Email:</strong> </td><td>" . $clientEmail . "</td></tr>" : '';
$message .= ($clientPhone) ?"<tr><td><strong>Phone:</strong> </td><td>" . $clientPhone . "</td></tr>" : '';
$message .= ($clientMessage) ?"<tr><td><strong>Message:</strong> </td><td>" . $clientMessage . "</td></tr>" : '';
$message .= ($clientService) ?"<tr><td><strong>Service:</strong> </td><td>" . $clientService . "</td></tr>" : '';
$message .= "</table>";
$message .= "</body></html>";

$mail->Body = $message;

if(!$mail->Send()) 
{ echo '<div class="alert alert-danger" role="alert">Error: '. $mail->ErrorInfo.'</div>'; } 
else { echo '<div class="alert alert-success" role="alert">Thank you. We will contact you shortly.</div>';}

?>