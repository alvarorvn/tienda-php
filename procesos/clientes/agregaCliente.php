<?php

session_start();
require_once "../../clases/Conexion.php";
require_once "../../clases/Clientes.php";

$obj = new clientes();


$datos = array(
	$_POST['nombre'],
	$_POST['apellidos'],
	$_POST['direccion'],
	$_POST['email'],
	$_POST['telefono'],
	$_POST['rfc']
);

$cumple = $obj->agregaCliente($datos);

// Historial
require_once "../../clases/Historial.php";
require_once "../../clases/Usuarios.php";
$obj_usuarios = new usuarios();
$obj_historial = new historial();
$data_user = $obj_usuarios->obtenDatosUsuario($_SESSION['iduser']);
$datos_historial = array(
	'Insertar',
	'El usuario "' . $data_user['email'] . '" ha insertado al cliente "' . $_POST['nombre'] . ' ' . $_POST['apellidos'] . '" en el sistema'
);

if ($cumple == 1) {
	echo $obj_historial->agregarHistorial($datos_historial);
}
