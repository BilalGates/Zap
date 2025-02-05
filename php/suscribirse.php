<?php
    session_start(); 

    $logged_in = isset($_SESSION['username']);

    if (!$logged_in) {
        echo "<script>alert('Para suscribirte tienes que iniciar sesión'); window.location.href = '../html/login2.html';</script>";
        exit;
    }
    
    if (isset($_GET['$codigo'])) {
        $subscriptionCode = $_GET['$codigo'];

        $servidor = "localhost";
        $usuario = "root";
        $password = "";
        $bd = "zap_rails";

        $enlace = mysqli_connect($servidor, $usuario, $password, $bd);

        if (!$enlace) {
            die("No he podido conectar con el servidor: " . mysqli_connect_error());
        }

        $sentencia1 = "SELECT id_client, id_sub FROM clients WHERE usuari = ?";
        $stmt1 = mysqli_prepare($enlace, $sentencia1);
        mysqli_stmt_bind_param($stmt1, "s", $_SESSION['username']);
        mysqli_stmt_execute($stmt1);
        mysqli_stmt_bind_result($stmt1, $id_client, $id_sub);
        mysqli_stmt_fetch($stmt1);
        mysqli_stmt_close($stmt1);

        if ($id_sub !== null && $id_sub !== "0") {
            echo "<script>alert('El cliente ya esta suscrito, si quieres cambiar de plan, elimina el actual'); window.location.href = '../php/cliente_gestionar.php';</script>";
        } else {
            $sentencia = "UPDATE clients SET ID_sub = '$subscriptionCode' WHERE id_client = '$id_client'";

            $result = mysqli_query($enlace, $sentencia);

            if ($result) {
                echo "<script>alert('Estas suscrito'); window.location.href = '../php/cliente_gestionar.php';</script>";
            } else {
                echo "<script>alert('Error al suscribirse'); window.location.href = '../html/suscribe.html';</script>";
            }
        }

        mysqli_close($enlace);
    } else {
        echo "<script>alert('Algo ha fallado'); window.location.href = '../html/suscribe.html';</script>";
    }
?>