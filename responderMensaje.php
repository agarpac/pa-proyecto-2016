<?php
include './header.php';
include_once './CRUD/CRUDMensaje.php';
include_once './CRUD/CRUDUsuario.php';

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
<section class="generico2">
    <form action="#" method="post">
        <span style="color:black">Para:</span> <input type="email" name="usuario_destino" value="<?php echo $_SESSION['correo_usuario_ID']; ?>" disabled /><br>
        <span style="color:black">Mensaje Recibido:</span><br>
        <textarea style="color:black" rows="5" cols="60" name="textoRecibido" disabled><?php echo $_COOKIE['texto_mensaje']; unset($_COOKIE["texto_mensaje"]);?></textarea><br>
        <span style="color:black">Texto: </span><br>
        <textarea style="color:black" rows="5" cols="60" name="texto"></textarea><br>
        <input type="submit" value="Enviar" name="btnEnviar" />
        <input type="submit" value="Volver a mensajes" name="btnVolver" />
    </form>
</section>
<?php
include './footer.php';
?>