<?php
	session_start();

		//realizamos la conexión con mysql
		include("conexion.php");
		 // $sql = "UPDATE contacto SET nombre_contacto='$_REQUEST[nomCont]', apellidos_contacto='$_REQUEST[apellCont]' WHERE id_contacto='$_REQUEST[idContacto]'";
		//$sql = "UPDATE contacto INNER JOIN ubicacion ON contacto.id_ubicacion=ubicacion.id_ubicacion SET contacto.nombre_contacto='Eric', contacto.id_lista = 2, contacto.apellidos_contacto='Sanchez', ubicacion.casa_lat= 2, ubicacion.casa_lon= 2, ubicacion.trabajo_lat= 6, ubicacion.trabajo_lon = 6 WHERE contacto.id_contacto=6";
		$sql = "UPDATE lista SET lista.nombre_lista='$_REQUEST[nomLista]', lista.descripcion_lista='$_REQUEST[descLista]' WHERE lista.id_lista='$_REQUEST[idLista]'";

			//lanzamos la sentencia sql
			$datos = mysqli_query($con, $sql);
			//echo $sql;
			header("location: gestionarlistas.php")
		?>
