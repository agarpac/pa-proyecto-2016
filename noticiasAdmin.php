<?php
session_start();
include './header.php'; 
include_once './conexionBD.php';
include_once './CRUD/CRUDNoticia.php';
if (isset($_SESSION['usuario_logueado']) && $_SESSION['usuario_logueado'] && ($_SESSION['admin'] == 0)) {
?>

<html>
    <head>
        <meta charset="UTF-8">
         <link rel="stylesheet" href="css/estilos.css" type="text/css" />
             
        <title>Social Football</title>
    </head>
    <body>
        <?php
            
            if (isset($_GET['btnCrearNoticia'])) {
                header('location: crearNoticia.php');
            }
            if (isset($_GET['btnModificarNoticia'])) {
               header('location: modificarNoticia.php');
    
            }
            if (isset($_GET['btnEliminarNoticia'])) {                
                if ($_SESSION['id_noticia']){
                    deleteNoticia($_SESSION['id_noticia']);
                    unset($_SESSION['id_noticia']);
            }
                
                
            }
           
        ?>
        <div id="colPrincipal1">
            <p>Selecciona una noticia Columna1 (Listado de titulares de las noticias. Si haces click en una, se muestra en la izda )</p>
            <?php
               
    
                if (isset($_GET['idNoticia'])){
                    readNoticia($_GET['idNoticia']);
                    
                    echo $_SESSION['fecha_noticia']. " ".$_SESSION['titular_noticia'].'<br>' ;

                    echo $_SESSION['texto_noticia'];   
                    $_SESSION['id_noticia'] = $_GET['idNoticia'];
                }else{
                    echo "Prueba a seleccionar una noticia";
                }
                                
                
               
            ?>
        </div>
        <div id="colPrincipal2">
            <p>Columna 2 (Listado de titulares de las noticias. Si haces click en una, se muestra en la izda )</p>
            <form action="noticiasAdmin.php" method="get" >   
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



<?php include './footer.php';
    }else{
        header('location: login.php');
    }
?>
