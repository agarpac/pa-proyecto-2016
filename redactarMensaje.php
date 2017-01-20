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
                    createMensaje($_POST['texto'], $_SESSION['id_usuario_login'], $_SESSION['id_usuario_CORREO']);
                    header('location: mensajes.php');
                } else {
                    echo '<script type="text/javascript">alert("No puedes enviarte un correo a ti mismo.");</script>';
                }
            } else {
                echo '<script type="text/javascript">alert("El usuario no existe.");</script>';
            }
        } else {
            echo '<script type="text/javascript">alert("Debe rellenar los datos.");</script>';
        }
    }
    if (isset($_POST['btnVolver'])) {
        header("Location: mensajes.php");
    }
    ?>
    <section class="generico">
        <div class="form-style">
            <div class="form-style-heading">Redactar mensaje:</div>

            <label><span>Para:</span> <input type="email" class="input-field" name="usuario_destino" /></label>
            <label><span>Texto:</span>
                <textarea style="color:black; resize:none;" class="input-field" rows="5" cols="60" name="texto"></textarea></label>
            <form action="#" method="post">
                <input type="submit" class="buttonSpecial" value="Enviar" name="btnEnviar" />
                <input type="submit" class="buttonSpecial" value="Volver a mensajes" name="btnVolver" />
            </form>
        </div>
    </section>
    <?php

} else {
    header('location: login.php');
}
include './footer.php';
?>