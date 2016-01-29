<?php
	session_start();
  	if(!isset($_SESSION['mail'])){
  	$_SESSION['error']="Tienes que logarte";
 	header("Location: index.php");
  	}
  	include("conexion.php");
  	$sql="SELECT * FROM lista, usuario WHERE `lista`.`id_usuario` = '$_SESSION[id]' AND `lista`.`id_lista` = $_REQUEST[id_lista]";
	$datos = mysqli_query($con, $sql);
	$prod=mysqli_fetch_array($datos);
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Mycontacts</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="style.css">
		<style>
	    	a {color: blue;}
	    </style>
	</head>
	<body>
<header></header>
<section id="contenido">
		

			<article>
				<h3>Modificar Lista</h3>
			</article>

			<article id ="letrasregistro">			
				<form name="formModLista" action="modificarLista.proc.php" method="post">
					<input type="hidden" name="idLista" value="<?php echo $prod['id_lista']; ?>">

					<strong>Nombre de la lista:</strong><br/>
					<input type="text" name="nomLista" size="20" maxlength="25" value="<?php echo $prod['nombre_lista']; ?>"required/><br/><br/>

					<strong>Descripcion de la lista:</strong><br/>
					<input type="text" name="descLista" size="20" maxlength="25" value="<?php echo $prod['descripcion_lista']; ?>"/><br/><br/>
					
					<br/>

					<input id="botonFormModContacto" type="submit" value="Modificar">
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
