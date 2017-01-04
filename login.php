<?php
//Se inicia session
session_start();
include_once './CRUD/CRUDUsuario.php';
//Si se ha pulsado sobre el botón de login
if (isset($_POST['btnLogin'])) {
    if ($_POST['correo'] != "" && $_POST["password"] != "") {

        //Recogida de datos del formulario
        $correo = $_POST['correo'];
        $password = $_POST['password'];

        //Para evitar las inyeciones SQL
        $correo = filter_var($correo, FILTER_SANITIZE_MAGIC_QUOTES);
        $password = filter_var($password, FILTER_SANITIZE_MAGIC_QUOTES);
        
        if (readUsuario($correo, $password)){
            header('location: inicio.php');
        }
    }
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
        /*if (isset($_SESSION['errorLogin']) && $_SESSION['errorLogin'] == True) {
            echo '<span style="color:red"><h3>ERROR, EL USUARIO NO EXISTE</h3></span>';
            session_destroy();
        }*/
        ?>
        <section id="fondo">
            <h2>Social Football</h2>
            <div class="centrar">
                <form action="#" method="POST" class="form-style">

                    <label><span>Email: </span><input type="email" class="input-field" name="correo" value="" required /></label>
                    <label><span>Password: </span><input type="password" class="input-field" name="password" value="" required/></label>

                    <ul>
                        <li>
                            <input type="submit" class="buttonSpecial" name="btnLogin" value="Login"/>

                            <input type="submit" class="buttonSpecial" name="btnRegistro" value="Reg&iacute;strate!"/> 
                        </li>
                    </ul>
                </form>           
            </div>
        </section>


    </body>
</html>