<?php
session_start();
include './header.php';
include_once './conexionBD.php';

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
            <?php
                $con = conectaBD();
    
                if (!isset($_GET['idNoticia'])){
                    $sqlQuery = "SELECT * FROM noticia WHERE id_equipo= ".$_SESSION['equipoUser']." ORDER BY id_noticia DESC";
                    $result = mysqli_query($con, $sqlQuery);

                    //No hago bucle porque solo quiero mnostrar la última noticia
                    $col = mysqli_fetch_array($result);
                    echo $col['fecha_noticia']. " ".$col['titular_noticia'].'<br>' ;

                    echo $col['texto_noticia'];    
                }else{
                    $sqlQuery = "SELECT * FROM noticia WHERE id_noticia=" .$_GET['idNoticia'];
                    $result = mysqli_query($con, $sqlQuery);

                    //No hago bucle porque solo quiero mnostrar la última noticia
                    $col = mysqli_fetch_array($result);
                    echo $col['fecha_noticia']. " ".$col['titular_noticia'].'<br>' ;

                    echo $col['texto_noticia'];   
                }
                                
                
                mysqli_close($con);
            ?>
        </div>
        <div id="colPrincipal2">
            <p>Columna 2 (Listado de titulares de las noticias del equipo seguidor. Si haces click en una, se muestra en la izda )</p>
            <?php
            $con = conectaBD();
    
                $sqlQuery = "SELECT titular_noticia, id_noticia FROM noticia WHERE id_equipo= ".$_SESSION['equipoUser']." ORDER BY id_noticia DESC";
                $result = mysqli_query($con, $sqlQuery);
                
                //Muestro todos los titulares en forma de enlace. 
                while ($col = mysqli_fetch_array($result)){
                     
                     echo "<a href='?idNoticia=".$col['id_noticia']."'>".$col['titular_noticia']."</a>";
                }
                                
                
                mysqli_close($con);
             ?>
        </div>
    </body>
</html>



<?php include './footer.php';?>
