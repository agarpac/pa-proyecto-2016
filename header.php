
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
                      
                    <a href="inicio.php">Inicio</a>
                    <a href="partidos.php">Partidos</a>
                    <a href="mensajes.php">Mensajes</a>
                    <a href="amigos.php">Amigos</a>
                    <?php
                    if ($_SESSION['admin'] == 0) {
                        ?>
                    <a href="noticiasAdmin.php">Noticias</a>
                    <a href="equipos.php">Equipos</a>
                        <?php
                    }
                    ?>
                    <a href="logout.php">Cerrar Sesión</a>
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

