<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once $_SERVER['DOCUMENT_ROOT'].'/system/php/libs/PHPMailer/src/Exception.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/system/php/libs/PHPMailer/src/PHPMailer.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/system/php/libs/PHPMailer/src/SMTP.php';


class Mail extends System{

    static function sendEmail($asunto,$mensaje,$correo){
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = Constants::$MAIL_SMTP_SERVER;                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = Constants::$MAIL_SMTP_USER;                     //SMTP username
            $mail->Password   = Constants::$MAIL_SMTP_PASS;                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
            //Recipients
            $mail->setFrom(Constants::$MAIL_SMTP_USER,  constants::$MAIL_SMTP_NAME);
            $mail->addAddress($correo);     //Add a recipient

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $asunto;
            $mail->Body    = $mensaje;
            $mail->AltBody =  $mensaje;
        // Activo condificacción utf-8
            $mail->CharSet = 'UTF-8';
            $mail->send();
            return true;
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            return false;
        }
    }

}




?>