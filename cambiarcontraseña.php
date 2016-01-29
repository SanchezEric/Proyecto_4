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
				<form name="formModUsuarios" action="cambiarcontraseña.proc.php" method="get">
					<input type="hidden" name="idUsuario" value="<?php echo $prod['id_usuario']; ?>">

					<strong>Password:</strong><br/>
					<input type="text" name="passwordUS" size="20" maxlength="25" value="<?php echo $prod['password']; ?>"/><br/><br/>
					

					<input id="botonFormModContacto" type="submit" value="Submit">
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
