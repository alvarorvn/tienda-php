<?php
require_once "../../clases/Conexion.php";

$obj = new conectar();
$conexion = $obj->conexion();

$sql = "SELECT usu.nombre, 
				log.log_accion,
				log.log_descripcion,
				log.log_fecha,
				log.log_hora,
                log.log_id
        from log_historial as log
        inner join usuarios as usu
        on log.usuario_id = usu.id_usuario";
$result = mysqli_query($conexion, $sql);
?>

<div class="table-responsive">
    <table class="table table-hover table-condensed table-bordered" style="text-align: center;">
        <caption><label>Historial de usuarios</label></caption>
        <tr>
            <td>Usuario</td>
            <td>Acción</td>
            <td>Descripción</td>
            <td>Fecha</td>
            <td>Hora</td>
            <td>Actualizar</td>
        </tr>

        <?php while ($ver = mysqli_fetch_row($result)) : ?>

            <tr>
                <td><?php echo $ver[0] ?></td>
                <td><?php echo $ver[1]; ?></td>
                <td><?php echo $ver[2]; ?></td>
                <td><?php echo $ver[3]; ?></td>
                <td><?php echo $ver[4]; ?></td>
                <td>
                    <span data-toggle="modal" class="btn btn-info btn-xs" data-target="#actualizaHistorialModal" onclick="agregaDatosHistorial('<?php echo $ver[5]; ?>')">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </span>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</div>