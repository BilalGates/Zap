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
        
        <title>ZAP · Eliminar usuarios</title>
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
            <h2>Eliminar usuarios</h2>
            <form method="POST" action="../php/zap_eliminar_usuarios.php">
                <label>Nombre de usuario:
                <input type="text" name="Tid" size=50></label> <br>
                
                <input type="submit" name="Eliminar" value="Eliminar"> <br>
            </form>
            <div class="cancelar">
                <a href="../html/zap_gestionar.html">Gestionar ZAP</a><br><br>
            </div>                
            <?php
                if (isset($_POST["Eliminar"])) {
                    if (empty($_POST["Tid"])) {
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

                        $sentenciaS = "SELECT count(*) FROM usuaris WHERE usuari = '" . $_POST["Tid"] . "'";
                        $resultS = mysqli_query($enlace, $sentenciaS);
                        $fila = mysqli_fetch_row($resultS);
                        
                        if ($fila[0] == 0) {
                            echo "<br> El usuario no existe.";
                        } else {
                            $sentencia = "UPDATE clients SET usuari = null WHERE usuari = '" . $_POST["Tid"] . "'";
                            $sentencia1 = "UPDATE personal SET usuari = null WHERE usuari = '" . $_POST["Tid"] . "'";
                            $sentencia2 = "DELETE FROM usuaris WHERE usuari = '" . $_POST["Tid"] . "'";

                            $result=mysqli_query($enlace, $sentencia);
                            $result1=mysqli_query($enlace, $sentencia1);
                            $result2=mysqli_query($enlace, $sentencia2);
                        if (!$result2) {
                            echo "<div class='message error'>El registro no se ha podido eliminar </div>";
                        } else {
                            echo "<script>alert('Usuario eliminado correctamente.'); window.location.href = '../html/zap_gestionar.html';</script>";
                        
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