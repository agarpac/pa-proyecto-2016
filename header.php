<?php
session_start();
include_once './CRUD/CRUDMensaje.php';
include_once './CRUD/CRUDPeticion_amistad.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Social Football</title>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="css/estilos.css" />      
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> 
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>        
        <script src="./js/validaciones.js"></script>         
        <script>
            $( function() {
              $( "#datepicker" ).datepicker({ dateFormat: 'dd/mm/yy' }).val();              
            } );            
        </script>              
       
        <script type="text/javascript">
            $(document).ready(function(){
                $('.search-box input[type="text"]').on("keyup input", function(){
                    /* Get input value on change */
                    var term = $(this).val();
                    var resultDropdown = $(this).siblings(".result");
                    if(term.length){
                        $.get("backend-search.php", {query: term}).done(function(data){
                            // Display the returned data in browser
                            resultDropdown.html(data);
                        });
                    } else{
                        resultDropdown.empty();
                    }
                });

                // Set search input value on click of result item
                $(document).on("click", ".result p", function(){
                    $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
                    $(this).parent(".result").empty();
                    if ($("#emailError").length === 0) {
                         $("#amistad").css("display", "block");
                         $("#limpiar").css("display", "block");
                         $("#autoc").attr("readonly","true");
                    }
                });
            });
        </script>
    </head>
    <body>
        <header id="header">
            <h1>Social Football</h1>
            <nav>
                <ul>
                    <?php
                    if (!isset($_SESSION['id_usuario_login'])) { //no logueado
                        ?>
                        <li><a href="login.php">Iniciar sesi&oacute;n</a></li>
                        <li><a href="registro.php">Reg&iacute;strate</a></li>
                    <?php } else { // usuario logueado
                        ?>
                        <li><a href="inicio.php">Inicio</a></li>
                        <li><a href="partidos.php">Partidos</a></li>
                        <li><a href="mensajes.php">Mensajes<?php if(numMensajesNoLeidos($_SESSION['id_usuario_login']) > 0){ echo '<strong> ['. numMensajesNoLeidos($_SESSION['id_usuario_login']) . ']</strong>';} ?></a></li>
                        <li><a href="amigos.php">Amigos<?php if (numPeticionesPendientes() > 0) {echo '<strong> [' . numPeticionesPendientes() . ']</strong>';}?></a></li>
                        <?php
                        if ($_SESSION['admin'] == 0) {
                            ?>
                            <li><a href="noticiasAdmin.php" class="admin">Noticias</a></li>
                            <li><a href="equipos.php" class="admin">Equipos</a></li>
                                <?php
                            }
                            ?>
                        <li><a href="logout.php">Cerrar Sesión</a></li>
                        <?php
                    }
                    ?>
                </ul>
            </nav>
        </header>