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
    $ubicacion = trim($_POST['ubicacion']);
    $precio = floatval($_POST['precio']);
    $moneda = trim($_POST['moneda']);
    $fechareserva = date($_POST['fechareserva']);
    $fechadevolucion = date($_POST['fechadevolucion']);

    $query = "INSERT INTO transporte(nombre, ubicacion, precio, moneda, fechareserva, fechadevolucion)
              VALUES ('$nombre', '$ubicacion', '$precio', '$moneda', '$fechareserva', '$fechadevolucion')";

    $resultado = mysqli_query($conex, $query);

    if ($resultado) {
        $mensaje = "✅ Transporte agregado correctamente";
    } else {
        $mensaje = "❌ Error al agregar transporte";
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
        <input type="text" name="nombre" placeholder="Marca y modelo del vehiculo" required><br>
        <textarea name="ubicacion" placeholder="Ubicacion" required></textarea><br>
        <input type="number" name="precio" step="0.01" placeholder="Precio" required><br>
        <input type="text" name="moneda" placeholder="Tipo de Moneda" required><br>
        <input type="date" name="fechareserva" placeholder="Fecha de Reserva" required><br>
        <input type="date" name="fechadevolucion" placeholder="Fecha de Devolución" required><br>

        <input type="submit" name="agregar" value="Agregar transporte">
    </form>

    <?php if (isset($mensaje)) echo "<p>$mensaje</p>"; ?>
    <?php 

$consulta = "SELECT * FROM transporte";
$resultado = mysqli_query($conex, $consulta);

while ($row = mysqli_fetch_assoc($resultado)) {
    echo "<div>";
    echo "<h3>" . $row['nombre'] . "</h3>";
    echo "<p>Ubicación: " . $row['ubicacion'] . "</p>";
    echo "<p>Precio: $" . $row['precio'] . "</p>";
    echo "<p>Divisa: " . $row['moneda'] . "</p>";
    echo "<p>Desde: " . $row['fechareserva'] . "</p>";
    echo "<p>Hasta: " . $row['fechadevolucion'] . "</p>";


    echo '<form method="post" action="eliminar_transportes.php">';
    echo '<input type="hidden" name="idtransporte" value="' . $row['idtransporte'] . '">';
    echo '<input type="submit" value="Eliminar">';
    echo '</form>';
    echo "</div><hr>";

    echo '<form method="get" action="editar_transporte.php">';
    echo '<input type="hidden" name="idtransporte" value="' . $row['idtransporte'] . '">';
    echo '<input type="submit" value="Editar">';
    echo '</form>';
    echo "</div><hr>";
}

?>

</body>
</html>