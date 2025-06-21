<?php
include("includes/conDB.php");
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Buscar paquete</title>
    <link rel="stylesheet" href="css/buscar.css">
</head>
<body>
<div class="buscador-container">
    <h1>Buscar paquete</h1>
    <form method="GET" action="buscarpaquete.php">
        <input type="text" name="nombre" placeholder="Ej: Londres" value="<?php echo isset($_GET['nombre']) ? htmlspecialchars($_GET['nombre']) : ''; ?>"><br><br>
        <label>Fecha ida:</label>
        <input type="date" name="fechaida" value="<?php echo isset($_GET['fechaida']) ? htmlspecialchars($_GET['fechaida']) : ''; ?>"><br><br>
        <label>Fecha vuelta:</label>
        <input type="date" name="fechavuelta" value="<?php echo isset($_GET['fechavuelta']) ? htmlspecialchars($_GET['fechavuelta']) : ''; ?>"><br><br>
        <button type="submit">Buscar</button>
    </form>
    <br>
    <a href="inicio.html"><button>Volver</button></a>
</div>

<div class="resultados">
<?php
$nombre = isset($_GET['nombre']) ? mysqli_real_escape_string($conex, $_GET['nombre']) : '';
$fechaida = $_GET['fechaida'] ?? '';
$fechavuelta = $_GET['fechavuelta'] ?? '';

$query = "SELECT * FROM paquete WHERE 1=1";
if ($nombre !== '') $query .= " AND nombre LIKE '%$nombre%'";
if ($fechaida !== '') $query .= " AND fechaida >= '$fechaida'";
if ($fechavuelta !== '') $query .= " AND fechavuelta <= '$fechavuelta'";

$resultado = mysqli_query($conex, $query);

if (!$resultado) {
    echo "<p>Error: " . mysqli_error($conex) . "</p>";
} elseif (mysqli_num_rows($resultado) > 0) {
    echo "<h2>Resultados</h2>";
    while ($paq = mysqli_fetch_assoc($resultado)) {
        echo "<div style='border:1px solid #ccc; padding:10px; margin:10px 0'>";
        echo "<h3>" . htmlspecialchars($paq['nombre']) . "</h3>";
        echo "<p><strong>Descripción:</strong> " . htmlspecialchars($paq['descripcion']) . "</p>";
        echo "<p><strong>Precio:</strong> $" . $paq['precio'] . " (" . $paq['moneda'] . ")</p>";
        echo "<p><strong>Desde:</strong> " . $paq['fechaida'] . "</p>";
        echo "<p><strong>Hasta:</strong> " . $paq['fechavuelta'] . "</p>";

        echo '<form action="agregar_carrito.php" method="post">';
        echo '<input type="hidden" name="idpaquete" value="' . $paq['idpaquete'] . '">';
        echo '<button type="submit">Agregar al carrito</button>';
        echo '</form>';
        echo "</div>";
    }
} else {
    echo "<p>No se encontraron paquetes.</p>";
}
?>
</div>
</body>
</html>
