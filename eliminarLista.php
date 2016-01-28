<?php
	session_start();

		//realizamos la conexión con mysql
		include("conexion.php");

		$sql = "UPDATE contacto SET contacto.id_lista='6' WHERE contacto.id_lista = '$_REQUEST[id_lista]' ";

		$sql2="DELETE lista FROM lista WHERE lista.id_lista= '$_REQUEST[id_lista]'";
		 
		$datos = mysqli_query($con, $sql);
		$datos2 = mysqli_query($con, $sql2);

			
			 header("location: gestionarlistas.php")
		?>