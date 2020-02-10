<?php 

	require_once "../../clases/Conexion.php";
	require_once "../../clases/Historial.php";

	$obj= new historial;

	echo json_encode($obj->obtenDatosHistorial($_POST['log_id']));

 ?>