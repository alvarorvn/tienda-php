<?php
session_start();
require_once "../../clases/Conexion.php";
require_once "../../clases/Articulos.php";

$obj = new articulos();

$datos = array(
	$_POST['idArticulo'],
	$_POST['categoriaSelectU'],
	$_POST['nombreU'],
	$_POST['descripcionU'],
	$_POST['cantidadU'],
	$_POST['precioU']
);

$cumple = $obj->actualizaArticulo($datos);

// Historial
require_once "../../clases/Historial.php";
require_once "../../clases/Usuarios.php";
$obj_usuarios = new usuarios();
$obj_historial = new historial();
$data_user = $obj_usuarios->obtenDatosUsuario($_SESSION['iduser']);
$datos_historial = array(
	'Actualizar',
	'El usuario "' . $data_user['email'] . '" ha actualizado el articulo "' . $_POST['nombreU'] . '" en el sistema'
);

if ($cumple == true) {
	echo $obj_historial->agregarHistorial($datos_historial);
}
