<?php
session_start();
include './header.php';

echo '<h1>Bienvenido  ' . $_SESSION['nombreUserLogin'] . ' ' . $_SESSION['apellido1UserLogin'] . ' ' . $_SESSION['apellido2UserLogin'] . '</h1>';
?>

<html>
    <head>
        <meta charset="UTF-8">
         <link rel="stylesheet" href="css/estilos.css" type="text/css" />
        <title>Social Football</title>
    </head>
    <body>
        
        <div id="colPrincipal1">
            <p>Columna 1 (Por defecto se ve la ultima noticia publica sobre el equipo el cual el user es seguidor )</p>
            
        </div>
        <div id="colPrincipal2">
            <p>Columna 2 (Listado de titulares de las noticias del equipo seguidor. Si haces click en una, se muestra en la izda )</p>
            
        </div>
    </body>
</html>



<?php include './footer.php';?>
