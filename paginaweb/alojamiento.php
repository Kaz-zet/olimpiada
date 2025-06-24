<!DOCTYPE html>
<html lang="en">
<?php
  include("includes/conDB.php");
  $query = "SELECT * FROM alojamiento";
  $resultado = mysqli_query($conex, $query);
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/buscador.css">
    <link rel="stylesheet" href="css/body.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/sidebar.css" />
    <link rel="stylesheet" href="css/carritof.css" />
    <link rel="stylesheet" href="css/alojamiento.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <!-- Kit de íconos -->
     <script src="https://kit.fontawesome.com/07a04549cf.js" crossorigin="anonymous"></script>
    <title>Alojamiento</title>
    <a href="carrito.php" class="carrito-flotante" title="Ver carrito">
    <i class="fas fa-shopping-cart"></i>
    </a>
</head>
<body>
<!-- CONTENEDOR: Encapsula todos los elementos de la página -->
<div class="contenedor">
    <header>
        <!--JAVA SCRIPT-->
        <script>
            function abrirSidebar() {
                document.getElementById("sidebar").classList.remove("d-none");
            }

            function cerrarSidebar() {
                document.getElementById("sidebar").classList.add("d-none");
            }
        </script>

        <!-- Barra de navegación -->
        <div class="barra">
            <div class="logo">
                <img src="imagenes/Turisteando.jpg" alt="Logo de la empresa">
            </div>
            <div class="botones">
                <div class="boton"><a href="inicio.html">Inicio</a></div>
                <div class="boton"><a href="alojamiento.php"><b>Alojamientos</b></a></div>
                <div class="boton"><a href="paquete.php">Paquetes</a></div>
                <div class="boton"><a href="transporte.php">Transporte</a></div>
                <div class="boton"><a href="contacto.php">Contactanos</a></div>
                 <!-- Para que al tocar la imagen te mande a la sidebar -->
                <a href="javascript:void(0)" onclick="abrirSidebar()" class="d-flex align-items-center">
                    <img src="imagenes/Turisteando1.jpg" alt="Perfil"/>
                </a>
            </div>
        </div>
        <!-- Sidebar que engloba todo -->
        <div id="sidebar" class="sidebar d-none">

            <!-- Botón para cerrar sidebar -->
            <button class="btn-close" aria-label="cerrar" onclick="cerrarSidebar()"></button>

            <!-- Contenido de la sidebar-->
            <nav class="nav flex-column mt-4">
                <a class="nav-link" href="ayuda.html"><i class=""></i>Ayuda</a>
                <a class="nav-link" href="index.php"><i class=""></i>Cerrar Sesion</a>
            </nav>
        </div>  
    </header>
    <main>
    <section class="intro">
        <h1>Encontra el alojamiento perfecto</h1>
        <p class="texto">Explorá una variedad de alojamientos únicos y cómodos para tu viaje.</p>
    </section>
    <section class="armar-viaje">
        <div class="caja">
            <h2>Arma tu viaje</h2>
            <form class="viaje" action="buscaralojamiento.php" method="GET">
    <input type="text" name="nombre" placeholder="Buscar alojamiento por nombre...">
    <input type="date" name="fechaida" placeholder="Desde..." />
    <input type="date" name="fechavuelta" placeholder="Hasta..." />

    <button type="submit">Buscar</button>
</form>
        </div>
    </section>
    <h1>Encontrá tu Alojamiento</h1>
    <?php


//Esto permite que las "tarjetas" sean visibles en la página donde cada alojamiento tiene la suya propia.
          $query = "SELECT * FROM alojamiento";
          $resultado = mysqli_query($conex, $query);
            while ($producto = mysqli_fetch_assoc($resultado)) {
                echo '<div class="card mx-auto my-4 shadow" style="max-width: 600px;">';
                echo '  <div class="card-body">';
                echo '    <h4 class="card-title "><i class="fas fa-bed"></i> ' . htmlspecialchars($producto['nombre']) . '</h4>';
                echo '    <p class="card-text"><i class="fas fa-map-marker-alt text-danger"></i> <strong>Dirección:</strong> ' . htmlspecialchars($producto['direccion']) . '</p>';
                echo '    <p class="card-text"><i class="fas fa-dollar-sign text-success"></i> <strong>Precio:</strong> $' . htmlspecialchars($producto['precio']) . '</p>';
                echo '    <p class="card-text"><strong>Divisa:</strong> ' . htmlspecialchars($producto['moneda']) . '</p>';
                echo '    <p class="card-text"><i class="fas fa-calendar-day text-info"></i> <strong>Entrada:</strong> ' . htmlspecialchars($producto['fechaentrada']) . '</p>';
                echo '    <p class="card-text"><i class="fas fa-calendar-check text-info"></i> <strong>Salida:</strong> ' . htmlspecialchars($producto['fechasalida']) . '</p>';
                echo '    <form method="POST" action="agregar_carrito.php" class="mt-3">';
                echo '      <input type="hidden" name="idalojamiento" value="' . $producto['idalojamiento'] . '">';
                echo '      <button type="submit" class="btn-perso"><i class="fas fa-cart-plus"></i> Agregar al carrito</button>';
                echo '    </form>';
                echo '  </div>';
                echo '</div>';
            }
        ?>
    </main>
        <!-- PIÉ DE PÁGINA/FOOTER -->
        <footer class="pie-pagina">

            <div class="grupo-1-footer">

                <div class="box-1-footer"> <!-- Caja 1: LOGO -->
                    <figure>
                        <a href="#">
                            <img class="logo-footer" src="" alt="logo">
                        </a>
                    </figure>
                </div>

                <div class="box-2-footer"> <!-- Caja 2: SOBRE NOSOTROS -->
                    <h2>SOBRE NOSOTROS</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio, natus?</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio, natus?</p>
                </div>

                <div class="box-3-footer"> <!-- Caja 3: REDES SOCIALES -->
                    <h2>SEGUINOS</h2>
                    <div class="red-social-footer">
                        <a href="#" class="fa fa-facebook"></a>
                        <a href="#" class="fa fa-instagram"></a>
                        <a href="#" class="fa-brands fa-x-twitter"></a>
                        <a href="#" class="fa fa-youtube"></a>
                    </div>
                </div>

            </div>


            <div class="grupo-2-footer">
                <small>&copy; 2025 Olimpiadas <b>Desarrollo Web</b> - Todos los Derechos Reservados</small>
            </div>
            
        </footer>

</div>
</body>
</html>