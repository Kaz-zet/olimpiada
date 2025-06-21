<?php
include("includes/conDB.php");

if (isset($_POST['idtransporte'], $_POST['nombre'], $_POST['ubicacion'], $_POST['precio'], $_POST['moneda'], $_POST['fechareserva'], $_POST['fechadevolucion'])) {
    $idtransporte = intval($_POST['idtransporte']);
    $nombre = mysqli_real_escape_string($conex, $_POST['nombre']);
    $ubicacion = mysqli_real_escape_string($conex, $_POST['ubicacion']);
    $precio = floatval($_POST['precio']);
    $moneda = mysqli_real_escape_string($conex, $_POST['moneda']);
    $fechareserva = date($_POST['fechareserva']);
    $fechadevolucion = date($_POST['fechadevolucion']);

    $sql = "UPDATE transporte SET nombre = '$nombre', ubicacion = '$ubicacion', precio = '$precio', moneda = '$moneda', fechareserva = '$fechareserva', fechadevolucion = '$fechadevolucion' WHERE idtransporte = $idtransporte";
    $resultado = mysqli_query($conex, $sql);

    if ($resultado) {
        header("Location: panel_jefe.php?actualizado=1");
        exit;
    } else {
        echo "Error al actualizar el transporte.";
    }
} else {
    echo "Datos incompletos.";
}
?>