<?php

require_once "../../clases/Conexion.php";
require_once "../../clases/Usuarios.php";

$obj = new usuarios();

$pass = sha1($_POST['password']);
$datos = array(
	$_POST['nombre'],
	$_POST['apellido'],
	$_POST['usuario'],
	$pass
);

echo $obj->registroUsuario($datos);

$imagenCodificada = $_POST['photo'];
$base_to_php = explode(',', $imagenCodificada);
$data = base64_decode($base_to_php[1]);
$nombreImagenGuardada = dirname(__DIR__, 2) . "/faces/foto_" . $_POST['usuario'] . "_" . uniqid() . ".png";
file_put_contents($nombreImagenGuardada, $data);
