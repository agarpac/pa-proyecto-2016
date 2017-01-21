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
        <section class="bodyRegistro generico">
            <div class="form-style">
            <div class="form-style-heading">Modificar noticia:</div>
            <form method="POST" action="#" >
                <label><span>Titulo: </span><input type="text" id="titulo" class="input-field" name="titulo" value="<?php echo $_SESSION['titular_noticia'] ?>"  /></label>
                <label><span>Noticia: </span><textarea style="color:black; resize:none;" id="cuerpoNoticia" rows="10px" cols="48px" class="input-field" name="cuerpoNoticia" ><?php echo $_SESSION['texto_noticia'] ?></textarea></label>

                <input type="submit" class="buttonSpecial"  name="btnModificarNoticia" value="Modificar"  onclick="return validacionRegistroNoticia();"/>
                <input type="button" class="buttonSpecial" name="clear" value="Limpiar" onclick="clearForm(this.form);" >
                <input type="submit" class="buttonSpecial"  name="btnVolver" value="Volver" />
            </form>
            </div>
        </section>
        <?php
    } else {
        header('location: login.php');
    }
    include './footer.php';
    