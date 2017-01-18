<?php

include './header.php';
require_once './CRUD/CRUDEstadio.php';

if (isset($_POST['btnCrear'])) {
    if ($_POST['nombre'] != "" && $_POST['direccion'] != "") {
        if (createEstadio($_POST['nombre'], $_POST['direccion'], $_POST['ciudad'])) {
            header('location: crearPartido.php');
        } else {
            echo '<script type="text/javascript">alert("Ese estadio existe, y se encuentra en ' . $_SESSION['direccion_estadio_existe'] . '. ' . $_SESSION['ciudad_estadio_existe'] . '.");</script>';
        }
    } else {
        echo '<script type="text/javascript">alert("Debe rellenar todos los datos");</script>';
    }
}

if (isset($_POST['btnCancelar'])) {
    header('location: crearPartido.php');
}
?>
<section class="generico2">   
    <form action="#" method="POST">
        <label><span>Nombre: <span class="required">*</span></span><input type="text" name="nombre" /></label><br>
        <label><span>Dirección: <span class="required">*</span></span><input type="text" name="direccion" /></label><br>
        <label><span>Ciudad: </span><select name="ciudad" class="select-field">
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
            </select> </label><br>
        <input type="submit" value="Crear" name="btnCrear" />
        <input type="submit" value="Cancelar" name="btnCancelar" />
    </form>
</section>
<?php

include './footer.php';
