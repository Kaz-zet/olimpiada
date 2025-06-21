<?php
session_start();
include("includes/conDB.php");

if (!isset($_SESSION['usuario']) || $_SESSION['cargo'] !== 'cliente') {
    echo "Acceso denegado.";
    exit;
}

$nombreCliente = $_SESSION['usuario'];

// Obtener idcliente
$queryCliente = "SELECT idcliente FROM cliente WHERE nombre = '$nombreCliente'";
$resCliente = mysqli_query($conex, $queryCliente);
$rowCliente = mysqli_fetch_assoc($resCliente);
$idcliente = $rowCliente['idcliente'];

function obtenerNombreItem($pedido, $conex) {
    if (!empty($pedido['idproducto'])) {
        $res = mysqli_query($conex, "SELECT nombre FROM producto WHERE idproducto = " . intval($pedido['idproducto']));
        if ($row = mysqli_fetch_assoc($res)) return $row['nombre'];
    } elseif (!empty($pedido['idpaquete'])) {
        $res = mysqli_query($conex, "SELECT nombre FROM paquete WHERE idpaquete = " . intval($pedido['idpaquete']));
        if ($row = mysqli_fetch_assoc($res)) return $row['nombre'];
    } elseif (!empty($pedido['idtransporte'])) {
        $res = mysqli_query($conex, "SELECT nombre FROM transporte WHERE idtransporte = " . intval($pedido['idtransporte']));
        if ($row = mysqli_fetch_assoc($res)) return $row['nombre'];
    } elseif (!empty($pedido['idalojamiento'])) {
        $res = mysqli_query($conex, "SELECT nombre FROM alojamiento WHERE idalojamiento = " . intval($pedido['idalojamiento']));
        if ($row = mysqli_fetch_assoc($res)) return $row['nombre'];
    }

    // Debug temporal:
    error_log("⚠️ Pedido con ID desconocido. Fila: " . json_encode($pedido));
    return "Desconocido";
}

function mostrarPedidos($conex, $idcliente, $filtroEstado, $titulo) {
    $filtroSQL = $filtroEstado === 'pasado' ? "!= 'pendiente'" : "= 'pendiente'";
    $query = "SELECT DISTINCT idcobro FROM pedido WHERE idcliente = $idcliente AND estado $filtroSQL ORDER BY idpedido DESC";
    $resCobros = mysqli_query($conex, $query);

    echo "<h2>$titulo</h2>";

    if (mysqli_num_rows($resCobros) === 0) {
        echo "<p>No hay pedidos en esta categoría.</p>";
        return;
    }

    while ($cobroRow = mysqli_fetch_assoc($resCobros)) {
        $idCobro = $cobroRow['idcobro'];

        $queryPedidos = "SELECT * FROM pedido WHERE idcliente = $idcliente AND idcobro = $idCobro";
        $resPedidos = mysqli_query($conex, $queryPedidos);

        $pedidoEjemplo = mysqli_fetch_assoc(mysqli_query($conex, "SELECT * FROM pedido WHERE idcobro = $idCobro LIMIT 1"));
        $cobroInfo = mysqli_fetch_assoc(mysqli_query($conex, "SELECT * FROM cobro WHERE idcobro = $idCobro"));
        $emailInfo = mysqli_fetch_assoc(mysqli_query($conex, "SELECT * FROM email WHERE idemail = " . $pedidoEjemplo['idemail']));

        echo "<div style='border:1px solid #ccc; padding:10px; margin-bottom:15px; border-radius:10px'>";
        echo "<p><strong>Compra total:</strong> $" . $pedidoEjemplo['total'] . "</p>";
        echo "<p><strong>Estado del pedido:</strong> " . ucfirst($pedidoEjemplo['estado']) . "</p>";
        echo "<p><strong>Pago:</strong> " . ucfirst($cobroInfo['estadopago']) . " (" . $cobroInfo['metodopago'] . ")</p>";
        echo "<p><strong>Email:</strong> " . ucfirst($emailInfo['estadoenvio']) . "</p>";

        echo "<ul><strong>Ítems comprados:</strong>";
        mysqli_data_seek($resPedidos, 0);
        while ($pedido = mysqli_fetch_assoc($resPedidos)) {
            $nombreItem = obtenerNombreItem($pedido, $conex);
            echo "<li>" . htmlspecialchars($nombreItem) . "</li>";
        }
        echo "</ul>";

        if ($pedidoEjemplo['estado'] === 'pendiente') {
            echo "<form method='post' action='cancelar_pedido.php'>";
            echo "<input type='hidden' name='idcobro' value='" . $idCobro . "'>";
            echo "<button type='submit'>Cancelar pedido</button>";
            echo "</form>";
        }

        echo "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Pedidos</title>
</head>
<body>
<a href="inicio.html"><button>Inicio</button></a>
<a href="carrito.php"><button>Carrito</button></a>

<?php
mostrarPedidos($conex, $idcliente, 'actuales', '🕒 Pedidos en curso');
mostrarPedidos($conex, $idcliente, 'pasado', '📜 Historial de pedidos');
?>
</body>
</html>