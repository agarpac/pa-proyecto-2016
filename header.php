
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div id="header">
            <a href="inicio.php">Inicio</a>
            <a href="partidos.php">Partidos</a>
            <a href="mensajes.php">Mensajes</a>
            <a href="amigos.php">Amigos</a>
            <?php
                if ($_SESSION['admin']==0){
                    ?>
                    <a href="noticias.php">Noticias</a>
                    <a href="equipos.php">Equipos</a>
                    <?php
                }
            ?>
        </div>
    </body>
</html>
