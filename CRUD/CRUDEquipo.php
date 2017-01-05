<?php
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

function muestraEquipos() {
    $con = conectaBD();
    $result = mysqli_query($con, 'SELECT id_equipo, nombre_equipo, foto_equipo FROM equipo');

    if (mysqli_num_rows($result) != 0) {

        echo '<fieldset>';
        echo '<legend>Elige tu favorito</legend>';
        $i = 0;
        while ($col = mysqli_fetch_array($result)) {
            if ($i < 2) {

                echo '<input type="radio" id="equipo'. $col['id_equipo'] . '"  name="equipos" value="' . $col['id_equipo'] . '" checked />' . '<img src = "' . $col['foto_equipo'] . '" alt = "equipo' . $col['id_equipo'] . '"/> ' . $col['nombre_equipo'];

                $i++;
            } else {
                echo '<label>';
                echo '<input type="radio" id="equipo'. $col['id_equipo'] . '" name="equipos" value="' . $col['id_equipo'] . '" checked />' . '<img src = "' . $col['foto_equipo'] . '" alt = "equipo' . $col['id_equipo'] . '"/> ' . $col['nombre_equipo'];
                echo '</label>';
                $i = 0;
            }
        }
        echo '</fieldset>';
    } else {
        echo 'No hay equipos para mostrar';
    }
}