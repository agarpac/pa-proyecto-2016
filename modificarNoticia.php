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
            <script script type="text/javascript" src="js/clear.js"></script>  


            <script type="text/javascript">
                //Funcion que valida los datos del registro, en caso de errores muestra un mensaje por cada error y devuelve false
                function validacionRegistro() {

                    var titulo = document.getElementById("titulo");
                    var cuerpoNoticia = document.getElementById("cuerpoNoticia");

                    var bool = true;

                    //Borramos mensajes de error anteriores si los hay
                    if ($("#tituloError").length !== 0) {
                        $("#tituloError").remove();
                    }

                    if ($("#cuerpoError").length !== 0) {
                        $("#cuerpoError").remove();
                    }

                    //Comprobamos todos los campos, mostrando un error en aquellos que los haya
                    if (titulo.value === "") {
                        var aux = document.createElement("p");
                        aux.setAttribute("id", "tituloError");
                        aux.setAttribute("class", "error");
                        aux.innerHTML = "Introduzca un titulo.";
                        $("#titulo").after(aux);
                        bool = false;
                    }


                    if (cuerpoNoticia.value === "") {
                        var aux = document.createElement("p");
                        aux.setAttribute("id", "cuerpoError");
                        aux.setAttribute("class", "error");
                        aux.innerHTML = "Introduzca un texto";
                        $("#cuerpoNoticia").after(aux);
                        bool = false;
                    }



                    return bool;
                }
            </script>
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
                if ($titulo != "" && $cuerpoNoticia != "") {
                    $_SESSION['existe_ERROR'] = FALSE;
                    updateNoticia($_SESSION['id_noticia'], $titulo, $cuerpoNoticia);
                    unset($_SESSION['id_noticia']);
                    header('location: noticiasAdmin.php');
                } else {
                    $_SESSION['existe_ERROR'] = TRUE;
                }
            }
            ?>
            <?php
            if (isset($_SESSION['existe_ERROR']) && $_SESSION['existe_ERROR'] == TRUE) {
                $_SESSION['existe_ERROR'] = FALSE;
                echo '<span style="color:red"><strong>ERROR: Debe rellenar los datos.</strong></span>';
            }
            ?>
            <form method="POST" action="#" >
                <span>Titulo: </span><input type="text" id="titulo" class="input-field" name="titulo" value="<?php echo $_SESSION['titular_noticia'] ?>"  />
                <span>Noticia: </span><textarea style="color:black" id="cuerpoNoticia" rows="4" cols="50" class="input-field" name="cuerpoNoticia" ><?php echo $_SESSION['texto_noticia'] ?></textarea>

                <input type="submit"  name="btnModificarNoticia" value="Modificar"  onclick="return validacionRegistro();"/>
                <input type="button" name="clear" value="Limpiar" onclick="clearForm(this.form);" >
                <input type="submit"  name="btnVolver" value="Volver" />
            </form>           
            <?php
        }
        ?>
    </body>
</html>
