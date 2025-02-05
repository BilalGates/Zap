<!DOCTYPE html>
<html lang="es">
    <head>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cabin:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
        
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">      
        
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/procesar_reserva.css">
        <link rel="shortcut icon" href="../img/icon.png" />
        
        <title>ZAP · Reservar viajes</title>
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
            if (isset($_POST["busca"])) {
                $origen = $_POST["origen"];
                $destino = $_POST["destino"];
                $num_pasajeros = $_POST["num_pasajeros"];
                $ida_fecha = $_POST["ida_fecha"];
                $hora = $_POST["hora"];
                $fecha_hora = $_POST["ida_fecha"] . " " . $_POST["hora"];

                $servidor = "localhost";
                $user = "root";
                $password = "";
                $bd = "zap_rails";
                
                $enlace = mysqli_connect($servidor, $user, $password, $bd);
                
                if (!$enlace) {
                    die("No he podido conectar con el servidor: " . mysqli_connect_error());
                }

                if (empty($destino) && empty($ida_fecha) && empty($hora)) {

                    echo "<h2>Viajes desde $origen</h2>";

                    $sentencia2 = "SELECT * FROM viatges WHERE origen = ?";
                    $stmt = mysqli_prepare($enlace, $sentencia2);
                    mysqli_stmt_bind_param($stmt, "s", $origen);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);

                } else if (empty($ida_fecha) && empty($hora)) {
                    
                    echo "<h2>Viajes de $origen hacia $destino</h2>";

                    $sentencia2 = "SELECT * FROM viatges WHERE origen = ? AND desti = ?";
                    $stmt = mysqli_prepare($enlace, $sentencia2);
                    mysqli_stmt_bind_param($stmt, "ss", $origen, $destino);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);

                } else if (empty($destino)) {

                    echo "<h2>Viajes desde $origen</h2>";

                    $sentencia2 = "SELECT * FROM viatges WHERE origen = ? AND dia_hora = ?";
                    $stmt = mysqli_prepare($enlace, $sentencia2);
                    mysqli_stmt_bind_param($stmt, "ss", $origen, $fecha_hora);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);

                } else {

                    echo "<h2>Viajes de $origen hacia $destino</h2>";

                    $sentencia2 = "SELECT * FROM viatges WHERE origen = ? AND desti = ? AND dia_hora = ?";
                    $stmt = mysqli_prepare($enlace, $sentencia2);
                    mysqli_stmt_bind_param($stmt, "sss", $origen, $destino, $fecha_hora);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);

                }

                if (mysqli_num_rows($result) > 0) {
                    echo "<div class='tickets-container'>";
                    while ($fila = mysqli_fetch_assoc($result)) {
                        echo "<div class='ticket'>";
                        echo "<h3 class='ticket-title'>De " . $fila['Origen'] . " a " . $fila['Desti'] . "</h3>";
                        echo "<p><strong>ID del viaje:</strong> " . $fila['ID_viatge'] . "</p>";
                        echo "<p><strong>Tren:</strong> " . $fila['Tren'] . "</p>";
                        echo "<p><strong>Origen:</strong> " . $fila['Origen'] . "</p>";
                        echo "<p><strong>Destino:</strong> " . $fila['Desti'] . "</p>";
                        echo "<p><strong>Día y hora:</strong> " . $fila['Dia_hora'] . "</p>";
                        echo "<a href='../php/ejecutar_reserva.php?ID_viatge=" . $fila['ID_viatge'] . "&num_pasajeros=" . $_POST["num_pasajeros"] . "&Dia_hora=" . $fila['Dia_hora'] . "' class='reservar-btn'>¡Reservar ahora!</a>";
                        echo "</div>";
                    }
                    echo "</div>";
                } else {
                    echo "<p>No hay viajes disponibles, sigue buscando <a href='../html/index.html'>aquí</a>.</p>";
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
    <script src="../scripts/script.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="../scripts/carousel.js"></script>
    <script src="../scripts/copiar.js"></script>
</html>