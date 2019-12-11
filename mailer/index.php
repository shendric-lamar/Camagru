<?php

require('PHPMailer/PHPMailerAutoload.php');

$mail = new PHPMailer();
$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl';
$mail->Host = 'smtp.gmail.com';
$mail->Port = '465';
$mail->isHTML();
$mail->Username = 'nomisofficial.contact@gmail.com';
$mail->Password = 'Vepforever7';
$mail->SetFrom('no-reply@camagru.com');
$mail->Subject = 'Hello World';
$mail->Body = 'A test email!';
$mail->AddAddress('cloud.dust01@gmail.com');

$mail->Send();

?>
