<?php
include './header.php';
include_once './CRUD/CRUDEquipo.php';
readEquipoModificar($_SESSION['id_equipo_modificar']);

if (isset($_POST['btnAceptar'])) {
    if ($_POST['nombre'] != "" && $_POST['anio'] != "") {
        updateEquipo($_SESSION['id_equipo_modificar'], $_POST['nombre'], $_POST['anio']);
        header('location: equipos.php');
    } else {
        echo '<script type="text/javascript">alert("Debe rellenar todos los datos");</script>';
    }
}
if (isset($_POST['btnCancelar'])){
    header('location: equipos.php');
}
?>

<section class="generico2">   
    <form action="#" method="POST">
        <label><span>Escudo:</span></label><img src="<?php echo $_SESSION['foto_equipo_modificar']; ?>" alt="equipo<?php echo $_SESSION['id_equipo_modificar']; ?>" width="40px"/><br>
        <label><span>Nombre:<span class="required">* </span></span><input type="text" name="nombre" value="<?php echo $_SESSION['nombre_equipo_modificar']; ?>"/></label><br>
        <label><span>Año de fundación:<span class="required">* </span></span><input type="number" name="anio" value="<?php echo $_SESSION['anio_fundacion_modificar']; ?>" /></label><br>
        
        <input type="submit" value="Aceptar" name="btnAceptar" />
        <input type="submit" value="Cancelar" name="btnCancelar" />
    </form>
</section>

<?php
include './footer.php';
