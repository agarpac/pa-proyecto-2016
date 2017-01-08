<?php
include './header.php';
include_once './conexionBD.php';
if (isset($_SESSION['usuario_logueado']) && $_SESSION['usuario_logueado']) {
    echo '<h1>Bienvenido  ' . $_SESSION['nombre_usuario_login'] . ' ' . $_SESSION['apellido1_usuario_login'] . ' ' . $_SESSION['apellido2_usuario_login'] . '</h1>';
?>
<section class="generico">   
    <article>
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
                     
                     echo "<a href='?idNoticia=".$col['id_noticia']."'>".$col['titular_noticia']."</a><br/>";
                }
                                
                
                mysqli_close($con);
                
        }else{
            header('location: login.php');
        }
             ?>
        </div>
        </article>
</section>


<?php include './footer.php';?>
