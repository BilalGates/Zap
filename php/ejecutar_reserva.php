<?php
    session_start(); 

    $logged_in = isset($_SESSION['username']);

    if (!$logged_in) {
        echo "<script>alert('Para reservar tienes que iniciar sesión'); window.location.href = '../html/login2.html';</script>";
        exit;
    } else {
        $reservation_data_received = isset($_GET["ID_viatge"]) && isset($_GET["num_pasajeros"]) && isset($_GET["Dia_hora"]);

        if ($reservation_data_received) {
            $_SESSION['ID_viatge'] = $_GET["ID_viatge"];
            $_SESSION['num_pasajeros'] = $_GET["num_pasajeros"]; 
            $_SESSION['Dia_hora'] = $_GET["Dia_hora"];
        } else {
            echo "Datos de reserva no recibidos correctamente.";
        }
    }

    if ($reservation_data_received) {
        $ID_viatge = $_SESSION['ID_viatge'];
        $num_pasajeros = $_SESSION['num_pasajeros'];
        $Dia_hora = $_SESSION['Dia_hora'];

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


        $sentenciaR = "SELECT pla FROM subscripcio WHERE id_sub = ?";
        $stmtR = mysqli_prepare($enlace, $sentenciaR);
        mysqli_stmt_bind_param($stmtR, "s", $id_sub);
        mysqli_stmt_execute($stmtR);
        mysqli_stmt_bind_result($stmtR, $pla);
        mysqli_stmt_fetch($stmtR);
        mysqli_stmt_close($stmtR);

        $sentencia2 = "INSERT INTO bitllets (Tipus, Dia, Estat, Viatgers, ID_viatge) VALUES ( '$pla', '" . $_SESSION['Dia_hora'] . "', '" . "Actiu" . "', '" . $_SESSION['num_pasajeros'] . "', '" . $_SESSION['ID_viatge'] . "')";
        $result2 = mysqli_query($enlace, $sentencia2);

        if ($result2) {
            $id_billet = mysqli_insert_id($enlace);
            $sentencia7 = "UPDATE clients SET ID_billet = '$id_billet' WHERE id_client = '$id_client'";

            $result7 = mysqli_query($enlace, $sentencia7);

            if ($result7) {
                echo "<script>alert('Reserva realizada correctamente'); window.location.href = '../php/cliente_gestionar.php';</script>";
            } else {
                echo "<script>alert('Error al realizar reserva'); window.location.href = '../php/procesar_reserva.php';</script>";
            }
        } else {
            echo "<script>alert('Error crear billete'); window.location.href = '../php/procesar_reserva.php';</script>";
        }

        mysqli_close($enlace);
    } else {
        echo "<script>alert('No se han recibido los datos, vuelve a intentarlo'); window.location.href = '../html/index.html';</script>";
    }
?>
