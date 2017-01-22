<?php
include './header.php';
if (isset($_SESSION['usuario_logueado']) && $_SESSION['usuario_logueado'] && $_SESSION['admin'] == 0) {
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
            <section class="bodyRegistro generico">
                <div class="form-style">
                    <div class="form-style-heading">Crear noticia:</div>
                    <form method="POST" >
                        <label><span>Titulo: </span><input type="text" id="titulo" class="input-field" name="titulo"   /></label>
                        <label><span>Fecha: </span><input type="text" id="datepicker" class="input-field" name="fecha" readonly value="<?php echo date('d/m/Y'); ?>" /></label>
                        <label><span>Noticia: </span><textarea style="color:black; resize:none;" id="cuerpoNoticia" rows="6px" cols="36px" class="input-field" name="cuerpoNoticia" ></textarea></label>                     
                        <label><span>Equipos: </span><?php muestraEquipos(); ?></label>
                        <input type="submit"  name="btnCrearNoticia" value="Crear"  onclick="return validacionRegistroNoticias();"/>
                        <input type="button" name="clear" value="Limpiar" onclick="clearForm(this.form);" >
                        <input type="submit"  name="btnVolver" value="Volver" />
                    </form>  
                </div>
            </section>
            <?php
        }
    } else {
        header('location: login.php');
    }
    include './footer.php';
    