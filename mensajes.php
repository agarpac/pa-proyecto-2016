<?php
include './header.php';
include_once './CRUD/CRUDMensaje.php';
include_once './CRUD/CRUDUsuario.php';

if (isset($_SESSION['usuario_logueado']) && $_SESSION['usuario_logueado']) {
    if (isset($_POST['btnBorrar'])) {
        if (isset($_POST['borra'])) {
            deleteMensaje($_POST['borra']);
        }
    }
    if (isset($_POST['btnRedactar'])) {
        header("Location: redactarMensaje.php");
    }
    if (isset($_POST['btnMarcar'])) {
        if (isset($_POST['borra'])) {
            mensajeNoLeido($_POST['borra']);
            header('location: mensajes.php');
        }
    }
    ?>
    <section class="generico2">
        <article id="colPrincipal1">
            <form  action="#" method="POST">
                <table>
                    <tr>
                        <td width="1%" > </td>
                        <td width="80%"> <h4>Mensajes Recibidos</h4></td>
                    </tr>
                    <?php
                    $numMensajes = listaMensajes();
                    if ($numMensajes > 0) {
                        ?>
                    </table>
                    <input type="submit" value="Redactar" name="btnRedactar" />
                    <input type="submit" value="Eliminar" name="btnBorrar" onclick="return confirmDel()" />
                    <input type="submit" value='Marcar como "No leído"' name="btnMarcar" />
                    <?php
                } else {
                    echo '</table>';
                    echo 'No hay mensajes recibidos para mostrar';
                    echo '<br><input type="submit" value="Redactar" name="btnRedactar" />';
                }
                ?>
            </form>
        </article>
    </section>
    <?php
} else {
    header('location: login.php');
}
include './footer.php';
?>