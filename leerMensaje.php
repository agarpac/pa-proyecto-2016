<?php
include './header.php';
include_once './CRUD/CRUDMensaje.php';
include_once './CRUD/CRUDUsuario.php';

if (isset($_SESSION['usuario_logueado']) && $_SESSION['usuario_logueado']) {
    mensajeLeido($_GET['id']); //Modifica LEIDO a SI

    readMensaje($_GET['id']);

    readUsuarioID($_SESSION['id_usuario_envia_mensaje']);
    echo '<br><br>';
    echo '<span style="color:black"><b>Mensaje de:</b> ' . $_SESSION['nombre_usuario_ID'] . ' ' . $_SESSION['apellido1_usuario_ID'] . ' ' . $_SESSION['apellido2_usuario_ID'] . '<br>';
    echo $_SESSION['texto_mensaje'] . '</span>';
    ?>
    <form action="mensajes.php" method="POST">
        <input type="submit" value="Volver a mensajes" name="btnVolver" />
    </form>
    <?php
} else {
    header('location: login.php');
}
include './footer.php';
?>