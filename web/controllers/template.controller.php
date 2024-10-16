<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class TemplateController
{
    /*================================================
    Traemos la vista Principal de la plantilla
    =============================================== */

    public function index()
    {

        include "views/template.php";
    }

    /*================================================
    Ruta Principal o Dominio del Sitio
    =============================================== */

    public static function path()
    {

        if (!empty($_SERVER["HTTPS"]) && ("on" == $_SERVER["HTTPS"])) {

            return "https://" . $_SERVER["SERVER_NAME"] . "/";
        } else {

            return "http://" . $_SERVER["SERVER_NAME"] . "/";
        }
    }

    /*================================================
    Función para enviar correos electrónicos
    =============================================== */

    public static function sendEmail($subject, $email, $title, $message, $link)
    {

        date_default_timezone_set("America/Argentina/Buenos_Aires");

        $mail = new PHPMailer(true);

        $mail->CharSet = 'utf-8';

        // $mail->Encoding = 'base64'; //Habilitar al subir el sistema a un hosting

        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '085f171c6946fb';
        $mail->Password = 'afe5f32756ab1e';
        $mail->SMTPSecure = 'tls';

        // $mail->UseSendmailOptions = 0;

        $mail->setFrom("noreply@ecommerce.com", "Ecommerce");
        $mail->addAddress($email);

        $mail->Subject = $subject;
        $mail->msgHTML('<div style="width:100%; background:#eee; position:relative; font-family:sans-serif; padding-top:40px; padding-bottom:40px;">

                    <div style="position: relative; margin: auto; width: 600px; background: white; padding: 20px;">

                        <center>

                                <img src="'.TemplateController::path().'views/assets/img/template/1/logo.png" 
                                style="padding:20px; width:30%">

                                <?php
                                    echo TemplateController::path();
                                ?>

                                <h3 style="font-weight: 100; color:#999">' . $title . '</h3>

                                <hr style="border:1px solid #ccc; width:80%">

                                ' . $message . '

                                <a href="' . $link . '" target="_blank" style="text-decoration: none;">

                                    <div style="line-height: 25px; background: #000; width: 60%; padding: 10px; color: white; border-radius: 5px;">Haz click aquí</div>
                                </a>

                                <br>

                                <hr style="border:1px solid #ccc; width:80%">

                                <h5 style="font-weight: 100; color: #999">Si no solicitó el envío de este correo, comuniquese con nosotros de inmediato.</h5>



                        </center>


                    </div>


                </div>');

        $send = $mail->send();

        try {
            // Enviar el correo
            $mail->send();
            return "ok";
        } catch (Exception $e) {
            return $mail->ErrorInfo;  // Retornar el error en caso de fallo
        }
    }

    /*================================================
    Función Limpiar HTML
    =============================================== */

    public static function htmlClean($code){

        $search = array('/\>[^\S ]+/s','/[^\S ]+\</s','/(\s)+/s');

        $replace = array('>','<','\\1');

        $code = preg_replace($search, $replace, $code);

        $code = str_replace("> <", "><", $code);

        return $code;
    }
}
