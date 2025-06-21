<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/registrarse.css">
    <!-- Kit de íconos -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
     <script src="https://kit.fontawesome.com/07a04549cf.js" crossorigin="anonymous"></script>
    <title>Registrarse</title>
</head>
<body>
        <form method="post" autocomplete="off">
            <h2>Bienvenido</h2>
            <div class="grupo input">

                <div class="contenedor input">
                    <input type="text" name="name" placeholder="Nombre">
                    <i class="fa-solid fa-user"></i>
                </div>

                <div class="contenedor input">
                    <input type="text" name="surname" placeholder="Apellido">
                    <i class="fa-solid fa-user"></i>
                </div>

                <div class="contenedor input">
                    <input type="password" name="password" placeholder="Contraseña">
                    <i class="fa-solid fa-lock"></i>
                </div>

                <div class="contenedor input">
                    <input type="email" name="email" placeholder="Email">
                    <i class="fa-solid fa-envelope"></i>
                </div>

                <div class="contenedor input">
                    <input type="tel" name="phone" placeholder="Teléfono">
                    <i class="fa-solid fa-phone"></i>
                </div>
                <a href="#">Terminos y Condiciones</a>
                <input type="submit" name="send" class="btn" value="Enviar">
                <a href="index.php" class="yatengo">Ya tengo cuenta</a>
            </div>

        </form>

       
        <?php
            include("registrarsebd.php");
        ?>
</div>
</body>
</html>