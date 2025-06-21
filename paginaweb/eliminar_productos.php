<?php
include("includes/conDB.php");

if (isset($_POST['idproducto'])) {
    $id = intval($_POST['idproducto']);
    $consulta = "DELETE FROM producto WHERE idproducto = $id";
    $resultado = mysqli_query($conex, $consulta);

    if ($resultado) {
        header("Location: panel_jefe.php?eliminado=1");
        exit;
    } else {
        echo "Error al eliminar el producto.";
    }
} else {
    echo "ID no recibido.";
}
?>