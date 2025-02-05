<?php   
    if (isset($_POST["verificar"]) && isset($_POST["usuario"]) && isset($_POST["email"])) {
        $servidor = "localhost";
        $user = "root";
        $password = "";
        $bd = "zap_rails";
        
        $usuario = $_POST["usuario"];
        $correo = $_POST["email"];

        $enlace = mysqli_connect($servidor, $user, $password, $bd);
        
        if (!$enlace) {
            die("No he podido conectar con el servidor: " . mysqli_connect_error());
        }

        $consulta = "SELECT count(*) FROM usuaris WHERE usuari = '$usuario'";
        $resultado = mysqli_query($enlace, $consulta);

        if (!$resultado) {
            echo "<script>alert('El usuario no existe'); window.location.href = '../html/cambiar_password.html';</script>";
        } else {
            $datos = "SELECT usuari, email FROM clients WHERE usuari = '$usuario'";
            $result = mysqli_query($enlace, $datos);
            $fila = mysqli_fetch_assoc($result);

            if ($fila['usuari'] == $usuario) {
                if ($fila['email'] == $correo) {
                    session_start();
                    $_SESSION['usuario'] = $usuario;   
                    header("Location: ../html/nueva_contraseña.html?$usuario");
                    exit();
                } else {
                    echo "<script>alert('El correo electronico no coincide.'); window.location.href = '../html/cambiar_password.html';</script>";
                }
            } else {
                echo "<script>alert('El usuario no existe'); window.location.href = '../html/cambiar_password.html';</script>";
            }
        }
    } else {
        echo "<script>alert('No se han recibido los datos.')</script>; window.location.href = '../html/cambiar_password.html';";
    }

    mysqli_close($enlace);
?>