<?php
	session_start();
  	if(!isset($_SESSION['mail'])){
  	$_SESSION['error']="Tienes que logarte";
 	header("Location: index.php");
  	}
  	include("conexion.php");
  	$sql="SELECT contacto.*, ubicacion.*, lista.* FROM contacto INNER JOIN ubicacion ON contacto.id_ubicacion=ubicacion.id_ubicacion INNER JOIN lista ON contacto.id_lista=lista.id_lista WHERE id_contacto=$_REQUEST[idCont]";
	$datos = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Mycontacts</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>

		<?php

		if(mysqli_num_rows($datos)>0){
			$prod=mysqli_fetch_array($datos);
			$ubicacionid = $prod['id_ubicacion'];
			// echo $sql;
			// echo $ubicacionid;
		?>

			<article>
				<h3>Modificar Contacto</h3>
			</article>

			<article id = "Contactform">			
				<form name="formModContacto" action="modificarContacto.proc.php" method="POST">
					<input type="hidden" name="idContacto" value="<?php echo $prod['id_contacto']; ?>">

					<strong>Nombre del contacto:</strong><br/>
					<input type="text" name="nomCont" size="20" maxlength="25" value="<?php echo $prod['nombre_contacto']; ?>"required/><br/><br/>

					<strong>Apellido del contacto:</strong><br/>
					<input type="text" name="apellCont" size="20" maxlength="25" value="<?php echo $prod['apellidos_contacto']; ?>"/><br/><br/>
					
					<strong>Mis listas:</strong><br/>
					
					<select name="idlista">

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
					C.lat<input type="text" name="casalatCont" size="5" maxlength="8" value="<?php echo $prod['casa_lat']; ?>"/><br/><br/>
					C.long<input type="text" name="casalonCont" size="5" maxlength="8" value="<?php echo $prod['casa_lon']; ?>"/><br/><br/>		

					<!-- Trabajo ubicacion -->
					T.lat<input type="text" name="trabajolatCont" size="5" maxlength="8" value="<?php echo $prod['trabajo_lat']; ?>"/><br/><br/>
					T.long<input type="text" name="trabajolonCont" size="5" maxlength="8" value="<?php echo $prod['trabajo_lon']; ?>"/><br/><br/>
					<input id="botonFormModContacto" type="submit" value="Submit">

				</form>
			</article>

		<?php
		} else {
			echo "Usuario con id=$_REQUEST[idCont] no encontrado!";
		}
			//cerramos la conexión con la base de datos
		mysqli_close($con);
		?>
		<br/><br/>
		<article>
			<a font color= "black" href="gestionarcontactos.php">Volver</a>
		</article>
	</body>
</html>
