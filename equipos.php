<?php
include './header.php';
include_once './CRUD/CRUDEquipo.php';

if (isset($_POST['btnEliminar'])){
    $con = conectaBD();
    
    $result = mysqli_query($con, 'SELECT id_usuario FROM usuario WHERE equipo_id = ' . $_POST['equipos']);
    
    if (mysqli_num_rows($result) > 0){
        echo '<script type="text/javascript">alert("El equipo que quiere borrar es el favorito de, al menos, un usuario");</script>';
    } else {
        deleteEquipo($_POST['equipos']);
    }
    mysqli_close($con);
}

if (isset($_POST['btnModificar'])){
    $_SESSION['id_equipo_modificar'] = $_POST['equipos'];
    header('location: modificarEquipo.php');
}

if (isset($_POST['btnCrear'])){
    header('location: crearEquipo.php');
}
?>
<section class="generico2">   
    <form action="#" method="POST">
        <div style="width: fit-content">
            <?php muestraEquipos(); ?>
        </div>
        <br>
        <input type="submit" value="Crear" name="btnCrear" />
        <input type="submit" value="Modificar" name="btnModificar" />
        <input type="submit" value="Eliminar" name="btnEliminar" onclick="return confirmDel()" />
    </form>
</section>

<?php
include './footer.php';
