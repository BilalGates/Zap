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
        <link rel="stylesheet" href="../css/zap_modificar.css">
        <link rel="shortcut icon" href="../img/icon.png" />
        
        <title>ZAP · Insertar suscripciones</title>
    </head>
    <body>

        <header>
            <div class="contenedor">
                <div class="columna"><a href="#servicios" id="nave">SERVICIOS</a></div>
                <div class="columna"><a href="#destinos" id="nave">DESTINOS</a></div>
                <div class="columna">
                    <a href="../html/index.html">
                        <img src="../img/logo3.png" alt="Logo de Zap" id="logo">
                    </a>
                </div>
                <div class="columna"><a href="../html/suscribe.html" id="nave">SUSCRIBETE</a></div>
                <div class="columna"><a href="../html/login.html" id="nave">INICIAR SESIÓN</a></div>
            </div> 
        </header>
        <div class="form">
            <h2>Insertar suscripciones:</h2>
            <form method="POST" action="../php/zap_insertar_suscripciones.php">
                <label>ID de la suscripción:
                <input type="text" name="Tid" size=50></label> <br>
                <label>Plan:
                <input type="text" name="Tplan"></label> <br>   
                <label>Precio:
                <input type="text" name="Tprecio" size=50></label> <br>
                <label>Cuenta:
                <input type="text" name="Tcuenta" size=50></label> <br>

                <input type="submit" name="Insertar" value="Insertar"> <br>
            </form>
            <div class="cancelar">
                <a href="../html/zap_gestionar.html">Gestionar ZAP</a>
            </div>
            <?php 
                if (isset($_POST["Insertar"])) {
                    if (empty($_POST["Tid"]) or empty($_POST["Tplan"]) or empty($_POST["Tprecio"]) or empty($_POST["Tcuenta"])) {

                        echo "<div class='message error'>Es necesario introducir todos los valores.</div>";

                    } else {

                        //establecer conexion con mysql
                        $servidor = "localhost";
                        $usuario = "root";
                        $password = "";
                        $bd = "zap_rails";

                        //crear conexión
                        $enlace = mysqli_connect($servidor, $usuario, $password, $bd);
                        
                        $sentenciaS = "SELECT count(*) FROM subscripcio WHERE ID_sub = '" . $_POST["Tid"] . "'";

                        $resultS = mysqli_query($enlace, $sentenciaS);
                        $fila = mysqli_fetch_row($resultS);

                        //comprobar conexión
                        if (!$enlace) {
                            die("No he podido conectar con el servidor: " . mysqli_connect_error());
                        }   

                        if ($fila[0] == 1) {
                            echo "<br> La suscripción ya existe.";
                        } else {
                            //se crea la sentencia del registro a eliminar
                            $sentencia = "INSERT INTO subscripcio VALUES ('" . $_POST["Tplan"] . "', Preu = '" . $_POST["Tprecio"] . "', Compte = '" . $_POST["Tcuenta"] . "')";

                            //se ejecuta la sentencia en el sistema gestor
                            $result=mysqli_query($enlace, $sentencia);
                        if (!$result) {
                            echo "<div class='message error'>El registro no se ha podido modificar </div>";
                        } else {
                            echo "<div class='message success'>Los datos de la suscripción  se han modificado correctamente.</div>";
                        }

                        //cerrar conexión
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