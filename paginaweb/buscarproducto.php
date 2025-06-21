<?php
include("includes/conDB.php");
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Buscar productos por nombre y fecha</title>
    <link rel="stylesheet" href="css/buscar.css">
</head>
<body>
    <div class="buscador-container">
        <h1>Buscar productos</h1>
        <form method="GET" action="buscarproducto.php">
            <input type="text" name="nombre" placeholder="Ej: Brasil" value="<?php echo isset($_GET['nombre']) ? htmlspecialchars($_GET['nombre']) : ''; ?>">
            <br><br>
            <label>Fecha ida:</label>
            <input type="date" name="fechaida" value="<?php echo isset($_GET['fechaida']) ? htmlspecialchars($_GET['fechaida']) : ''; ?>">
            <br><br>
            <label>Fecha vuelta:</label>
            <input type="date" name="fechavuelta" value="<?php echo isset($_GET['fechavuelta']) ? htmlspecialchars($_GET['fechavuelta']) : ''; ?>">
            <br><br>
            <button type="submit">Buscar</button>
        </form>
        <br>
        <a href="inicio.html"><button>Volver</button></a>
    </div>

    <div class="resultados">
<?php
// Variables al buscar
$nombre = isset($_GET['nombre']) ? mysqli_real_escape_string($conex, $_GET['nombre']) : '';

$fechaida = '';
if (!empty($_GET['fechaida']) && preg_match('/^\d{4}-\d{2}-\d{2}$/', $_GET['fechaida'])) {
    $fechaida = $_GET['fechaida'];
}

$fechavuelta = '';
if (!empty($_GET['fechavuelta']) && preg_match('/^\d{4}-\d{2}-\d{2}$/', $_GET['fechavuelta'])) {
    $fechavuelta = $_GET['fechavuelta'];
}

// Arma consulta SQL para buscar
$query = "SELECT * FROM producto WHERE 1=1";
if ($nombre !== '') {
    $query .= " AND nombre LIKE '%$nombre%'";
}
if ($fechaida !== '') {
    $query .= " AND fechaida >= '$fechaida'";
}
if ($fechavuelta !== '') {
    $query .= " AND fechavuelta <= '$fechavuelta'";
}

$resultado = mysqli_query($conex, $query);

if (!$resultado) {
    echo "<p>Error en la consulta: " . mysqli_error($conex) . "</p>";
} else {
    $cantidad_resultados = mysqli_num_rows($resultado);

    echo "<h2>Resultados de búsqueda</h2>";

    if ($cantidad_resultados > 0) {
        while ($producto = mysqli_fetch_assoc($resultado)) {
            echo "<div style='border:1px solid #ccc; padding:10px; margin:10px 0'>";
            echo "<h3>" . htmlspecialchars($producto['nombre']) . "</h3>";
            echo "<p><strong>Descripción:</strong> " . htmlspecialchars($producto['descripcion']) . "</p>";
            echo "<p><strong>Precio:</strong> $" . $producto['precio'] . "</p>";
            echo "<p><strong>Desde:</strong> " . $producto['fechaida'] . "</p>";
            echo "<p><strong>Hasta:</strong> " . $producto['fechavuelta'] . "</p>";

            //boton para agregar al carrito
            echo '<form action="agregar_carrito.php" method="post">';
            echo '<input type="hidden" name="idproducto" value="' . $producto['idproducto'] . '">';
            echo '<button type="submit">Agregar al carrito</button>';
            echo '</form>';

            echo "</div>";
        }
    } else {
        echo "<p>No se encontraron productos que coincidan con los criterios.</p>";
    }
}
?>
    </div>
</body>
</html>