<?php

include './header.php';
include_once './CRUD/CRUDEquipo.php';
if (isset($_SESSION['usuario_logueado']) && $_SESSION['usuario_logueado']) {
    if (isset($_POST['btnCancelar'])) {
        header('location: equipos.php');
    }

    function soloImagenes($fichero) {
        $tiposAceptados = Array('image/jpg', 'image/jpeg', 'image/png');
        if (array_search($fichero['type'], $tiposAceptados) === false)
            return false;
        else
            return true;
    }

    if (isset($_POST['btnAceptar'])) {
        $foto = $_FILES['escudo']['tmp_name'];

        if ($_FILES['escudo']['name']) {
            //Si no hay errores
            if ($_FILES['escudo']['error'] == 0) {
                if (soloImagenes($_FILES['escudo'])) {
                    $valid_file = TRUE;
                    //Cogemos el nombre del fichero
                    $new_file_name = strtolower($_FILES['escudo']['tmp_name']); //Lo renombramos
                    if ($_FILES['escudo']['size'] > (2048000)) { //Si el fichero es menor que 2MB
                        $valid_file = FALSE;
                    }
                    //Si ha pasado bien 
                    if ($valid_file) {
                        $ruta = "img/" . time() . $_FILES['escudo']['name'];
                        $foto = 'img/' . $new_file_name;
                    }
                }
            }
        }

        if ($_POST['nombre'] != "" && $_POST['anio'] != "" && isset($ruta)) {
            $foto = filter_var($ruta, FILTER_SANITIZE_MAGIC_QUOTES);
            createEquipo($_POST['nombre'], $_POST['anio'], $foto);
            move_uploaded_file($_FILES['escudo']['tmp_name'], $ruta);
            header('location: equipos.php');
        } else {
            echo '<script type="text/javascript">alert("Debe rellenar todos los datos");</script>';
        }
    }
    ?>
    <section class="generico">   
        <div class="form-style">
            <div class="form-style-heading">Crear equipo:</div>
            <form action="#" method="POST" enctype="multipart/form-data">
                <label><span>Nombre:<span class="required"> * </span></span><input type="text" class="input-field" name="nombre" /></label>
                <label><span>Fundación:<span class="required">*</span></span><input type="number" class="input-field" name="anio" /></label>
                <label><span>Escudo:<span class="required"> * </span></span><input type="file" class="input-field" name="escudo" /></label>
                
                <input type="submit" class="buttonSpecial" value="Aceptar" name="btnAceptar" />
                <input type="submit" class="buttonSpecial" value="Cancelar" name="btnCancelar" />
            </form>
        </div>
    </section>

    <?php

} else {
    header('location: login.php');
}
include './footer.php';
