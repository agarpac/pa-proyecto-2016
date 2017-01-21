<?php
include './header.php';
include_once './CRUD/CRUDMensaje.php';
include_once './CRUD/CRUDUsuario.php';
if (isset($_SESSION['usuario_logueado']) && $_SESSION['usuario_logueado']) {
    if (isset($_POST['btnEnviar'])) {
        if ($_POST['texto'] != "") {
            readUsuarioCORREO($_SESSION['correo_usuario_ID']);
            createMensaje($_POST['texto'], $_SESSION['id_usuario_login'], $_SESSION['id_usuario_CORREO']);
            header("location: mensajes.php");
        } else {
            echo '<script type="text/javascript">alert("Debe rellenar el campo de texto.");</script>';
        }
    }
    if (isset($_POST['btnVolver'])) {
        header("location: mensajes.php");
    }
    ?>
    <section class="bodyRegistro generico">
        <div class="form-style">
            <div class="form-style-heading">Respondiendo al mensaje:</div>
            <form action="#" method="post">
                <label><span>Para:</span> <input type="email" class="input-field" name="usuario_destino" value="<?php echo $_SESSION['correo_usuario_ID']; ?>" disabled /></label>
                <label><span>Mensaje Recibido:</span>
                    <textarea style="color:black; resize:none;" class="input-field" rows="5" cols="60" name="textoRecibido" disabled><?php
                        echo $_COOKIE['texto_mensaje'];
                        unset($_COOKIE["texto_mensaje"]);
                        ?></textarea></label>
                <label><span>Texto:</span>
                    <textarea style="color:black; resize:none;" class="input-field" rows="5" cols="60" name="texto"></textarea></label>
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
