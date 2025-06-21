<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['cargo'] !== 'jefe') {
    header("Location: index.php");
    exit;
}

include("includes/conDB.php");

// PARA AGREGAR PRODUCTOSS
if (isset($_POST['agregar'])) {
    $nombre = trim($_POST['nombre']);
    $codigo = trim($_POST['codigo']);
    $descripcion = trim($_POST['descripcion']);
    $precio = floatval($_POST['precio']);
    $moneda = trim($_POST['moneda']);
    $fechaida = date($_POST['fechaida']);
    $fechavuelta = date($_POST['fechavuelta']);

    $query = "INSERT INTO producto(nombre, codigo, descripcion, precio, moneda, fechaida, fechavuelta)
              VALUES ('$nombre', '$codigo', '$descripcion', '$precio', '$moneda', '$fechaida', '$fechavuelta')";

    $resultado = mysqli_query($conex, $query);

    if ($resultado) {
        $mensaje = "✅ Producto agregado correctamente";
    } else {
        $mensaje = "❌ Error al agregar producto";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/panel_jefe.css">
    <title>Panel del Jefe</title>
</head>
<body>

    <form method="post">
        <input type="text" name="nombre" placeholder="Nombre del producto" required><br>
        <input type="number" name="codigo" placeholder="Numero del producto" required><br>
        <textarea name="descripcion" placeholder="Descripción" required></textarea><br>
        <input type="number" name="precio" step="0.01" placeholder="Precio" required><br>
        <input type="text" name="moneda" placeholder="Tipo de Moneda" required><br>
        <input type="date" name="fechaida" placeholder="Fecha de Salida" required><br>
        <input type="date" name="fechavuelta" placeholder="Fecha de Vuelta" required><br>

        <input type="submit" name="agregar" value="Agregar producto">
    </form>

    <?php if (isset($mensaje)) echo "<p>$mensaje</p>"; ?>
    <?php 

$consulta = "SELECT * FROM producto";
$resultado = mysqli_query($conex, $consulta);

while ($row = mysqli_fetch_assoc($resultado)) {
    echo "<div>";
    echo "<h3>" . $row['nombre'] . "</h3>";
    echo "<h3>" . $row['codigo'] . "</h3>";
    echo "<p>" . $row['descripcion'] . "</p>";
    echo "<p>Precio: $" . $row['precio'] . "</p>";
    echo "<p>Divisa: " . $row['moneda'] . "</p>";
    echo "<p>Desde: " . $row['fechaida'] . "</p>";
    echo "<p>Hasta: " . $row['fechavuelta'] . "</p>";


    echo '<form method="post" action="eliminar_productos.php">';
    echo '<input type="hidden" name="idproducto" value="' . $row['idproducto'] . '">';
    echo '<input type="submit" value="Eliminar">';
    echo '</form>';
    echo "</div><hr>";

    echo '<form method="get" action="editar_producto.php">';
    echo '<input type="hidden" name="idproducto" value="' . $row['idproducto'] . '">';
    echo '<input type="submit" value="Editar">';
    echo '</form>';
    echo "</div><hr>";
}

?>

</body>
</html>