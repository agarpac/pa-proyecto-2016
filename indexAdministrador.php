<?php
session_start();

echo '<h1>Hola admin ' . $_SESSION['nombreUserLogin'] . ' ' . $_SESSION['apellido1UserLogin'] . ' ' . $_SESSION['apellido2UserLogin'] . '</h1>';