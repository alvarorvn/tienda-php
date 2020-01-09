<?php
session_start();
require_once "../../clases/Conexion.php";
require_once "../../clases/Usuarios.php";
require_once "../../clases/Historial.php";

$obj = new usuarios();
$obj_historial = new historial();

$data_user = $obj->obtenDatosUsuarioByUser($_POST['id']);
$_SESSION['iduser'] = $data_user['id_usuario'];
$_SESSION['usuario'] = $_POST['id'];
$datos_historial = array(
	'Login',
	'El usuario "' . $_POST['id'] . '" ha iniciado sesión en el sistema mediante reconocimiento facial.'
);

echo $obj_historial->agregarHistorial($datos_historial);
