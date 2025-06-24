<?php
//Actualiza el ajoamiento con unos nuevos valores.
include("includes/conDB.php");

if (isset($_POST['idalojamiento'], $_POST['nombre'], $_POST['direccion'], $_POST['precio'], $_POST['moneda'], $_POST['fechaentrada'], $_POST['fechasalida'])) {
    $idalojamiento = intval($_POST['idalojamiento']);
    $nombre = mysqli_real_escape_string($conex, $_POST['nombre']);
    $direccion = mysqli_real_escape_string($conex, $_POST['direccion']);
    $precio = floatval($_POST['precio']);
    $moneda = mysqli_real_escape_string($conex, $_POST['moneda']);
    $fechaentrada = date($_POST['fechaentrada']);
    $fechasalida = date($_POST['fechasalida']);

    $sql = "UPDATE alojamiento SET nombre = '$nombre', direccion = '$direccion', precio = '$precio', moneda = '$moneda', fechaentrada = '$fechaentrada', fechasalida = '$fechasalida' WHERE idalojamiento = $idalojamiento";
    $resultado = mysqli_query($conex, $sql);

    if ($resultado) {
        header("Location: panel_jefe.php?actualizado=1");
        exit;
    } else {
        echo "Error al actualizar el alojamiento.";
    }
} else {
    echo "Datos incompletos.";
}
?>