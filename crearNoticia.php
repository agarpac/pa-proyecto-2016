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
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Social Football</title>
        <link rel="stylesheet" href="css/estilos.css" type="text/css" />
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">   
        
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script script type="text/javascript" src="js/clear.js"></script>
        <script>
            $( function() {
              $( "#datepicker" ).datepicker({ dateFormat: 'dd/mm/yy' }).val();              
            } );
            
        </script>
        <script type="text/javascript">
            //Funcion que valida los datos del registro, en caso de errores muestra un mensaje por cada error y devuelve false
            function validacionRegistro() {
                
                var titulo = document.getElementById("titulo");
                var cuerpoNoticia = document.getElementById("cuerpoNoticia");
                var fecha = document.getElementById("datepicker");
                var bool = true;

                //Borramos mensajes de error anteriores si los hay
                if ($("#tituloError").length !== 0) {
                    $("#tituloError").remove();
                }

                if ($("#cuerpoError").length !== 0) {
                    $("#cuerpoError").remove();
                }

                if ($("#fechaError").length !== 0) {
                    $("#fechaError").remove();
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
                
                if (fecha.value === "") {
                    var aux = document.createElement("p");
                    aux.setAttribute("id", "fechaError");
                    aux.setAttribute("class", "error");
                    aux.innerHTML = "Introduzca la fecha";
                    $("#datepicker").after(aux);
                    bool = false;
                } 
               
                return bool;
            }
        </script>

       
    </head>
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
                 ?>
                 <article >
                    <p>La noticia se ha creado con éxito</p>
                    <form method="post" action="./noticiasAdmin.php">
                        <input class="botonBusqueda" type="submit" value="Volver"/>
                    </form>
                </article>
         <?php  
            }
        ?>
        <?php
        //En este caso se muestra un formulario de registro
        if (!isset($_POST['btnCrearNoticia'])) {
            ?>
         <form method="POST" >
             <span>Titulo: </span><input type="text" id="titulo" class="input-field" name="titulo"   /> <br>
             <span>Noticia: </span><br><textarea style="color:black" id="cuerpoNoticia" rows="4" cols="50" class="input-field" name="cuerpoNoticia" ></textarea><br>
             <span>Fecha: </span><input type="text" id="datepicker" name="fecha" /><br>
             <span>Equipos:</span> <?php muestraEquipos(); ?><br>
             <input type="submit"  name="btnCrearNoticia" value="Crear"  onclick="return validacionRegistro();"/>
             <input type="button" name="clear" value="Limpiar" onclick="clearForm(this.form);" >
             <input type="submit"  name="btnVolver" value="Volver" />
        </form>           
         <?php } ?>
    </body>
</html>
