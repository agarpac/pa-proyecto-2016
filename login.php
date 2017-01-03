<?php
//Se inicia session
session_start();
//Si se ha pulsado sobre el botón de login
if (isset($_POST['btnLogin'])) {
    if ($_POST['correo'] != "" && $_POST["password"] != "") {

        //Recogida de datos del formulario
        $correo = $_POST['correo'];
        $password = $_POST['password'];

        //Para evitar las inyeciones SQL
        $correo = filter_var($correo, FILTER_SANITIZE_MAGIC_QUOTES);
        $password = filter_var($password, FILTER_SANITIZE_MAGIC_QUOTES);

        //Conexión a base de datos
        $con = mysqli_connect("localhost", "root", "");

        if (!$con) {
            die("Error al conectarse a la base de datos");
        }

        //Seleccion de base de datos
        $db = mysqli_select_db($con, 'social_football');
        if (!$db) {
            die("Error al seleccionar la base de datos");
        }

        //Consulta para comprobar si existe o no el usuario
        $result = mysqli_query($con, 'SELECT * FROM usuario WHERE correo_usuario LIKE "' . $correo . '" AND pass_usuario LIKE "' . $password . '"');

        //Si hay un solo resultado significa que es correcto
        if (mysqli_num_rows($result) == 1) {
            //Se añade al array global Session valores
            $_SESSION['errorLogin'] = False;
            $col = mysqli_fetch_array($result);
            $_SESSION['idUserLogin'] = $col['id_usuario'];
            $_SESSION['nombreUserLogin'] = $col['nombre_usuario'];
            $_SESSION['apellido1UserLogin'] = $col['apellido1_usuario'];
            $_SESSION['apellido2UserLogin'] = $col['apellido2_usuario'];
            $_SESSION['equipoUser'] = $col['equipo_id'];
            $_SESSION['admin'] = $col['admin'];

            header('location: inicio.php');
        } else {
            $_SESSION['errorLogin'] = True;
        }
        mysqli_close($con);
    } /*else {
        echo '<span style="color:red"><h3>Debe rellenar los campos</h3></span>';
    }*/
}
//Si se pulsa sobre el botón de registrarse, se manda al formulario
if (isset($_POST['btnRegistro'])) {
    header('location: registro.php');
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Social Football</title>
        <link rel="stylesheet" href="css/estilos.css" />
    </head>
    <body>
        <?php
        if (isset($_SESSION['errorLogin']) && $_SESSION['errorLogin'] == True) {
            echo '<span style="color:red"><h3>ERROR, EL USUARIO NO EXISTE</h3></span>';
            session_destroy();
        }
        ?>
        <section id="fondo">
            <h2>Social Football</h2>
            <div class="centrar">
                <form action="#" method="POST" class="form-style">

                    <label><span>Email: </span><input type="email" class="input-field" name="correo" value="" required /></label>
                    <label><span>Password: </span><input type="password" class="input-field" name="password" value="" required/></label>

                    <ul>
                        <li>
                            <input type="submit" class="button special" name="btnLogin" value="Login"/>

                            <input type="submit" class="button special" name="btnRegistro" value="Reg&iacute;strate!"/> 
                        </li>
                    </ul>
                </form>           
            </div>
        </section>


    </body>
</html>