<?php
session_start();

if (isset($_POST['clave'])) {
    $clave = $_POST['clave'];

    if (isset($_SESSION['carrito'][$clave])) {
        unset($_SESSION['carrito'][$clave]);
    }
}

header("Location: carrito.php");
exit;
?>