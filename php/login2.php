<?php
    if (isset($_POST["boton"])) {

        $usuario = $_POST["username"];
        $contrasena = $_POST["password"];

        if (empty($usuario) or empty($contrasena)) {
            echo "<script>alert('Introduce los valores'); window.location.href = '../html/login2.html';</script>";
        } else {
            $servidor = "localhost";
            $user = "root";
            $password = "";
            $bd = "zap_rails";
            
            $enlace = mysqli_connect($servidor, $user, $password, $bd);
            
            if (!$enlace) {
                die("No he podido conectar con el servidor: " . mysqli_connect_error());
            }
            
            $sentenciaS = "SELECT count(*) FROM usuaris WHERE usuari = '" . $_POST["username"] . "' AND contrasenya = '" . $_POST["password"] . "'";
            $sentencia2 = "SELECT tipus FROM usuaris WHERE usuari = '" . $_POST["username"] . "'";

            $resultS = mysqli_query($enlace, $sentenciaS);
            $result2 = mysqli_query($enlace, $sentencia2);

            $fila = mysqli_fetch_row($resultS);
            $tipus = mysqli_fetch_row($result2);

            if ($fila[0] == 1) {
                if ($tipus[0] == 1) {
                    header("Location: ../html/zap_gestionar.html");
                    exit();
                } else {
                    session_start();
                    $_SESSION["username"] = $usuario;

                    echo "<script>alert('Acabas de iniciar sesión'); window.location.href = '../html/index.html';</script>";
                    exit();
                }
            } else {
                echo "<script>alert('Error al autenticarse'); window.location.href = '../html/login2.html';</script>";
            }

            mysqli_close($enlace);
        }
    }
?>