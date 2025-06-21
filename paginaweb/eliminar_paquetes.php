<?php
include("includes/conDB.php");

if (isset($_POST['idpaquete'])) {
    $id = intval($_POST['idpaquete']);
    $consulta = "DELETE FROM paquete WHERE idpaquete = $id";
    $resultado = mysqli_query($conex, $consulta);

    if ($resultado) {
        header("Location: panel_jefe.php?eliminado=1");
        exit;
    } else {
        echo "Error al eliminar el paquete.";
    }
} else {
    echo "ID no recibido.";
}
?>