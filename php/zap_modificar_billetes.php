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
        
        <title>ZAP · Modificar viajes</title>
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
            <h2>Modificar billetes</h2>
            <form method="POST" action="../php/zap_modificar_billetes.php">
                <label>ID del billete:
                <input type="text" name="id"></label> <br> 
                <label>Tipus:
                <input type="text" name="tipus"></label> <br>   
                <label>Dia:
                <input type="date" name="dia"></label> <br>
                <label>Estat:
                <input type="text" name="estat"></label> <br>
                <label>Viatgers:
                <input type="number" name="viatgers"></label> <br>
                <label>ID_viatge:
                <input type="text" name="viatge"></label> <br>

                <input type="submit" name="modificar" value="modificar"> <br>
            </form>
            
            <div class="cancelar">
                <a href="../html/zap_gestionar.html">Gestionar ZAP</a>
            </div>
            
            <?php 
                if (isset($_POST["modificar"])) {
                    if (empty($_POST["id"]) or empty($_POST["tipus"]) or empty($_POST["dia"]) or empty($_POST["estat"]) or empty($_POST["viatgers"]) or empty($_POST["viatge"])) {
                        echo "<div class='message error'>Es necesario introducir todos los valores.</div>";
                    } else {
                        $servidor = "localhost";
                        $usuario = "root";
                        $password = "";
                        $bd = "zap_rails";

                        $enlace = mysqli_connect($servidor, $usuario, $password, $bd);

                        if (!$enlace) {
                            die("No he podido conectar con el servidor: " . mysqli_connect_error());
                        }
                        
                        $sentencia = "SELECT count(*) FROM bitllets WHERE id_billet = '" . $_POST["id"] . "'";
                        $result = mysqli_query($enlace, $sentencia);
                        $fila = mysqli_fetch_row($result);  

                        $sentenciaS = "SELECT count(*) FROM viatges WHERE id_viatge = '" . $_POST["viatge"] . "'";
                        $resultS = mysqli_query($enlace, $sentenciaS);
                        $filas = mysqli_fetch_row($resultS);  

                        if ($filas[0] == 1) {
                            if ($filas[0] == 1) {
                                $sentenciac = "UPDATE bitllets SET Tipus = '" . $_POST['tipus'] . "', Dia = '" . $_POST['dia'] . "', Estat = '" . $_POST['estat'] . "', Viatgers = '" . $_POST['viatgers'] . "', ID_viatge = '" . $_POST['viatge'] . "' WHERE id_billet = '" . $_POST['id'] . "'";
                                $result=mysqli_query($enlace, $sentenciac);
                                if (!$result) {
                                    echo "<div class='message error'>El registro no se ha podido insertar.</div>";
                                } else {
                                    echo "<div class='message success'>Billete modificado correctamente.</div>";
                                }
                            } else {
                                echo "<br> El viaje no existe.";                            
                            }
                        } else {
                            echo "<br> El billete no existe.";  
                        }
                        
                        mysqli_close($enlace);
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