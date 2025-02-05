<?php
    session_start();
    $usuario = $_SESSION['usuario'];
    if (isset($_POST["cambiar"]) && isset($_POST["contra1"]) && isset($_POST["contra2"])) {
        $servidor = "localhost";
        $user = "root";
        $password = "";
        $bd = "zap_rails";

        $enlace = mysqli_connect($servidor, $user, $password, $bd);
        
        if (!$enlace) {
            die("No he podido conectar con el servidor: " . mysqli_connect_error());
        }

        if ($_POST["contra1"] != $_POST["contra2"]) {
            echo "<script>alert('Las contraseñas no coinciden.'); window.location.href = '../html/nueva_contraseña.html';</script>";
        } else {
            $cambio = "UPDATE usuaris SET contrasenya = '" . $_POST["contra1"] . "' WHERE usuari = '$usuario'";
            $result = mysqli_query($enlace, $cambio);

            if ($result) {
                echo "<script>alert('Contraseña cambiada correctamente'); window.location.href = '../html/login.html';</script>";
            } else {
                echo "<script>alert('No se ha podido cambiar la contraseña'); window.location.href = '../html/nueva_contraseña.html';</script>";
            }
        }
    } else {
        echo "<script>alert('No se han recibido los datos.')</script>; window.location.href = '../html/cambiar_password.html';";
    }

    mysqli_close($enlace);
?>