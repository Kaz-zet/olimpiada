<?php
include("includes/conDB.php");
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Buscar transporte</title>
    <link rel="stylesheet" href="css/buscar.css">
</head>
<body>
<div class="buscador-container">
    <h1>Buscar transporte</h1>
    <form method="GET" action="buscartransporte.php">
        <input type="text" name="nombre" placeholder="Ej: Auto Mendoza" value="<?php echo isset($_GET['nombre']) ? htmlspecialchars($_GET['nombre']) : ''; ?>"><br><br>
        <label>Fecha de reserva:</label>
        <input type="date" name="fechareserva" value="<?php echo isset($_GET['fechareserva']) ? htmlspecialchars($_GET['fechareserva']) : ''; ?>"><br><br>
        <label>Fecha de devolución:</label>
        <input type="date" name="fechadevolucion" value="<?php echo isset($_GET['fechadevolucion']) ? htmlspecialchars($_GET['fechadevolucion']) : ''; ?>"><br><br>
        <button type="submit">Buscar</button>
    </form>
    <br>
    <a href="inicio.html"><button>Volver</button></a>
</div>

<div class="resultados">
<?php
$nombre = isset($_GET['nombre']) ? mysqli_real_escape_string($conex, $_GET['nombre']) : '';
$reserva = $_GET['fechareserva'] ?? '';
$devolucion = $_GET['fechadevolucion'] ?? '';

$query = "SELECT * FROM transporte WHERE 1=1";
if ($nombre !== '') $query .= " AND nombre LIKE '%$nombre%'";
if ($reserva !== '') $query .= " AND fechareserva >= '$reserva'";
if ($devolucion !== '') $query .= " AND fechadevolucion <= '$devolucion'";

$resultado = mysqli_query($conex, $query);

if (!$resultado) {
    echo "<p>Error: " . mysqli_error($conex) . "</p>";
} elseif (mysqli_num_rows($resultado) > 0) {
    echo "<h2>Resultados</h2>";
    while ($trans = mysqli_fetch_assoc($resultado)) {
        echo "<div style='border:1px solid #ccc; padding:10px; margin:10px 0'>";
        echo "<h3>" . htmlspecialchars($trans['nombre']) . "</h3>";
        echo "<p><strong>Ubicación:</strong> " . htmlspecialchars($trans['ubicacion']) . "</p>";
        echo "<p><strong>Precio:</strong> $" . $trans['precio'] . " (" . $trans['moneda'] . ")</p>";
        echo "<p><strong>Reserva:</strong> " . $trans['fechareserva'] . "</p>";
        echo "<p><strong>Devolución:</strong> " . $trans['fechadevolucion'] . "</p>";

        echo '<form action="agregar_carrito.php" method="post">';
        echo '<input type="hidden" name="idtransporte" value="' . $trans['idtransporte'] . '">';
        echo '<button type="submit">Agregar al carrito</button>';
        echo '</form>';
        echo "</div>";
    }
} else {
    echo "<p>No se encontraron transportes.</p>";
}
?>
</div>
</body>
</html>
