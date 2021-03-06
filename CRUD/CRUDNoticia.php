<?php

require_once './conexionBD.php';

//Recoge los datos del equipo
function datosMiEquipo($id) {
    //Se conecta
    $con = conectaBD();

    //Realiza una consulta
    $result = mysqli_query($con, 'SELECT nombre_equipo, foto_equipo FROM equipo WHERE id_equipo = "' . $id . '"');
    if (mysqli_num_rows($result) == 1) {
        $col = mysqli_fetch_array($result);
        $_SESSION['nombre_equipo'] = $col['nombre_equipo'];
        $_SESSION['foto_equipo'] = $col['foto_equipo'];
    }
    mysqli_close($con);
}

//Crea una noticia
function createNoticia($titular, $texto, $id_equipo, $fecha) {
    $titular = filter_var($titular, FILTER_SANITIZE_MAGIC_QUOTES);
    $texto = filter_var($texto, FILTER_SANITIZE_MAGIC_QUOTES);
    $fecha = filter_var($fecha, FILTER_SANITIZE_MAGIC_QUOTES);

    $con = conectaBD();

    mysqli_query($con, 'INSERT INTO noticia (fecha_noticia, texto_noticia, id_equipo, titular_noticia) VALUES ("' . $fecha . '", "' . $texto . '", ' . $id_equipo . ', "' . $titular . '")');
    mysqli_close($con);
}

//Lee los datos de una noticia
function readNoticia($id_noticia) {
    $con = conectaBD();

    $result = mysqli_query($con, 'SELECT * FROM noticia WHERE id_noticia = ' . $id_noticia);

    if (mysqli_num_rows($result) == 1) {
        $col = mysqli_fetch_array($result);
        $_SESSION['fecha_noticia'] = $col['fecha_noticia'];
        $_SESSION['texto_noticia'] = $col['texto_noticia'];
        $_SESSION['titular_noticia'] = $col['titular_noticia'];
        datosMiEquipo($col['id_equipo']);
    }
    mysqli_close($con);
}

//Actualiza una noticia
function updateNoticia($id_noticia, $titular, $texto) {
    $titular = filter_var($titular, FILTER_SANITIZE_MAGIC_QUOTES);
    $texto = filter_var($texto, FILTER_SANITIZE_MAGIC_QUOTES);

    $con = conectaBD();

    mysqli_query($con, 'UPDATE noticia SET titular_noticia = "' . $titular . '" , texto_noticia = "' . $texto . '" WHERE id_noticia = ' . $id_noticia);

    mysqli_close($con);
}

//Elimina una noticia
function deleteNoticia($id_noticia) {
    $con = conectaBD();

    mysqli_query($con, 'DELETE FROM noticia WHERE id_noticia = ' . $id_noticia);

    mysqli_close($con);
}

//Muestro todos los titulares de todas las noticias
function listaTitulares() {
    $con = conectaBD();

    $sqlQuery = "SELECT titular_noticia, id_noticia FROM noticia  ORDER BY id_equipo ASC";
    $result = mysqli_query($con, $sqlQuery);

    //Muestro todos los titulares en forma de enlace. 
    while ($col = mysqli_fetch_array($result)) {
        echo "<a href='?idNoticia=" . $col['id_noticia'] . "'>" . $col['titular_noticia'] . "</a><hr size='1' />";
    }
    mysqli_close($con);
}

function listaMisTitulares($idEquipo) {
    $con = conectaBD();

    $sqlQuery = "SELECT titular_noticia, id_noticia FROM noticia WHERE id_equipo= " . $idEquipo . " ORDER BY id_noticia DESC";
    $result = mysqli_query($con, $sqlQuery);

    //Muestro todos los titulares en forma de enlace. 
    while ($col = mysqli_fetch_array($result)) {
        echo "<a href='?idNoticia=" . $col['id_noticia'] . "'>" . $col['titular_noticia'] . "</a><hr size='1' />";
    }
    mysqli_close($con);
}
