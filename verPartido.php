<?php
include './header.php';
require_once './CRUD/CRUDPartido.php';
require_once './CRUD/CRUDUsuario.php';

//Lista los jugadores inscritos en ese partido
function listadoJugadores() {
    $encontrado = FALSE;
    readUsuarioID($_SESSION['id_usuario_creador']);
    echo '1. ' . $_SESSION['nombre_usuario_ID'] . ' ' . $_SESSION['apellido1_usuario_ID'] . ' ' . $_SESSION['apellido2_usuario_ID'];
    if ($_SESSION['id_usuario_creador'] == $_SESSION['id_usuario_login']) {
        $encontrado = TRUE;
    }
    $_SESSION['numJugadores'] = 1;
    for ($i = 2; $i <= 10; $i++) {
        if ($_SESSION['id_usuario_' . $i] != -1) {
            readUsuarioID($_SESSION['id_usuario_' . $i]);
            echo '<br>'. $i . '. ' . $_SESSION['nombre_usuario_ID'] . ' ' . $_SESSION['apellido1_usuario_ID'] . ' ' . $_SESSION['apellido2_usuario_ID'];
            if ($_SESSION['id_usuario_' . $i] == $_SESSION['id_usuario_login'] && !$encontrado) {
                $encontrado = TRUE;
            }
            $_SESSION['numJugadores'] = $_SESSION['numJugadores'] + 1;
        }
    }
    if (!$encontrado) {
        echo '<br><input type = "submit" value = "Registrarse" name = "btnRegistro" />';
    }
}

if (isset($_POST['btnRegistro'])) {
    $posicion = $_SESSION['numJugadores'] + 1;
    $con = conectaBD();

    mysqli_query($con, 'UPDATE partido SET id_usuario_' . $posicion . '=' . $_SESSION['id_usuario_login'] . ' WHERE id_partido=' . $_SESSION['partidoVisto']);

    mysqli_close($con);
}

//Muestra los datos del partido
function datosPartido() {
    readPartido($_SESSION['partidoVisto']);
    echo '<fieldset>';
    echo '<legend>Datos del partido</legend>';
    echo 'Nombre: ' . $_SESSION['nombre_estadio'];
    echo '<br>Ciudad: ' . $_SESSION['ciudad_estadio'];
    echo '<br>Direccion: ' . $_SESSION['direccion_estadio'];
    echo '<br>Fecha: ' . $_SESSION['fecha_partido'];
    echo '<br>Hora: ' . $_SESSION['hora_partido'];
    echo '</fieldset>';
    echo '<fieldset>';
    echo '<legend>Jugadores</legend>';
    listadoJugadores();
    echo '</fieldset>';
}
?>

<section class="generico2">
    <form action="" method = "POST">
<?php datosPartido(); ?>
    </form>
    <form action="partidos.php" method = "POST">
        <input type="submit" value="Volver" name="btnVolver" />
    </form>
</section>
<?php
include './footer.php';
