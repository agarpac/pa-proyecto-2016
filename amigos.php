<?php
include './header.php';
?>
<section class="generico">   
    <article>
        <div id="colPrincipal1">
            <p>Columna 1 (Para pedir )</p>
            <div class="search-box">
                <form id="dataForm" action="#" method="post" enctype="multipart/form-data" ">
                <input type="text" id="autoc" autocomplete="off" placeholder="Busca usuario" />
                <input type="submit" class="buttonSpecial" id="amistad" name="buttonAmistad" value="Enviar Peticion" style="display: none;"/> 
                <div class="result"></div>
                </form>
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
