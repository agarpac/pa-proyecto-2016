<?php
session_start();
include_once './conexionBD.php';
?>
<html>
    <head>
        <title>Social Football</title>      
        <link rel="stylesheet" href="css/estilos.css" />      
    </head>
</html>
        <?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$con = conectaBD();
 
// Escape user inputs for security
$query = mysqli_real_escape_string($con, $_REQUEST['query']);
 
if(isset($query)){
    // Attempt select query execution
    $sql = "SELECT * FROM usuario WHERE correo_usuario LIKE '" . $query . "%' AND correo_usuario NOT LIKE '" . $_SESSION['correo_usuario_login'] ."'";                            
    if($result = mysqli_query($con, $sql)){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                echo "<p class='dropdownList'>" . $row['correo_usuario'] . "</p>";
            }
            // Close result set
            mysqli_free_result($result);
        } else{
            echo "<p class='dropdownList'>No hay resultado para <b>$query</b></p>";
        }
    } else{
        echo "ERROR: No se puede ejecutar $sql. " . mysqli_error($con);
    }
}
 
// close connection
mysqli_close($con);
?>