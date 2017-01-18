<?php

require_once './conexionBD.php';

//Crea un mensaje
function createMensaje($texto, $idUsuarioEnvia, $idUsuarioRecibe) {
    $texto = filter_var($texto, FILTER_SANITIZE_MAGIC_QUOTES);

    $con = conectaBD();

    mysqli_query($con, 'INSERT INTO mensaje (texto, leido, id_usuario_envia, id_usuario_recibe) VALUES ("' . $texto . '", "no", ' . $idUsuarioEnvia . ', ' . $idUsuarioRecibe . ')');

    mysqli_close($con);
}

//Lee los datos de un mensaje
function readMensaje($id) {
    $con = conectaBD();

    $result = mysqli_query($con, 'SELECT * FROM mensaje WHERE id_mensaje = ' . $id);

    if (mysqli_num_rows($result) == 1) {
        $col = mysqli_fetch_array($result);
        $_SESSION['texto_mensaje'] = $col['texto'];
        $_SESSION['leido_mensaje'] = $col['leido'];
        $_SESSION['id_usuario_envia_mensaje'] = $col['id_usuario_envia'];
        $_SESSION['id_usuario_recibe_mensaje'] = $col['id_usuario_recibe'];
    }
    mysqli_close($con);
}

//Edita los datos de un mensaje
function updateMensaje($id, $texto, $idUsuarioEnvia, $idUsuarioRecibe) {
    $texto = filter_var($texto, FILTER_SANITIZE_MAGIC_QUOTES);

    $con = conectaBD();

    mysqli_query($con, 'UPDATE mensaje SET texto = "' . $texto . '", id_usuario_envia = ' . $idUsuarioEnvia . ', id_usuario_recibe = ' . $idUsuarioRecibe . ' WHERE id_mensaje = ' . $id);

    mysqli_close($con);
}

//Elimina un mensaje
function deleteMensaje($id) {
    $con = conectaBD();

    mysqli_query($con, 'DELETE FROM mensaje WHERE id_mensaje = ' . $id);

    mysqli_close($con);
}

//Modifica el campo "leido" a "si"
function mensajeLeido($id) {
    $con = conectaBD();

    mysqli_query($con, 'UPDATE mensaje SET leido = "si" WHERE id_mensaje = ' . $id);

    mysqli_close($con);
}

//Modifica el campo "leido" a "no"
function mensajeNoLeido($id) {
    $con = conectaBD();

    mysqli_query($con, 'UPDATE mensaje SET leido = "no" WHERE id_mensaje = ' . $id);

    mysqli_close($con);
}

//Devuelve el numero de mensajes no leidos por el usuario
function numMensajesNoLeidos($id_usuario_recibe){
    $num = 0;
    $con = conectaBD();
    
    $result = mysqli_query($con, 'SELECT leido FROM mensaje WHERE id_usuario_recibe = ' . $id_usuario_recibe);
    
    while ($col = mysqli_fetch_array($result)) {
        if ($col['leido'] == "no"){
            $num++;
        }
    }
    mysqli_close($con);
    return $num;
}