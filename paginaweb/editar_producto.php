<?php

include("includes/conDB.php");

if (!isset($_GET['idproducto'])) {
    echo "ID de producto no especificado.";
    exit;
}

$idproducto = intval($_GET['idproducto']);

$sql = "SELECT * FROM producto WHERE idproducto = $idproducto";
$resultado = mysqli_query($conex, $sql);

if (!$producto = mysqli_fetch_assoc($resultado)) {
    echo "Producto no encontrado.";
    exit;
}
?>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/editar_producto.css">
    <title>Editar Producto</title>
</head>
<form action="actualizar_producto.php" method="post">
    <input type="hidden" name="idproducto" value="<?= $producto['idproducto'] ?>">
    <label>Nombre:</label>
    <input type="text" name="nombre" value="<?= htmlspecialchars($producto['nombre']) ?>" required>
    <br>
    <label>Codigo:</label>
    <input type="number" name="codigo" step="0.01" value="<?= $producto['codigo'] ?>" required>
    <br>
    <label>Descripcion:</label>
    <input type="text" name="descripcion" step="0.01" value="<?= $producto['descripcion'] ?>" required>
    <label>Precio:</label>
    <input type="number" name="precio" step="0.01" value="<?= $producto['precio'] ?>" required>
    <label>Moneda:</label>
    <input type="text" name="moneda" step="0.01" value="<?= $producto['moneda'] ?>" required>
    <label>Fecha de Ida:</label>
    <input type="date" name="fechaida" step="0.01" value="<?= $producto['fechaida'] ?>" required>
    <label>Fecha de Vuelta:</label>
    <input type="date" name="fechavuelta" step="0.01" value="<?= $producto['fechavuelta'] ?>" required>
    <button type="submit">Actualizar producto</button>
</form>