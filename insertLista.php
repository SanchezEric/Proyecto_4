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
				<h3>Modificar Lista</h3>
			</article>

			<article id = "Contactform">			
				<form name="formModLista" action="insertLista.proc.php" method="get">

					<strong>Nombre de la lista:</strong><br/>
					<input type="text" name="nomLista" size="20" maxlength="25" required/><br/><br/>

					<strong>Descripcion de la lista:</strong><br/>
					<input type="text" name="descLista" size="20" maxlength="25" /><br/><br/>
					
					<br/>

					<input id="botonFormModContacto" type="submit" value="Submit">
				</form>
			</article>

		
		<br/><br/>
		<article>
			<a font color= "black" href="gestionarlistas.php">Volver</a>
		</article>
	</body>
</html>