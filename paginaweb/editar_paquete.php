<?php

include("includes/conDB.php");

if (!isset($_GET['idpaquete'])) {
    echo "ID de paquete no especificado.";
    exit;
}

$idpaquete = intval($_GET['idpaquete']);

$sql = "SELECT * FROM paquete WHERE idpaquete = $idpaquete";
$resultado = mysqli_query($conex, $sql);

if (!$paquete = mysqli_fetch_assoc($resultado)) {
    echo "Paquete no encontrado.";
    exit;
}
?>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/editar_producto.css">
    <title>Editar Paquete</title>
</head>
<form action="actualizar_paquete.php" method="post">
    <input type="hidden" name="idpaquete" value="<?= $paquete['idpaquete'] ?>">
    <label>Nombre:</label>
    <input type="text" name="nombre" value="<?= htmlspecialchars($paquete['nombre']) ?>" required>
    <br>
    <label>Descripcion:</label>
    <input type="text" name="descripcion" step="0.01" value="<?= $paquete['descripcion'] ?>" required>
    <label>Precio:</label>
    <input type="number" name="precio" step="0.01" value="<?= $paquete['precio'] ?>" required>
    <label>Moneda:</label>
    <input type="text" name="moneda" step="0.01" value="<?= $paquete['moneda'] ?>" required>
    <label>Fecha de Ida:</label>
    <input type="date" name="fechaida" step="0.01" value="<?= $paquete['fechaida'] ?>" required>
    <label>Fecha de Vuelta:</label>
    <input type="date" name="fechavuelta" step="0.01" value="<?= $paquete['fechavuelta'] ?>" required>
    <button type="submit">Actualizar paquete</button>
</form>