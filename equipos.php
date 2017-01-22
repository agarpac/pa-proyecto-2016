<?php
include './header.php';
include_once './CRUD/CRUDEquipo.php';
if (isset($_SESSION['usuario_logueado']) && $_SESSION['usuario_logueado'] && $_SESSION['admin'] == 0) {
    if (isset($_POST['btnEliminar'])) {
        if (equipoFavorito($_POST['equipos'])) {
            echo '<script type="text/javascript">alert("El equipo que quiere borrar es el favorito de, al menos, un usuario");</script>';
        } else {
            deleteEquipo($_POST['equipos']);
        }
    }

    if (isset($_POST['btnModificar'])) {
        $_SESSION['id_equipo_modificar'] = $_POST['equipos'];
        header('location: modificarEquipo.php');
    }

    if (isset($_POST['btnCrear'])) {
        header('location: crearEquipo.php');
    }
    ?>
    <section class="bodyRegistro generico"> 
        <div class="form-style">
            <form action="#" method="POST">
                <div>
                    <?php muestraEquipos(); ?>
                </div>
                <br>
                <input type="submit" class="buttonSpecial" value="Crear" name="btnCrear" />
                <input type="submit" class="buttonSpecial" value="Modificar" name="btnModificar" />
                <input type="submit" class="buttonSpecial" value="Eliminar" name="btnEliminar" onclick="return confirmDel()" />
            </form>
        </div>
    </section>

    <?php
} else {
    header('location: login.php');
}
include './footer.php';
