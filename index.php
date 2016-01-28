<html>
 <head>
 <title>My Contacts</title>
 <link href="styles.css" rel="stylesheet" type="text/css">
</head>
<header>
	</header>
<body>
	<?php 

 	//Miramos si la variable Sesion existe y enviamos a la pagina perfil
	if(isset($_SESSION['mail'])){
	 	header('location:principal.php');
	} else{
		echo "<div>";
		echo "<form id='form1' action='login.php' method='get'>";
		echo "<label>Usuario</label>"; 
		echo "<p/><input type='text' class='cuadrostexto' name='mail'>";
		echo "</br></br>";
		echo "<label>Contraseña</label>"; 
		echo "<p><input type='password' class='cuadrostexto' name='password'></p>";
		echo "<p><input type='submit' name='submit' value='Identificarse'>";
		echo "</form>";
		echo "<p><form id='form1' action='registro.php'><input type=submit value='Registrate'></form></p>";
		echo "</div>";
	}

	
 ?>

 </body>
 </html>