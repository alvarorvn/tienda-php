<?php

require_once '../../clases/Conexion.php';
require_once '../../clases/Historial.php';

$obj = new historial();

$output = '';

$result =  $obj->buscarHistorialIP($_POST['search']);

print_r($result);

if (mysqli_num_rows($result) > 0) {
    $output .= '<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
                    <caption><label>Historial de rastreo de acciones por IP</label></caption>
                    <tr>
                        <td>IP</td>
                        <td>Descripción</td>
                        <td>Fecha</td>
                        <td>Hora</td>
                    </tr>';
    while ($row = mysqli_fetch_array($result)) {

        $output .= '<tr>
                        <td>' . $row['ip_ip'] . '</td>
                        <td>' . $row['ip_descripcion'] . '</td>
                        <td>' . $row['ip_fecha'] . '</td>
                        <td>' . $row['ip_hora'] . '</td>
                    </tr>';
    }
    echo $output;
} else {
    echo 0;
}
