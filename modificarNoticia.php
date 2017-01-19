<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
include './header.php';
include_once './CRUD/CRUDNoticia.php';
include_once './CRUD/CRUDEquipo.php';
if (isset($_SESSION['usuario_logueado']) && $_SESSION['usuario_logueado'] && ($_SESSION['admin'] == 0)) {
    ?>
    <body>
        <?php
        if (isset($_POST['btnVolver'])) {
            unset($_SESSION['id_noticia']);
            header('location: noticiasAdmin.php');
        }
        if (isset($_POST['btnModificarNoticia'])) {
            //Recogida de datos del formulario
            $titulo = $_POST['titulo'];
            $cuerpoNoticia = $_POST['cuerpoNoticia'];
            updateNoticia($_SESSION['id_noticia'], $titulo, $cuerpoNoticia);
            header('location: noticiasAdmin.php');
        }
        ?>
        <?php
        ?>
        <section class="generico2">
            <form method="POST" action="#" >
                <span>Titulo: </span><input type="text" id="titulo" class="input-field" name="titulo" value="<?php echo $_SESSION['titular_noticia'] ?>"  /><br>
                <span>Noticia: </span><br><textarea style="color:black" id="cuerpoNoticia" rows="10" cols="100%" class="input-field" name="cuerpoNoticia" ><?php echo $_SESSION['texto_noticia'] ?></textarea><br>

                <input type="submit"  name="btnModificarNoticia" value="Modificar"  onclick="return validacionRegistroNoticia();"/>
                <input type="button" name="clear" value="Limpiar" onclick="clearForm(this.form);" >
                <input type="submit"  name="btnVolver" value="Volver" />
            </form>
        </section>
        <?php
    } else {
        header('location: login.php');
    }
    include './footer.php';
    