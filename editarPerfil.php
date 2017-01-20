<?php
include './header.php';
//include_once './CRUD/CRUDUsuario.php';
include_once './CRUD/CRUDEquipo.php';
include_once './CRUD/CRUDMensaje.php';
include_once './CRUD/CRUDPeticion_amistad.php';
include_once './CRUD/CRUDPartido.php';

if (isset($_SESSION['usuario_logueado']) && $_SESSION['usuario_logueado']) {
    readUsuarioID($_SESSION['id_usuario_login']);
    
    if (isset($_POST['btnAceptar'])){
        if ($_POST['nombre'] != "" && $_POST['apellido1'] != "" && $_POST['apellido2'] != "" && $_POST['password'] != ""){
            updateUsuario($_SESSION['id_usuario_login'], $_POST['nombre'], $_POST['apellido1'], $_POST['apellido2'], $_POST['password'], $_POST['ciudades'], $_POST['equipos']);
            $pass = md5($_POST['password']);
            readUsuario($_SESSION['correo_usuario_login'], $pass);
            header('location: inicio.php');
        } else {
            echo '<script type="text/javascript">alert("Debe rellenar todos los datos");</script>';
        }
    }
    if (isset($_POST['btnVolver'])){
        header('location: inicio.php');
    }
    if (isset($_POST['btnEliminar'])){
        unlink($_SESSION['foto_usuario_login']);// elimino su foto de perfil
        eliminaMensajesUsuario($_SESSION['id_usuario_login']);
        eliminaPeticionesUsuario($_SESSION['id_usuario_login']);
        eliminaSuscripcionesUsuario($_SESSION['id_usuario_login']);
        deleteUsuario($_SESSION['id_usuario_login']);
        $_SESSION['usuario_logueado'] = FALSE;
        unset($_SESSION['usuario_logueado']);
        header('location: index.php');
    }
    ?>
    <section class="generico2">
        <form action="#" method="post">
            <table>
                <tr>
                    <td><img src="<?php echo $_SESSION['foto_usuario_login']; ?>" alt="<?php echo $_SESSION['nombre_usuario_login']; ?>" height="150"></a></td>
                    <td><h1>Perfil de <?php echo $_SESSION['nombre_usuario_login'] . ' ' . $_SESSION['apellido1_usuario_login'] . ' ' . $_SESSION['apellido2_usuario_login']; ?></h1></td>
                </tr>
            </table>
            <label><span>Nombre: <span class="required">*</span></span><input id="nombre" type="text" class="input-field" name="nombre" value="<?php echo $_SESSION['nombre_usuario_login']; ?>" /></label><br>
            <label><span>Primer apellido: <span class="required">*</span></span><input id="apellido1" type="text" class="input-field" name="apellido1" value="<?php echo $_SESSION['apellido1_usuario_login']; ?>" /></label><br>
            <label><span>Segundo apellido: <span class="required">*</span></span><input id="apellido2" type="text" class="input-field" name="apellido2" value="<?php echo $_SESSION['apellido2_usuario_login']; ?>" /></label><br>
            <label><span>Email: </span><input id="email" type="email" class="input-field" name="correo" value="<?php echo $_SESSION['correo_usuario_login']; ?>" readonly disabled/></label><br>
            <label><span>Password: <span class="required">*</span></span><input id="password" type="password" class="input-field" name="password" onkeyup="passStrenght();" data-display="displayElement" value=""/></label><br>
            <label><span>Ciudad:</span><select name="ciudades" class="select-field">
                    <option value="A Coru&ntilde;a">A coru&ntilde;a</option>
                    <option value="&Aacute;lava">&Aacute;lava</option>
                    <option value="Albacete">Albacete</option>
                    <option value="Alicante">Alicante</option>
                    <option value="Almer&iacute;a">Almer&iacute;a</option>
                    <option value="Asturias">Asturias</option>
                    <option value="&Aacute;vila">&Aacute;vila</option>
                    <option value="Badajoz">Badajoz</option>
                    <option value="Baleares">Baleares</option>
                    <option value="Barcelona">Barcelona</option>
                    <option value="Burgos">Burgos</option>
                    <option value="C&aacute;ceres">C&aacute;ceres</option>
                    <option value="C&aacute;diz">C&aacute;diz</option>
                    <option value="Cantabria">Cantabria</option>
                    <option value="Castell&oacute;n">Castell&oacute;n</option>
                    <option value="Ceuta">Ceuta</option>
                    <option value="Ciudad Real">Ciudad Real</option>
                    <option value="C&oacute;rdoba">C&oacute;rdoba</option>
                    <option value="Cuenca">Cuenca</option>
                    <option value="Girona">Girona</option>
                    <option value="Granada">Granada</option>
                    <option value="Guadalajara">Guadalajara</option>
                    <option value="Gipuzkoa">Gipuzkoa</option>
                    <option value="Huelva">Huelva</option>
                    <option value="Huesca">Huesca</option>
                    <option value="Ja&eacute;n">Ja&eacute;n</option>
                    <option value="La Rioja">La Rioja</option>
                    <option value="Las Palmas">Las Palmas</option>
                    <option value="Le&oacute;n">Le&oacute;n</option>
                    <option value="L&eacute;rida">L&eacute;rida</option>
                    <option value="Lugo">Lugo</option>
                    <option value="Madrid">Madrid</option>
                    <option value="M&aacute;laga">M&aacute;laga</option>
                    <option value="Melilla">Melilla</option>
                    <option value="Murcia">Murcia</option>
                    <option value="Navarra">Navarra</option>
                    <option value="Orense">Orense</option>
                    <option value="Palencia">Palencia</option>
                    <option value="Pontevedra">Pontevedra</option>
                    <option value="Salamanca">Salamanca</option>
                    <option value="Segovia">Segovia</option>
                    <option value="Sevilla">Sevilla</option>
                    <option value="Soria">Soria</option>
                    <option value="Tarragona">Tarragona</option>
                    <option value="Santa Cruz de Tenerife">Santa Cruz de Tenerife</option>
                    <option value="Teruel">Teruel</option>
                    <option value="Toledo">Toledo</option>
                    <option value="Valencia">Valencia</option>
                    <option value="Valladolid">Valladolid</option>
                    <option value="Vizcaya">Vizcaya</option>
                    <option value="Zamora">Zamora</option>
                    <option value="Zaragoza">Zaragoza</option>
                </select></label>
            <label><span>Equipos:</span> <?php muestraEquipos(); ?></label>

            <br><input type="submit" value="Aceptar" name="btnAceptar" />
            <input type="submit" value="Volver" name="btnVolver" />
            <input type="submit" value="Eliminar mi cuenta" name="btnEliminar" onclick="return confirmDel()" style="float: right" />
        </form>
    </section>
    <?php
} else {
    header('location: login.php');
}
include './footer.php';
