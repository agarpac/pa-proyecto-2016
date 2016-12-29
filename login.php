<?php
//Se inicia session
session_start();
//Si se ha pulsado sobre el botón de login
if (isset($_POST['btnLogin'])){
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
        $db = mysqli_select_db($con,'social_football');
        if (!$db) {
            die("Error al seleccionar la base de datos");
        }

        //Consulta para comprobar si existe o no el usuario
        $result = mysqli_query($con,'SELECT * FROM usuario WHERE correo_usuario LIKE "' . $correo . '" AND pass_usuario LIKE "' . $password . '"');
        
        //Si hay un solo resultado significa que es correcto
        if (mysqli_num_rows($result) == 1) {
            //Se añade al array global Session valores
            $_SESSION['errorLogin'] = False;
            $col = mysqli_fetch_array($result);
            $_SESSION['idUserLogin'] = $col['id_usuario'];
            $_SESSION['nombreUserLogin'] = $col['nombre_usuario'];
            $_SESSION['apellido1UserLogin'] = $col['apellido1_usuario'];
            $_SESSION['apellido2UserLogin'] = $col['apellido2_usuario'];
            //Si es admin se redirige a la página de admin
            if ($col['admin'] == 0) {
                header('location: indexAdministrador.php');
            } elseif ($col['admin'] == 1) {
                header('location: indexCliente.php');
            }
        } else {
            $_SESSION['errorLogin'] = True;
        }
        mysqli_close($con);
    } else {
        echo '<span style="color:red"><h3>Debe rellenar los campos</h3></span>';
    }
}
//Si se pulsa sobre el botón de registrarse, se manda al formulario
if(isset($_POST['btnRegistro'])){
    header('location: registro.php');
}

?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Social Football</title>
    </head>
    <body>
        <?php
        if (isset($_SESSION['errorLogin']) && $_SESSION['errorLogin'] == True) {
            echo '<span style="color:red"><h3>ERROR, EL USUARIO NO EXISTE</h3></span>';
            session_destroy();
        }
        ?>
        <h2>Login</h2>
        <form action="#" method="POST">
            Correo: <input type="email" name="correo" /> <br>
            Password: <input type="password" name="password" /> <br>

            <input type="submit" name="btnLogin" value="Login"/>
            <input type="submit" name="btnRegistro" value="Reg&iacute;strate!"/> <br><br><br>                                
        </form>
    </body>
</html>