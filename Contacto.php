<?php
 
if($_POST) {
    $nombre = "";
    $correo = "";
    $asunto = "";
    $mensaje = "";
     
    if(isset($_POST['nombre'])) {
      $nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
    }
     
    if(isset($_POST['correo'])) {
        $correo = str_replace(array("\r", "\n", "%0a", "%0d"), '', $_POST['correo']);
        $correo = filter_var($correo, FILTER_VALIDATE_EMAIL);
    }
     
    if(isset($_POST['asunto'])) {
        $asunto = filter_var($_POST['asunto'], FILTER_SANITIZE_STRING);
    }
     
    if(isset($_POST['mensaje'])) {
        $mensaje = htmlspecialchars($_POST['mensaje']);
    }
     
    $buzon = "contact@domain.com"; /*correo al que llegan los mensajes, se separa con coma a los demas integrantes de poll*/
     
    $headers  = 'MIME-Version: 1.0' . "\r\n"
    .'Content-type: text/html; charset=utf-8' . "\r\n"
    .'From: ' . $correo . "\r\n";
     
    if(mail($buzon, $asunto, $mensaje, $headers)) {

        echo "<script language='javascript' type='text/javascript'> alert('Gracias $nombre por tu mensaje. Nos pondremos en contacto a la brevedad posible');
        </script>";

        echo "<script language='javascript' type='text/javascript'> window.location='index.html'
        </script>";

    } else {

        echo "<script language='javascript' type='text/javascript'> alert('Lo sentimos $nombre pero tu correo no fue enviado. Por favor, envíe un mail a info@collserv.com');
        </script>";

        echo "<script language='javascript' type='text/javascript'> window.location='index.html'
        </script>";
    }
     
} else {
    echo "<script language='javascript' type='text/javascript'> alert('Lo sentimos $nombre tuvimos un error interno');
    </script>";

    echo "<script language='javascript' type='text/javascript'> window.location='index.html'
    </script>";
}
 
?>