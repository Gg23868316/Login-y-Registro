<?php 

    include 'conexion.php';

    $nombre_completo = $_POST['nombre_completo'];
    $correo = $_POST['correo'];
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];
    
    //Encriptamiento de la clave
    $clave = hash('sha512', $clave);

    $query = "INSERT INTO usuarios(nombre_completo, correo, usuario, clave)
                VALUES('$nombre_completo', '$correo', '$usuario', '$clave')";

    //verificar que el correo no se repita en la base de datos

    $verificar_correo = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo='$correo' ");

    if(mysqli_num_rows($verificar_correo) > 0){
        echo '
            <script>
                alert("Este correo ya esta registrado, intenta con otro.");
                window.location = "../index.php";
            </script>
        ';
        exit();
    }

    //verificar que el nombre de usuiario no se repita en la base de datos

    $verificar_usuario = mysqli_query($conexion, "SELECT * FROM usuarios WHERE usuario='$usuario' ");

    if(mysqli_num_rows($verificar_usuario) > 0){
        echo '
            <script>
                alert("Este usuario ya esta registrado, intenta con otro.");
                window.location = "../index.php";
            </script>
        ';
        exit();
    }

    $ejecutar = mysqli_query($conexion, $query);

    if($ejecutar){
        echo '
            <script>
                alert("Usuario registrado exitosamente");
                window.location = "../index.php";
            </script>   
        ';
    } else{
        echo '
            <script>
                alert("Intentalo de nuevo, usuario no registrado");
                window.location = "../index.php";
            </script>';
    }

    mysqli_close($conexion);

?>