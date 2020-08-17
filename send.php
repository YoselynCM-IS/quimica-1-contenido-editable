<?php

/***librerias phpmailer**/
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/* Exception class. */
require 'PHPMailer/src/Exception.php';

/* The main PHPMailer class. */
require 'PHPMailer/src/PHPMailer.php';

/* SMTP class, needed if you want to use SMTP. */
require 'PHPMailer/src/SMTP.php';
/**********/

$imagen = $_POST["imagen"];
$quim_regGP = $_POST["quim_regGP"];
$quim_regCA = $_POST["quim_regCA"];
$quim_regND = $_POST["quim_regND"];
$quim_regCD = $_POST["quim_regCD"];
$quim_regNA = $_POST["quim_regNA"];
/*
echo $imagen;
echo "<br>";
echo $quim_regGP;
echo "<br>";
echo $quim_regCA;
echo "<br>";
echo $quim_regND;
echo "<br>";
echo $quim_regCD;
echo "<br>";
echo $quim_regNA;
echo "<br>";
//die("fin");
**/
$imagen = preg_replace('#^data:image/[^;]+;base64,#', '', $imagen); 
$mensaje = '<b>Qu&iacute;mica 1</b><br><b>Nombre del estudiante: </b>'.$quim_regNA.'<br><b>Grupo: </b> '.$quim_regGP.'<br><b>Docente: </b>'.$quim_regND;

$para = $quim_regCD;
$para2 = $quim_regCA;
$asunto = 'Quimica 1: Actividad';				
//Create a new PHPMailer instance
$mail = new PHPMailer();
$mail->IsSMTP();
//Agregar la imagen
$decode = base64_decode($imagen);
$mail->addStringAttachment($decode, "Actividad.png", "base64", "image/png");
$mensaje .= '<br><img src="https://majesticeducacion.com.mx/nuevo/wp-content/uploads/2018/08/logo-header-majesticeducacion.png">';
 
//Configuracion servidor mail

$mail->From = "ebook@majesticeducationdigital.com"; //remitente
$mail->FromName = "Majestic Education";//nombre remitente
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl'; //seguridad
$mail->Host = "mail.majesticeducationdigital.com"; // servidor smtp
$mail->Port = 465; //puerto
$mail->Username ='ebook@majesticeducationdigital.com'; //nombre usuario
$mail->Password = '[;$&0?H_zuq#'; //contraseña


 
//Agregar destinatario
$mail->AddAddress($para);
$mail->AddAddress($para2);
$mail->Subject = $asunto;
$mail->IsHTML(true);
$mail->Body = $mensaje;


 
//Avisar si fue enviado o no y dirigir al index
if ($mail->Send()) {
    echo'<script type="text/javascript">
           alert("Enviado correctamente");
		   window.history.back();
        </script>';
} else {
    echo'<script type="text/javascript">
           alert("No enviado, intenta de nuevo");
        </script>';
}
?>