<?php
session_start();
require_once "../../clases/Conexion.php";
require_once "../../clases/Categorias.php";


$datos = array(
	$_POST['idcategoria'],
	$_POST['categoriaU']
);

$obj = new categorias();

$cumple = $obj->actualizaCategoria($datos);

// Historial
require_once "../../clases/Historial.php";
require_once "../../clases/Usuarios.php";
$obj_usuarios = new usuarios();
$obj_historial = new historial();
$data_user = $obj_usuarios->obtenDatosUsuario($_SESSION['iduser']);
$datos_historial = array(
	'Actualizar',
	'El usuario "' . $data_user['email'] . '" ha actualizado la categoria "' . $_POST['categoriaU'] . '" en el sistema'
);

if ($cumple == true) {
	echo $obj_historial->agregarHistorial($datos_historial);
}
