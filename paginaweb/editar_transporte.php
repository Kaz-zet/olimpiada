<?php

include("includes/conDB.php");

if (!isset($_GET['idtransporte'])) {
    echo "ID de transporte no especificado.";
    exit;
}

$idtransporte = intval($_GET['idtransporte']);

$sql = "SELECT * FROM transporte WHERE idtransporte = $idtransporte";
$resultado = mysqli_query($conex, $sql);

if (!$transporte = mysqli_fetch_assoc($resultado)) {
    echo "Transporte no encontrado.";
    exit;
}
?>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/editar_producto.css">
    <title>Editar Transporte</title>
</head>
<form action="actualizar_transporte.php" method="post">
    <input type="hidden" name="idtransporte" value="<?= $transporte['idtransporte'] ?>">
    <label>Nombre:</label>
    <input type="text" name="nombre" value="<?= htmlspecialchars($transporte['nombre']) ?>" required>
    <br>
    <label>Ubicación:</label>
    <input type="text" name="ubicacion" value="<?= htmlspecialchars($transporte['ubicacion']) ?>" required>
    <br>
    <label>Precio:</label>
    <input type="number" name="precio" step="0.01" value="<?= $transporte['precio'] ?>" required>
    <label>Moneda:</label>
    <input type="text" name="moneda" step="0.01" value="<?= $transporte['moneda'] ?>" required>
    <label>Fecha de Reserva:</label>
    <input type="date" name="fechareserva" step="0.01" value="<?= $transporte['fechareserva'] ?>" required>
    <label>Fecha de Devolución:</label>
    <input type="date" name="fechadevolucion" step="0.01" value="<?= $transporte['fechadevolucion'] ?>" required>
    <button type="submit">Actualizar transporte</button>
</form>