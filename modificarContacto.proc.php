<?php
	session_start();

		//realizamos la conexión con mysql
		include("conexion.php");
		 // $sql = "UPDATE contacto SET nombre_contacto='$_REQUEST[nomCont]', apellidos_contacto='$_REQUEST[apellCont]' WHERE id_contacto='$_REQUEST[idContacto]'";
		//$sql = "UPDATE contacto INNER JOIN ubicacion ON contacto.id_ubicacion=ubicacion.id_ubicacion SET contacto.nombre_contacto='Eric', contacto.id_lista = 2, contacto.apellidos_contacto='Sanchez', ubicacion.casa_lat= 2, ubicacion.casa_lon= 2, ubicacion.trabajo_lat= 6, ubicacion.trabajo_lon = 6 WHERE contacto.id_contacto=6";
		$sql = "UPDATE contacto INNER JOIN ubicacion ON contacto.id_ubicacion=ubicacion.id_ubicacion SET contacto.nombre_contacto='$_REQUEST[nomCont]', contacto.apellidos_contacto='$_REQUEST[apellCont]', contacto.id_lista = '$_REQUEST[idlista]', ubicacion.casa_lat= '$_REQUEST[casalatCont]', ubicacion.casa_lon= '$_REQUEST[casalonCont]', ubicacion.trabajo_lat= '$_REQUEST[trabajolatCont]', ubicacion.trabajo_lon = '$_REQUEST[trabajolonCont]' WHERE contacto.id_contacto='$_REQUEST[idContacto]'";
		
			//lanzamos la sentencia sql
			$datos = mysqli_query($con, $sql);
			//echo $sql;
			header("location: gestionarcontactos.php")
		?>
