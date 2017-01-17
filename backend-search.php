<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "root", "", "social_football");
 
// Check connection
if($link === false){
    die("ERROR: NO hay conexión. " . mysqli_connect_error());
}
 
// Escape user inputs for security
$query = mysqli_real_escape_string($link, $_REQUEST['query']);
 
if(isset($query)){
    // Attempt select query execution
    $sql = "SELECT * FROM usuario WHERE correo_usuario LIKE '" . $query . "%'";
    if($result = mysqli_query($link, $sql)){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                echo "<p>" . $row['correo_usuario'] . "</p>";
            }
            // Close result set
            mysqli_free_result($result);
        } else{
            echo "<p>No hay resultado para <b>$query</b></p>";
        }
    } else{
        echo "ERROR: No se puede ejecutar $sql. " . mysqli_error($link);
    }
}
 
// close connection
mysqli_close($link);
?>