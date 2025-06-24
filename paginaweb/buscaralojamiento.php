<?php
include("includes/conDB.php");
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Buscar alojamiento</title>
    <link rel="stylesheet" href="css/buscar.css">
</head>
<body>
    <div class="buscador-container">
        <h1>Buscar alojamiento</h1>
        <form method="GET" action="buscaralojamiento.php">
            <input type="text" name="nombre" placeholder="Ej: Hotel Plaza" value="<?php echo isset($_GET['nombre']) ? htmlspecialchars($_GET['nombre']) : ''; ?>">
            <br><br>
            <label>Fecha entrada:</label>
            <input type="date" name="fechaentrada" value="<?php echo isset($_GET['fechaentrada']) ? htmlspecialchars($_GET['fechaentrada']) : ''; ?>">
            <br><br>
            <label>Fecha salida:</label>
            <input type="date" name="fechasalida" value="<?php echo isset($_GET['fechasalida']) ? htmlspecialchars($_GET['fechasalida']) : ''; ?>">
            <br><br>
            <button type="submit">Buscar</button>
        </form>
        <br>
        <a href="inicio.html"><button>Volver</button></a>
    </div>

    <div class="resultados">
<?php
//Variables al buscar.
$nombre = isset($_GET['nombre']) ? mysqli_real_escape_string($conex, $_GET['nombre']) : '';

$fechaentrada = '';
if (!empty($_GET['fechaentrada']) && preg_match('/^\d{4}-\d{2}-\d{2}$/', $_GET['fechaentrada'])) {
    $fechaentrada = $_GET['fechaentrada'];
}

$fechasalida = '';
if (!empty($_GET['fechasalida']) && preg_match('/^\d{4}-\d{2}-\d{2}$/', $_GET['fechasalida'])) {
    $fechasalida = $_GET['fechasalida'];
}
//Consulta SQL.
$query = "SELECT * FROM alojamiento WHERE 1=1";
if ($nombre !== '') {
    $query .= " AND nombre LIKE '%$nombre%'";
}
if ($fechaentrada !== '') {
    $query .= " AND fechaentrada >= '$fechaentrada'";
}
if ($fechasalida !== '') {
    $query .= " AND fechasalida <= '$fechasalida'";
}

$resultado = mysqli_query($conex, $query);

if (!$resultado) {
    echo "<p>Error en la consulta: " . mysqli_error($conex) . "</p>";
} else {
    $cantidad = mysqli_num_rows($resultado);

    if ($cantidad > 0) {
        echo "<h2>Resultados</h2>";
        while ($aloj = mysqli_fetch_assoc($resultado)) {
            echo "<div style='border:1px solid #ccc; padding:10px; margin:10px 0'>";
            echo "<h3>" . htmlspecialchars($aloj['nombre']) . "</h3>";
            echo "<p><strong>Dirección:</strong> " . htmlspecialchars($aloj['direccion']) . "</p>";
            echo "<p><strong>Precio:</strong> $" . $aloj['precio'] . " (" . $aloj['moneda'] . ")</p>";
            echo "<p><strong>Desde:</strong> " . $aloj['fechaentrada'] . "</p>";
            echo "<p><strong>Hasta:</strong> " . $aloj['fechasalida'] . "</p>";

            //Agrega al carrito.
            echo '<form action="agregar_carrito.php" method="post">';
            echo '<input type="hidden" name="idalojamiento" value="' . $aloj['idalojamiento'] . '">';
            echo '<button type="submit">Agregar al carrito</button>';
            echo '</form>';

            echo "</div>";
        }
    } else {
        echo "<p>No se encontraron alojamientos que coincidan con los criterios.</p>";
    }
}
?>
    </div>
</body>
</html>
