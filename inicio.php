<?php
include './header.php';
include_once './conexionBD.php';
if (isset($_SESSION['usuario_logueado']) && $_SESSION['usuario_logueado']) {
    ?>
    <section class="generico2">   
        <?php
        echo '<h1>Bienvenido  ' . $_SESSION['nombre_usuario_login'] . ' ' . $_SESSION['apellido1_usuario_login'] . ' ' . $_SESSION['apellido2_usuario_login'] . '</h1>';
        echo '<img src="'. $_SESSION['foto_usuario_login'] . '" alt="' . $_SESSION['nombre_usuario_login'] . '" height="150">';
        ?>
        <article>           
            <div id="colPrincipal1">
                <h1>Noticias de mi equipo:</h1>
                <?php
                $con = conectaBD();

                if (!isset($_GET['idNoticia'])) {
                    $sqlQuery = "SELECT * FROM noticia WHERE id_equipo= " . $_SESSION['equipoUser'] . " ORDER BY id_noticia DESC";
                    $result = mysqli_query($con, $sqlQuery);

                    //No hago bucle porque solo quiero mnostrar la última noticia
                    $col = mysqli_fetch_array($result);
                    echo '<strong>' . $col['fecha_noticia'] . '</strong>' . " <br><strong>" . $col['titular_noticia'] . '</strong><br>';

                    echo '<p class="pNoticia">' . $col['texto_noticia'] . '</p>';
                } else {
                    $sqlQuery = "SELECT * FROM noticia WHERE id_noticia=" . $_GET['idNoticia'];
                    $result = mysqli_query($con, $sqlQuery);

                    //No hago bucle porque solo quiero mnostrar la última noticia
                    $col = mysqli_fetch_array($result);
                    echo '<strong>' . $col['fecha_noticia'] . '</strong>' . " <br><strong>" . $col['titular_noticia'] . '</strong><br>';

                    echo '<p class="pNoticia">' . $col['texto_noticia'] . '</p>';
                }
                mysqli_close($con);
                ?>
            </div>
        </article>

        <article>
            <div id="colPrincipal2">
                <h1>Titulares:</h1><p>Haz click para ver el contenido</p>
                <?php
                $con = conectaBD();

                $sqlQuery = "SELECT titular_noticia, id_noticia FROM noticia WHERE id_equipo= " . $_SESSION['equipoUser'] . " ORDER BY id_noticia DESC";
                $result = mysqli_query($con, $sqlQuery);

                //Muestro todos los titulares en forma de enlace. 
                while ($col = mysqli_fetch_array($result)) {

                    echo "<a href='?idNoticia=" . $col['id_noticia'] . "'>" . $col['titular_noticia'] . "</a><hr size='1' />";
                }
                mysqli_close($con);
            } else {
                header('location: login.php');
            }
            ?>
        </div>
    </article>
</section>


<?php include './footer.php'; ?>
