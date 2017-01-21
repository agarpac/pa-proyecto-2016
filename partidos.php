<?php
include './header.php';
require_once './CRUD/CRUDEstadio.php';
require_once './CRUD/CRUDPartido.php';
if (isset($_SESSION['usuario_logueado']) && $_SESSION['usuario_logueado']) {
    if (isset($_POST['btnVerPartidoDisponible'])) {
        if (isset($_POST['verPartido'])) {
            $_SESSION['partidoVisto'] = $_POST['verPartido'];
            $_SESSION['noDisponible'] = FALSE;
            header('location: verPartido.php');
        }
    }
    if (isset($_POST['btnVerPartidoNoDisponible'])) {
        if (isset($_POST['verPartidoNoDisponible'])) {
            $_SESSION['partidoVisto'] = $_POST['verPartidoNoDisponible'];
            $_SESSION['noDisponible'] = TRUE;
            header('location: verPartido.php');
        }
    }
    if (isset($_POST['btnCrearPartido'])) {
        header('location: crearPartido.php');
    }

    if (isset($_POST['btnEliminarPartido'])) {
        if (isset($_POST['verPartido'])) {
            detelePartido($_POST['verPartido']);
        } elseif (isset($_POST['verPartidoNoDisponible'])) {
            detelePartido($_POST['verPartidoNoDisponible']);
        }
    }
    ?>
    <section class="generico">
        <article id="colPartidos1" class="form-style">
            <form action = "#" method = "POST">
                <table>
                    <tr>
                        <td> </td>
                        <td><h4>Partidos disponibles</h4></td>
                    </tr>
                    <?php
                    if (listaPartidosDisponibles() > 0) {
                        ?>
                    </table>
                    <br>
                    <input type="submit" class="buttonSpecial" value="Ver partido" name="btnVerPartidoDisponible" />
                    <input type="submit" class="buttonSpecial" value="Crear partido" name="btnCrearPartido" />
                    <?php
                    if ($_SESSION['admin'] == 0) {
                        echo '<input type="submit" class="buttonSpecial" value="Eliminar partido" name="btnEliminarPartido" onclick="return confirmDel()" />';
                    }
                } else {
                    echo '</table>';
                    echo '<label>No hay partidos "disponibles" para mostrar</label>';
                    echo '<input type="submit" class="buttonSpecial" value="Crear partido" name="btnCrearPartido" />';
                }
                ?>
            </form>
        </article>
        <article id="colPartidos2" class="form-style">
            <form action = "#" method = "POST">
                <table>
                    <tr>
                        <td> </td>
                        <td><h4>Partidos no disponibles</h4></td>
                    </tr>
                    <?php
                    if (listaPartidosNoDisponibles() > 0) {
                        ?>
                    </table>
                    <br>
                    <input type="submit" class="buttonSpecial" value="Ver partido" name="btnVerPartidoNoDisponible" />
                    <?php
                    if ($_SESSION['admin'] == 0) {
                        echo '<input type="submit" class="buttonSpecial" value="Eliminar partido" name="btnEliminarPartido" onclick="return confirmDel()" />';
                    }
                } else {
                    echo '</table>';
                    echo 'No hay partidos "no disponibles" para mostrar';
                }
                ?>
            </form>
        </article>
    </section>

    <?php
} else {
    header('location: login.php');
}
include './footer.php';
