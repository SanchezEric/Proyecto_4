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
				<form name="formModLista" action="insertLista.proc.php" method="post">

					<strong>Nombre de la lista:</strong><br/>
					<input type="text" name="nomLista" size="20" maxlength="25" required/><br/><br/>

					<strong>Descripcion de la lista:</strong><br/>
					<input type="text" name="descLista" size="20" maxlength="25" /><br/><br/>
					
					<br/>

					<input id="botonFormModContacto" type="submit" value="Submit">
				</form>
			</article>

		
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