<?php
include './header.php';
include_once './CRUD/CRUDPeticion_amistad.php';

if (isset($_POST['buttonAmistad'])) {
    if (!compruebaAmistad($_POST['mailUser'])) {
        readUsuarioCORREO($_POST['mailUser']);
        createPeticion_amistad($_SESSION['id_usuario_login'], $_SESSION['id_usuario_CORREO']);
    } else {
        echo '<script type="text/javascript">alert("El usuario ' . $_SESSION['nombre_usuario_CORREO'] . ' ' . $_SESSION['apellido1_usuario_CORREO'] . ' ya es amigo tuyo o hay una petición a la espera de ser aceptada o eliminada.");</script>';
    }
}
if (isset($_POST['btnRechazar'])) {
    deletePeticion_amistad($_POST['idPeticion']);
    header('location: amigos.php');
}
if (isset($_POST['btnAceptar'])) {
    aceptaPeticion($_POST['idPeticion']);
    header('location: amigos.php');
}
?>
<section class="generico">
    <div id="colAmistad">
        <div class="form-style-heading">Buscar amigos:</div>
        <div class="search-box">
            <form action="#" method="POST">
                <span class="form-style">
                    <input type="text" id="autoc" name="mailUser" autocomplete="off" style="margin-bottom: 0.5rem" placeholder="Buscar usuario"/>
                    <input type="submit" class="buttonSpecial" id="amistad" name="buttonAmistad" placeholder="Enviar Peticion" value="Enviar" style="display: none; float: left;"/> 
                    <input type="submit" class="buttonSpecial" id="limpiar" name="buttonLimpiar" placeholder="Limpiar" value="Limpiar" style="display: none; float: right" onclick="limpiaTexto(this)"/> 
                    <div class="result"></div>
                </span>
            </form>
        </div>

    </div>
    <div id="colAmistadScroll">
        <div class="form-style-heading">Mis amigos:</div>
        <table>
            <?php listarAmigos(); ?>
        </table>
    </div>
    <div id="colAmistadScroll">
        <div class="form-style-heading">Mis peticiones pendientes:</div>
        <table style="margin: 0 auto;">
            <?php
            if (!listarPeticionesPendientes()) {
                echo '<tr><td>No hay peticiones pendientes</td></tr>';
            }
            ?>
        </table>
    </div>
</section>
<?php include './footer.php'; ?>
