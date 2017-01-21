<?php

require_once './CRUD/CRUDUsuario.php';

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
        //estado_peticion ==> 0 -> en espera, 1-> aceptada
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
    if (mysqli_num_rows($result) == 1) {
        $col = mysqli_fetch_array($result);
        $_SESSION['estado_peticion'] = $col['estado_peticion'];
        $_SESSION['fecha_peticion'] = $col['fecha_peticion'];
        $_SESSION['id_usuario_peticion'] = $col['id_usuario_peticion'];
        $_SESSION['id_usuario_recibe'] = $col['id_usuario_recibe'];
    }
    mysqli_close($con);
}

//Edita los datos de una peticion
function updatePeticion_amistad($id, $estado, $id_usuario_peticion, $id_usuario_recibe) {
    $con = conectaBD();

    mysqli_query($con, 'UPDATE peticion_amistad SET estado_peticion = ' . $estado . ', id_usuario_peticion = ' . $id_usuario_peticion . ', id_usuario_recibe = ' . $id_usuario_recibe . ' WHERE id_peticion = ' . $id);

    mysqli_close($con);
}

//Elimina una peticion
function deletePeticion_amistad($id) {
    $con = conectaBD();

    mysqli_query($con, 'DELETE FROM peticion_amistad WHERE id_peticion = ' . $id);

    mysqli_close($con);
}

function listarAmigos() {
    $con = conectaBD();

    $sqlQuery = "SELECT * FROM peticion_amistad WHERE (id_usuario_peticion= " . $_SESSION['id_usuario_login'] . " OR id_usuario_recibe= " . $_SESSION['id_usuario_login'] . ") AND estado_peticion = 1";
    $result = mysqli_query($con, $sqlQuery);

    //Muestro todos los titulares en forma de enlace. 
    while ($col = mysqli_fetch_array($result)) {
        if ($col['id_usuario_peticion'] == $_SESSION['id_usuario_login']) {
            //Mostrar datos usuario id_usuario_recibe
            readUsuarioID($col['id_usuario_recibe']);
            echo '<tr><td><img src="' . $_SESSION['foto_usuario_ID'] . '" width="40px"/>' . ' </td><td>' . $_SESSION['nombre_usuario_ID'] . ' ' . $_SESSION['apellido1_usuario_ID'] . '</td></tr>';
        } else {
            //Mostrar datos usuario id_usuario_peticion
            readUsuarioID($col['id_usuario_peticion']);
            echo '<tr><td><img src="' . $_SESSION['foto_usuario_ID'] . '" width="40px"/>' . '</td><td> ' . $_SESSION['nombre_usuario_ID'] . ' ' . $_SESSION['apellido1_usuario_ID'] . '</td></tr>';
        }
    }
    mysqli_close($con);
}

function compruebaAmistad($correo_recibe) {
    $existe = FALSE;
    readUsuarioCORREO($correo_recibe);
    $con = conectaBD();
    $result = mysqli_query($con, 'SELECT * FROM peticion_amistad WHERE ((id_usuario_peticion = ' . $_SESSION['id_usuario_login'] . ' AND id_usuario_recibe = ' . $_SESSION['id_usuario_CORREO'] . ') OR (id_usuario_peticion = ' . $_SESSION['id_usuario_CORREO'] . ' AND id_usuario_recibe = ' . $_SESSION['id_usuario_login'] . ')) AND (estado_peticion = 1 OR estado_peticion = 0)');
    if (mysqli_num_rows($result) == 1) {
        $existe = TRUE;
    }
    mysqli_close($con);
    return $existe;
}

//lista todas las peticiones pentientes
function listarPeticionesPendientes() {
    $existe = FALSE;
    $con = conectaBD();
    $result = mysqli_query($con, 'SELECT * FROM peticion_amistad WHERE id_usuario_recibe = ' . $_SESSION['id_usuario_login'] . ' AND estado_peticion = 0');
    if (mysqli_num_rows($result) > 0) {
        $existe = TRUE;
        while ($col = mysqli_fetch_array($result)) {
            readUsuarioID($col['id_usuario_peticion']);
            echo '<tr><td><form action="#" method="POST">';
            echo '<fieldset class="form-style">';
            echo '<input type="hidden" name="idPeticion" value="' . $col['id_peticion'] . '" />';
            echo '<table style="text-align: center;"><tr><td><img src="' . $_SESSION['foto_usuario_ID'] . '" width="40px"/>' . '</td><td> ' . $_SESSION['nombre_usuario_ID'] . ' ' . $_SESSION['apellido1_usuario_ID'] . '</td></tr>';
            echo '<tr><td><input type="submit" value="Aceptar" class="buttonSpecial" name="btnAceptar" /></td>';
            echo '<td><input type="submit" value="Rechazar" class="buttonSpecial" name="btnRechazar" onclick="return confirmDel()" /></td></tr></table>';
            echo '</fieldset>';
            echo '</form></td></tr>';
        }
    }
    mysqli_close($con);
    return $existe;
}

//cambia el estado de la peticion a "aceptada"
function aceptaPeticion($idPeticion) {
    $con = conectaBD();
    mysqli_query($con, 'UPDATE peticion_amistad SET estado_peticion = 1 WHERE id_peticion = ' . $idPeticion);
    mysqli_close($con);
}

//elimina todas las peticiones enviadas y recibidas por el usuario
function eliminaPeticionesUsuario($idUsuario) {
    $con = conectaBD();
    mysqli_query($con, 'DELETE FROM peticion_amistad WHERE id_usuario_peticion = ' . $idUsuario . ' OR id_usuario_recibe = ' . $idUsuario);
    mysqli_close($con);
}

function numPeticionesPendientes() {
    $numPeticiones = 0;
    $con = conectaBD();
    $result = mysqli_query($con, 'SELECT * FROM peticion_amistad WHERE id_usuario_recibe = ' . $_SESSION['id_usuario_login'] . ' AND estado_peticion = 0');
    while ($col = mysqli_fetch_array($result)) {
        $numPeticiones++;
    }
    mysqli_close($con);
    return $numPeticiones;
}
