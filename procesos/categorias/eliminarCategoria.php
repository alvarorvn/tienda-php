<?php
session_start();
require_once "../../clases/Conexion.php";
require_once "../../clases/Categorias.php";
$id = $_POST['idcategoria'];

$obj = new categorias();
$cumple = $obj->eliminaCategoria($id);

// Historial
require_once "../../clases/Historial.php";
require_once "../../clases/Usuarios.php";
$obj_usuarios = new usuarios();
$obj_historial = new historial();
$data_user = $obj_usuarios->obtenDatosUsuario($_SESSION['iduser']);
$datos_historial = array(
	'Eliminar',
	'El usuario "' . $data_user['email'] . '" ha eliminado una categoria en el sistema'
);

if ($cumple == true) {
	echo $obj_historial->agregarHistorial($datos_historial);
}
