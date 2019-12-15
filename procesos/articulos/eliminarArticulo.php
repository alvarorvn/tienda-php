<?php
session_start();

require_once "../../clases/Conexion.php";
require_once "../../clases/Articulos.php";
$idart = $_POST['idarticulo'];

$obj = new articulos();

$cumple = $obj->eliminaArticulo($idart);

// Historial
require_once "../../clases/Historial.php";
require_once "../../clases/Usuarios.php";
$obj_usuarios = new usuarios();
$obj_historial = new historial();
$data_user = $obj_usuarios->obtenDatosUsuario($_SESSION['iduser']);
$datos_historial = array(
	'Eliminar',
	'El usuario "' . $data_user['email'] . '" ha eliminado una articulo en el sistema'
);

if ($cumple == true) {
	echo $obj_historial->agregarHistorial($datos_historial);
}
