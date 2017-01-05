<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Social Football</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="css/estilos.css" />

    </head>
    <body>
        <header id="header">
            <h1>Social Football</h1>
            <nav>
                <ul>
                    <?php
                    if (!isset($_SESSION['id_usuario_login'])) { //no logueado
                        ?>
                    <li><a href="login.php">Iniciar sesi&oacute;n</a></li>
                    <li><a href="registro.php">Reg&iacute;strate</a></li>
                    <?php } else { // usuario logueado
                        ?>
                        <li><a href="inicio.php">Inicio</a></li>
                        <li><a href="partidos.php">Partidos</a></li>
                        <li><a href="mensajes.php">Mensajes</a></li>
                        <li><a href="amigos.php">Amigos</a></li>
                        <?php
                        if ($_SESSION['admin'] == 0) {
                            ?>
                            <li><a href="noticias.php" class="admin">Noticias</a></li>
                            <li><a href="equipos.php" class="admin">Equipos</a></li>
                                <?php
                            }
                            ?>
                        <li><a href="logout.php">Cerrar Sesión</a></li>
                        <?php
                    }
                    ?>
                </ul>
            </nav>
        </header>