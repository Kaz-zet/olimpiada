<?php

//BASE PARA TODO, CONEXION CON LA BASE DE DATOS
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "turisteandobd";

$conex = mysqli_connect($servername, $username, $password, $dbname);

if (!$conex) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>