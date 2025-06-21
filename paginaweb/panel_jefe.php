
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
    <h2>Bienvenido Jefe, <?php echo $_SESSION['usuario']; ?></h2> <a href="panel_aprobacion.php">Aprobar productos</a>
    <h3>¿A cual apartado desea entrar?</h3>
    <a href="jefe_producto.php">Productos</a>
    <a href="jefe_paquete.php">Paquetes</a>
    <a href="jefe_transporte.php">Transportes</a>
    <a href="jefe_alojamiento.php">Alojamientos</a>
    <a href="index.php">Cerrar sesión</a>
</body>
</html>