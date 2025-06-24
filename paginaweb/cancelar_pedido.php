<?php
session_start();
include("includes/conDB.php");

if (!isset($_SESSION['usuario']) || $_SESSION['cargo'] !== 'cliente') {
    echo "Acceso denegado.";
    exit;
}

if (!isset($_POST['idcobro'])) {
    echo "Solicitud inválida.";
    exit;
}

$idcobro = intval($_POST['idcobro']);
$idcliente = $_SESSION['idcliente'] ?? 0;

//Valida que el cobro sea del cliente.
$queryValidacion = "SELECT COUNT(*) as total FROM pedido WHERE idcobro = $idcobro AND idcliente = $idcliente";
$resValid = mysqli_query($conex, $queryValidacion);
$dataValid = mysqli_fetch_assoc($resValid);

if ($dataValid['total'] == 0) {
    echo "No puedes cancelar este pedido.";
    exit;
}

//Cancela.
mysqli_query($conex, "UPDATE pedido SET estado = 'cancelado' WHERE idcobro = $idcobro AND idcliente = $idcliente");

//Cobro cancelado.
mysqli_query($conex, "UPDATE cobro SET estadopago = 'cancelado' WHERE idcobro = $idcobro");

//Email en estado cancelado también.
mysqli_query($conex, "UPDATE email SET estadoenvio = 'cancelado' 
    WHERE idemail IN (
        SELECT idemail FROM pedido WHERE idcobro = $idcobro AND idcliente = $idcliente LIMIT 1
    )");

echo "<p>❌ Compra cancelada correctamente.</p>";
echo "<a href='mis_pedidosh.php'>Volver a mis pedidos</a>";
?>
