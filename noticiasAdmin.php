<?php
session_start();
include './header.php'; 
include_once './conexionBD.php';
print_r($_GET);
?>

<html>
    <head>
        <meta charset="UTF-8">
         <link rel="stylesheet" href="css/estilos.css" type="text/css" />
             
        <title>Social Football</title>
    </head>
    <body>
        <?php
            $con = conectaBD();
            if (isset($_POST['btnCrearNoticia'])) {
                header('location: crearNoticia.php');
            }
            if (isset($_POST['btnModificarNoticia'])) {
                 if (isset($_GET['idNoticia'])){
                       $_SESSION['idNoticia'] = $_GET['idNoticia'];             
                }else{
                    
                    $sqlQuery = "SELECT id_noticia FROM noticia ORDER BY id_noticia DESC";
                    $result = mysqli_query($con, $sqlQuery);

                    //No hago bucle porque solo quiero mnostrar la última noticia
                    $col = mysqli_fetch_array($result);
                    
                    $_SESSION['idNoticia'] = $col['id_noticia'];    
                }
                header('location: modificarNoticia.php');
            }
            if (isset($_POST['btnEliminarNoticia'])) {
                if (!isset($_GET['idNoticia'])){
                    $sqlQuery = "SELECT id_noticia FROM noticia ORDER BY id_noticia DESC";
                    $result = mysqli_query($con, $sqlQuery);

                    //No hago bucle porque solo quiero mnostrar la última noticia
                    $col = mysqli_fetch_array($result);
                    
                    $idNoticia = $col['id_noticia'];                    
                }else{
                    $idNoticia = $_GET['idNoticia'];
                }
                
                $sqlQuery = "DELETE FROM noticia WHERE id_noticia=".$idNoticia;
                $result = mysqli_query($con, $sqlQuery);
            }
            mysqli_close($con);
        ?>
        <div id="colPrincipal1">
            <p>Columna 1 (Por defecto se ve la ultima noticia publicada )</p>
            <?php
                $con = conectaBD();
    
                if (!isset($_GET['idNoticia'])){
                    $sqlQuery = "SELECT * FROM noticia ORDER BY id_noticia DESC";
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
            <p>Columna 2 (Listado de titulares de las noticias. Si haces click en una, se muestra en la izda )</p>
            <?php
            $con = conectaBD();
    
                $sqlQuery = "SELECT titular_noticia, id_noticia FROM noticia  ORDER BY id_noticia DESC";
                $result = mysqli_query($con, $sqlQuery);
                
                //Muestro todos los titulares en forma de enlace. 
                while ($col = mysqli_fetch_array($result)){                     
                     echo "<a href='?idNoticia=".$col['id_noticia']."'>".$col['titular_noticia']."</a><br/>";
                }
                mysqli_close($con);
             ?>
        </div>
        <form action="noticiasAdmin.php" method="get" >      
            <ul>
                <li>
                    <input type="submit" class="buttonSpecial" name="btnCrearNoticia" value="Crear"/>
                    <input type="submit" class="buttonSpecial" name="btnModificarNoticia" value="Modificar"/> 
                    <input type="submit" class="buttonSpecial" name="btnEliminarNoticia" value="Eliminar"/> 
                </li>
            </ul>
        </form>           
    </body>
</html>



<?php include './footer.php';?>
