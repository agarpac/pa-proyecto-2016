<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
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
    <br><br>
    <table width="60%" cellpadding="2" cellspacing="0" border="0" bgcolor="#000000">
        <tr>
            <td width="1%" > </td>
            <td width="20%"> Mensajes Recibidos: </td>
        </tr>
        <?php listaMensajes(); ?>
    </table>
    <form action="#" method="POST">
        <input type="submit" value="Redactar mensaje" name="btnRedactar" />
        <input type="submit" value="Eliminar mensaje" name="btnBorrar" />
    </form>
    <?php
} else {
    header('location: login.php');
}
include './footer.php';
?>