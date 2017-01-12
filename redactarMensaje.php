<?php

include './header.php';
include_once './CRUD/CRUDMensaje.php';
include_once './CRUD/CRUDUsuario.php';

if (isset($_SESSION['usuario_logueado']) && $_SESSION['usuario_logueado']) {
    if (isset($_POST['btnEnviar'])) {
        if ($_POST['usuario_destino'] != "" && $_POST['texto'] != "") {
            if (compruebaSiUsuarioExisteCORREO($_POST['usuario_destino'])) { //Si el usuario existe
                readUsuarioCORREO($_POST['usuario_destino']);
                if ($_SESSION['id_usuario_login'] != $_SESSION['id_usuario_CORREO']) {
                    $_SESSION['existe_ERROR'] = FALSE;
                    $_SESSION['texto_ERROR'] = "";
                    createMensaje($_POST['texto'], $_SESSION['id_usuario_login'], $_SESSION['id_usuario_CORREO']);
                    header('location: mensajes.php');
                } else {
                    $_SESSION['existe_ERROR'] = TRUE;
                    $_SESSION['texto_ERROR'] = "ERROR: No puedes enviarte un correo a ti mismo.";
                    //echo '<span style="color:red"><br><br>ERROR: No puedes enviarte un correo a ti mismo.</span>';
                }
            } else {
                $_SESSION['existe_ERROR'] = TRUE;
                $_SESSION['texto_ERROR'] = "ERROR: El usuario no existe.";
                //echo '<br><br>ERROR: El usuario no existe';
            }
        } else {
            $_SESSION['existe_ERROR'] = TRUE;
            $_SESSION['texto_ERROR'] = "ERROR: Debe rellenar los datos.";
            //echo '<br><br>ERROR: DEBE RELLENAR LOS DATOS';
        }
    } elseif (isset($_POST['btnVolver'])) {
        header("Location: mensajes.php");
    }
    ?>
    <section class="generico2">
        <?php
        if (isset($_SESSION['existe_ERROR']) && $_SESSION['existe_ERROR'] == TRUE) {
            echo '<span style="color:red"><strong>' . $_SESSION['texto_ERROR'] . '</strong></span>';
            $_SESSION['existe_ERROR'] = FALSE;
            $_SESSION['texto_ERROR'] = "";
        }
        ?>
        <form action="#" method="post">
            <span style="color:black">Para:</span> <input type="email" name="usuario_destino" /><br>
            <span style="color:black">Texto:</span><br>
            <textarea style="color:black" rows="5" cols="60" name="texto"></textarea>
            <br><input type="submit" value="Enviar" name="btnEnviar" />
            <input type="submit" value="Volver a mensajes" name="btnVolver" />
        </form>
    </section>
    <?php

} else {
    header('location: login.php');
}
include './footer.php';
?>