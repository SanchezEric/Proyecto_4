<?php
	session_start();
  	if(!isset($_SESSION['mail'])){
  	$_SESSION['error']="Tienes que logarte";
 	header("Location: index.php");
  	}
  	include("conexion.php");
  	$sql="SELECT * FROM usuario WHERE id_usuario = '$_REQUEST[id_usuario]'";
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
				<form name="formModUsuarios" action="modificarUsuarios.proc.php" method="get">
					<input type="hidden" name="idUsuario" value="<?php echo $prod['id_usuario']; ?>">

					<strong>Nombre del Usuario:</strong><br/>
					<input type="text" name="nomUsuario" size="20" maxlength="25" value="<?php echo utf8_encode("$prod[nombre_usuario]"); ?>"required/><br/><br/>

					<strong>Apellido del Usuario:</strong><br/>
					<input type="text" name="apellidoUsuario" size="20" maxlength="25" value="<?php echo utf8_encode("$prod[apellidos_usuario]"); ?>"/><br/><br/>

					<strong>Mail del Usuario:</strong><br/>
					<input type="text" name="mailUsuario" size="20" maxlength="25" value="<?php echo $prod['mail_usuario']; ?>"/><br/><br/>

					<strong>Direccion del Usuario:</strong><br/>
					<input type="text" name="direccionUsuario" size="20" maxlength="25" value="<?php echo $prod['direccion_usuario']; ?>"/><br/><br/>

					<strong>Telefono del Usuario:</strong><br/>
					<input type="text" name="telefonoUsuario" size="20" maxlength="25" value="<?php echo $prod['telefono_usuario']; ?>"/><br/><br/>
					
					<strong>Nivel de Usuario:</strong><br/>
					<select name="nivelusuario">

							<?php
							/*hacemos un form y rellenamos el select o combobox*/
							/*include conexion.php etc.... la conexion antes que nada......*/
							$con = mysqli_connect('localhost', 'root', 'DAW22015', 'bd_mycontacts');
							$sql = mysqli_query($con, "SELECT * FROM nivel, usuario WHERE `usuario`.`id_usuario` = '$_SESSION[id]' AND `usuario`.`mail_usuario` = '$_SESSION[mail]'");


							while($dato=mysqli_fetch_array($sql)) {
							echo "<option value=\"$dato[id_nivel]\">$dato[nombre_nivel]</option>";
							}
							
							?>

					</select>

					<input id="botonFormModContacto" type="submit" value="Submit">
				</form>
			</article>

		<?php
		 
			//cerramos la conexión con la base de datos
		mysqli_close($con);
		?>
		<br/><br/>
		<article>
			<a font color= "black" href="administrarusuarios.php">Volver</a>
		</article>
	</body>
</html>
