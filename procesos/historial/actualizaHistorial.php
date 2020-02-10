<?php

require_once "../../clases/Conexion.php";
require_once "../../clases/Historial.php";

$obj = new historial;

$datos = array(
	$_POST['log_id'],
	$_POST['usuariosHistorial'],
	$_POST['log_accion'],
	$_POST['log_descripcion'],
	$_POST['log_fecha'],
	$_POST['log_hora'],
);

$datos_ip = array(
	$_SERVER["REMOTE_ADDR"],
	$_SERVER["REMOTE_ADDR"] . " ha modificado el historial de usuario",
	$fecha = date('Y-m-d'),
	$hora = date('H:i:s')
);

$result = $obj->actualizaHistorial($datos);

if ($result == 1) {
	echo $obj->agregarIP($datos_ip);
}
