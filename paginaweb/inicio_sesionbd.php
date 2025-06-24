<?php
session_start();
include("includes/conDB.php");

if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    //Se revisa en jefe de ventas.
    $query_jefe = "SELECT * FROM jefeventas WHERE email='$email'";
    $resultado_jefe = mysqli_query($conex, $query_jefe);

    if ($resultado_jefe && mysqli_num_rows($resultado_jefe) === 1) {
        $jefe = mysqli_fetch_assoc($resultado_jefe);

        if ($jefe['contraseña'] === $password) {
            $_SESSION['usuario'] = $jefe['nombre'];
            $_SESSION['cargo'] = 'jefe';
            header("Location: panel_jefe.php");
            exit;
        } else {
            $mensaje = "Contraseña o usuario incorrecta";
        }
    } else {
        // Si no se encuentra en jefe de ventas se revisa en cliente.
        $query_cliente = "SELECT * FROM cliente WHERE email='$email'";
        $resultado_cliente = mysqli_query($conex, $query_cliente);

        if ($resultado_cliente && mysqli_num_rows($resultado_cliente) === 1) {
            $cliente = mysqli_fetch_assoc($resultado_cliente);

            if ($cliente['contraseña'] === $password) {
                $_SESSION['usuario'] = $cliente['nombre'];
                $_SESSION['cargo'] = 'cliente';
                $_SESSION['idcliente'] = $cliente['idcliente'];
                header("Location: inicio.html");
                exit;
            } else {
                $mensaje = "Contraseña o usuario incorrecto";
            }
        } else {
            $mensaje = "Usuario no encontrado";
        }
    }

    // Error
    echo "<h3 class='error'>$mensaje</h3>";
}
?>