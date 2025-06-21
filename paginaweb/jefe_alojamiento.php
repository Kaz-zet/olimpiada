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
    $direccion = trim($_POST['direccion']);
    $precio = floatval($_POST['precio']);
    $moneda = trim($_POST['moneda']);
    $fechaentrada = date($_POST['fechaentrada']);
    $fechasalida = date($_POST['fechasalida']);

    $query = "INSERT INTO alojamiento(nombre, direccion, precio, moneda, fechaentrada, fechasalida)
              VALUES ('$nombre', '$direccion', '$precio', '$moneda', '$fechaentrada', '$fechasalida')";

    $resultado = mysqli_query($conex, $query);

    if ($resultado) {
        $mensaje = "✅ Alojamiento agregado correctamente";
    } else {
        $mensaje = "❌ Error al agregar paquete";
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
        <input type="text" name="nombre" placeholder="Nombre del Alojamiento" required><br>
        <textarea name="direccion" placeholder="Dirección" required></textarea><br>
        <input type="number" name="precio" step="0.01" placeholder="Precio" required><br>
        <input type="text" name="moneda" placeholder="Tipo de Moneda" required><br>
        <input type="date" name="fechaentrada" placeholder="Fecha de Entrada" required><br>
        <input type="date" name="fechasalida" placeholder="Fecha de Salida" required><br>

        <input type="submit" name="agregar" value="Agregar alojamiento">
    </form>

    <?php if (isset($mensaje)) echo "<p>$mensaje</p>"; ?>
    <?php 

$consulta = "SELECT * FROM alojamiento";
$resultado = mysqli_query($conex, $consulta);

while ($row = mysqli_fetch_assoc($resultado)) {
    echo "<div>";
    echo "<h3>" . $row['nombre'] . "</h3>";
    echo "<p>Direccion: " . $row['direccion'] . "</p>";
    echo "<p>Precio: $" . $row['precio'] . "</p>";
    echo "<p>Divisa: " . $row['moneda'] . "</p>";
    echo "<p>Fecha de Entrada: " . $row['fechaentrada'] . "</p>";
    echo "<p>Fecha de Salida: " . $row['fechasalida'] . "</p>";


    echo '<form method="post" action="eliminar_alojamientos.php">';
    echo '<input type="hidden" name="idalojamiento" value="' . $row['idalojamiento'] . '">';
    echo '<input type="submit" value="Eliminar">';
    echo '</form>';
    echo "</div><hr>";

    echo '<form method="get" action="editar_alojamiento.php">';
    echo '<input type="hidden" name="idalojamiento" value="' . $row['idalojamiento'] . '">';
    echo '<input type="submit" value="Editar">';
    echo '</form>';
    echo "</div><hr>";
}

?>
</body>
</html>