<?php
//Actualiza el paquete con unos nuevos valores.
include("includes/conDB.php");

if (isset($_POST['idpaquete'], $_POST['nombre'], $_POST['descripcion'], $_POST['precio'], $_POST['moneda'], $_POST['fechaida'], $_POST['fechavuelta'])) {
    $idpaquete = intval($_POST['idpaquete']);
    $nombre = mysqli_real_escape_string($conex, $_POST['nombre']);
    $descripcion = mysqli_real_escape_string($conex, $_POST['descripcion']);
    $precio = floatval($_POST['precio']);
    $moneda = mysqli_real_escape_string($conex, $_POST['moneda']);
    $fechaida = date($_POST['fechaida']);
    $fechavuelta = date($_POST['fechavuelta']);

    $sql = "UPDATE paquete SET nombre = '$nombre', precio = '$precio', descripcion = '$descripcion', moneda = '$moneda', fechaida = '$fechaida', fechavuelta = '$fechavuelta' WHERE idpaquete = $idpaquete";
    $resultado = mysqli_query($conex, $sql);

    if ($resultado) {
        header("Location: panel_jefe.php?actualizado=1");
        exit;
    } else {
        echo "Error al actualizar el paquete.";
    }
} else {
    echo "Datos incompletos.";
}
?>