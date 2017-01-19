<?php
session_start();
if (isset($_SESSION['usuario_logueado'])){
    unset($_SESSION['usuario_logueado']);
}
include_once './CRUD/CRUDUsuario.php';
//Si se ha pulsado sobre el botón de login
if (isset($_POST['btnLogin'])) {
    //Compruebo que el usuario existe
    if (!isset($_POST['correo']) || $_POST['correo'] == '') {
        $errores[] = 'El correo no es correcto';
    }
    if (!isset($_POST['password']) || $_POST['password'] == '') {
        $errores[] = 'El pass no es correcto';
    }
    if (!isset($errores)) {
        //Recogida de datos del formulario
        $correo = filter_input(INPUT_POST, 'correo', FILTER_SANITIZE_MAGIC_QUOTES);

        $pass = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_MAGIC_QUOTES);


        $correo = addslashes($correo);
        $pass = md5($pass);

        if (readUsuario($correo, $pass)) {
            header('location: inicio.php');
        }
    }
}
//Si se pulsa sobre el botón de registrarse, se manda al formulario
if (isset($_POST['btnRegistro'])) {
    header('location: registro.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Social Football</title>
        <link rel="stylesheet" href="css/estilos.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script src="js/validaciones.js"></script>
        <script type="text/javascript">

            $(document).ready(function () {
                $('#password').focus(function () {
                    /*cuando se le pone focus, el input se vacia y es tipo password*/
                    document.formLogin.password.value = "";
                    var tipo = document.formLogin.password.type = 'password';
                    $(this).attr('type', tipo);
                });

                $('#user').focus(function () {
                    document.formLogin.user.value = "";
                    $(this).attr('value', "");
                });
            });
        </script>
    </head>
    <body>

        <main id="fondo">
            <h2>Social Football</h2>
            <div class="centrar">
                <form action="#" method="POST" name="formLogin" class="form-style" >

                    <label><span>Email: </span><input type="email" id="user" class="input-field" name="correo" value=""  /></label>
                    <label><span>Password: </span><input type="password" id="password" class="input-field" name="password" value="" /></label>

                    <ul>
                        <li>
                            <input type="submit" class="buttonSpecial" name="btnLogin" value="Login" onclick="return validacionLogin()"/>

                            <input type="submit" class="buttonSpecial" name="btnRegistro" value="Reg&iacute;strate!"/> 
                        </li>
                    </ul>
                </form>           
            </div>
        </main>

        <?php include("footer.php"); ?>