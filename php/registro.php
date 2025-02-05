<?php 
    if (isset($_POST["crear"])) {
        if (empty($_POST["nombre"]) or empty($_POST["apellido"]) or empty($_POST["email"]) or empty($_POST["fecha"]) or empty($_POST["cp"]) or empty($_POST["usuario"]) or empty($_POST["contra1"]) or empty($_POST["contra2"])) {
            echo "<script>alert('Es necesario introducir todos los valores.'); window.location.href = '../html/login.html';</script>";
        } else {
            if ($_POST["contra1"] != $_POST["contra2"]) {
                echo "<script>alert('Las contraseñas no coinciden.'); window.location.href = '../html/login.html';</script>";
            } else {
                $servidor = "localhost";
                $usuario = "root";
                $password = "";
                $bd = "zap_rails";

                $enlace = mysqli_connect($servidor, $usuario, $password, $bd);
                
                $sentenciaS = "SELECT count(*) FROM clients WHERE email = '" . $_POST["email"] . "'";
                $sentencia5 = "SELECT count(*) FROM usuaris WHERE usuari = '" . $_POST["usuario"] . "'";

                $result5 = mysqli_query($enlace, $sentencia5);
                $fila5 = mysqli_fetch_row($result5);
                $resultS = mysqli_query($enlace, $sentenciaS);
                $fila = mysqli_fetch_row($resultS);

                if (!$enlace) {
                    die("No he podido conectar con el servidor: " . mysqli_connect_error());
                }   

                if ($fila5[0] == 1) {
                    echo "<script>alert('Este nombre de usuario ya esta en uso, prueba con otro.'); window.location.href = '../html/login.html';</script>";
                } else {
                    if ($fila[0] == 1) {
                        echo "<script>alert('Este correo electronico ya esta en uso, prueba con otro.'); window.location.href = '../html/login.html';</script>";
                    } else {
                        $sentenciaU = "INSERT INTO usuaris VALUES ('" . $_POST["usuario"] . "', '" . $_POST["contra1"] . "', 0)";
                        $sentencia = "INSERT INTO clients (Nom, Cognom, Email, Data_naixement, CP, ID_billet, ID_sub, usuari) VALUES ('" . $_POST["nombre"] . "', '" . $_POST["apellido"] . "', '" . $_POST["email"] . "', '" . $_POST["fecha"] . "', '" . $_POST["cp"] . "', NULL, NULL, '" . $_POST["usuario"] . "')";
    
                        $resultU=mysqli_query($enlace, $sentenciaU);
                        $result=mysqli_query($enlace, $sentencia);
                        if (!$result) {
                            echo "<script>alert('No se ha podido crear la cuenta.'); window.location.href = '../html/login.html';</script>";
                        } else {
                            session_start();
                            $_SESSION['username'] = $_POST["usuario"];
                            
                            echo "<script>alert('Cliente creado correctamente. Bienvenido " . $_POST["nombre"] . "'); window.location.href = '../php/cliente_gestionar.php';</script>";
                            header("Location: ../php/cliente_gestionar.php");
                            exit;
                        }
                    }
                }
                mysqli_close($enlace);
            }
        }
    }
?>