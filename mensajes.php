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
    <section class="bodyRegistro generico">
        <article class="form-style">
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
                    <input style="margin-top: 40px" type="submit" class="buttonSpecial" value="Redactar" name="btnRedactar" />
                    <input type="submit" value="Eliminar" class="buttonSpecial" name="btnBorrar" onclick="return confirmDel()" />
                    <input type="submit" value='Marcar como "No leído"' class="buttonSpecial" name="btnMarcar" />
                    <?php
                } else {
                    echo '</table>';
                    echo '<label>No hay mensajes recibidos para mostrar</label>';
                    echo '<input style="margin-top: 30px" type="submit" class="buttonSpecial" value="Redactar" name="btnRedactar" />';
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