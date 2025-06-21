<?php

include("includes/conDB.php");

if(isset($_POST['send'])){

    if(
        strlen($_POST['name']) >= 1 &&
        strlen($_POST['surname']) >=  1&&
        strlen($_POST['password']) >= 1 &&
        strlen($_POST['email']) >= 1 &&
        strlen($_POST['phone']) >= 1
    ){
        $name = trim ($_POST['name']);
        $surname = trim ($_POST['surname']);
        $password = trim ($_POST['password']);
        $email = trim ($_POST['email']);
        $phone = trim ($_POST['phone']);
        $checkQuery = "SELECT * FROM cliente WHERE email = '$email'";
        $checkResult = mysqli_query($conex, $checkQuery);

        if (mysqli_num_rows($checkResult) > 0) {
            echo "<h3 class='error'>Este email ya está registrado.</h3>";
        } else {
        $consulta= "INSERT INTO cliente(nombre, apellido, contraseña, email, telefono)
                    VALUES ('$name', '$surname', '$password', '$email', '$phone')";
        $resultado = mysqli_query ($conex, $consulta);
        if ($resultado) {
            ?>
                <h3 class="success"> Tu registro se ha completado</h3>
                
            <?php
        } else {
            ?>
            <h3 class="error"> Error</h3>
             <?php
        }
    }
    } else {
        ?>
        <h3 class="error"> Llena todos los campos </h3>
        <?php
    }
}

?>