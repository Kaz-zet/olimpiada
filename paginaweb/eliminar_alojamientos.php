<?php
include("includes/conDB.php");

if (isset($_POST['idalojamiento'])) {
    $id = intval($_POST['idalojamiento']);
    $consulta = "DELETE FROM alojamiento WHERE idalojamiento = $id";
    $resultado = mysqli_query($conex, $consulta);

    if ($resultado) {
        header("Location: panel_jefe.php?eliminado=1");
        exit;
    } else {
        echo "Error al eliminar el alojamiento.";
    }
} else {
    echo "ID no recibido.";
}
?>