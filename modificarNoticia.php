<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
include_once './CRUD/CRUDNoticia.php';
include_once './CRUD/CRUDEquipo.php';
if (isset($_SESSION['usuario_logueado']) && $_SESSION['usuario_logueado'] && ($_SESSION['admin'] == 0)) {
    ?>
    <html>
        <head>
            <meta charset="UTF-8">
            <title>Social Football</title>
            <link rel="stylesheet" href="css/estilos.css" type="text/css" />
            <script script type="text/javascript" src="js/validaciones.js"></script>  
            <link rel="stylesheet" href="jquery-ui-1.11.4/jquery-ui.css" type="text/css" />
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
            <script src="./jquery-ui-1.11.4/jquery-ui.js"></script>
            <script src="./jquery-ui-1.11.4/jquery-ui.min.js"></script>            
        </head>
        <body style="color:black">
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
            <form method="POST" action="#" >
                <span>Titulo: </span><input type="text" id="titulo" class="input-field" name="titulo" value="<?php echo $_SESSION['titular_noticia'] ?>"  />
                <span>Noticia: </span><textarea style="color:black" id="cuerpoNoticia" rows="4" cols="50" class="input-field" name="cuerpoNoticia" ><?php echo $_SESSION['texto_noticia'] ?></textarea>

                <input type="submit"  name="btnModificarNoticia" value="Modificar"  onclick="return validacionRegistroNoticia();"/>
                <input type="button" name="clear" value="Limpiar" onclick="clearForm(this.form);" >
                <input type="submit"  name="btnVolver" value="Volver" />
            </form>           
            <?php
        }
        ?>
    </body>
</html>
