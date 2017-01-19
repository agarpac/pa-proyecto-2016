<?php
    session_start();
    $_SESSION['usuario_logueado'] = FALSE;
    unset($_SESSION['usuario_logueado']);
    session_unset();
    session_destroy();

    header("location:login.php");
    exit();
?>