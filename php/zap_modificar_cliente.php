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
        
        <title>ZAP · Modificar clientes</title>
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
            <h2>Modificar clientes</h2>
            <form method="POST" action="../php/zap_modificar_cliente.php">
                <label>ID del cliente:
                <input type="text" name="Tid" size=50></label> <br>
                <label>Nombre:
                <input type="text" name="Tnombre"></label> <br>   
                <label>Apellido:
                <input type="text" name="Tapellido" size=50></label> <br>
                <label>Email:
                <input type="text" name="Temail" size=50></label> <br>
                <label>Fecha de nacimiento:
                <input type="date" name="Tfecha" size=50></label> <br>
                <label>Codigo postal:
                <input type="text" name="Tcp" size=50></label> <br>
                <label>ID del billete:
                <input type="text" name="Tidbillete" size=50></label> <br>
                <label>ID de la suscripción:
                <input type="text" name="Tidsub" size=50></label> <br>
                <label>Nombre de usuario:
                <input type="text" name="Tusuario" size=50></label> <br>

                <input type="submit" name="Modificar" value="Modificar"> <br>
            </form>
            <div class="cancelar">
                <a href="../html/zap_gestionar.html">Gestionar ZAP</a>
            </div>
            <?php 
                if (isset($_POST["Modificar"])) {
                    if (empty($_POST["Tid"]) or empty($_POST["Tnombre"]) or empty($_POST["Tapellido"]) or empty($_POST["Temail"]) or empty($_POST["Tfecha"]) or empty($_POST["Tcp"]) or empty($_POST["Tidbillete"]) or empty($_POST["Tidsub"]) or empty($_POST["Tusuario"])) {

                        echo "<div class='message error'>Es necesario introducir todos los valores.</div>";

                    } else {

                        //establecer conexion con mysql
                        $servidor = "localhost";
                        $usuario = "root";
                        $password = "";
                        $bd = "zap_rails";

                        //crear conexión
                        $enlace = mysqli_connect($servidor, $usuario, $password, $bd);
                        
                        $sentenciaE = "SELECT count(*) FROM bitllets WHERE ID_billet = '" . $_POST["Tidbillete"] . "'";
                        $sentenciaC = "SELECT count(*) FROM subscripcio WHERE ID_sub = '" . $_POST["Tidsub"] . "'";
                        $sentenciaD = "SELECT count(*) FROM usuaris WHERE usuari = '" . $_POST["Tusuario"] . "'";
                        $sentenciaS = "SELECT count(*) FROM clients WHERE ID_client = '" . $_POST["Tid"] . "'";

                        $resultE = mysqli_query($enlace, $sentenciaE);
                        $resultC = mysqli_query($enlace, $sentenciaC);
                        $resultD = mysqli_query($enlace, $sentenciaD);
                        $resultS = mysqli_query($enlace, $sentenciaS);

                        $filaE = mysqli_fetch_row($resultE);
                        $filaC = mysqli_fetch_row($resultC);
                        $filaD = mysqli_fetch_row($resultD);
                        $fila = mysqli_fetch_row($resultS);

                        //comprobar conexión
                        if (!$enlace) {
                            die("No he podido conectar con el servidor: " . mysqli_connect_error());
                        }   

                        if ($filaE[0] == 0 && $filaC[0] == 0 && $filaD[0] == 0) {
                            echo "<br> Los campos de 'Id del billete', 'Id de la suscripción' e 'Usuario' son incorrectos.";
                        } else {
                            if ($filaE[0] == 0) {
                                echo "<br> El billete no existe en el campo 'Id del billete'.";
                            } else {
                                if ($filaC[0] == 0) {
                                    echo "<br> La suscripción no existe en el campo 'Id de la suscripción'.";
                                } else {
                                    if ($filaD[0] == 0) {
                                        echo "<br> El usuario no existe en el campo 'Nombre de Usuario'.";
                                    } else {
                                        if ($fila[0] == 0) {
                                            echo "<br> El cliente no existe.";
                                        } else {
                                            //se crea la sentencia del registro a eliminar
                                            $sentencia = "UPDATE clients SET Nom = '" . $_POST["Tnombre"] . "', Cognom = '" . $_POST["Tapellido"] . "', Email = '" . $_POST["Temail"] . "', Data_naixement = '" . $_POST["Temail"] . "', CP = '" . $_POST["Tcp"] . "', ID_billet = '" . $_POST["Tidbillete"] . "', ID_sub = '" . $_POST["Tidsub"] . "', usuari = '" . $_POST["Tusuario"] . "'" . " WHERE ID_client = '" . $_POST["Tid"] . "'";

                                            //se ejecuta la sentencia en el sistema gestor
                                            $result=mysqli_query($enlace, $sentencia);
                                            
                                        if (!$result) {
                                            echo "<div class='message error'>El registro no se ha podido modificar </div>";
                                        } else {
                                            echo "<div class='message success'>Los datos del cliente se han modificado correctamente.</div>";
                                        }
                                    }
                                }
                            }
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