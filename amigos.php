<?php
include './header.php';
include './CRUD/CRUDUsuario.php';
include './CRUD/CRUDPeticion_amistad.php';

    if (isset($_POST['buttonAmistad'])) {

        if (!isset($_POST['mailUser']) || $_POST['mailUser'] == '') {
            $errores[] = 'El user está vacio';
        }
        
        if (!isset($errores)) {
            //Recogida de datos del formulario
            $correo = filter_input(INPUT_POST, 'mailUser', FILTER_SANITIZE_MAGIC_QUOTES);

            $correo = addslashes($correo);


            if (compruebaSiUsuarioExisteCORREO($correo)) {
                readUsuarioCORREO($correo);
                createPeticion_amistad($_SESSION['id_usuario_login'],$_SESSION['id_usuario_CORREO']);
            }else{
                $errores[] = 'El user no existe';
            }
        }
       
         if (isset($errores)) {
                    echo '<p>Datos incorrectos</p>';
        }
    }           
           
?>
<section class="generico">   
    <article>
        <div id="colPrincipal1">
            <p>Columna 1 (Para pedir )</p>
            <div class="search-box">
                
                    <input type="text" id="autoc" name="mailUser" autocomplete="off" placeholder="Busca usuario" />
                    <input type="submit" class="buttonSpecial" id="amistad" name="buttonAmistad" placeholder="Enviar Peticion" style="display: none;"/> 
                    <input type="submit" class="buttonSpecial" id="limpiar" name="buttonLimpiar" placeholder="Limpiar" value="Limpiar" style="display: none;" onclick="limpiaTexto(this)"/> 
                    <div class="result"></div>
                
            </div>
           
        </div>
        <div id="colPrincipal2">
            <p>Columna 2 (Para listar a los amigos )</p>
            
        </div>
        <div id="colPrincipal3">
            <p>Columna 3 (Para ver las peticiones )</p>
            
        </div>
        </article>
</section>
<?php include './footer.php';?>
