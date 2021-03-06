<?php

require_once './conexionBD.php';

//Comprueba si ya hay alguien con el correo registrado
function compruebaSiCorreoRegistrado($correo) {
    $encontrado = FALSE;

    //Se conecta 
    $con = conectaBD();

    //Realiza consulta
    $result = mysqli_query($con, 'SELECT nombre_usuario, apellido1_usuario FROM usuario WHERE correo_usuario = "' . $correo . '"');

    //Si solo hay un resultado es que está bien

    if (mysqli_num_rows($result) == 1) {
        $encontrado = TRUE;
        $col = mysqli_fetch_array($result);
        $_SESSION['nombre_usuario'] = $col['nombre_usuario'];
        $_SESSION['apellido1_usuario'] = $col['apellido1_usuario'];
    }
    mysqli_close($con);
    return $encontrado;
}

//Recoge los datos del equipo
function datosEquipo($id) {
    //Se conecta
    $con = conectaBD();

    //Realiza una consulta
    $result = mysqli_query($con, 'SELECT nombre_equipo, foto_equipo FROM equipo WHERE id_equipo = ' . $id);
    if (mysqli_num_rows($result) == 1) {
        $col = mysqli_fetch_array($result);
        $_SESSION['nombre_equipo'] = $col['nombre_equipo'];
        $_SESSION['foto_equipo'] = $col['foto_equipo'];
    }
    mysqli_close($con);
}

//Crea un usuario 
function createUsuario($nombre, $apellido1, $apellido2, $correo, $password, $foto, $ciudad, $equipo) {
    $correo = filter_var($correo, FILTER_SANITIZE_MAGIC_QUOTES);
    if (!compruebaSiCorreoRegistrado($correo)) { //Comprueba si el correo ya existe en la base de datos
        $nombre = filter_var($nombre, FILTER_SANITIZE_MAGIC_QUOTES);
        $apellido1 = filter_var($apellido1, FILTER_SANITIZE_MAGIC_QUOTES);
        $apellido2 = filter_var($apellido2, FILTER_SANITIZE_MAGIC_QUOTES);
        $password = filter_var($password, FILTER_SANITIZE_MAGIC_QUOTES);
        $password = md5($password);
        $foto = filter_var($foto, FILTER_SANITIZE_MAGIC_QUOTES);

        $con = conectaBD();

        mysqli_query($con, 'INSERT INTO usuario (nombre_usuario, apellido1_usuario, apellido2_usuario, correo_usuario, pass_usuario, foto_usuario, ciudad_usuario, equipo_id, admin) VALUES ("' . $nombre . '", "' . $apellido1 . '", "' . $apellido2 . '", "' . $correo . '", "' . $password . '", "' . $foto . '", "' . $ciudad . '", ' . $equipo . ', 1)');

        mysqli_close($con);
        $flag = TRUE;
    } else {
        $flag = FALSE;
        //echo '<span style="color:red"><h3>Sr. ' . $_SESSION['nombre_usuario'] . ' ' . $_SESSION['apellido1_usuario'] . ' ya est&aacute;s registrado.</h3></span>';
    }
    return $flag;
}

//Lee los datos de un usuario
function readUsuario($correo, $password) {
    $correo = filter_var($correo, FILTER_SANITIZE_MAGIC_QUOTES);
    $password = filter_var($password, FILTER_SANITIZE_MAGIC_QUOTES);

    $con = conectaBD();

    $result = mysqli_query($con, 'SELECT * FROM usuario WHERE correo_usuario = "' . $correo . '" AND pass_usuario = "' . $password . '"');
    if (mysqli_num_rows($result) == 1) {
        $_SESSION['errorLogin'] = False;
        $col = mysqli_fetch_array($result);
        $_SESSION['id_usuario_login'] = $col['id_usuario'];
        $_SESSION['nombre_usuario_login'] = $col['nombre_usuario'];
        $_SESSION['apellido1_usuario_login'] = $col['apellido1_usuario'];
        $_SESSION['apellido2_usuario_login'] = $col['apellido2_usuario'];
        $_SESSION['correo_usuario_login'] = $col['correo_usuario'];
        $_SESSION['foto_usuario_login'] = $col['foto_usuario'];
        $_SESSION['ciudad_usuario_login'] = $col['ciudad_usuario'];
        $_SESSION['equipoUser'] = $col['equipo_id'];
        $_SESSION['admin'] = $col['admin'];
        $_SESSION['usuario_logueado'] = TRUE;
        datosEquipo($col['equipo_usuario']); //Muestra el nombre y la foto del equipo de ese ID
        $encontrado = True;
    } else {
        $_SESSION['errorLogin'] = True;
        $encontrado = False;
        //echo '<span style="color:red"><h3>El usuario no existe.</h3></span>';
    }
    mysqli_close($con);
    return $encontrado;
}

//Actualiza un usuario
function updateUsuario($id, $nombre, $apellido1, $apellido2, $password, $ciudad, $equipo) {
    $nombre = filter_var($nombre, FILTER_SANITIZE_MAGIC_QUOTES);
    $apellido1 = filter_var($apellido1, FILTER_SANITIZE_MAGIC_QUOTES);
    $apellido2 = filter_var($apellido2, FILTER_SANITIZE_MAGIC_QUOTES);
    $password = filter_var($password, FILTER_SANITIZE_MAGIC_QUOTES);
    $pass = md5($password);

    $con = conectaBD();

    mysqli_query($con, 'UPDATE usuario SET nombre_usuario = "' . $nombre . '", apellido1_usuario = "' . $apellido1 . '", apellido2_usuario = "' . $apellido2 . '", pass_usuario = "' . $pass . '", ciudad_usuario = "' . $ciudad . '", equipo_id = "' . $equipo . '" WHERE id_usuario = ' . $id);

    mysqli_close($con);
}

//Borra un usuario
function deleteUsuario($id) {
    $con = conectaBD();

    mysqli_query($con, 'DELETE FROM usuario WHERE id_usuario = ' . $id);

    mysqli_close($con);
}

//Lee los datos de un usuario a partir de su ID
function readUsuarioID($id) {
    $con = conectaBD();

    $result = mysqli_query($con, 'SELECT * FROM usuario WHERE id_usuario = ' . $id);
    if (mysqli_num_rows($result) == 1) {
        $col = mysqli_fetch_array($result);
        $_SESSION['id_usuario_ID'] = $col['id_usuario'];
        $_SESSION['nombre_usuario_ID'] = $col['nombre_usuario'];
        $_SESSION['apellido1_usuario_ID'] = $col['apellido1_usuario'];
        $_SESSION['apellido2_usuario_ID'] = $col['apellido2_usuario'];
        $_SESSION['correo_usuario_ID'] = $col['correo_usuario'];
        $_SESSION['foto_usuario_ID'] = $col['foto_usuario'];
        $_SESSION['ciudad_usuario_ID'] = $col['ciudad_usuario'];
    }
    mysqli_close($con);
}

//Lee los datos de un usuario a partir de su CORREO, y devuelve True si existe, y False si no
function readUsuarioCORREO($correo) {
    $con = conectaBD();

    $result = mysqli_query($con, 'SELECT * FROM usuario WHERE correo_usuario ="' . $correo . '"');
    if (mysqli_num_rows($result) == 1) {
        $col = mysqli_fetch_array($result);
        $_SESSION['id_usuario_CORREO'] = $col['id_usuario'];
        $_SESSION['nombre_usuario_CORREO'] = $col['nombre_usuario'];
        $_SESSION['apellido1_usuario_CORREO'] = $col['apellido1_usuario'];
        $_SESSION['apellido2_usuario_CORREO'] = $col['apellido2_usuario'];
        $_SESSION['correo_usuario_CORREO'] = $col['correo_usuario'];
        $_SESSION['foto_usuario_CORREO'] = $col['foto_usuario'];
        $_SESSION['ciudad_usuario_CORREO'] = $col['ciudad_usuario'];
    }
    mysqli_close($con);
}

function compruebaSiUsuarioExisteCORREO($correo){
    $existe = FALSE;
    $con = conectaBD();

    $result = mysqli_query($con, 'SELECT * FROM usuario WHERE correo_usuario ="' . $correo . '"');
    if (mysqli_num_rows($result) == 1) {
        $existe = TRUE;
    }
    mysqli_close($con);
    return $existe;
}