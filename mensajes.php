<?php
include './header.php';
include_once './CRUD/CRUDMensaje.php';
include_once './CRUD/CRUDUsuario.php';

if (isset($_SESSION['usuario_logueado']) && $_SESSION['usuario_logueado']) {

    function nombreUsuarioEnvia($id) {
        readUsuarioID($id);
        return $_SESSION['nombre_usuario_ID'] . ' ' . $_SESSION['apellido1_usuario_ID'] . ' ' . $_SESSION['apellido2_usuario_ID'];
    }

    function listaMensajes() {
        $con = conectaBD();

        $result = mysqli_query($con, 'SELECT * FROM mensaje WHERE id_usuario_recibe = ' . $_SESSION['id_usuario_login']);

        while ($col = mysqli_fetch_array($result)) {
            $nombreRemitente = nombreUsuarioEnvia($col['id_usuario_envia']);
            echo '<tr>';
            echo '<td><input type="radio" name="borra" value="' . $col['id_mensaje'] . '"> </td>';
            echo '<td> <a href="leerMensaje.php?id=' . $col['id_mensaje'] . '">';
            if ($col['leido'] == 'no') {
                echo '<strong>' . $nombreRemitente . '</strong>';
            } else {
                echo $nombreRemitente;
            }
            echo'</a></td>';
            echo '</tr>';
        }
        mysqli_close($con);
    }

    if (isset($_POST['btnBorrar'])) {
        if (isset($_POST['borra'])) {
            deleteMensaje($_POST['borra']);
        }
    } elseif (isset($_POST['btnRedactar'])) {
        header("Location: redactarMensaje.php");
    }
    ?>
    <section class="generico2">   
        <form  action="#" method="POST">
            <table width="100%" cellpadding="2" cellspacing="0" border="0" bgcolor="#fff">
                <tr>
                    <td width="1%" > </td>
                    <td width="80%"> Mensajes Recibidos: </td>
                </tr>
                <?php listaMensajes(); ?>
            </table>
            <input type="submit" value="Redactar mensaje" name="btnRedactar" />
            <input type="submit" value="Eliminar mensaje" name="btnBorrar" onclick="return confirmDel()" />
        </form>
    </section>
    <?php
} else {
    header('location: login.php');
}
include './footer.php';
?>