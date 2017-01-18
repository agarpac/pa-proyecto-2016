<?php
include './header.php';

if (isset($_SESSION['usuario_logueado']) && $_SESSION['usuario_logueado']) {
require_once './CRUD/CRUDPartido.php';
require_once './CRUD/CRUDEstadio.php';

//Lista todos los estadios para el listBox
function listaEstadios() {
    $con = conectaBD();

    $result = mysqli_query($con, 'SELECT id_estadio, nombre_estadio FROM estadio');
    while ($col = mysqli_fetch_array($result)) {
        echo '<option value = "' . $col['id_estadio'] . '">' . $col['nombre_estadio'] . '</option>';
    }
    mysqli_close($con);
}

//Si existe el boton Crear
if (isset($_POST['btnCrear'])) {
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $estadio = $_POST['estadio'];

    if ($fecha < date("Y-m-d")) {
        echo '<script type="text/javascript">alert("Elija una fecha igual o posterior a la actual");</script>';
    } else {
        if (createPartido($fecha, $hora, $estadio)) {
            header('location: partidos.php');
        } else {
            echo '<script type="text/javascript">alert("Estadio ocupado, elija otra fecha");</script>';
        }
    }
}
if (isset($_POST['btnCancelar'])) {
    header('location: partidos.php');
}

if (isset($_POST['btnCrearEstadio'])) {
    header('location: crearEstadio.php');
}

if (isset($_POST['btnEliminarEstadio'])) {
    if (!readPartidoESTADIO($_POST['estadio'])) {
        deleteEstadio($_POST['estadio']);
    } else {
        echo '<script type="text/javascript">alert("El estadio está ocupado por algún partido, no se puede eliminar");</script>';
    }
}
?>
<section class="generico2">
    <form action="#" method="POST">
        Estadios: <select name="estadio" style="color:black">
            <?php listaEstadios(); ?>
        </select> <input type="submit" value="+" name="btnCrearEstadio" /> <?php if ($_SESSION['admin'] == 0) {
                echo '<input type="submit" value="-" name="btnEliminarEstadio" onclick="return confirmDel()" />';
            } ?>
        <br>
        Día: <input name="fecha" type="date" id="fecha"> <script> document.getElementById('fecha').value = new Date().toISOString().substring(0, 10);</script><br>
        Hora: <select name="hora" style="color:black">
            <option disabled>Horarios de mañana</option>
            <option value="10:00">10:00 - 11:30</option>
            <option value="12:00">12:00 - 13:30</option>
            <option disabled>Horarios de tarde</option>
            <option value="16:00">16:00 - 17:30</option>
            <option value="18:00">18:00 - 19:30</option>
            <option value="20:00">20:00 - 21:30</option>
        </select> <br>
        <input type="submit" value="Crear" name="btnCrear" />
        <input type="submit" value="Cancelar" name="btnCancelar" />
    </form>
</section>


<?php 

} else {
    header('location: login.php');
}
include './footer.php';
