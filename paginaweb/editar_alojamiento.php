<?php

include("includes/conDB.php");

if (!isset($_GET['idalojamiento'])) {
    echo "ID de alojamiento no especificado.";
    exit;
}

$idalojamiento = intval($_GET['idalojamiento']);

$sql = "SELECT * FROM alojamiento WHERE idalojamiento = $idalojamiento";
$resultado = mysqli_query($conex, $sql);

if (!$alojamiento = mysqli_fetch_assoc($resultado)) {
    echo "Alojamiento no encontrado.";
    exit;
}
?>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/editar_producto.css">
    <title>Editar Alojamiento</title>
</head>
<form action="actualizar_alojamiento.php" method="post">
    <input type="hidden" name="idalojamiento" value="<?= $alojamiento['idalojamiento'] ?>">
    <label>Nombre:</label>
    <input type="text" name="nombre" value="<?= htmlspecialchars($alojamiento['nombre']) ?>" required>
    <br>
    <label>Direccion:</label>
    <input type="text" name="direccion" step="0.01" value="<?= $alojamiento['direccion'] ?>" required>
    <label>Precio:</label>
    <input type="number" name="precio" step="0.01" value="<?= $alojamiento['precio'] ?>" required>
    <label>Moneda:</label>
    <input type="text" name="moneda" step="0.01" value="<?= $alojamiento['moneda'] ?>" required>
    <label>Fecha de Entrada:</label>
    <input type="date" name="fechaentrada" step="0.01" value="<?= $alojamiento['fechaentrada'] ?>" required>
    <label>Fecha de Salida:</label>
    <input type="date" name="fechasalida" step="0.01" value="<?= $alojamiento['fechasalida'] ?>" required>
    <button type="submit">Actualizar alojamiento</button>
</form>