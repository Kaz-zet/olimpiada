<?php
//Actualiza el producto con unos nuevos valores.
include("includes/conDB.php");

if (isset($_POST['idproducto'], $_POST['nombre'], $_POST['codigo'], $_POST['descripcion'], $_POST['precio'], $_POST['moneda'], $_POST['fechaida'], $_POST['fechavuelta'],)) {
    $idproducto = intval($_POST['idproducto']);
    $nombre = mysqli_real_escape_string($conex, $_POST['nombre']);
    $codigo = intval($_POST['codigo']);
    $descripcion = mysqli_real_escape_string($conex, $_POST['descripcion']);
    $precio = floatval($_POST['precio']);
    $moneda = mysqli_real_escape_string($conex, $_POST['moneda']);
    $fechaida = date($_POST['fechaida']);
    $fechavuelta = date($_POST['fechavuelta']);

    $sql = "UPDATE producto SET nombre = '$nombre', codigo='$codigo', precio = '$precio', descripcion = '$descripcion', moneda = '$moneda', fechaida = '$fechaida', fechavuelta = '$fechavuelta' WHERE idproducto = $idproducto";
    $resultado = mysqli_query($conex, $sql);

    if ($resultado) {
        header("Location: panel_jefe.php?actualizado=1");
        exit;
    } else {
        echo "Error al actualizar el producto.";
    }
} else {
    echo "Datos incompletos.";
}
?>