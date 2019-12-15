<?php
session_start();
require_once "../../clases/Conexion.php";
require_once "../../clases/Categorias.php";
$fecha = date("Y-m-d");
$idusuario = $_SESSION['iduser'];
$categoria = $_POST['categoria'];

$datos = array(
	$idusuario,
	$categoria,
	$fecha
);

$obj = new categorias();

$cumple =  $obj->agregaCategoria($datos);

// Historial
require_once "../../clases/Historial.php";
require_once "../../clases/Usuarios.php";
$obj_usuarios = new usuarios();
$obj_historial = new historial();
$data_user = $obj_usuarios->obtenDatosUsuario($_SESSION['iduser']);
$datos_historial = array(
	'Insertar',
	'El usuario "' . $data_user['email'] . '" ha insertado la categoria "' . $categoria . '" en el sistema'
);

if ($cumple == 1) {
	echo $obj_historial->agregarHistorial($datos_historial);
}
