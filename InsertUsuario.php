<?php
	session_start();
	include("conexion.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Mycontacts</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>

		

			<article>
				<h3>Insertar Usuarios</h3>
			</article>

			<article id = "Contactform">			
				<form name="formInsertUsuarios" action="InsertUsuario.proc.php" method="get">
			
					<strong>Nombre del Usuario:</strong><br/>
					<input type="text" name="nomUsuario" size="20" maxlength="25" required/><br/><br/>

					<strong>Apellido del Usuario:</strong><br/>
					<input type="text" name="apellidoUsuario" size="20" maxlength="25" required/><br/><br/>

					<strong>Mail del Usuario:</strong><br/>
					<input type="text" name="mailUsuario" size="20" maxlength="25" required/><br/><br/>

					<strong>Contraseña:</strong><br/>
					<input type="text" name="passwordUS" size="20" maxlength="25" required/><br/><br/>

					<strong>Direccion del Usuario:</strong><br/>
					<input type="text" name="direccionUsuario" size="20" maxlength="25"/><br/><br/>

					<strong>Telefono del Usuario:</strong><br/>
					<input type="text" name="telefonoUsuario" size="20" maxlength="25" /><br/><br/>

					<input id="botonFormModContacto" type="submit" value="Submit">
				</form>
			</article>
		<br/><br/>
		<article>
			<a font color= "black" href="index.php">Volver</a>
		</article>
	</body>
</html>