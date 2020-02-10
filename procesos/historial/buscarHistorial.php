<?php

require_once '../../clases/Conexion.php';
require_once '../../clases/Historial.php';
require_once '../../clases/Usuarios.php';

$obj = new historial();
$obj_usuarios = new usuarios;

$output = '';

$result =  $obj->buscarHistorial($_POST['search']);

if (mysqli_num_rows($result) > 0) {
    $output .= '<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
                    <caption><label>Historial de usuarios</label></caption>
                    <tr>
                        <td>Usuario</td>
                        <td>Acción</td>
                        <td>Descripción</td>
                        <td>Fecha</td>
                        <td>Hora</td>                        
                        <td>Actualizar</td>
                    </tr>';
    while ($row = mysqli_fetch_array($result)) {

        $output .= '<tr>
                        <td>' . $row['nombre'] . '</td>
                        <td>' . $row['log_accion'] . '</td>
                        <td>' . $row['log_descripcion'] . '</td>
                        <td>' . $row['log_fecha'] . '</td>
                        <td>' . $row['log_hora'] . '</td>
                        <td>
                            <span data-toggle="modal" class="btn btn-info btn-xs" data-target="#actualizaHistorialModal" onclick="agregaDatosHistorial(' . $row['log_id'] . ')">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </span>
                        </td>
                    </tr>';
    }
    echo $output;
} else {
    echo 0;
}
