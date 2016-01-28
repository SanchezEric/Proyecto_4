<?php
	session_start();

		//realizamos la conexión con mysql
		include("conexion.php");
		 // $sql = "UPDATE contacto SET nombre_contacto='$_REQUEST[nomCont]', apellidos_contacto='$_REQUEST[apellCont]' WHERE id_contacto='$_REQUEST[idContacto]'";
		//$sql = "UPDATE contacto INNER JOIN ubicacion ON contacto.id_ubicacion=ubicacion.id_ubicacion SET contacto.nombre_contacto='Eric', contacto.id_lista = 2, contacto.apellidos_contacto='Sanchez', ubicacion.casa_lat= 2, ubicacion.casa_lon= 2, ubicacion.trabajo_lat= 6, ubicacion.trabajo_lon = 6 WHERE contacto.id_contacto=6";
		$sql = "UPDATE usuario SET usuario.nombre_usuario='$_REQUEST[nomUsuario]', usuario.apellidos_usuario='$_REQUEST[apellidoUsuario]', usuario.mail_usuario = '$_REQUEST[mailUsuario]', usuario.direccion_usuario= '$_REQUEST[direccionUsuario]', usuario.telefono_usuario= '$_REQUEST[telefonoUsuario]', usuario.nivel_usuario= '$_REQUEST[nivelusuario]' WHERE usuario.id_usuario='$_REQUEST[idUsuario]'";
		
			//lanzamos la sentencia sql
			$datos = mysqli_query($con, $sql);
			//echo $sql;
			header("location: administrarusuarios.php")
		?>
