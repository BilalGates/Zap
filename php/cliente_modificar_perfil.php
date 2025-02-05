<!DOCTYPE html>
<html lang="es">
    <head>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cabin:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Jost:wght@200&family=Kanit:wght@200&family=Sulphur+Point:wght@700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
        
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">      
        
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/php.css">
        <link rel="stylesheet" href="../css/cliente_modificar.css">
        <link rel="shortcut icon" href="../img/icon.png" />
        
        <title>ZAP · Modifica tu perfil</title>
    </head>
    <body>

        <header>
            <div class="contenedor">
                <div class="columna"><a href="../html/servicios.html" id="nave">SERVICIOS</a></div>
                <div class="columna"><a href="../html/destinos.html" id="nave">DESTINOS</a></div>
                <div class="columna">
                    <a href="../html/index.html">
                        <img src="../img/logo3.png" alt="Logo de Zap" id="logo">
                    </a>
                </div>
                <div class="columna"><a href="../html/suscribe.html" id="nave">SUSCRIBETE</a></div>
                <div class="columna"><a href="../html/login.html" id="nave">INICIAR SESIÓN</a></div>
            </div> 
        </header>

        <?php
            $servidor = "localhost";
            $user = "root";
            $password = "";
            $bd = "zap_rails";

            $enlace = mysqli_connect($servidor, $user, $password, $bd);

            if (!$enlace) {
                die("No he podido conectar con el servidor: " . mysqli_connect_error());
            }

            session_start();

            if (!isset($_SESSION["username"])) {
                header("Location: ../html/login.html");
                exit();
            }

            // Consultas tabla clients
            $consulta = "SELECT id_client, nom, cognom, email, data_naixement, cp, id_sub, id_billet FROM clients WHERE usuari = ?";
            $usuario = $_SESSION["username"];

            $stmt = mysqli_prepare($enlace, $consulta);
            mysqli_stmt_bind_param($stmt, "s", $usuario);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $id_client, $nombre, $apellidos, $email, $fecha, $cp, $id_sub, $id_billet);
            mysqli_stmt_fetch($stmt);
            mysqli_stmt_close($stmt);
            
            mysqli_close($enlace);
        ?>

        <div class="form">
            <h2>Modifica tu perfil</h2>
            <form method="POST" action="../php/cliente_modificar_perfil.php">
            <?php
                echo "<label>Nombre:";
                echo "<input type='text' name='Tnombre' value=$nombre></label> <br>";   
                echo "<label>Apellido:";
                echo "<input type='text' name='Tapellido' value=$apellidos></label> <br>";
                echo "<label>Email:";
                echo "<input type='text' name='Temail' value=$email></label> <br>";
                echo "<label>Fecha de nacimiento:";
                echo "<input type='date' name='Tfecha' value=$fecha></label> <br>";
                echo "<label>Codigo postal:";
                echo "<input type='text' name='Tcp' value=$cp></label> <br>";
                //echo "<label>Nombre de usuario:";
                //echo "<input type='text' name='Tusuario' value=$usuario></label> <br>";
                echo "<input type='submit' name='ModificarC' value='Modificar'>";
            ?>
            </form>
            <div class="cancelar">
                <a href="../php/cliente_gestionar.php">Volver al perfil</a><br><br>
            </div>
            <?php 
                if (isset($_POST["ModificarC"])) {
                    if (empty($_POST["Tnombre"]) or empty($_POST["Tapellido"]) or empty($_POST["Temail"]) or empty($_POST["Tfecha"]) or empty($_POST["Tcp"])) {

                        echo "<div class='message error'>Es necesario introducir todos los valores.</div>";

                    } else {
                        $servidor = "localhost";
                        $usuario = "root";
                        $password = "";
                        $bd = "zap_rails";

                        $enlace = mysqli_connect($servidor, $usuario, $password, $bd);
                        
                        $sentenciaS = "SELECT count(*) FROM clients WHERE ID_client = '$id_client'";
                        $resultS = mysqli_query($enlace, $sentenciaS);
                        $fila = mysqli_fetch_row($resultS);

                        if (!$enlace) {
                            die("No he podido conectar con el servidor: " . mysqli_connect_error());
                        }   

                        if ($fila[0] == 0) {
                            echo "<br> El cliente no existe.";
                        } else {
                            $sentencia = "UPDATE clients SET Nom = '" . $_POST["Tnombre"] . "', Cognom = '" . $_POST["Tapellido"] . "', Email = '" . $_POST["Temail"] . "', Data_naixement = '" . $_POST["Tfecha"] . "', CP = '" . $_POST["Tcp"] . "' WHERE ID_client = " . $id_client;
                            $result=mysqli_query($enlace, $sentencia);
                            
                        if (!$result) {
                            echo "<div class='message error'>El registro no se ha podido modificar </div>";
                        } else {
                            echo "<script>alert('Perfil modificado correctament'); window.location.href = '../php/cliente_gestionar.php';</script>";
                        }

                        mysqli_close($enlace);
                    }
                    }
                }
            ?>
        </div>

        <footer>
            <div class="contenedor">
                <div class="columna">
                    <img src="../img/logo3.png" alt="old logo" id="logo">
                </div>
                <div class="columna">
                    <a href="../html/privacidad.html">Aviso Legal y Política de Privacidad</a><br>
                    <a href="#terminos">Términos y Condiciones</a><br>
                    <a href="#terminos">Política de Cookies</a><br>
                </div>
                <div class="columna">
                    <p>
                        <a href="../html/contacto.html">Contactanos</a>
                    </p>
                    <p>
                        <a href="https://sites.google.com/bemen3.cat/ipopmorentemarc?usp=sharing">Marc Morente López</a><br>
                        <u><a class="texto-editable" contenteditable="false" onclick="seleccionarTexto()">mamolo22@bemen3.cat</a></u>                          
                    </p>
                    <p>
                        <a href="https://sites.google.com/bemen3.cat/ipopelarbibilal?usp=sharing">Bilal el Arbi Ouriach</a><br>
                        <u><a class="texto-editable" contenteditable="false" onclick="seleccionarTexto()">bielou22@bemen3.cat</a></u>
                    </p>
                </div>
            </div>
            <div class="contenedor">
                <div class="columna">
                    <a href="https://maps.app.goo.gl/SA1Z652ZtnRfmTXx7">Av. Diagonal, 403, 08008 Barcelona</a>
                </div>
            </div>
            <br>
            © Zap Rails Corporation 2022 - 2024
        </footer>
    </body>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="../scripts/script.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="../scripts/carousel.js"></script>
    <script src="../scripts/copiar.js"></script>
</html>