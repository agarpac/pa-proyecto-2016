<?php
include './header.php';
include_once './CRUD/CRUDEquipo.php';
if (isset($_SESSION['usuario_logueado']) && $_SESSION['usuario_logueado'] && $_SESSION['admin'] == 0) {
    readEquipoModificar($_SESSION['id_equipo_modificar']);

    if (isset($_POST['btnAceptar'])) {
        if ($_POST['nombre'] != "" && $_POST['anio'] != "") {
            updateEquipo($_SESSION['id_equipo_modificar'], $_POST['nombre'], $_POST['anio']);
            header('location: equipos.php');
        } else {
            echo '<script type="text/javascript">alert("Debe rellenar todos los datos");</script>';
        }
    }
    if (isset($_POST['btnCancelar'])) {
        header('location: equipos.php');
    }
    ?>

    <section class="bodyRegistro generico">
        <div class="form-style">
            <div class="form-style-heading">Modificar equipo:</div>
            <form action="#" method="POST">
                <label><span>Escudo:</span></label><img src="<?php echo $_SESSION['foto_equipo_modificar']; ?>" alt="equipo<?php echo $_SESSION['id_equipo_modificar']; ?>" width="40px"/>
                <label><span>Nombre:<span class="required"> * </span></span><input type="text" class="input-field" name="nombre" value="<?php echo $_SESSION['nombre_equipo_modificar']; ?>"/></label>
                <label><span>Fundación:<span class="required">*</span></span><input type="number" class="input-field" name="anio" value="<?php echo $_SESSION['anio_fundacion_modificar']; ?>" /></label>

                <input type="submit" class="buttonSpecial" value="Aceptar" name="btnAceptar" />
                <input type="submit" class="buttonSpecial" value="Cancelar" name="btnCancelar" />
            </form>
        </div>
    </section>

    <?php
} else {
    header('location: login.php');
}
include './footer.php';
