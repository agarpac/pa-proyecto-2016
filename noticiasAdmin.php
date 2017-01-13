<?php
include './header.php';
include_once './conexionBD.php';
include_once './CRUD/CRUDNoticia.php';
if (isset($_SESSION['usuario_logueado']) && $_SESSION['usuario_logueado'] && ($_SESSION['admin'] == 0)) {

    if (isset($_GET['btnCrearNoticia'])) {
        header('location: crearNoticia.php');
    }
    if (isset($_GET['btnModificarNoticia'])) {
        if (isset($_SESSION['id_noticia'])) {
            header('location: modificarNoticia.php');
        }
    }
    if (isset($_GET['btnEliminarNoticia'])) {
        if (isset($_SESSION['id_noticia'])) {
            deleteNoticia($_SESSION['id_noticia']);
            unset($_SESSION['id_noticia']);
        }
    }
    ?>
    <section class="generico">   
        <article>
            <div id="colPrincipal1">
                <h1>Cuerpo de la noticia:</h1>
                <?php
                if (isset($_GET['idNoticia'])) {
                    readNoticia($_GET['idNoticia']);

                    echo '<strong>' . $_SESSION['fecha_noticia'] . '</strong>' . " <br><strong>" . $_SESSION['titular_noticia'] . '</strong><br>';

                    echo '<p class="pNoticia">' . $_SESSION['texto_noticia'] . '</p>';
                    $_SESSION['id_noticia'] = $_GET['idNoticia'];
                } else {
                    echo "Selecciona una noticia";
                }
                ?>
            </div>
        </article>
        <article>
            <div id="colPrincipal2">
                <h1>Titulares:</h1><p>Haz click para ver el contenido</p>
                <form action="noticiasAdmin.php" method="get" >   
                    <?php
                    $con = conectaBD();

                    $sqlQuery = "SELECT titular_noticia, id_noticia FROM noticia  ORDER BY id_equipo ASC";
                    $result = mysqli_query($con, $sqlQuery);

                    //Muestro todos los titulares en forma de enlace. 
                    while ($col = mysqli_fetch_array($result)) {
                        echo "<a href='?idNoticia=" . $col['id_noticia'] . "'>" . $col['titular_noticia'] . "</a><hr size='1' />";
                    }
                    mysqli_close($con);
                    ?>
                    <span class="form-style">                        
                        <input type="submit" class="buttonSpecial" name="btnCrearNoticia" value="Crear"/>
                        <input type="submit" class="buttonSpecial" name="btnModificarNoticia" value="Modificar"/> 
                        <input type="submit" class="buttonSpecial" name="btnEliminarNoticia" value="Eliminar" onclick="return confirmDel()"/>
                    </span>
                </form>
            </div>
        </article>
    </section>


    <?php
    include './footer.php';
} else {
    header('location: login.php');
}
?>
