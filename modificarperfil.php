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
		<header>
		</header>
		<section class="seccion">
			<article class="tituloForm">
				<h3>Modificar Usuarios</h3>
			</article>
			<article class= "Contactform">			
				<form name="formModUsuarios" action="modificarperfil.proc.php" method="get">
					<input type="hidden" name="idUsuario" value="<?php echo $prod['id_usuario']; ?>">

					<strong>Nombre:</strong>
					<input type="text" name="nomUsuario" size="20" maxlength="25" value="<?php echo $prod['nombre_usuario']; ?>"required/>

					<strong>Apellidos:</strong>
					<input type="text" name="apellidoUsuario" size="20" maxlength="25" value="<?php echo $prod['apellidos_usuario']; ?>"/>

					<strong>Mail:</strong>
					<input type="text" name="mailUsuario" size="20" maxlength="25" value="<?php echo $prod['mail_usuario']; ?>"/>

					<strong>Direccion:</strong>
					<input type="text" name="direccionUsuario" size="20" maxlength="25" value="<?php echo $prod['direccion_usuario']; ?>"/>

					<strong>Telefono:</strong>
					<input type="text" name="telefonoUsuario" size="20" maxlength="25" value="<?php echo $prod['telefono_usuario']; ?>"/>
						
					<input id="botonFormModContacto" type="submit" value="Modificar">
					<button><a href='cambiarMiPassword.php'>Cambiar contraseña</a></button>
					</form>
				</article>
			</section>
		<?php
			//cerramos la conexión con la base de datos
			mysqli_close($con);
		?>
		
		<article id="volver">
			<button><a font color= "black" href="principal.php">Volver</a></button>
		</article>
		<footer id="piepagina">
      <p id="componentes">Raúl Calvo - Víctor Cruz - Eric Sánchez</p>
      <p id="copyright">2016 &copy; MyContacts</p>
    </footer>
	</body>
</html>
