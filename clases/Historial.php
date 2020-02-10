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
                        log.log_hora,
                        log.log_id
                from log_historial as log
                inner join usuarios as usu
                on log.usuario_id = usu.id_usuario 
                where usu.nombre like '%$data_search%' or log.log_accion like '%$data_search%' or log.log_fecha like '%$data_search%'";

        $result = mysqli_query($conexion, $sql);

        return $result;
    }

    public function obtenDatosHistorial($log_id)
    {

        $c = new conectar();
        $conexion = $c->conexion();

        $sql = "SELECT usu.nombre, 
                        log.log_accion,
                        log.log_descripcion,
                        log.log_fecha,
                        log.log_hora,
                        log.log_id,
                        log.usuario_id
                from log_historial as log
                inner join usuarios as usu
                on log.usuario_id = usu.id_usuario and log.log_id = '$log_id'";
        $result = mysqli_query($conexion, $sql);

        $ver = mysqli_fetch_row($result);

        $datos = array(
            'log_id' => $ver[5],
            'log_accion' => $ver[1],
            'log_descripcion' => $ver[2],
            'log_fecha' => $ver[3],
            'log_hora' => $ver[4],
            'usuario_id' => $ver[6],
            'usuario_nombre' => $ver[0]
        );

        return $datos;
    }

    public function actualizaHistorial($datos)
    {
        $c = new conectar();
        $conexion = $c->conexion();

        $sql = "UPDATE log_historial set usuario_id='$datos[1]',
									log_accion='$datos[2]',
									log_descripcion='$datos[3]',
                                    log_fecha='$datos[4]',
                                    log_hora='$datos[5]'
						where log_id='$datos[0]'";
        return mysqli_query($conexion, $sql);
    }

    public function agregarIP($datos)
    {
        $c = new conectar();
        $conexion = $c->conexion();

        $sql = "insert into rastreo_ip (ip_ip, ip_descripcion, ip_fecha, ip_hora)
            values('$datos[0]','$datos[1]','$datos[2]','$datos[3]')";

        return mysqli_query($conexion, $sql);
    }

    public function buscarHistorialIP($data_search)
    {
        $c = new conectar();
        $conexion = $c->conexion();

        $sql = "SELECT ip_ip,
                        ip_descripcion,
                        ip_fecha,
                        ip_hora
                from rastreo_ip 
                where ip_ip like '%$data_search%' or ip_fecha like '%$data_search%'";

        $result = mysqli_query($conexion, $sql);

        return $result;
    }
}
