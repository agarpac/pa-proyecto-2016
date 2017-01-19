<?php

require_once './conexionBD.php';

//Comprueba si existe un estadio con ese nombre
function compruebaSiEstadioExiste($nombre) {
    $existe = FALSE;
    $con = conectaBD();
    $result = mysqli_query($con, 'SELECT direccion, ciudad FROM estadio WHERE nombre_estadio = "' . $nombre . '"');

    if (mysqli_num_rows($result) == 1) {
        $existe = TRUE;
        $col = mysqli_fetch_array($result);
        $_SESSION['direccion_estadio_existe'] = $col['direccion'];
        $_SESSION['ciudad_estadio_existe'] = $col['ciudad'];
    }
    mysqli_close($con);
    return $existe;
}

//Crea un estadio
function createEstadio($nombre, $direccion, $ciudad) {
    $nombre = filter_var($nombre, FILTER_SANITIZE_MAGIC_QUOTES);

    if (!compruebaSiEstadioExiste($nombre)) {
        $direccion = filter_var($direccion, FILTER_SANITIZE_MAGIC_QUOTES);
        $ciudad = filter_var($ciudad, FILTER_SANITIZE_MAGIC_QUOTES);

        $con = conectaBD();

        mysqli_query($con, 'INSERT INTO estadio (nombre_estadio, direccion, ciudad) VALUES ("' . $nombre . '", "' . $direccion . '", "' . $ciudad . '")');

        mysqli_close($con);
        return TRUE;
    } else {
        return FALSE;
    }
}

//Lee los datos de un estadio
function readEstadio($id) {
    $con = conectaBD();

    $result = mysqli_query($con, 'SELECT * FROM estadio WHERE id_estadio = ' . $id);

    if (mysqli_num_rows($result) == 1) {
        $col = mysqli_fetch_array($result);
        $_SESSION['nombre_estadio'] = $col['nombre_estadio'];
        $_SESSION['direccion_estadio'] = $col['direccion'];
        $_SESSION['ciudad_estadio'] = $col['ciudad'];
    }
    mysqli_close($con);
}

//Edita los datos de un estadio
function updateEstadio($id, $nombre, $direccion, $ciudad) {
    $nombre = filter_var($nombre, FILTER_SANITIZE_MAGIC_QUOTES);
    $direccion = filter_var($direccion, FILTER_SANITIZE_MAGIC_QUOTES);
    $ciudad = filter_var($ciudad, FILTER_SANITIZE_MAGIC_QUOTES);

    $con = conectaBD();

    mysqli_query($con, 'UPDATE estadio SET nombre_estadio = "' . $nombre . '", direccion = "' . $direccion . '", ciudad = "' . $ciudad . '" WHERE id_estadio = ' . $id);
    mysqli_close($con);
}

//Elimina un estadio
function deleteEstadio($id) {
    $con = conectaBD();

    mysqli_query($con, 'DELETE FROM estadio WHERE id_estadio = ' . $id);

    mysqli_close($con);
}

//Lista todos los estadios para el listBox
function listaEstadios() {
    $con = conectaBD();

    $result = mysqli_query($con, 'SELECT id_estadio, nombre_estadio FROM estadio');
    while ($col = mysqli_fetch_array($result)) {
        echo '<option value = "' . $col['id_estadio'] . '">' . $col['nombre_estadio'] . '</option>';
    }
    mysqli_close($con);
}