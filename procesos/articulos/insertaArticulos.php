<?php
session_start();
$iduser = $_SESSION['iduser'];
require_once "../../clases/Conexion.php";
require_once "../../clases/Articulos.php";

$obj = new articulos();

$datos = array();

$nombreImg = $_FILES['imagen']['name'];
$rutaAlmacenamiento = $_FILES['imagen']['tmp_name'];
$carpeta = '../../archivos/';
$rutaFinal = $carpeta . $nombreImg;

$datosImg = array(
	$_POST['categoriaSelect'],
	$nombreImg,
	$rutaFinal
);

if (move_uploaded_file($rutaAlmacenamiento, $rutaFinal)) {
	$idimagen = $obj->agregaImagen($datosImg);

	if ($idimagen > 0) {

		$datos[0] = $_POST['categoriaSelect'];
		$datos[1] = $idimagen;
		$datos[2] = $iduser;
		$datos[3] = $_POST['nombre'];
		$datos[4] = $_POST['descripcion'];
		$datos[5] = $_POST['cantidad'];
		$datos[6] = $_POST['precio'];
		$cumple = $obj->insertaArticulo($datos);

		// Historial
		require_once "../../clases/Historial.php";
		require_once "../../clases/Usuarios.php";
		$obj_usuarios = new usuarios();
		$obj_historial = new historial();
		$data_user = $obj_usuarios->obtenDatosUsuario($_SESSION['iduser']);
		$datos_historial = array(
			'Insertar',
			'El usuario "' . $data_user['email'] . '" ha insertado el articulo "' . $datos[3] . '" en el sistema'
		);

		if ($cumple == 1) {
			echo $obj_historial->agregarHistorial($datos_historial);
		}
	} else {
		echo 0;
	}
}
