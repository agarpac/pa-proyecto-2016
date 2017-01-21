<?php
include './header.php';
include_once './CRUD/CRUDUsuario.php';
include_once './CRUD/CRUDNoticia.php';
datosMiEquipo($_SESSION['equipoUser']);
if (isset($_SESSION['usuario_logueado']) && $_SESSION['usuario_logueado']) {
    ?>
    <section class="generico2">
        <table>
            <tr>
                <td>
                    <div id="perfil">
                        <a href="editarPerfil.php" class = "enlaceMensajes"><img src="<?php echo $_SESSION['foto_usuario_login']; ?>" alt="<?php echo $_SESSION['nombre_usuario_login']; ?>" height="150px"></a>
                        <div>Editar perfil</div>
                    </div>
                </td>
                <td><h1>Bienvenido  <a href="editarPerfil.php" class = "enlaceMensajes"><?php echo $_SESSION['nombre_usuario_login'] . ' ' . $_SESSION['apellido1_usuario_login'] . ' ' . $_SESSION['apellido2_usuario_login']; ?></a></h1></td>
            </tr>
        </table>

        <a href="editarPerfil.php"></a>
        <article>
            <div id="colNoticias1">
                <table>
                    <tr>
                        <td>
                            <h1>Noticias del<em><?php echo " " . $_SESSION['nombre_equipo']; ?></em></h1>
                        </td>
                        <td>
                            <img src="<?php echo $_SESSION['foto_equipo']; ?>" alt="<?php echo $_SESSION['nombre_equipo']; ?>" height="35px">
                        </td>
                    </tr>
                </table>
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
            <div id="colNoticias2">
                <h1>Titulares:</h1><p>Haz click para ver el contenido</p>
                <?php
                listaMisTitulares($_SESSION['equipoUser']);
                ?>
            </div>
        </article>
    </section>
    <?php
} else {
    header('location: login.php');
}
include './footer.php';
