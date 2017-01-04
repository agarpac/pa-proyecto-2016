<?php

session_start();

require_once './conexionBD.php';

//Crea un equipo
function createEquipo($nombre, $anio, $foto){
    $nombre = filter_var($nombre, FILTER_SANITIZE_MAGIC_QUOTES);
    $anio = filter_var($anio, FILTER_SANITIZE_MAGIC_QUOTES);
    $foto = filter_var($foto, FILTER_SANITIZE_MAGIC_QUOTES);
    
    $con = conectaBD();
    
    mysqli_query($con, 'INSERT INTO equipo (nombre_equipo, anio_fundacion, foto_equipo) VALUES ("' . $nombre . '", "' . $anio . '", "' . $foto . '")');
    
    mysqli_close($con);
}

//Lee los datos de un equipo
function readEquipo($id){
    $con = conectaBD();
    
    $result = mysqli_query($con, 'SELECT * FROM equipo WHERE id_equipo = ' . $id);
    
    if(mysqli_num_rows($result) == 1){
        $col = mysqli_fetch_array($result);
        $_SESSION['nombre_equipo'] = $col['nombre_equipo'];
        $_SESSION['anio_fundacion'] = $col['anio_fundacion'];
        $_SESSION['foto_equipo'] = $col['foto_equipo'];
    }
    mysqli_close($con);
}

//Edita los datos de un equipo
function updateEquipo($id, $nombre, $anio, $foto){
    $nombre = filter_var($nombre, FILTER_SANITIZE_MAGIC_QUOTES);
    $anio = filter_var($anio, FILTER_SANITIZE_MAGIC_QUOTES);
    $foto = filter_var($foto, FILTER_SANITIZE_MAGIC_QUOTES);
    
    $con = conectaBD();
    
    mysqli_query($con, 'UPDATE equipo SET nombre_equipo = "' . $nombre . '", anio_fundacion = "' . $anio . '", foto_equipo = "' . $foto . '" WHERE id_equipo = ' . $id);
    
    mysqli_close($con);
}

//Elimina un equipo
function deleteEquipo($id){
    $con = conectaBD();
    
    mysqli_query($con, 'DELETE FROM equipo WHERE id_equipo = ' - $id);
    
    mysqli_close($con);
}