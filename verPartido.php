<?php
include './header.php';
require_once './CRUD/CRUDPartido.php';
require_once './CRUD/CRUDUsuario.php';

if (isset($_SESSION['usuario_logueado']) && $_SESSION['usuario_logueado']) {
    if (isset($_POST['btnRegistro'])) {
        registrarse();
    }

    if (isset($_POST['btnCancelar'])) {
        cancelarSuscripcion();
    }

//Muestra los datos del partido
    function datosPartido() {
        readPartido($_SESSION['partidoVisto']);
        echo '<div id = "colPartidos1">';
        echo '<fieldset>';
        echo '<legend>Datos del partido</legend>';
        echo 'Nombre: ' . $_SESSION['nombre_estadio'];
        echo '<br>Ciudad: ' . $_SESSION['ciudad_estadio'];
        echo '<br>Direccion: ' . $_SESSION['direccion_estadio'];
        echo '<br>Fecha: ' . $_SESSION['fecha_partido'];
        echo '<br>Hora: ' . $_SESSION['hora_partido'];
        echo '</fieldset>';
        echo '</div>';

        echo '<div id = "colPartidos2">';
        echo '<fieldset>';
        echo '<legend>Jugadores (Máx. 10 personas)</legend>';
        listadoJugadores();
        echo '</fieldset>';
        echo '</div>';
    }
    ?>

    <section class="generico">
        <form action="" method = "POST">
            <?php datosPartido(); ?>
        </form>
        <div class="form-style" style="clear: left; float: left">
            <form action="partidos.php" method = "POST">
                <input type="submit"  class="buttonSpecial" value="Volver a partidos" name="btnVolver" />
            </form>
        </div>
    </section>
    <?php
} else {
    header('location: login.php');
}
include './footer.php';
