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
        <link rel="stylesheet" href="../css/zap_consultar.css">
        <link rel="shortcut icon" href="../img/icon.png" />
        
        <title>ZAP · Consultar suscripciones</title>
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
        <div class="table">
            <h2>Consultar suscripciones</h2>
            <form method="POST" action="../php/zap_consultar_suscripciones.php">
            </form>
            <div class="cancelar">
                <a href="../html/zap_gestionar.html">Gestionar ZAP</a>
            </div>
            <?php
                //establecer conexion con mysql
                $servidor = "localhost";
                $usuario = "root";
                $password = "";
                $bd = "zap_rails";

                //crear conexión
                $enlace = mysqli_connect($servidor, $usuario, $password, $bd);
                
                //comprobar conexión
                if (!$enlace) {
                    die("No he podido conectar con el servidor: " . mysqli_connect_error());
                }
                
                //se crea la sentencia de la sentencia
                $sentencia= "SELECT * FROM subscripcio";
                
                //se ejecuta la sentencia en el sistema gestor
                $result=mysqli_query($enlace, $sentencia);
                
                // se visualiza la cabecera de la tabla con el nombre de los atributos
                $grado = mysqli_num_fields($result);
                echo "<table border=1> <tr>";
                for ($x = 0; $x < $grado; $x++) {
                    $atributo = mysqli_fetch_field($result);
                    echo "<td><strong>$atributo->name</strong></td>";
                }
                echo "</tr>"; // Cerramos la fila de encabezado
                
                //se visualizan los registros en forma de tabla
                $cardinalidad = mysqli_num_rows($result);
                while ($cardinalidad!=0) {
                $fila = mysqli_fetch_row($result);
                echo "<tr>";
                for ($x = 0; $x < $grado; $x++) {
                echo "<td>";
                echo "$fila[$x]"." ";
                echo "</td>";
                }
                echo "</tr>";
                $cardinalidad--;
                }
                echo "</table>";

                //cerrar conexión
                mysqli_close($enlace);
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