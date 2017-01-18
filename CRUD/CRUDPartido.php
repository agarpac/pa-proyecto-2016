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
function createPartido($fecha, $hora, $id_estadio) {
    if (compruebaSiEstadioLibre($id_estadio, $fecha, $hora)) {
        $con = conectaBD();

        mysqli_query($con, 'INSERT INTO partido (fecha_partido, hora_partido, id_estadio) VALUES ("' . $fecha . '", "' . $hora . '", ' . $id_estadio . ')');
        $result = mysqli_query($con, 'SELECT id_partido FROM partido WHERE fecha_partido ="' . $fecha .'" AND hora_partido="' . $hora . '" AND id_estadio = ' . $id_estadio);
        
        if(mysqli_num_rows($result) == 1){
            $col = mysqli_fetch_array($result);
            $id_partido = $col['id_partido'];
            mysqli_query($con, 'INSERT INTO partido_usuario (id_partido, id_usuario) VALUES ('. $id_partido .', ' . $_SESSION['id_usuario_login'] .')');
        }
        
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