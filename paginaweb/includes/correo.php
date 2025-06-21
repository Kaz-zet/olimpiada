<?php
    if (isset($_POST['enviar'])) {
        if (!empty($_POST['nombre']) && !empty($_POST['mensaje']) && !empty($_POST['calificacion'])) {
            $nombre = htmlspecialchars($_POST['nombre']);
            $mensaje = htmlspecialchars($_POST['mensaje']);
            $calificacion = htmlspecialchars($_POST['calificacion']);

            $header = "From: $nombre noreply@example.com" . "\r\n";
            $header .= "Reply-To: noreply@example.com" . "\r\n";
            $header .= "X-Mailer: PHP/" . phpversion();
            $mail = mail("nose@gmail.com", "Nuevo mensaje de contacto", "Nombre: $nombre\nMensaje: $mensaje\nCalificación: $calificacion", $header);
            if ($mail) {
                echo "Gracias por tu mensaje, $nombre. Nos pondremos en contacto contigo pronto.";
            } else {
                echo "Lo sentimos, hubo un error al enviar tu mensaje. Por favor, inténtalo de nuevo más tarde.";
            }
        } else {
            echo "Por favor, completa todos los campos del formulario.";
        }
    }
?>