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
if (isset($_POST['btnRechazar'])){
    deletePeticion_amistad($_POST['idPeticion']);
    header('location: amigos.php');
}
if (isset($_POST['btnAceptar'])){
    aceptaPeticion($_POST['idPeticion']);
    header('location: amigos.php');
}
?>
<section class="generico">   
    <article>
        <div id="colPrincipal1">
            <p>Columna 1 (Para pedir )</p>
            <div class="search-box">
                <form action="#" method="POST">
                    <input type="text" id="autoc" name="mailUser" autocomplete="off" placeholder="Busca usuario"/>
                    <input type="submit" class="buttonSpecial" id="amistad" name="buttonAmistad" placeholder="Enviar Peticion" value="Enviar" style="display: none;"/> 
                    <input type="submit" class="buttonSpecial" id="limpiar" name="buttonLimpiar" placeholder="Limpiar" value="Limpiar" style="display: none;" onclick="limpiaTexto(this)"/> 
                    <div class="result"></div>
                </form>
            </div>

        </div>
        <div id="colPrincipal2">
            <p>Columna 2 (Para listar a los amigos )</p>
            <?php listarAmigos(); ?>
        </div>
        <div id="colPrincipal3">
            <p>Columna 3 (Para ver las peticiones )</p>
            <table>
                <?php
                if (!listarPeticionesPendientes()) {
                    echo '<tr><td>No hay peticiones pendientes</td></tr>';
                }
                ?>
            </table>
        </div>
    </article>
</section>
<?php include './footer.php'; ?>
