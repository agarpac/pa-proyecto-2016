
<html>
    <head>
        <title>Social Football</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="css/estilos.css" />

    </head>
    <body>
        <header id="header">
            <h1><a href="index.html">PA-Equipo-07</a></h1>
            <nav id="nav">
                <ul>
                    <li class="special">
                      <!--  <a href="#menu" class="menuToggle"><span>Menu</span></a>
                        <div id="menu">
                            <ul>-->
                    <li><a href="inicio.php">Inicio</a></li>
                    <li><a href="partidos.php">Partidos</a></li>
                    <li><a href="mensajes.php">Mensajes</a></li>
                    <li><a href="amigos.php">Amigos</a></li><?php
                    if ($_SESSION['admin'] == 0) {
                        ?>
                        <li><a href="noticias.php">Noticias</a></li>
                        <li><a href="equipos.php">Equipos</a></li>
                        <?php
                    }
                    ?>
                    <li><a href="logout.php">Cerrar Sesión</a></li>
                    <!-- </ul>
                 </div>
             </li>-->
                </ul>
            </nav>
        </header>

       <!-- <div id="header">
            <a href="inicio.php">Inicio</a>
            <a href="partidos.php">Partidos</a>
            <a href="mensajes.php">Mensajes</a>
            <a href="amigos.php">Amigos</a>

           
            <a href="logout.php">Cerrar Sesión</a>
        </div> -->

