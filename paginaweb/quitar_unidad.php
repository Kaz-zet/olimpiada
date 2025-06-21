<?php
session_start();

if (isset($_POST['clave'])) {
    $clave = $_POST['clave'];

    if (isset($_SESSION['carrito'][$clave])) {
        if ($_SESSION['carrito'][$clave] > 1) {
            $_SESSION['carrito'][$clave]--; // Resta una unidad
        } else {
            unset($_SESSION['carrito'][$clave]); // Elimina si solo queda una
        }
    }
}

header("Location: carrito.php");
exit;
?>