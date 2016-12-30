<?php
session_start();
include './header.php';

echo '<h1>Bienvenido  ' . $_SESSION['nombreUserLogin'] . ' ' . $_SESSION['apellido1UserLogin'] . ' ' . $_SESSION['apellido2UserLogin'] . '</h1>';

echo "Aqui deben ir las noticias, lo bonito sería dividir la pantalla en dos columnas (tipo facebook). 70% para noticias y 30 % para???"

?>

<?php include './footer.php';?>
