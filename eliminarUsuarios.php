<?php
	session_start();

		//realizamos la conexión con mysql
		include("conexion.php");

		$sql="DELETE usuario FROM usuario WHERE usuario.id_usuario= '$_REQUEST[id_usuario]'";
		
		$datos = mysqli_query($con, $sql);

			
			header("location: administrarusuarios.php")
		?>