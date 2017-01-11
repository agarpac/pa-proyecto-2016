<?php

include './header.php';
include_once './CRUD/CRUDMensaje.php';
include_once './CRUD/CRUDUsuario.php';

if (isset($_SESSION['usuario_logueado']) && $_SESSION['usuario_logueado']) {
    if (isset($_POST['btnEnviar'])) {
        if ($_POST['usuario_destino'] != "" && $_POST['texto'] != "") {
            if (compruebaSiCorreoRegistrado($_POST['usuario_destino'])) { //Si el usuario existe
                readUsuarioCORREO($_POST['usuario_destino']);
                createMensaje($_POST['texto'], $_SESSION['id_usuario_login'], $_SESSION['id_usuario_CORREO']);
                header('location: mensajes.php');
            } else {
                echo '<br><br>ERROR: El usuario no existe';
            }
        } else {
            echo '<br><br>ERROR: DEBE RELLENAR LOS DATOS';
        }
    } elseif (isset($_POST['btnVolver'])) {
        header("Location: mensajes.php");
    }
    ?>
    <section class="generico2">
        <form action="#" method="post">
            <span style="color:black">Para:</span> <input type="text" name="usuario_destino" /><br>
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