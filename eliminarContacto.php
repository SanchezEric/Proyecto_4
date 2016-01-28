<?php
	session_start();

		//realizamos la conexión con mysql
		include("conexion.php");

		$sql="DELETE contacto, ubicacion FROM contacto INNER JOIN ubicacion ON contacto.id_ubicacion = ubicacion.id_ubicacion WHERE contacto.id_contacto= '$_REQUEST[idCont]'";
		
		$datos = mysqli_query($con, $sql);
			
			header("location: gestionarcontactos.php")
		?>