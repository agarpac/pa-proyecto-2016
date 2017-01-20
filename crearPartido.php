<?php
include './header.php';

if (isset($_SESSION['usuario_logueado']) && $_SESSION['usuario_logueado']) {
    require_once './CRUD/CRUDPartido.php';
    require_once './CRUD/CRUDEstadio.php';

//Si existe el boton Crear
    if (isset($_POST['btnCrear'])) {
        $fecha = $_POST['fecha'];
        $hora = $_POST['hora'];
        $estadio = $_POST['estadio'];

        if ($fecha >= date("d/m/Y") && $fecha != "") {
            if (createPartido($fecha, $hora, $estadio)) {
                header('location: partidos.php');
            } else {
                echo '<script type="text/javascript">alert("Estadio ocupado, elija otra fecha");</script>';
            }
        } else {
            echo '<script type="text/javascript">alert("Elija una fecha igual o posterior a la actual");</script>';
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
    <section class="bodyRegistro generico">
        <div class="form-style">
            <div class="form-style-heading">Registro de un nuevo partido</div>
            <form method="POST">

                <label><span>Estadios:</span> <select name="estadio" style="color:black">
                        <?php listaEstadios(); ?>
                    </select>
                    <button type="submit" class="buttonSpecial" name="btnCrearEstadio"><img src="img/crear.png" width="25" height="25" alt="+"/>
                    </button> <?php
                    if ($_SESSION['admin'] == 0) {
                        echo '<button type="submit" class="buttonSpecial" name="btnEliminarEstadio"><img src="img/eliminar.png" width="25" height="25" alt="-"/>
                    </button>';
                    }
                    ?></label>

                <label><span>Día:</span><input type="text" id="datepicker" class="input-field" name="fecha" value="<?php echo date("d/m/Y"); ?>"></label>
                <label><span>Hora:</span> <select name="hora" class="input-field" style="color:black">
                        <option disabled>Horarios de mañana</option>
                        <option value="10:00">10:00 - 11:30</option>
                        <option value="12:00">12:00 - 13:30</option>
                        <option disabled>Horarios de tarde</option>
                        <option value="16:00">16:00 - 17:30</option>
                        <option value="18:00">18:00 - 19:30</option>
                        <option value="20:00">20:00 - 21:30</option>
                    </select></label>

                <input type="submit" class="buttonSpecial" value="Crear" name="btnCrear" />
                <input type="submit"  class="buttonSpecial" value="Cancelar" name="btnCancelar" />
            </form>
        </div>
    </section>


    <?php
} else {
    header('location: login.php');
}
include './footer.php';
