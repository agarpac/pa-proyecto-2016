<?php
include './header.php';
include_once './CRUD/CRUDMensaje.php';
include_once './CRUD/CRUDUsuario.php';

if (isset($_SESSION['usuario_logueado']) && $_SESSION['usuario_logueado']) {
    if (isset($_POST['btnVolver'])) {
        header('location: mensajes.php');
    }
    if (isset($_POST['btnResponder'])) {
        setcookie("texto_mensaje", $_SESSION['texto_mensaje']);
        header('location: responderMensaje.php');
    }
    mensajeLeido($_GET['id']); //Modifica LEIDO a SI
    readMensaje($_GET['id']);
    readUsuarioID($_SESSION['id_usuario_envia_mensaje']);
    ?>
    <section class="bodyRegistro generico">
        <div class="form-style">
            <form action="#" method="POST">
            <?php
            echo '<span style="color:black"><b>Mensaje de:</b> ' . $_SESSION['nombre_usuario_ID'] . ' ' . $_SESSION['apellido1_usuario_ID'] . ' ' . $_SESSION['apellido2_usuario_ID'];
            echo '<label>' . $_SESSION['texto_mensaje'] . '</label></span>';
            ?>
            
                <input type="submit" class="buttonSpecial" value="Responder" name="btnResponder" />
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