<?php
	session_start();

		//realizamos la conexión con mysql
		include("conexion.php");

	$sql="INSERT INTO `lista`(`id_usuario`, `nombre_lista`, `descripcion_lista`) VALUES ('$_SESSION[id]','$_REQUEST[nomLista]','$_REQUEST[descLista]')";

	$datos = mysqli_query($con, $sql);
	echo "$sql";
	header("Location: gestionarlistas.php");

?>