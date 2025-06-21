<?php
include("includes/conDB.php");

if (isset($_POST['idtransporte'])) {
    $id = intval($_POST['idtransporte']);
    $consulta = "DELETE FROM transporte WHERE idtransporte = $id";
    $resultado = mysqli_query($conex, $consulta);

    if ($resultado) {
        header("Location: panel_jefe.php?eliminado=1");
        exit;
    } else {
        echo "Error al eliminar el transporte.";
    }
} else {
    echo "ID no recibido.";
}
?>