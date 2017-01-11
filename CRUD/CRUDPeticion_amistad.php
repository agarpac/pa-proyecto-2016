<?php

require_once './conexionBD.php';

//Comprueba si existe una peticion creada a ese usuario
function peticionCreada($id_usuario_peticion, $id_usuario_recibe) {
    $existe = False;
    $con = conectaBD();
    $result = mysqli_query($con, 'SELECT estado_peticion FROM peticion_amistad '
            . 'WHERE id_usuario_peticion = ' . $id_usuario_peticion . ' AND id_usuario_recibe = ' . $id_usuario_recibe);

    if (mysqli_num_rows($result) == 1) {
        $col = mysqli_fetch_array($result);
        if ($col['estado_peticion'] == 0 || $col['estado_peticion'] == 1) {
            $existe = True;
        }
    }
    mysqli_close($con);
    return $existe;
}

//Comprueba si existe una peticion creada por el usuario al que se la voy a mandar
function peticionRecibida($id_usuario_peticion, $id_usuario_recibe) {
    $existe = False;
    $con = conectaBD();
    $result = mysqli_query($con, 'SELECT estado_peticion FROM peticion_amistad '
            . 'WHERE id_usuario_peticion = ' . $id_usuario_recibe . ' AND id_usuario_recibe = ' . $id_usuario_peticion);

    if (mysqli_num_rows($result) == 1) {
        $col = mysqli_fetch_array($result);
        if ($col['estado_peticion'] == 0 || $col['estado_peticion'] == 1) {
            $existe = True;
        }
    }
    mysqli_close($con);
    return $existe;
}

//Crea una peticion de amistad
function createPeticion_amistad($id_usuario_peticion, $id_usuario_recibe) {
    if (!peticionCreada($id_usuario_peticion, $id_usuario_recibe) && !peticionRecibida($id_usuario_peticion, $id_usuario_recibe)) {
        $con = conectaBD();
        //estado_peticion ==> 0 -> en espera, 1-> aceptada, 2 -> cancelada
        mysqli_query($con, 'INSERT INTO peticion_amistad (estado_peticion, fecha_peticion, id_usuario_peticion, id_usuario_recibe) '
                . 'VALUES (0, "' . date('d/m/Y') . '", ' . $id_usuario_peticion . ', ' . $id_usuario_recibe . ')');

        mysqli_close($con);
    } else {
        echo 'La peticion está creada o ya existe una amistad entre vosotros';
    }
}

//Lee los datos de una peticion de amistad
function readPeticion_amistad($id) {
    $con = conectaBD();
    
    $result = mysqli_query($con, 'SELECT * FROM peticion_amistad WHERE id_peticion = ' . $id);
    if(mysqli_num_rows($result) == 1){
        $col = mysqli_fetch_array($result);
        $_SESSION['estado_peticion'] = $col['estado_peticion'];
        $_SESSION['fecha_peticion'] = $col['fecha_peticion'];
        $_SESSION['id_usuario_peticion'] = $col['id_usuario_peticion'];
        $_SESSION['id_usuario_recibe'] = $col['id_usuario_recibe'];
    }
    mysqli_close($con);
}

//Edita los datos de una peticion
function updatePeticion_amistad($id, $estado, $id_usuario_peticion, $id_usuario_recibe){
    $con = conectaBD();
    
    mysqli_query($con, 'UPDATE peticion_amistad SET estado_peticion = ' . $estado . ', id_usuario_peticion = ' . $id_usuario_peticion . ', id_usuario_recibe = ' . $id_usuario_recibe . ' WHERE id_peticion = ' . $id);

    mysqli_close($con);
}

//Elimina una peticion
function deletePeticion_amistad($id){
    $con = conectaBD();
    
    mysqli_query($con, 'DELETE FROM peticion_amistad WHERE id_peticion = ' . $id);
    
    mysqli_close($con);
}