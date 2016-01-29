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
<style>
	    	a {color: blue;}
	    </style>
	<head>
		<title>Mycontacts</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>

	<body>
<header></header>
<section id="contenido1">
		

			<article>
				<h3>Modificar Usuarios</h3>
			</article>

			<article id = "letrasregistro">			
				<form name="formModUsuarios" action="modificarUsuarios.proc.php" method="post">
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
							
							$sql = mysqli_query($con, "SELECT * FROM nivel, usuario WHERE `usuario`.`id_usuario` = '$_SESSION[id]' AND `usuario`.`mail_usuario` = '$_SESSION[mail]'");


							while($dato=mysqli_fetch_array($sql)) {
							echo "<option value=\"$dato[id_nivel]\">$dato[nombre_nivel]</option>";
							}
							
							?>

					</select>
					<br>
					<input class="myButton1" id="botonFormModContacto" type="submit" value="Modifica el usuario">
				</form>
			</article>

		<?php
		 
			//cerramos la conexión con la base de datos
		mysqli_close($con);
		?>
		<br/><br/>
		<article class="myButton1">
			<br>
			<a href="principal.php">Volver</a>
		</article>
		</section>
		<footer id="piepagina">
      <p id="componentes">Raúl Calvo - Víctor Cruz - Eric Sánchez</p>
      <p id="copyright">2016 &copy; MyContacts</p>
    </footer>
	</body>
</html>
