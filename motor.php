<?php

function mostrar_tabla($rs = [])
{

    if (count($rs) == 0) {
        return "<h3>No hay registros</h3>";
    }

    $final = "<table>
        <thead>
            <tr>";

    $fila = $rs[0];
    foreach ($fila as $key => $value) {
        $final .= "<th>{$key}</th>";
    }
    $final .= "</tr><tbody>";

    foreach ($rs as $fila) {
        $final .= "<tr>";
        foreach ($fila as $key => $value) {
            $final .= "<td>{$value}</td>";
        }
        $final .= "</tr>";
    }

    $final .= "</tbody></table>";
    return $final;
}
