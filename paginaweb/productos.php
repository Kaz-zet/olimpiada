<?php
include("includes/conDB.php");

$query = "SELECT * FROM producto";
$resultado = mysqli_query($conex, $query);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Productos disponibles</title>
</head>
<body>
    <h2>Catálogo de productos</h2>

    <?php while($producto = mysqli_fetch_assoc($resultado)): ?>
        <div>
            <h3><?= $producto['nombre'] ?></h3>
            <p><?= $producto['descripcion'] ?></p>
            <p><?= $producto['codigo'] ?></p>
            <strong>Precio: $<?= $producto['precio'] ?></strong>
            <p><?= $producto['fechaida'] ?></p>
            <p><?= $producto['fechavuelta'] ?></p>
            <hr>
        </div>
    <?php endwhile; ?>
    <?php

    //se agrega al carrito los productos.
    $consulta = "SELECT * FROM producto";
    $resultado = mysqli_query($conex, $consulta);
    while ($producto = mysqli_fetch_assoc($resultado)) {
        echo "<div>";
        echo "<h3>" . htmlspecialchars($producto['nombre']) . "</h3>";
        echo "<p>Precio: $" . htmlspecialchars($producto['precio']) . "</p>";
        echo "<p>Ida:" ($producto['fechaida']) . "</p>";
        echo "<p>Vuelta:" ($producto['fechavuelta']) . "</p>";
        
        
        echo '<form method="POST" action="agregar_carrito.php">';
        echo '<input type="hidden" name="idproducto" value="' . $producto['idproducto'] . '">';
        echo '<input type="number" name="cantidad" value="1" min="1">';
        echo '<button type="submit">Agregar al carrito</button>';
        echo '</form>';

        echo "</div>";
}
    ?>
</body>
</html>