<?php

    session_start();

    include 'conexion.php';

    $correo = $_POST['correo'];
    $clave = $_POST['clave'];
    $clave = hash('sha512', $clave);

    $validar_login = mysqli_query($conexion, "SELECT * FROM usuarios WHERE
    correo='$correo' and clave='$clave'");

    if(mysqli_num_rows($validar_login) > 0){
        $_SESSION['usuarios'] = $correo;
        header("location: ../bienvenido.php");
        exit;
    } else {
        echo '
            <script>
                alert("Usuario no existente, por favor verifique los datos introducidos");
                window.location = "../index.php";
            </script>
        ';
        exit;
    }



?>