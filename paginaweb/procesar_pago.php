<?php
session_start();

if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])) {
    echo "Carrito vacío.";
    exit;
}

include("includes/conDB.php");

$idCliente = $_SESSION['idcliente'] ?? 1; // fallback a 1 si no está
$idJefe = 1; // o lógica para obtener jefe disponible

$nombre = $_POST['nombre'];
$numero = $_POST['numero'];
$vencimiento = $_POST['vencimiento'];
$cvc = $_POST['cvc'];
$email = $_POST['email'];
$metodo = $_POST['metodo'];
$fechaCobro = date("Y-m-d H:i:s");

$carrito = $_SESSION['carrito'];
$total = 0;

// Calcular total, detectando tipo de ítem
foreach ($carrito as $clave => $cantidad) {
    if (preg_match('/^prod_(\d+)$/', $clave, $match)) {
        $id = intval($match[1]);
        $res = mysqli_query($conex, "SELECT precio FROM producto WHERE idproducto = $id");
    } elseif (preg_match('/^paq_(\d+)$/', $clave, $match)) {
        $id = intval($match[1]);
        $res = mysqli_query($conex, "SELECT precio FROM paquete WHERE idpaquete = $id");
    } elseif (preg_match('/^trans_(\d+)$/', $clave, $match)) {
        $id = intval($match[1]);
        $res = mysqli_query($conex, "SELECT precio FROM transporte WHERE idtransporte = $id");
    } elseif (preg_match('/^aloja_(\d+)$/', $clave, $match)) {
        $id = intval($match[1]);
        $res = mysqli_query($conex, "SELECT precio FROM alojamiento WHERE idalojamiento = $id");
    } else {
        continue; // clave no válida, ignorar
    }

    if ($row = mysqli_fetch_assoc($res)) {
        $total += $row['precio'] * $cantidad;
    }
}

// Inserta en tabla cobro
mysqli_query($conex, "INSERT INTO cobro (montopagado, metodopago, estadopago, fechacobro) 
VALUES ($total, '$metodo', 'pendiente', '$fechaCobro')");
$idCobro = mysqli_insert_id($conex);

// Inserta en tabla email
$asunto = "Gracias por tu compra";
$cuerpo = "Tu compra fue registrada por un total de $$total. Estado: pendiente de aprobación.";
mysqli_query($conex, "INSERT INTO email (destinatario, asunto, cuerpo, fechaenvio, estadoenvio) 
VALUES ('$email', '$asunto', '$cuerpo', '$fechaCobro', 'pendiente')");
$idEmail = mysqli_insert_id($conex);

// Inserta en tabla pedido por cada ítem, según tipo
foreach ($carrito as $clave => $cantidad) {
    for ($i = 0; $i < $cantidad; $i++) {
        if (preg_match('/^prod_(\d+)$/', $clave, $match)) {
            $id = intval($match[1]);
            $query = "INSERT INTO pedido (idcliente, idjefeventas, idproducto, idemail, idcobro, estado, total) 
                      VALUES ($idCliente, $idJefe, $id, $idEmail, $idCobro, 'pendiente', $total)";
        } elseif (preg_match('/^paq_(\d+)$/', $clave, $match)) {
            $id = intval($match[1]);
            $query = "INSERT INTO pedido (idcliente, idjefeventas, idpaquete, idemail, idcobro, estado, total) 
                      VALUES ($idCliente, $idJefe, $id, $idEmail, $idCobro, 'pendiente', $total)";
        } elseif (preg_match('/^trans_(\d+)$/', $clave, $match)) {
            $id = intval($match[1]);
            $query = "INSERT INTO pedido (idcliente, idjefeventas, idtransporte, idemail, idcobro, estado, total) 
                      VALUES ($idCliente, $idJefe, $id, $idEmail, $idCobro, 'pendiente', $total)";
        } elseif (preg_match('/^aloja_(\d+)$/', $clave, $match)) {
            $id = intval($match[1]);
            $query = "INSERT INTO pedido (idcliente, idjefeventas, idalojamiento, idemail, idcobro, estado, total) 
                      VALUES ($idCliente, $idJefe, $id, $idEmail, $idCobro, 'pendiente', $total)";
        } else {
            continue;
        }
        mysqli_query($conex, $query);
    }
}

unset($_SESSION['carrito']); // Vaciar carrito

echo "<p>✅ Compra registrada. Un jefe de ventas la aprobará pronto.</p>";
echo "<a href='inicio.html'>Volver a la tienda</a>";
?>
