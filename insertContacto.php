<?php
	session_start();
	if(!isset($_SESSION['mail'])){
  	$_SESSION['error']="Tienes que logarte";
 	header("Location: index.php");
  	}
?>
<html>
	<head>
		<title>Mycontacts</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>

		<article>
				<h3>Insertar Contacto</h3>
			</article>

			<article id = "Contactform">			
				<form name="formInserContacto" action="InsertContacto.proc.php" method="get">
					
					<strong>Nombre:</strong><br/>
					<input type="text" name="nomCont" size="20" maxlength="25" required/><br/><br/>

					<strong>Apellido:</strong><br/>
					<input type="text" name="apellCont" size="20" maxlength="25"/><br/><br/>
					
					<strong>Lista:</strong><br/>
					<select name="idlista" value="3">

							<?php
							/*hacemos un form y rellenamos el select o combobox*/
							/*include conexion.php etc.... la conexion antes que nada......*/
							$con = mysqli_connect('localhost', 'root', 'DAW22015', 'bd_mycontacts');
							$sql = mysqli_query($con, "SELECT * FROM lista, usuario WHERE `lista`.`id_usuario` = '$_SESSION[id]' AND `usuario`.`mail_usuario` = '$_SESSION[mail]'");


							while($dato=mysqli_fetch_array($sql)) {
							echo "<option value=\"$dato[id_lista]\">$dato[nombre_lista]</option>";
							}
							
							?>

					</select>
					<br/>

					<strong>ubicación:</strong><br/>
					<!-- Casa ubicacion -->
					C.lat<input type="text" name="casalatCont" size="5" maxlength="8" /><br/><br/>
					C.long<input type="text" name="casalonCont" size="5" maxlength="8" /><br/><br/>		

					<!-- Trabajo ubicacion -->
					T.lat<input type="text" name="trabajolatCont" size="5" maxlength="8" /><br/><br/>
					T.long<input type="text" name="trabajolonCont" size="5" maxlength="8" /><br/><br/>
					<input id="botonFormModContacto" type="submit" value="Submit">

				</form>
			</article>
		<?php
		
			
		mysqli_close($con);
		?>
		<br/><br/>
		<article>
			<a font color= "black" href="gestionarcontactos.php">Volver</a>
		</article>
	</body>
</html>
