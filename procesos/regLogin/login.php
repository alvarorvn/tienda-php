<?php
session_start();
require_once "../../clases/Conexion.php";
require_once "../../clases/Usuarios.php";
require_once "../../clases/Historial.php";

$obj = new usuarios();
$obj_historial = new historial();

$datos = array(
	$_POST['usuario'],
	$_POST['password']
);

//$data_user = $obj->obtenDatosUsuario($_SESSION['iduser']);

$datos_historial = array(
	'Login',
	'El usuario "' . $_POST['usuario'] . '" ha iniciado sesión en el sistema.'
);

$isLogin = $obj->loginUser($datos);

if ($isLogin == 1) {
	echo $obj_historial->agregarHistorial($datos_historial);
}
