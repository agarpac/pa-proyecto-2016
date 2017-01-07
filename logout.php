<?php
    session_start();
    $_SESSION['usuario_logueado'] = FALSE;
    session_unset();
    session_destroy();

    header("location:login.php");
    exit();
?>