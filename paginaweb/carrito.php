<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/carrito.css">
    <link rel="stylesheet" href="css/footer.css">
    <!-- Kit de íconos -->
     <script src="https://kit.fontawesome.com/07a04549cf.js" crossorigin="anonymous"></script>
    <title>Carrito</title>
</head>
<body>

    <main>
        <a href="inicio.html" class="btn-volver"><button>Inicio</button></a>
        <a href="mis_pedidosh.php" class="btn-volver"><button>Pedidos e Historial</button></a>


    </main>
        <!-- CONTENEDOR: Encapsula todos los elementos de la página -->
    <div class="contenedor">



<?php
session_start();
include("includes/conDB.php");

if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])) {
    echo "El carrito está vacío.";
    exit;
}

$carrito = $_SESSION['carrito'];
echo "<h2>Tu carrito</h2>";

$total = 0;

// Recorremos el carrito
foreach ($carrito as $clave => $cantidad) {
    // Detectar tipo e ID: ejemplo 'prod_5'
    if (preg_match('/^(prod|paq|trans|aloja)_(\d+)$/', $clave, $match)) {
        $tipo = $match[1];  // prod, paq, etc.
        $id = intval($match[2]);

        // Definir tabla y campo
        switch ($tipo) {
            case 'prod':
                $tabla = 'producto';
                $campo = 'idproducto';
                break;
            case 'paq':
                $tabla = 'paquete';
                $campo = 'idpaquete';
                break;
            case 'trans':
                $tabla = 'transporte';
                $campo = 'idtransporte';
                break;
            case 'aloja':
                $tabla = 'alojamiento';
                $campo = 'idalojamiento';
                break;
            default:
                continue 2; // salta al siguiente ítem si no coincide
        }

        // Obtener datos desde la base
        $sql = "SELECT * FROM $tabla WHERE $campo = $id";
        $res = mysqli_query($conex, $sql);
        $item = mysqli_fetch_assoc($res);

        if ($item) {
            $subtotal = $item['precio'] * $cantidad;
            $total += $subtotal;

            echo '<div class="producto">';
            echo "<h3>" . htmlspecialchars($item['nombre']) . "</h3>";
            echo "<p>Cantidad: $cantidad</p>";
            echo "<p>Subtotal: $" . number_format($subtotal, 2) . "</p>";

            // Botón: Quitar una unidad
            echo '<form action="quitar_unidad.php" method="post">';
            echo '<input type="hidden" name="clave" value="' . htmlspecialchars($clave) . '">';
            echo '<button type="submit">Quitar 1 unidad</button>';
            echo '</form>';

            // Botón: Eliminar completamente
            echo '<form action="eliminar_carrito.php" method="post">';
            echo '<input type="hidden" name="clave" value="' . htmlspecialchars($clave) . '">';
            echo '<button type="submit">Eliminar</button>';
            echo '</form>';

            echo "</div><hr>";
        }
    }
}

echo "<h3>Total: $" . number_format($total, 2) . "</h3>";
?>
<form action="finalizar_compra.php" method="post">
    <button type="submit">Finalizar compra</button>
</form>
</div>
</body>
</html>