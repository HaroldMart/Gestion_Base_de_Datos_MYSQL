<?php

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

include('conexion.php');
include('plantilla.php');
plantilla::aplicar();

if (isset($_POST['nombre_db'])) {
    $nombre_db = $_POST['nombre_db'];
    $sql = "CREATE DATABASE $nombre_db";
    $con = conexion::get_con();
    mysqli_query($con, $sql);
}

?>

<div class="cointaer">
    <div class="row">
        <div class="col">
            <form method="post" action=''>
                <input type="text" class="form-control" placeholder="Nombre de la base de datos" name="nombre_db" />
                <br>
                <button type="submit" class="btn btn-primary">crear</button>

            </form>
        </div>
        <div class="col">
            <h3>Selecciona la base de datos</h3>
            <ul>
                <?php
                $sql = "Show databases;";
                $con = conexion::get_con();

                $rs = mysqli_query($con, $sql);

                if ($rs) {
                    while ($row = mysqli_fetch_object($rs)) {
                        echo "<li><a href='db_index.php?db={$row->Database}'>
            {$row->Database}
            </a></li>";
                    }
                }
                ?>
            </ul>
        </div>
    </div>
</div>