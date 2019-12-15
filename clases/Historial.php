<?php

class historial
{

    public function agregarHistorial($datos)
    {
        $c = new conectar();
        $conexion = $c->conexion();

        $idusuario = $_SESSION['iduser'];
        $fecha = date('Y-m-d');
        $hora = date('H:i:s');

        $sql = "insert into log_historial (usuario_id, log_accion, log_descripcion, log_fecha, log_hora)
            values('$idusuario','$datos[0]','$datos[1]','$fecha', '$hora')";

        return mysqli_query($conexion, $sql);
    }

    public function buscarHistorial($data_search)
    {
        $c = new conectar();
        $conexion = $c->conexion();

        $sql = "SELECT usu.nombre, 
                        log.log_accion,
                        log.log_descripcion,
                        log.log_fecha,
                        log.log_hora
                from log_historial as log
                inner join usuarios as usu
                on log.usuario_id = usu.id_usuario 
                where usu.nombre like '%$data_search%' or log.log_accion like '%$data_search%' or log.log_fecha like '%$data_search%'";

        $result = mysqli_query($conexion, $sql);

        return $result;
    }
}
