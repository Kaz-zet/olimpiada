<?php
include("includes/conDB.php");
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Buscar en todos los productos</title>
    <link rel="stylesheet" href="css/buscar.css">
</head>
<body>
<div class="buscador-container">
    <h1>Buscar productos</h1>
    <form method="GET" action="buscargeneral.php">
        <input type="text" name="nombre" placeholder="Ej: Brasil, Hotel, Auto..." value="<?php echo isset($_GET['nombre']) ? htmlspecialchars($_GET['nombre']) : ''; ?>">
        <button type="submit">Buscar</button>
    </form>
    <br>
    <a href="inicio.html"><button>Volver</button></a>
</div>

<div class="resultados">
<?php
$nombre = isset($_GET['nombre']) ? mysqli_real_escape_string($conex, $_GET['nombre']) : '';

if ($nombre === '') {
    echo "<p>Ingresá un nombre para buscar.</p>";
    exit;
}

// ---- PRODUCTO ----
$query = "SELECT * FROM producto WHERE nombre LIKE '%$nombre%'";
$res = mysqli_query($conex, $query);
while ($row = mysqli_fetch_assoc($res)) {
    echo "<div><h3>Producto: " . htmlspecialchars($row['nombre']) . "</h3>";
    echo "<p>Descripción: " . htmlspecialchars($row['descripcion']) . "</p>";
    echo "<p>Precio: $" . $row['precio'] . "</p>";
    echo "<p>Fecha ida: " . $row['fechaida'] . " | Vuelta: " . $row['fechavuelta'] . "</p>";
    echo '<form action="agregar_carrito.php" method="post">';
    echo '<input type="hidden" name="idproducto" value="' . $row['idproducto'] . '">';
    echo '<button type="submit">Agregar al carrito</button>';
    echo '</form></div><hr>';
}

// ---- PAQUETE ----
$query = "SELECT * FROM paquete WHERE nombre LIKE '%$nombre%'";
$res = mysqli_query($conex, $query);
while ($row = mysqli_fetch_assoc($res)) {
    echo "<div><h3>Paquete: " . htmlspecialchars($row['nombre']) . "</h3>";
    echo "<p>Descripción: " . htmlspecialchars($row['descripcion']) . "</p>";
    echo "<p>Precio: $" . $row['precio'] . " (" . $row['moneda'] . ")</p>";
    echo "<p>Fecha ida: " . $row['fechaida'] . " | Vuelta: " . $row['fechavuelta'] . "</p>";
    echo '<form action="agregar_carrito.php" method="post">';
    echo '<input type="hidden" name="idpaquete" value="' . $row['idpaquete'] . '">';
    echo '<button type="submit">Agregar al carrito</button>';
    echo '</form></div><hr>';
}

// ---- ALOJAMIENTO ----
$query = "SELECT * FROM alojamiento WHERE nombre LIKE '%$nombre%'";
$res = mysqli_query($conex, $query);
while ($row = mysqli_fetch_assoc($res)) {
    echo "<div><h3>Alojamiento: " . htmlspecialchars($row['nombre']) . "</h3>";
    echo "<p>Dirección: " . htmlspecialchars($row['direccion']) . "</p>";
    echo "<p>Precio: $" . $row['precio'] . " (" . $row['moneda'] . ")</p>";
    echo "<p>Desde: " . $row['fechaentrada'] . " | Hasta: " . $row['fechasalida'] . "</p>";
    echo '<form action="agregar_carrito.php" method="post">';
    echo '<input type="hidden" name="idalojamiento" value="' . $row['idalojamiento'] . '">';
    echo '<button type="submit">Agregar al carrito</button>';
    echo '</form></div><hr>';
}

// ---- TRANSPORTE ----
$query = "SELECT * FROM transporte WHERE nombre LIKE '%$nombre%'";
$res = mysqli_query($conex, $query);
while ($row = mysqli_fetch_assoc($res)) {
    echo "<div><h3>Transporte: " . htmlspecialchars($row['nombre']) . "</h3>";
    echo "<p>Ubicación: " . htmlspecialchars($row['ubicacion']) . "</p>";
    echo "<p>Precio: $" . $row['precio'] . " (" . $row['moneda'] . ")</p>";
    echo "<p>Reserva: " . $row['fechareserva'] . " | Devolución: " . $row['fechadevolucion'] . "</p>";
    echo '<form action="agregar_carrito.php" method="post">';
    echo '<input type="hidden" name="idtransporte" value="' . $row['idtransporte'] . '">';
    echo '<button type="submit">Agregar al carrito</button>';
    echo '</form></div><hr>';
}
?>
</div>
</body>
</html>
