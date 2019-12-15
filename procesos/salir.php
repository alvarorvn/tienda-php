<?php

session_start();

require_once "../clases/Conexion.php";
require_once "../clases/Historial.php";
require_once "../clases/Usuarios.php";

$obj = new usuarios();
$obj_historial = new historial();

$data_user = $obj->obtenDatosUsuario($_SESSION['iduser']);

$datos_historial = array(
	'Salida',
	'El usuario "' . $data_user['email'] . '" ha salido del sistema.'
);

echo $obj_historial->agregarHistorial($datos_historial);

session_destroy();

header("location:../index.php");
