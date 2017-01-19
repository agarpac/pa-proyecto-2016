<?php
session_start();
include_once './CRUD/CRUDMensaje.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Social Football</title>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="css/estilos.css" />
        <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>     
        <script src="./js/clear.js"></script> 
        <script type="text/javascript">
            function confirmDel() { //confirmar borrar noticia
                if (confirm("¿Realmente desea eliminarla?"))
                    return true; 
                else
                    return false;
            }
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
                         $("#autoc").attr("disabled","disabled");
                         
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
                        <li><a href="amigos.php">Amigos</a></li>
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