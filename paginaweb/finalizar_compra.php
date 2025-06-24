<?php
session_start();

if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])) {
    echo "Tu carrito está vacío.";
    exit;
}

include("includes/conDB.php");

//Calcular y mostrar resumen del carrito.
$total = 0;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Finalizar Compra</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        form { max-width: 400px; margin: auto; }
        input, select { width: 100%; padding: 10px; margin: 10px 0; }
        ul { list-style: none; padding: 0; }
        ul li { margin-bottom: 8px; }
        .total { font-weight: bold; font-size: 1.2em; margin-top: 20px; }
    </style>
</head>
<body>

<h2>Resumen del carrito</h2>
<ul>
<?php
//Muestra el resumen del carrito con cada item.
foreach ($_SESSION['carrito'] as $clave => $cantidad) {
    if (preg_match('/^prod_(\d+)$/', $clave, $match)) {
        $id = intval($match[1]);
        $res = mysqli_query($conex, "SELECT nombre, precio FROM producto WHERE idproducto = $id");
    } elseif (preg_match('/^paq_(\d+)$/', $clave, $match)) {
        $id = intval($match[1]);
        $res = mysqli_query($conex, "SELECT nombre, precio FROM paquete WHERE idpaquete = $id");
    } elseif (preg_match('/^trans_(\d+)$/', $clave, $match)) {
        $id = intval($match[1]);
        $res = mysqli_query($conex, "SELECT nombre, precio FROM transporte WHERE idtransporte = $id");
    } elseif (preg_match('/^aloja_(\d+)$/', $clave, $match)) {
        $id = intval($match[1]);
        $res = mysqli_query($conex, "SELECT nombre, precio FROM alojamiento WHERE idalojamiento = $id");
    } else {
        continue;
    }

    if ($row = mysqli_fetch_assoc($res)) {
        $subtotal = $row['precio'] * $cantidad;
        $total += $subtotal;
        echo "<li>" . htmlspecialchars($row['nombre']) . " x{$cantidad} - $" . number_format($subtotal, 2) . "</li>";
    }
}
?>
</ul>

<p class="total">Total a pagar: $<?php echo number_format($total, 2); ?></p>

<h2>Datos de Pago</h2>
<a href="carrito.php" class="btn-volver"><button>Inicio</button></a>
<a href="mis_pedidos.php" class="btn-volver"><button>Pedidos</button></a>
<form method="POST" action="procesar_pago.php">
    <label>Nombre en la tarjeta:</label>
    <input type="text" name="nombre" required>

    <label>Número de tarjeta:</label>
    <input type="text" name="numero" pattern="\d{16}" placeholder="16 dígitos" required>

    <label>Fecha de vencimiento:</label>
    <input type="month" name="vencimiento" required>

    <label>CVC:</label>
    <input type="text" name="cvc" pattern="\d{3}" required>

    <label>Correo electrónico:</label>
    <input type="email" name="email" required>

    <label>Método de pago:</label>
    <select name="metodo" required>
        <option value="Tarjeta">Tarjeta</option>
        <option value="Transferencia">Transferencia</option>
        <option value="MercadoPago">MercadoPago</option>
    </select>

    <button type="submit">Pagar</button>
</form>

</body>
</html>
