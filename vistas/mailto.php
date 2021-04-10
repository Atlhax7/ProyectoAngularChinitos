<?php

//librerias
require '../PHPMailer/PHPMailerAutoload.php';
 
//Create a new PHPMailer instance
$mail = new PHPMailer();
$mail->IsSMTP();
 
//Configuracion servidor mail
$mail->setFrom("henry83266@gmail.com","Comercializadora Monster");
//$mail->From = "henry83266@gmail.com"; //remitente
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'tls'; //seguridad
$mail->Host = "smtp.gmail.com"; // servidor smtp
$mail->Port = 587; //puerto
$mail->Username ='henry83266@gmail.com'; //nombre usuario
$mail->Password = 'Thouloose>:0'; //contraseña
 
//Agregar destinatario
$mail->AddAddress($_POST['email']);
$mail->Subject = "Codigo de Ingreso";
$message = '
<html>
    <head>
        <title>HTML email</title>
    </head>
    <body>
        <h1>Estimado señor/a '.$_POST['nombres']." ".$_POST['apellidos'].'</h1>
        <h2>Código de ingreso: <a> '.$_POST['password'].' </a></h2>
    </body>
</html>
';

$mail->Body = $message;
$mail->CharSet = 'UTF-8';
$mail->isHTML(true);
//Avisar si fue enviado o no y dirigir al index
if ($mail->Send()) {
    echo 'Enviado Correctamente';
} else {
    echo 'Error: '.$mail->ErrorInfo;
}
?>