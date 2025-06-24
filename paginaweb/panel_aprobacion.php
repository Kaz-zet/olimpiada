<?php
session_start();
include("includes/conDB.php");

// Verifica si es jefe
if (!isset($_SESSION['cargo']) || $_SESSION['cargo'] !== 'jefe') {
    echo "Acceso denegado.";
    exit;
}

echo "<h2>Pedidos pendientes de aprobación</h2>";

// Consulta: une todas las posibles tablas de ítems por separado
$query = "SELECT pedido.idpedido, cliente.nombre AS cliente,
                 producto.nombre AS nombre_producto,
                 paquete.nombre AS nombre_paquete,
                 transporte.nombre AS nombre_transporte,
                 alojamiento.nombre AS nombre_alojamiento,
                 pedido.total, pedido.estado
          FROM pedido
          INNER JOIN cliente ON pedido.idcliente = cliente.idcliente
          LEFT JOIN producto ON pedido.idproducto = producto.idproducto
          LEFT JOIN paquete ON pedido.idpaquete = paquete.idpaquete
          LEFT JOIN transporte ON pedido.idtransporte = transporte.idtransporte
          LEFT JOIN alojamiento ON pedido.idalojamiento = alojamiento.idalojamiento
          WHERE pedido.estado = 'pendiente'";

$resultado = mysqli_query($conex, $query);

if (!$resultado) {
    echo "Error en la consulta: " . mysqli_error($conex);
    exit;
}

while ($pedido = mysqli_fetch_assoc($resultado)) {
    echo "<div style='border:1px solid #ccc; padding:10px; margin:10px'>";
    echo "<p><strong>ID Pedido:</strong> {$pedido['idpedido']}</p>";
    echo "<p><strong>Cliente:</strong> {$pedido['cliente']}</p>";

    //Muestra los items que existen.
    if (!empty($pedido['nombre_producto'])) {
        echo "<p><strong>Producto:</strong> {$pedido['nombre_producto']}</p>";
    }
    if (!empty($pedido['nombre_paquete'])) {
        echo "<p><strong>Paquete:</strong> {$pedido['nombre_paquete']}</p>";
    }
    if (!empty($pedido['nombre_transporte'])) {
        echo "<p><strong>Transporte:</strong> {$pedido['nombre_transporte']}</p>";
    }
    if (!empty($pedido['nombre_alojamiento'])) {
        echo "<p><strong>Alojamiento:</strong> {$pedido['nombre_alojamiento']}</p>";
    }

    echo "<p><strong>Total:</strong> {$pedido['total']}</p>";
    echo "<p><strong>Estado:</strong> {$pedido['estado']}</p>";

    //Para aprobar o rechazar.
    echo "<form action='procesar_aprobacion.php' method='post' style='display:inline'>";
    echo "<input type='hidden' name='idpedido' value='{$pedido['idpedido']}'>";
    echo "<input type='hidden' name='accion' value='aprobar'>";
    echo "<button type='submit'>✅ Aprobar</button>";
    echo "</form>";

    echo "<form action='procesar_aprobacion.php' method='post' style='display:inline'>";
    echo "<input type='hidden' name='idpedido' value='{$pedido['idpedido']}'>";
    echo "<input type='hidden' name='accion' value='rechazar'>";
    echo "<button type='submit'>❌ Rechazar</button>";
    echo "</form>";

    echo "</div>";
}
?>