<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php 
            session_start();
            include './header.php';
            
            echo 'Aqui deberian de listarse por un lado los partidos disponibles. Por otro lado un enlace para poder crear un partido';
        ?>
        <?php include './footer.php';?>
    </body>
</html>
