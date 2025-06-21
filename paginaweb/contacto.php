<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/body.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/sidebar.css" />
    <link rel="stylesheet" href="css/alojamiento.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <!-- Kit de íconos -->
     <script src="https://kit.fontawesome.com/07a04549cf.js" crossorigin="anonymous"></script>
    <title>Contactenos</title>
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
                <div class="boton"><a href="alojamiento.php">Alojamientos</a></div>
                <div class="boton"><a href="paquete.php">Paquetes</a></div>
                <div class="boton"><a href="transporte.php">Transporte</a></div>
                <div class="boton"><a href="contacto.php"><b>Contactanos</b></a></div>
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
  <div class="container my-5">
    <div class="card shadow-sm mx-auto" style="max-width: 600px; border-radius: 12px;">
      <div class="card-body p-4">
        <h2 class="card-title text-center mb-4" style="color:#310838; font-weight: 700;">
          Déjanos tus recomendaciones
        </h2>
        <form method="post" novalidate>
          <div class="mb-3">
            <input
              type="text"
              name="nombre"
              placeholder="Nombre de usuario"
              class="form-control"
              required
            />
          </div>

          <div class="mb-3">
            <textarea
              name="mensaje"
              placeholder="Mensaje"
              class="form-control"
              rows="5"
              required
            ></textarea>
          </div>

          <div class="mb-4">
            <select name="calificacion" class="form-select" required>
              <option value="" disabled selected>
                Calificación de estadía en la página
              </option>
              <option value="1">1 - Muy mala</option>
              <option value="2">2 - Mala</option>
              <option value="3">3 - Regular</option>
              <option value="4">4 - Buena</option>
              <option value="5">5 - Excelente</option>
            </select>
          </div>

          <div class="d-grid">
            <input
              type="submit"
              name="enviar"
              value="Enviar"
              class="btn-perso"
            />
          </div>
        </form>
      </div>
    </div>
  </div>
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