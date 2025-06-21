<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['idproducto'])) {
        $id = 'prod_' . intval($_POST['idproducto']);
    } else if (isset($_POST['idpaquete'])) {
        $id = 'paq_' . intval($_POST['idpaquete']);
    } else if (isset($_POST['idtransporte'])) {
        $id = 'trans_' . intval($_POST['idtransporte']);
    } else if (isset($_POST['idalojamiento'])) {
        $id = 'aloja_' . intval($_POST['idalojamiento']);
    } else {
        echo "Error al agregar producto.";
        exit;
    }

    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    if (isset($_SESSION['carrito'][$id])) {
        $_SESSION['carrito'][$id]++;
    } else {
        $_SESSION['carrito'][$id] = 1;
    }

    header("Location: carrito.php");
    exit;
} else {
    echo "Error: método no permitido.";
}
?>
