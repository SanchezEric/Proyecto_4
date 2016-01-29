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
		<header></header>
		<section class="seccion">
			<article class="tituloForm">
				<h3>Modificar Usuarios</h3>
			</article>

			<article class = "Contactform">			
				<form name="formModUsuarios" action="cambiarMiPassword.proc.php" method="get">
					<input type="hidden" name="idUsuario" value="<?php echo $prod['id_usuario']; ?>">

					<strong>Password:</strong>
					<input type="text" name="password" size="20" maxlength="25" value="" required/>
					

					<input id="botonFormModContacto" type="submit" value="Cambiar password">
				</form>
			</article>
</section>
		<?php
		 
			//cerramos la conexión con la base de datos
		mysqli_close($con);
		?>
		
		<article id="volver">
			<button><a font color= "black" href="modificarperfil.php">Volver</a></button>
		</article>
		<footer id="piepagina">
      <p id="componentes">Raúl Calvo - Víctor Cruz - Eric Sánchez</p>
      <p id="copyright">2016 &copy; MyContacts</p>
    </footer>
	</body>
</html>
