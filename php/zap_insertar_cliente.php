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
        
        <title>ZAP · Insertar clientes</title>
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
            <h2>Insertar clientes</h2>
            <form method="POST" action="../php/zap_insertar_cliente.php">
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
                <input type="text" name="Tidsub" size=50></label> <br><br>
                <label>Nombre de usuario:
                <input type="text" name="Tusuario" size=50></label> <br>
                <label>Contraseña:
                <input type="password" name="Tcontrasenya1" size=50></label> <br>
                <label>Repite la contraseña:
                <input type="password" name="Tcontrasenya2" size=50></label> <br>

                <input type="submit" name="Insertar" value="Insertar"> <br>
            </form>
            <div class="cancelar">
                <a href="../html/zap_gestionar.html">Gestionar ZAP</a>
            </div>
            <?php 
                if (isset($_POST["Insertar"])) {
                    if (empty($_POST["Tnombre"]) or empty($_POST["Tapellido"]) or empty($_POST["Temail"]) or empty($_POST["Tfecha"]) or empty($_POST["Tcp"]) or empty($_POST["Tusuario"]) or empty($_POST["Tcontrasenya1"]) or empty($_POST["Tcontrasenya2"])) {

                        echo "<div class='message error'>Es necesario introducir todos los valores.</div>";

                    } else {

                        if ($_POST["Tcontrasenya1"] != $_POST["Tcontrasenya2"]) {

                            echo "<div class='message error'>La contraseña no coincide.</div>";

                        } else {
                            //establecer conexion con mysql
                            $servidor = "localhost";
                            $usuario = "root";
                            $password = "";
                            $bd = "zap_rails";

                            //crear conexión
                            $enlace = mysqli_connect($servidor, $usuario, $password, $bd);
                            
                            $sentenciaS = "SELECT count(*) FROM clients WHERE email = '" . $_POST["Temail"] . "'";

                            $resultS = mysqli_query($enlace, $sentenciaS);
                            $fila = mysqli_fetch_row($resultS);

                            //comprobar conexión
                            if (!$enlace) {
                                die("No he podido conectar con el servidor: " . mysqli_connect_error());
                            }   

                            if ($fila[0] == 1) {
                                echo "<br> Este correo electronico ya esta en uso, prueba con otro.";
                            } else {
                                $idbillete = !empty($_POST["Tidbillete"]) ? "'" . $_POST["Tidbillete"] . "'" : "NULL";
                                $idsub = !empty($_POST["Tidsub"]) ? "'" . $_POST["Tidsub"] . "'" : "NULL";
                                
                                //se crea la sentencia del registro a eliminar
                                $sentenciaU = "INSERT INTO usuaris VALUES ('" . $_POST["Tusuario"] . "', '" . $_POST["Tcontrasenya1"] . "', 0)";
                                $sentencia = "INSERT INTO clients (Nom, Cognom, Email, Data_naixement, CP, ID_billet, ID_sub, usuari) VALUES ('" . $_POST["Tnombre"] . "', '" . $_POST["Tapellido"] . "', '" . $_POST["Temail"] . "', '" . $_POST["Tfecha"] . "', '" . $_POST["Tcp"] . "', " . $idbillete . ", " . $idsub . ", '" . $_POST["Tusuario"] . "')";

                                //se ejecuta la sentencia en el sistema gestor
                                $resultU=mysqli_query($enlace, $sentenciaU);
                                $result=mysqli_query($enlace, $sentencia);
                            if (!$result) {
                                echo "<div class='message error'>El registro no se ha podido insertar. </div>";
                            } else {
                                echo "<div class='message success'Cliente agregado correctamente.</div>";
                            }

                            //cerrar conexión
                            mysqli_close($enlace);
                        }
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