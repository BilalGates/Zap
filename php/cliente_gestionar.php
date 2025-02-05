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
        <link rel="stylesheet" href="../css/cliente_gestionar.css">
        <link rel="shortcut icon" href="../img/icon.png" />
        
        <title>ZAP · Tu perfil</title>
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
            
            // Consultas tabla bitllets
            $billetes_query ="SELECT id_billet, tipus, dia, estat FROM bitllets WHERE id_billet = ?";
            $stmt_billetes = mysqli_prepare($enlace, $billetes_query);
            mysqli_stmt_bind_param($stmt_billetes, "i", $id_billet);
            mysqli_stmt_execute($stmt_billetes);
            mysqli_stmt_bind_result($stmt_billetes, $id_billet, $tipus, $dia, $estat);
            mysqli_stmt_fetch($stmt_billetes);
            mysqli_stmt_close($stmt_billetes);

            // Consultas tabla subscripcio
            $suscripcion_query ="SELECT pla, preu FROM subscripcio WHERE id_sub = ?";
            $stmt_suscripcion = mysqli_prepare($enlace, $suscripcion_query);
            mysqli_stmt_bind_param($stmt_suscripcion, "i", $id_sub);
            mysqli_stmt_execute($stmt_suscripcion);
            mysqli_stmt_bind_result($stmt_suscripcion, $pla, $preu);
            mysqli_stmt_fetch($stmt_suscripcion);
            mysqli_stmt_close($stmt_suscripcion);
            
            mysqli_close($enlace);
        ?>

        <div class="contenedor">
        <div class="perfil">
            <h2>Mi perfil</h2>
            <?php
                echo "<p><strong>Nombre:</strong> " . $nombre . "</p>";
                echo "<p><strong>Apellidos:</strong> " . $apellidos . "</p>";
                echo "<p><strong>Correo electrónico:</strong> " . $email . "</p>";
                echo "<p><strong>Fecha de nacimiento:</strong> " . $fecha . "</p>";
                echo "<p><strong>Código postal:</strong> " . $cp . "</p>";
                echo "<a class='modificar-perfil' href='../php/cliente_modificar_perfil.php'>Modificar perfil</a>";
            ?>
        </div>

        <div class="billetes">
            <h2>Mis billetes</h2>
            <?php
                $enlace = mysqli_connect($servidor, $user, $password, $bd);

                if (!$enlace) {
                    die("No he podido conectar con el servidor: " . mysqli_connect_error());
                }
                
                $sentenciaP = "SELECT count(*) FROM bitllets WHERE id_billet = '$id_billet'";
                $resultP = mysqli_query($enlace, $sentenciaP);
                $filaP = mysqli_fetch_row($resultP);
                
                if ($filaP[0] == 0) {
                    echo '<ul class="lista-billetes">';
                    echo '<li class="billete">';
                    echo '<div class="info-billete">';
                    echo "No tienes billetes";
                    echo '</li>';                    
                    echo '</ul>';
                } else {
                    echo '<ul class="lista-billetes">';
                    echo '<li class="billete">';
                    echo '<div class="info-billete">';
                    echo "<p class='numero-billete'><strong>Billete:</strong> $id_billet <br></p>";
                    echo "<p class='tipo-billete'><strong>Tipo:</strong> $tipus <br></p>";
                    echo "<p class='dia-billete'><strong>Día:</strong> $dia <br></p>";
                    echo "<p class='estado-billete'><strong>Estado:</strong> $estat</p>";
                    echo '</div>';
                    echo "<a class='eliminar-billete' data-id='$id_billet'>Cancelar viaje</a>";
                    echo '</li>';                    
                    echo '</ul>';
                    //echo "<li>Billete #$id_billet <br> Tipo: $tipus<br> Día: $dia<br> Estado<br> $estat <br><a class='eliminar-billete' data-id='$id_billet'>Cancelar viaje</a></li>";
                }

                mysqli_close($enlace);
            ?>
        </div>

        <?php
            if (isset($_GET['eliminar_billete'])) {
                $id_billet = $_GET['eliminar_billete'];

                $enlace = mysqli_connect($servidor, $user, $password, $bd);

                if (!$enlace) {
                    die("No he podido conectar con el servidor: " . mysqli_connect_error());
                }
                
                $sentencia = "UPDATE clients SET id_billet = null WHERE id_client = '$id_client'";
                $result = mysqli_query($enlace, $sentencia);

                if ($result) {
                    $sentencia0 = "DELETE FROM bitllets WHERE id_billet = '$id_billet'";
                    $resultado = mysqli_query($enlace, $sentencia0);
                                
                    echo "<script>alert('Billete eliminado correctamente'); window.location.href = '../php/cliente_gestionar.php';</script>";
                    exit();
                } else {
                    http_response_code(500);
                    echo "Error al eliminar el billete";
                }

                mysqli_close($enlace);
            }
        ?>

        <div class="plan">
            <h2>Mi plan</h2>
            <?php
                $enlace = mysqli_connect($servidor, $user, $password, $bd);

                if (!$enlace) {
                    die("No he podido conectar con el servidor: " . mysqli_connect_error());
                }

                $sentenciaP = "SELECT count(*) FROM subscripcio WHERE id_sub = '$id_sub'";
                $resultP = mysqli_query($enlace, $sentenciaP);
                $filaP = mysqli_fetch_row($resultP);
                
                if ($filaP[0] == 0) {
                    echo '<ul class="lista-billetes">';
                    echo '<li class="billete">';
                    echo '<div class="info-billete">';
                    echo "No estas suscrito en algun plan";
                    echo '</li>';                    
                    echo '</ul>';
                } else {
                    $sentenciae = "SELECT pla, preu FROM subscripcio WHERE id_sub = '$id_sub'";
                    $resulte = mysqli_query($enlace, $sentenciae);
                    $filae = mysqli_fetch_assoc($resulte);
                    echo '<ul class="lista-billetes">';
                    echo '<li class="billete">';
                    echo '<div class="info-billete">';
                    echo "<p><strong>Plan:</strong> " . $filae['pla'] . "<br></p>";
                    echo "<p><strong>Precio:</strong> " . $filae['preu'] . "<br></p>";
                    echo '</div>';
                    echo "<a class='cancelar-plan' data-id='$id_sub'>Cancelar plan</a>";
                    echo '</li>';                    
                    echo '</ul>';
                }

                mysqli_close($enlace);
            ?>
        </div>

        <?php
            if (isset($_GET['cancelar_plan'])) {
                $id_sub = $_GET['cancelar_plan'];

                $enlace = mysqli_connect($servidor, $user, $password, $bd);

                if (!$enlace) {
                    die("No he podido conectar con el servidor: " . mysqli_connect_error());
                }
                
                $sentencia2 = "UPDATE clients SET id_sub = null WHERE id_sub = ?";
                $stmt = mysqli_prepare($enlace, $sentencia2);
                mysqli_stmt_bind_param($stmt, "i", $id_sub);
                $result2 = mysqli_stmt_execute($stmt);

                if ($result2) {
                    echo "<script>alert('Plan cancelado correctamente'); window.location.href = '../php/cliente_gestionar.php';</script>";
                    exit();
                } else {
                    echo "<script>alert('Error al cancelar el plan'); window.location.href = '../php/cliente_gestionar.php';</script>";
                }

                mysqli_close($enlace);
            }
        ?>
        </div>

        <div class="cuenta">
            <?php
                echo "<a class='eliminar-cliente' data-id='$id_client'>Eliminar cuenta</a><br><br>";
            ?>
        </div>

        <?php
            if (isset($_GET['eliminar_cliente'])) {
                $id_client = $_GET['eliminar_cliente'];

                $enlace = mysqli_connect($servidor, $user, $password, $bd);

                if (!$enlace) {
                    die("No he podido conectar con el servidor: " . mysqli_connect_error());
                }
                
                $sentenciat = "SELECT count(*) FROM usuaris WHERE usuari = '$usuario'";
                $resultt = mysqli_query($enlace, $sentenciat);
                $fila2 = mysqli_fetch_row($resultt);
                
                $sentenciaY = "SELECT count(*) FROM clients WHERE id_client = '$id_client'";
                $resultS = mysqli_query($enlace, $sentenciaY);
                $fila = mysqli_fetch_row($resultS);
                
                if ($fila[0] == 1 && $fila2[0] == 1) {
                    $sentencia3 = "DELETE FROM usuaris WHERE usuari = '$usuario'";
                    $sentencia0 = "DELETE FROM clients WHERE id_client = '$id_client'";
                    $result2 = mysqli_query($enlace, $sentencia0);
                    $result3 = mysqli_query($enlace, $sentencia3);
                    
                    if (!$result2 && !$result3) {
                        http_response_code(500);
                        echo "Error al eliminar la cuenta: " . mysqli_error($enlace);
                    } else {
                        echo "<script>alert('Cuenta eliminada correctamente'); window.location.href = '../html/index.html';</script>";
                    exit();
                    }
                } else {
                    echo "<script>alert('El cliente no se puede eliminar'); window.location.href = '../php/cliente_gestionar.php';</script>";
                }

                mysqli_close($enlace);
            }
        ?>

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
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="../scripts/carousel.js"></script>
    <script src="../scripts/copiar.js"></script>
    <script src="../scripts/eliminar_billete.js"></script>
    <script src="../scripts/cancelar_plan.js"></script>
    <script src="../scripts/eliminar_cliente.js"></script>
</html>