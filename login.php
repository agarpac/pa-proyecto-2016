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

            //Funcion que valida los datos de login, en caso de errores muestra un mensaje por cada error y devuelve false
            function validacionLogin() {
                var exp = new RegExp(/^[A-Z]{1,2}\s\d{4}\s([B-D]|[F-H]|[J-N]|[P-T]|[V-Z]){3}$/);
                var user = document.getElementById("user");
                var pass = document.getElementById("password");
                var bool = true;

                /* if ($("#userError").length !== 0) {
                 $("#userError").remove();
                 $("#user").css("background-color", "#f2d6b5");
                 }
                 if ($("#passError").length !== 0) {
                 $("#passError").remove();
                 $("#password").css("background-color", "#f2d6b5");
                 }
                 if ($("#userError").length !== 0) {
                 $("#userError").remove();
                 }*/

                if (user.value === "") {

                    /*var aux = document.createElement("p");
                     aux.setAttribute("id", "userError");*/
                    /*aux.setAttribute("class", "error");*/
                    /*aux.innerHTML = "Introduzca un usuario.";*/
                    user.value = "Introduzca su correo";
                    /*$("#user").after(aux);*/
                    $("#user").css("background-color", "#f2dede");
                    $("#user").css("color", "#a94442");
                    $("#user").css("border-width", "1px");
                    $("#user").css("border-style", "solid");
                    $("#user").css("border-color", "red");
                    $("#user").css("box-shadow", "red");

                    bool = false;
                }

                if (pass.value === "") {

                    /*var aux = document.createElement("p");
                     aux.setAttribute("id", "passError");
                     aux.setAttribute("class", "error");
                     aux.innerHTML = "Introduzca una contrase&ntilde;a.";
                     $("#password").after(aux);
                     $("#password").css("background-color", "red");*/
                    document.formLogin.password.type = 'text';
                    password.value = "Introduzca su password";
                    /*$("#user").after(aux);*/
                    $("#password").css("background-color", "#f2dede");
                    $("#password").css("color", "#a94442");
                    $("#password").css("border-width", "1px");
                    $("#password").css("border-style", "solid");
                    $("#password").css("border-color", "red");
                    $("#password").css("box-shadow", "red");
                    bool = false;
                }

                if (user.value !== "" && exp.test(String(user.value))) {

                    /*var aux = document.createElement("p");
                     aux.setAttribute("id", "userError");
                     aux.setAttribute("class", "error");
                     aux.innerHTML = "Introduzca un nombre de usuario correcto.";
                     $("#user").after(aux);*/
                    user.value = "Introduzca un nombre correcto";
                    $("#user").css("background-color", "#f2dede");
                    $("#user").css("color", "#a94442");
                    $("#user").css("border-width", "1px");
                    $("#user").css("border-style", "solid");
                    $("#user").css("border-color", "red");
                    $("#user").css("box-shadow", "red");
                    bool = false;
                }

                return bool;
            }

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