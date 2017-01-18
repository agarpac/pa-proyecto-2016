<?php
include './header.php';
require_once './conexionBD.php';
require_once './CRUD/CRUDEstadio.php';
require_once './CRUD/CRUDPartido.php';

//Lista todos los partidos con huecos disponibles
function listaPartidosDisponibles() {
    $con = conectaBD();

    $result = mysqli_query($con, 'SELECT id_partido, fecha_partido, hora_partido, id_estadio FROM partido');

    while ($col = mysqli_fetch_array($result)) {
        if ($col['fecha_partido'] >= date("Y-m-d")) {
            readEstadio($col['id_estadio']);
            echo '<tr>';
            echo '<td width="5%"><input type="radio" name="verPartido" value="' . $col['id_partido'] . '"></td>';
            echo '<td width="40%">' . $_SESSION['nombre_estadio'] . ', ' . $col['fecha_partido'] . ', ' . $col['hora_partido'] . '</td>';
            echo '</tr>';
        }
    }
    mysqli_close($con);
}

if (isset($_POST['btnVerPartido'])) {
    if (isset($_POST['verPartido'])) {
        $_SESSION['partidoVisto'] = $_POST['verPartido'];
        header('location: verPartido.php');
    }
}
if (isset($_POST['btnCrearPartido'])) {
    header('location: crearPartido.php');
}
?>
<section class="generico2">
    <form action = "#" method = "POST">
        <table width="50%" cellpadding="2" cellspacing="0" border="0" bgcolor="#fff">
            <tr>
                <td> </td>
                <td><h4>Partidos disponibles</h4></td>
            </tr>
            <?php listaPartidosDisponibles(); ?>
        </table>
        <input type="submit" value="Ver Partido" name="btnVerPartido" />
        <input type="submit" value="Crear partido" name="btnCrearPartido" />
    </form>
</section>

<?php
include './footer.php';
