<?php
include './header.php';
if (isset($_SESSION['usuario_logueado']) && $_SESSION['usuario_logueado']) {
    include_once './CRUD/CRUDNoticia.php';
    include_once './CRUD/CRUDEquipo.php';
    ?>
    <body style="color:black">
        <?php
        if (isset($_POST['btnVolver'])) {
            header('location: noticiasAdmin.php');
        }
        if (isset($_POST['btnCrearNoticia'])) {
            //Recogida de datos del formulario
            $titulo = $_POST['titulo'];
            $cuerpoNoticia = $_POST['cuerpoNoticia'];
            $id_equipo = $_POST['equipos'];
            $fecha = $_POST['fecha'];

            createNoticia($titulo, $cuerpoNoticia, $id_equipo, $fecha);
            header('location: noticiasAdmin.php');
        }
        ?>
        <?php
        //En este caso se muestra un formulario de registro
        if (!isset($_POST['btnCrearNoticia'])) {
            ?>
        <section class="generico2">
            <form method="POST" >
                <span>Titulo: </span><input type="text" id="titulo" class="input-field" name="titulo"   /> <br>
                <span>Noticia: </span><br><textarea style="color:black" id="cuerpoNoticia" rows="4" cols="50" class="input-field" name="cuerpoNoticia" ></textarea><br>
                <span>Fecha: </span><input type="text" id="datepicker" name="fecha" readonly value="<?php echo date('d/m/Y'); ?>" /><br>
                <span>Equipos:</span> <?php muestraEquipos(); ?><br>
                <input type="submit"  name="btnCrearNoticia" value="Crear"  onclick="return validacionRegistroNoticias();"/>
                <input type="button" name="clear" value="Limpiar" onclick="clearForm(this.form);" >
                <input type="submit"  name="btnVolver" value="Volver" />
            </form>  
        </section>
        <?php
        }
    } else {
        header('location: login.php');
    }
    include './footer.php';
    