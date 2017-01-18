<?php

require_once './conexionBD.php';
require_once './CRUD/CRUDEstadio.php';

//Comprueba si el estadio está ocupado ese dia a esa hora
function compruebaSiEstadioLibre($id_estadio, $fecha, $hora) {
    $libre = TRUE;
    $con = conectaBD();
    $result = mysqli_query($con, 'SELECT fecha_partido, hora_partido FROM partido WHERE id_estadio = ' . $id_estadio);

    while ($col = mysqli_fetch_array($result)) {
        if ($col['fecha_partido'] == $fecha && $col['hora_partido'] == $hora) {
            $libre = FALSE;
        }
    }
    mysqli_close($con);
    return $libre;
}

//Crea un partido nuevo y devuelve un booleano
function createPartido($fecha, $hora, $id_estadio, $id_usuario_creador, $id_usuario_2, $id_usuario_3, $id_usuario_4, $id_usuario_5, $id_usuario_6, $id_usuario_7, $id_usuario_8, $id_usuario_9, $id_usuario_10) {
    if (compruebaSiEstadioLibre($id_estadio, $fecha, $hora)) {
        $con = conectaBD();

        mysqli_query($con, 'INSERT INTO partido (fecha_partido, hora_partido, id_estadio, id_usuario_creador, id_usuario_2, id_usuario_3, id_usuario_4, id_usuario_5, id_usuario_6, id_usuario_7, id_usuario_8, id_usuario_9, id_usuario_10) '
                . 'VALUES ("' . $fecha . '", "' . $hora . '", ' . $id_estadio . ', ' . $id_usuario_creador . ', ' . $id_usuario_2 . ', ' . $id_usuario_3 . ', ' . $id_usuario_4 . ', ' . $id_usuario_5 . ', ' . $id_usuario_6 . ', ' . $id_usuario_7 . ', ' . $id_usuario_8 . ', ' . $id_usuario_9 . ', ' . $id_usuario_10 . ')');

        mysqli_close($con);
        return TRUE;
    } else {
        return FALSE;
    }
}

//Lee los datos de un partido
function readPartido($id) {
    $con = conectaBD();

    $result = mysqli_query($con, 'SELECT * FROM partido WHERE id_partido = ' . $id);

    if (mysqli_num_rows($result) == 1) {
        $col = mysqli_fetch_array($result);
        $_SESSION['fecha_partido'] = $col['fecha_partido'];
        $_SESSION['hora_partido'] = $col['hora_partido'];
        $_SESSION['id_estadio'] = $col['id_estadio'];
        readEstadio($col['id_estadio']);
        $_SESSION['id_usuario_creador'] = $col['id_usuario_creador'];
        $_SESSION['id_usuario_2'] = $col['id_usuario_2'];
        $_SESSION['id_usuario_3'] = $col['id_usuario_3'];
        $_SESSION['id_usuario_4'] = $col['id_usuario_4'];
        $_SESSION['id_usuario_5'] = $col['id_usuario_5'];
        $_SESSION['id_usuario_6'] = $col['id_usuario_6'];
        $_SESSION['id_usuario_7'] = $col['id_usuario_7'];
        $_SESSION['id_usuario_8'] = $col['id_usuario_8'];
        $_SESSION['id_usuario_9'] = $col['id_usuario_9'];
        $_SESSION['id_usuario_10'] = $col['id_usuario_10'];
    }
    mysqli_close($con);
}

//Edita la fecha, hora y/o estadio de un partido y devuelve un booleano
function updatePartido($id_partido, $fecha, $hora, $id_estadio) {
    if (compruebaSiEstadioLibre($id_estadio, $fecha, $hora)) {
        $con = conectaBD();

        mysqli_query($con, 'UPDATE partido SET fecha_partido = "' . $fecha . '", hora_partido = "' . $hora . '", id_estadio = ' . $id_estadio . ' WHERE id_partido = ' . $id_partido);

        mysqli_close($con);
        return TRUE;
    } else {
        return FALSE;
    }
}

//Elimina un partido
function detelePartido($id) {
    $con = conectaBD();

    mysqli_query($con, 'DELETE FROM partido WHERE id_partido = ' . $id);

    mysqli_close($con);
}

//Comprueba si el estadio está vinculado a algun partido
function readPartidoESTADIO($id_estadio) {
    $ocupado = FALSE;
    $con = conectaBD();

    $result = mysqli_query($con, 'SELECT id_partido FROM partido WHERE id_estadio = ' . $id_estadio);

    if (mysqli_num_rows($result) >= 1) {
        $ocupado = TRUE;
    }
    mysqli_close($con);
    return $ocupado;
}