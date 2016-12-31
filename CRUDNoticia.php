<?php
session_start();
require_once  './conexionBD.php';

//Recoge los datos del equipo
function datosEquipo($id){
    //Se conecta
    $con = conectaBD();
    
    //Realiza una consulta
    $result = mysqli_query('SELECT nombre_equipo, foto_equipo FROM equipo WHERE id_equipo = "' . $id . '"');
    if(mysqli_num_rows($result) == 1){
        $col = mysqli_fetch_array($result);
        $_SESSION['nombre_equipo'] = $col['nombre_equipo'];
        $_SESSION['foto_equipo'] = $col['foto_equipo'];
    }
    mysqli_close($con);
}

//Crea una noticia
function createNoticia($titular, $texto, $id_equipo){
    $titular = filter_var($titular, FILTER_SANITIZE_MAGIC_QUOTES);
    $texto = filter_var($texto, FILTER_SANITIZE_MAGIC_QUOTES);
    
    $con = conectaBD();
    
    $result = mysqli_query($con, 'INSERT INTO noticia (fecha_noticia, texto_noticia, id_equipo, titular_noticia) VALUES ("' . date("d/m/y H:m:s") . '", "' . $texto . '", ' . $id_equipo . ', "' . $titular . '")');
    mysqli_close($con);
}

//Lee los datos de una noticia
function readNoticia($id_noticia){
    $con = conectaBD();
    
    $result = mysqli_query($con, 'SELECT * FROM noticia WHERE id_noticia = ' . $id_noticia);
    
    if(mysqli_num_rows($result) == 1){
        $col = mysqli_fetch_array($result);
        $_SESSION['fecha_noticia'] = $col['fecha_noticia'];
        $_SESSION['texto_noticia'] = $col['texto_noticia'];
        $_SESSION['titular_noticia'] = $col['titular_noticia'];
        datosEquipo($col['id_equipo']);
    }
    mysqli_close($con);
}

//Actualiza una noticia
function updateNoticia($id_noticia, $titular, $texto, $id_equipo){
    $titular = filter_var($titular, FILTER_SANITIZE_MAGIC_QUOTES);
    $texto = filter_var($texto, FILTER_SANITIZE_MAGIC_QUOTES);
    
    $con = conectaBD();
    
    $result = mysqli_query($con, 'UPDATE noticia SET titular_noticia = "' . $titular . '", texto_noticia = "' . $texto . '", id_equipo = ' . $id_equipo . ' WHERE id_noticia = ' . $id_noticia);
    
    mysqli_close($con);
}

//Elimina una noticia
function deleteNoticia($id_noticia){
    $con = conectaBD();
    
    $result = mysqli_query($con, 'DELETE FROM noticia WHERE id_noticia = ' . $id_noticia);
    
    mysqli_close($con);
}