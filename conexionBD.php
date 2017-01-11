<?php
//Realiza la conexion a la base de datos y devuelve el conector
function conectaBD() {
    $con = mysqli_connect("localhost", "root", "");
    if (!$con) {
        die("Error al conectarse a la base de datos");
    }
    $db = mysqli_select_db($con,'social_football');   
    if (!$db) {
        die("Error al seleccionar la base de datos". mysqli_error($con));
    }
    return $con;
}