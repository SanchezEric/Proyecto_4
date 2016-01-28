<?php
	session_start();
  	if(!isset($_SESSION['mail'])){
  	$_SESSION['error']="Tienes que logarte";
 	header("Location: index.php");
  	}
  	include("conexion.php");
  	$sql="SELECT * FROM usuario WHERE id_usuario = '$_SESSION[id]'";
	$datos = mysqli_query($con, $sql);
	$prod=mysqli_fetch_array($datos);
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
				<h3>Modificar Usuarios</h3>
			</article>

			<article id = "Contactform">			
				<form name="formModUsuarios" action="modificarperfil.proc.php" method="get">
					<input type="hidden" name="idUsuario" value="<?php echo $prod['id_usuario']; ?>">

					<strong>Nombre:</strong><br/>
					<input type="text" name="nomUsuario" size="20" maxlength="25" value="<?php echo utf8_encode("$prod[nombre_usuario]"); ?>"required/><br/><br/>

					<strong>Apellidos:</strong><br/>
					<input type="text" name="apellidoUsuario" size="20" maxlength="25" value="<?php echo utf8_encode("$prod[apellidos_usuario]"); ?>"/><br/><br/>

					<strong>Mail:</strong><br/>
					<input type="text" name="mailUsuario" size="20" maxlength="25" value="<?php echo $prod['mail_usuario']; ?>"/><br/><br/>

					<strong>Direccion:</strong><br/>
					<input type="text" name="direccionUsuario" size="20" maxlength="25" value="<?php echo $prod['direccion_usuario']; ?>"/><br/><br/>

					<strong>Telefono:</strong><br/>
					<input type="text" name="telefonoUsuario" size="20" maxlength="25" value="<?php echo $prod['telefono_usuario']; ?>"/><br/><br/>
					
					

					<input id="botonFormModContacto" type="submit" value="Submit">
					<a href='cambiarcontrasenya.php'>Cambiar contraseña</a>
				</form>
			</article>

		<?php
		 
			//cerramos la conexión con la base de datos
		mysqli_close($con);
		?>
		<br/><br/>
		<article>
			<a font color= "black" href="principal.php">Volver</a>
		</article>
	</body>
</html>
