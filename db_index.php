<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('conexion.php');
include('plantilla.php');
plantilla::aplicar();

if (isset($_GET['db_delete'])) {
    $nombre_db = $_GET['db_delete'];
    $sql = "DROP DATABASE $nombre_db";
    $con = conexion::get_con();
    mysqli_query($con, $sql);

    header('Location: index.php');
}

if (!isset($_GET['db'])) {
    echo '
    <script>
    
    alert("Debe indicar una base de datos");
    
    window.location="index.php";
    </script>
    
    ';
}

$db = $_GET['db'];
$con = conexion::get_con();

if (isset($_POST['nombre_tbl'])) {
    $nombre_tbl = $_POST['nombre_tbl'];
    $db = $_GET['db'];
    $con = conexion::get_con();


    $sql = "use $db";
    mysqli_query($con, $sql);

    $sql = "CREATE TABLE $nombre_tbl (nombre varchar(50), edad int, correo varchar(100));";
    $con = conexion::get_con();

    mysqli_query($con, $sql);
}

if (isset($_POST['query'])) {
    $query = $_POST['query'];
    $db = $_GET['db'];
    $con = conexion::get_con();


    $sql = "use $db";
    mysqli_query($con, $sql);

    $sql = "$query";
    $con = conexion::get_con();

    mysqli_query($con, $sql);
}


mysqli_select_db($con, $db);
?>

<div class="cointaer">
    <div class="row">
        <div class="col">
            <h3>Selecciona la tabla de datos que prefieras</h3>
            <ul>
                <?php
                $sql = "Show tables;";

                $rs = mysqli_query($con, $sql);

                if ($rs) {
                    while ($row = mysqli_fetch_row($rs)) {
                        echo "<li><a href='table_index.php?db={$db}&tabla={$row[0]}'>
            {$row[0]}
            </a></li>";
                    }
                }
                ?>
            </ul>
        </div>
        <div class="col">
            <form method="post" action=''>
                <input type="text" class="form-control" placeholder="Nombre de la tabla" name="nombre_tbl" />
                <br>
                <button type="submit" class="btn btn-primary">crear</button>
            </form>
            <br>
            <form method="post" action=''>
                <input type="text" class="form-control" placeholder="Escriba el query" name="query" />
                <br>
                <button type="submit" class="btn btn-primary">Ejecutar query</button>
            </form>
            <hr>

            <p>Opciones:</p>
            <ul>

                <li><a onclick="return confirm('Seguro que desea borrar la DB<?= $db; ?>');" href="db_index.php?db_delete=<?php echo $db; ?>">Eliminar Base de datos</li>

            </ul>
        </div>
    </div>
</div>