<?php
session_start();
include './CRUD/CRUDUsuario.php';
include_once './conexionBD.php';
include './CRUD/CRUDEquipo.php';

if (isset($_POST['volver'])) {
    header('location: login.php');
}
?>

<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>Social Football</title>
        <link rel="stylesheet" href="css/estilos.css" />
        <link rel="stylesheet" href="jquery-ui-1.11.4/jquery-ui.css" type="text/css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script src="./jquery-ui-1.11.4/jquery-ui.js"></script>
        <script src="./jquery-ui-1.11.4/jquery-ui.min.js"></script>
        <script src="./pStrength-master/pStrength.jquery.js"></script>

        <script type="text/javascript">
            //Funcion que valida los datos del registro, en caso de errores muestra un mensaje por cada error y devuelve false
            function validacionRegistro() {
                var exp = new RegExp(/^[A-Z]{1,2}\s\d{4}\s([B-D]|[F-H]|[J-N]|[P-T]|[V-Z]){3}$/);
                var passExp = new RegExp(/(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/);
                var emailExp = new RegExp(/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);
                var nombre = document.getElementById("nombre");
                var apellido1 = document.getElementById("apellido1");
                var apellido2 = document.getElementById("apellido2");
                var pass = document.getElementById("password");
                var email = document.getElementById("email");

                var bool = true;

                //Borramos mensajes de error anteriores si los hay
                if ($("#nombreError").length !== 0) {
                    $("#nombreError").remove();
                }

                if ($("#apellido1Error").length !== 0) {
                    $("#apellido1Error").remove();
                }
                if ($("#apellido2Error").length !== 0) {
                    $("#apellido2Error").remove();
                }

                if ($("#passError").length !== 0) {
                    $("#passError").remove();
                }

                if ($("#emailError").length !== 0) {
                    $("#emailError").remove();
                }


                //Comprobamos todos los campos, mostrando un error en aquellos que los haya
                if (nombre.value === "") {
                    var aux = document.createElement("p");
                    aux.setAttribute("id", "nombreError");
                    aux.setAttribute("class", "error");
                    aux.innerHTML = "Introduzca un nombre.";
                    $("#nombre").after(aux);
                    bool = false;
                } else {
                    if (exp.test(String(nombre.value))) {
                        var aux = document.createElement("p");
                        aux.setAttribute("id", "nombreError");
                        aux.setAttribute("class", "error");
                        aux.innerHTML = "Introduzca un nombre correcto.";
                        $("#nombre").after(aux);
                        bool = false;
                    }
                }

                if (apellido1.value === "") {
                    var aux = document.createElement("p");
                    aux.setAttribute("id", "apellido1Error");
                    aux.setAttribute("class", "error");
                    aux.innerHTML = "Introduzca un apellido.";
                    $("#apellido1").after(aux);
                    bool = false;
                } else {
                    if (exp.test(String(nombre.value))) {
                        var aux = document.createElement("p");
                        aux.setAttribute("id", "apellido1Error");
                        aux.setAttribute("class", "error");
                        aux.innerHTML = "Introduzca un apellido correcto.";
                        $("#apellido1Error").after(aux);
                        bool = false;
                    }
                }
                if (apellido2.value === "") {
                    var aux = document.createElement("p");
                    aux.setAttribute("id", "apellido2Error");
                    aux.setAttribute("class", "error");
                    aux.innerHTML = "Introduzca un apellido.";
                    $("#apellido2").after(aux);
                    bool = false;
                } else {
                    if (exp.test(String(nombre.value))) {
                        var aux = document.createElement("p");
                        aux.setAttribute("id", "apellido2Error");
                        aux.setAttribute("class", "error");
                        aux.innerHTML = "Introduzca un apellido correcto.";
                        $("#apellido2").after(aux);
                        bool = false;
                    }
                }

                if (pass.value === "") {
                    var aux = document.createElement("p");
                    aux.setAttribute("id", "passError");
                    aux.setAttribute("class", "error");
                    aux.innerHTML = "Introduzca una contrase&ntilde;a.";
                    $("#password").after(aux);
                    bool = false;
                } else {
                    if (passExp.test(String(pass.value))) {
                        var aux = document.createElement("p");
                        aux.setAttribute("id", "passError");
                        aux.setAttribute("class", "error");
                        aux.innerHTML = "Introduzca una contraseña correcta.";
                        $("#password").after(aux);
                        bool = false;
                    }
                }



                if (email.value === "") {
                    var aux = document.createElement("p");
                    aux.setAttribute("id", "emailError");
                    aux.setAttribute("class", "error");
                    aux.innerHTML = "Introduzca un correo electronico.";
                    $("#email").after(aux);
                    bool = false;
                } else {
                    if (!emailExp.test(String(email.value))) {
                        var aux = document.createElement("p");
                        aux.setAttribute("id", "emailError");
                        aux.setAttribute("class", "error");
                        aux.innerHTML = "Introduzca un email valido.";
                        $("#email").after(aux);
                        bool = false;
                    }
                }


                return bool;
            }

            //Funcion que comprueba la fortaleza de la contraseña
            function passStrenght() {
                $("#password").pStrength({
                    'changeBackground': false,
                    'passwordValidForm': 50,
                    'backgrounds': [['#cc0000', '#FFF'], ['#cc3333', '#FFF'], ['#cc6666', '#FFF'], ['#ff9999', '#FFF'],
                        ['#e0941c', '#FFF'], ['#efd09e', '#FFF'],
                        ['#ccffcc', '#FFF'], ['#66cc66', '#FFF'], ['#339933', '#FFF'], ['#006600', '#FFF'], ['#105610', '#FFF']],
                    'onValidatePassword': function (percentage) {
                        $('#' + $(this).data('display')).html($('#' + $(this).data('display')).html() + 'La contraseña es optima para registro');
                        $('#formulario').submit(function () {
                            return true;
                        });
                    },
                    'onPasswordStrengthChanged': function (passwordStrength, percentage) {
                        if ($(this).val()) {
                            $.fn.pStrength('changeBackground', this, passwordStrength);
                        } else {
                            $.fn.pStrength('resetStyle', this);
                        }
                        $('#' + $(this).data('display')).html('Porcentaje de seguridad:' + percentage + '%');
                    }
                });
            }
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
                        <li class="vertical"><a href="login.php">Iniciar sesi&oacute;n</a></li>
                    <?php } ?>
                </ul>
            </nav>
        </header>
        <?php

        function soloImagenes($fichero) {
            $tiposAceptados = Array('image/jpg', 'image/jpeg', 'image/png');
            if (array_search($fichero['type'], $tiposAceptados) === false)
                return false;
            else
                return true;
        }

        if (isset($_POST['btnEnviar'])) {
            $valid_file = TRUE;
            $nombre = $_POST['nombre'];
            $apellido1 = $_POST['apellido1'];
            $apellido2 = $_POST['apellido2'];
            $correo = $_POST['correo'];
            $password = $_POST['password'];
            $foto = $_FILES['foto']['tmp_name'];

            if ($_FILES['foto']['name']) {
                //Si no hay errores
                if ($_FILES['foto']['error'] == 0) {
                    if (soloImagenes($_FILES['foto'])) {
                        //Cogemos el nombre del fichero
                        $new_file_name = strtolower($_FILES['foto']['tmp_name']); //Lo renombramos
                        if ($_FILES['foto']['size'] > (2048000)) { //Si el fichero es menor que 2MB
                            $valid_file = FALSE;
                        }

                        //Si ha pasado bien 
                        if ($valid_file) {
                            $ruta = "userImgs/" . time() . $_FILES['foto']['name'];
                            $foto = 'userImgs/' . $new_file_name;
                        }
                    }
                }
            }
            //Si foto ok
            if (isset($ruta)) {
                $nombre = filter_var($nombre, FILTER_SANITIZE_MAGIC_QUOTES);
                $apellido1 = filter_var($apellido1, FILTER_SANITIZE_MAGIC_QUOTES);
                $apellido2 = filter_var($apellido2, FILTER_SANITIZE_MAGIC_QUOTES);
                $correo = filter_var($correo, FILTER_SANITIZE_MAGIC_QUOTES);
                $password = filter_var($password, FILTER_SANITIZE_MAGIC_QUOTES);
                $foto = filter_var($ruta, FILTER_SANITIZE_MAGIC_QUOTES);

                if (createUsuario($nombre, $apellido1, $apellido2, $correo, $password, $foto, $_POST['ciudades'], $_POST['equipos'])) {
                    //Una vez que se ha insertado en Base de datos, trato la ruta de la foto y la muevo
                    move_uploaded_file($_FILES['foto']['tmp_name'], $ruta);
                    ?>
                    <!--Mensaje de exito-->
                    <article class="contenedor2 generico">
                        <p>Su cuenta se ha creado con éxito</p>
                        <form method="post" action="./index.php">
                            <input  type="submit" value="Iniciar sesi&oacute;n"/>
                        </form>
                    </article>
                    <?php
                } else {
                    ?>
                    <article class="contenedor2 generico">
                        <p>El usuario ya existe</p>
                        <form method="post" action="./registro.php">
                            <input type="submit" value="Volver"/>
                        </form>
                    </article>
                    <?php
                }
            } else {
                ?>
                <article class="contenedor3">
                    <p>El fichero debe ser jpg,png o jpeg y debe ser inferior a 2MB</p>
                    <form method="post" action="./registro.php">
                        <input type="submit" value="Volver"/>
                    </form>
                </article>
                <?php
            }
        }



        //En este caso se muestra un formulario de registro
        if (!isset($_POST['btnEnviar'])) {
            ?>

            <section class="bodyRegistro generico">

                <div class="form-style">

                    <div class="form-style-heading">Registro en Social Football</div>
                    <form action="#" method="POST" enctype="multipart/form-data" >
                        <label><span>Nombre: <span class="required">*</span></span><input id="nombre" type="text" class="input-field" name="nombre" value="" /></label>
                        <label><span>Primer apellido: <span class="required">*</span></span><input id="apellido1" type="text" class="input-field" name="apellido1" value="" /></label>
                        <label><span>Segundo apellido: <span class="required">*</span></span><input id="apellido2" type="text" class="input-field" name="apellido2" value="" /></label>
                        <label><span>Email: <span class="required">*</span></span><input id="email" type="email" class="input-field" name="correo" value="" /></label>
                        <label><span>Password: <span class="required">*</span></span><input id="password" type="password" class="input-field" name="password" onkeyup="passStrenght();" data-display="displayElement" value=""/></label>
                        <div id="displayElement" class="displayElement"></div>
                        <label><span>Foto: <span class="required">*</span></span><input type="file" name="foto" /></label>
                        <label><span>Ciudad:</span><select name="ciudades" class="select-field">
                                <option value="A Coru&ntilde;a">A coru&ntilde;a</option>
                                <option value="&Aacute;lava">&Aacute;lava</option>
                                <option value="Albacete">Albacete</option>
                                <option value="Alicante">Alicante</option>
                                <option value="Almer&iacute;a">Almer&iacute;a</option>
                                <option value="Asturias">Asturias</option>
                                <option value="&Aacute;vila">&Aacute;vila</option>
                                <option value="Badajoz">Badajoz</option>
                                <option value="Baleares">Baleares</option>
                                <option value="Barcelona">Barcelona</option>
                                <option value="Burgos">Burgos</option>
                                <option value="C&aacute;ceres">C&aacute;ceres</option>
                                <option value="C&aacute;diz">C&aacute;diz</option>
                                <option value="Cantabria">Cantabria</option>
                                <option value="Castell&oacute;n">Castell&oacute;n</option>
                                <option value="Ceuta">Ceuta</option>
                                <option value="Ciudad Real">Ciudad Real</option>
                                <option value="C&oacute;rdoba">C&oacute;rdoba</option>
                                <option value="Cuenca">Cuenca</option>
                                <option value="Girona">Girona</option>
                                <option value="Granada">Granada</option>
                                <option value="Guadalajara">Guadalajara</option>
                                <option value="Gipuzkoa">Gipuzkoa</option>
                                <option value="Huelva">Huelva</option>
                                <option value="Huesca">Huesca</option>
                                <option value="Ja&eacute;n">Ja&eacute;n</option>
                                <option value="La Rioja">La Rioja</option>
                                <option value="Las Palmas">Las Palmas</option>
                                <option value="Le&oacute;n">Le&oacute;n</option>
                                <option value="L&eacute;rida">L&eacute;rida</option>
                                <option value="Lugo">Lugo</option>
                                <option value="Madrid">Madrid</option>
                                <option value="M&aacute;laga">M&aacute;laga</option>
                                <option value="Melilla">Melilla</option>
                                <option value="Murcia">Murcia</option>
                                <option value="Navarra">Navarra</option>
                                <option value="Orense">Orense</option>
                                <option value="Palencia">Palencia</option>
                                <option value="Pontevedra">Pontevedra</option>
                                <option value="Salamanca">Salamanca</option>
                                <option value="Segovia">Segovia</option>
                                <option value="Sevilla">Sevilla</option>
                                <option value="Soria">Soria</option>
                                <option value="Tarragona">Tarragona</option>
                                <option value="Santa Cruz de Tenerife">Santa Cruz de Tenerife</option>
                                <option value="Teruel">Teruel</option>
                                <option value="Toledo">Toledo</option>
                                <option value="Valencia">Valencia</option>
                                <option value="Valladolid">Valladolid</option>
                                <option value="Vizcaya">Vizcaya</option>
                                <option value="Zamora">Zamora</option>
                                <option value="Zaragoza">Zaragoza</option>
                            </select></label>
                        <label><span>Equipos:</span> <?php muestraEquipos(); ?></label>  
                        <div class="derecha">                    
                            <input type="submit" class="buttonSpecial" name="btnEnviar" value="Enviar" onclick="return validacionRegistro()"/>
                            <input  type="submit" class="buttonSpecial" name="volver" value="Cancelar" /> 
                        </div>
                    </form>

                </div>
            </section>
            <?php
        }
        include './footer.php';
        ?>
    