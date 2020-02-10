<?php
require_once "../../clases/Conexion.php";

$obj = new conectar();
$conexion = $obj->conexion();

$sql = "SELECT * from rastreo_ip";
$result = mysqli_query($conexion, $sql);
?>

<div class="table-responsive">
    <table class="table table-hover table-condensed table-bordered" style="text-align: center;">
        <caption><label>Historial de rastreo de acciones por IP</label></caption>
        <tr>
            <td>IP</td>
            <td>Descripción</td>
            <td>Fecha</td>
            <td>Hora</td>
        </tr>

        <?php while ($ver = mysqli_fetch_row($result)) : ?>

            <tr>
                <td><?php echo $ver[1]; ?></td>
                <td><?php echo $ver[2]; ?></td>
                <td><?php echo $ver[3]; ?></td>
                <td><?php echo $ver[4]; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</div>