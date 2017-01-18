<?php
include './header.php';
require_once './CRUD/CRUDPartido.php';
require_once './CRUD/CRUDUsuario.php';

//Lista los jugadores inscritos en ese partido
function listadoJugadores() {
    $encontrado = FALSE;

    $_SESSION['numJugadores'] = 0;

    $con = conectaBD();
    $result = mysqli_query($con, 'SELECT id_usuario FROM partido_usuario WHERE id_partido = ' . $_SESSION['partidoVisto']);
    while ($col = mysqli_fetch_array($result)) {
        $_SESSION['numJugadores'] = $_SESSION['numJugadores'] + 1;
        readUsuarioID($col['id_usuario']);
        echo $_SESSION['numJugadores'] . '. ' . $_SESSION['nombre_usuario_ID'] . ' ' . $_SESSION['apellido1_usuario_ID'] . ' ' . $_SESSION['apellido2_usuario_ID'] . '<br>';
        if ($col['id_usuario'] == $_SESSION['id_usuario_login'] && !$encontrado && $_SESSION['numJugadores'] < 10) {
            $encontrado = TRUE;
        }
    }
    mysqli_close($con);
    if (!$encontrado) {
        echo '<br><input type = "submit" value = "Suscribirse" name = "btnRegistro" />';
    } else {
        echo '<br><input type = "submit" value = "Cancelar suscripción" name = "btnCancelar" />';
    }
}

if (isset($_POST['btnRegistro'])) {
    $con = conectaBD();
    mysqli_query($con, 'INSERT INTO partido_usuario (id_partido, id_usuario) VALUES (' . $_SESSION['partidoVisto'] . ', ' . $_SESSION['id_usuario_login'] . ')');
    mysqli_close($con);
}

if (isset($_POST['btnCancelar'])) {
    $con = conectaBD();
    mysqli_query($con, 'DELETE FROM partido_usuario WHERE id_partido = ' . $_SESSION['partidoVisto'] . ' AND id_usuario = ' . $_SESSION['id_usuario_login']);
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
    echo '<legend>Jugadores (Máx. 10 personas)</legend>';
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
