<?php
session_start();
include("includes/conDB.php");

//Vuelve a verificar si es un jefe
if (!isset($_SESSION['cargo']) || $_SESSION['cargo'] !== 'jefe') {
    echo "Acceso denegado.";
    exit;
}

if (isset($_POST['idpedido']) && isset($_POST['accion'])) {
    $idpedido = intval($_POST['idpedido']);
    $accion = $_POST['accion'];

    if ($accion === 'aprobar') {
        $nuevoEstadoPedido = 'aprobado';
        $nuevoEstadoPago = 'aprobado';
        $nuevoEstadoEnvio = 'enviado';
    } elseif ($accion === 'rechazar') {
        $nuevoEstadoPedido = 'rechazado';
        $nuevoEstadoPago = 'rechazado';
        $nuevoEstadoEnvio = 'cancelado';
    } else {
        echo "Acción no válida.";
        exit;
    }

    //Actualiza el estado del pedido
    $sqlPedido = "UPDATE pedido SET estado = '$nuevoEstadoPedido' WHERE idpedido = $idpedido";
    $exitoPedido = mysqli_query($conex, $sqlPedido);

    if ($exitoPedido) {
        //busca idcobro e idemail del pedido
        $consultaDatos = "SELECT idcobro, idemail FROM pedido WHERE idpedido = $idpedido";
        $resultadoDatos = mysqli_query($conex, $consultaDatos);
        $fila = mysqli_fetch_assoc($resultadoDatos);
        $idcobro = $fila['idcobro'];
        $idemail = $fila['idemail'];

        //Actualiza estado del cobro
        $sqlCobro = "UPDATE cobro SET estadopago = '$nuevoEstadoPago' WHERE idcobro = $idcobro";
        mysqli_query($conex, $sqlCobro);

        //Actualiza estado del email
        $sqlEmail = "UPDATE email SET estadoenvio = '$nuevoEstadoEnvio' WHERE idemail = $idemail";
        mysqli_query($conex, $sqlEmail);

        echo "✅ Pedido, pago y email actualizados a <strong>$nuevoEstadoPedido</strong>. <a href='panel_aprobacion.php'>Volver</a>";
    } else {
        echo "❌ Error al actualizar el pedido.";
    }
}
?>
