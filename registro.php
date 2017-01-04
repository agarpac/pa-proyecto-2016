<?php
include './CRUDUsuario.php';
include_once './conexionBD.php';

function muestraEquipos() {
    $con = conectaBD();
    $result = mysqli_query($con, 'SELECT id_equipo, nombre_equipo, foto_equipo FROM equipo');

    if (mysqli_num_rows($result) != 0) {

        echo '<fieldset>';
        echo '<legend>Elige tu favorito</legend>';
        $i = 0;
        while ($col = mysqli_fetch_array($result)) {
            if ($i < 2) {

                echo '<input type="radio" name="equipos" value="' . $col['id_equipo'] . '" checked />' . '<img src = "' . $col['foto_equipo'] . '" alt = "equipo' . $col['id_equipo'] . '"/> ' . $col['nombre_equipo'];

                $i++;
            } else {
                echo '<label>';
                echo '<input type="radio" name="equipos" value="' . $col['id_equipo'] . '" checked />' . '<img src = "' . $col['foto_equipo'] . '" alt = "equipo' . $col['id_equipo'] . '"/> ' . $col['nombre_equipo'];
                echo '</label>';
                $i = 0;
            }
        }
        echo '</fieldset>';
    } else {
        echo 'No hay equipos para mostrar';
    }
}

if (isset($_POST['btnEnviar'])) {
    if ($_POST['nombre'] != "" && $_POST['apellido1'] != "" && $_POST['apellido2'] != "" && $_POST['correo'] != "" && $_POST['password'] != "") {
        $nombre = $_POST['nombre'];
        $apellido1 = $_POST['apellido1'];
        $apellido2 = $_POST['apellido2'];
        $correo = $_POST['correo'];
        $password = $_POST['password'];
        $foto = $_FILES['foto']['tmp_name'];


        $nombre = filter_var($nombre, FILTER_SANITIZE_MAGIC_QUOTES);
        $apellido1 = filter_var($apellido1, FILTER_SANITIZE_MAGIC_QUOTES);
        $apellido2 = filter_var($apellido2, FILTER_SANITIZE_MAGIC_QUOTES);
        $correo = filter_var($correo, FILTER_SANITIZE_MAGIC_QUOTES);
        $password = filter_var($password, FILTER_SANITIZE_MAGIC_QUOTES);
        $foto = filter_var($foto, FILTER_SANITIZE_MAGIC_QUOTES);

        createUsuario($nombre, $apellido1, $apellido2, $correo, $password, $foto, $_POST['ciudades'], $_POST['equipos']);
        header('location: index.php');
    } else {
        echo '<span style="color:red"><h3>Debe rellenar todos los campos</h3></span>';
    }
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Social Football</title>
        <link rel="stylesheet" href="css/estilos.css" />
    </head>
    <body class="bodyRegistro">
        <section>

            <div class="form-style">

                <div class="form-style-heading">Registro en Social Football</div>
                <form action="#" method="POST" enctype="multipart/form-data">
                    <label><span>Nombre: <span class="required">*</span></span><input type="text" class="input-field" name="nombre" value="" /></label>
                   <!-- Nombre: <input type="text" name="nombre" /> <br> -->
                    <label><span>Primer apellido: <span class="required">*</span></span><input type="text" class="input-field" name="apellido1" value="" /></label>
                   <!-- Primer apellido: <input type="text" name="apellido1" /> <br>-->
                    <label><span>Segundo apellido: <span class="required">*</span></span><input type="text" class="input-field" name="apellido2" value="" /></label>
                     <!-- Segundo apellido: <input type="text" name="apellido2" /> <br>-->
                    <label><span>Email: <span class="required">*</span></span><input type="email" class="input-field" name="correo" value="" /></label>
                    <!--Correo: <input type="email" name="correo" /> <br>-->
                    <label><span>Password: <span class="required">*</span></span><input type="password" class="input-field" name="password" value=""/></label>
                    <!--Password: <input type="password" name="password" /> <br>-->
                    <label><span>Foto: </span><input type="file" name="foto" /></label>
                    <!--Foto: <input type="file" name="foto" /> <br>-->


<!--<input type="file" name="foto" id="foto" class="inputfile"/>
<label for="foto"> el for="" debe tener el mismo nombre que el id del input 
    <span class="buttonSpecial">Subir foto</span>
</label>-->

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
                    <div class="derecha">                    
                        <input type="submit" class="buttonSpecial" name="btnEnviar" value="Enviar"/>
                        <input  type="submit" class="buttonSpecial" name="volver" value="Cancelar" onClick="history.back()"/> 
                    </div>
                </form>

            </div>
        </section>
    </body>
</html>