<html>
 <head>
 <title>My Contacts</title>
 <link href="styles.css" rel="stylesheet" type="text/css">
</head>
<header>
	</header>
<body>
	<?php 
 include('login.php');

 	//Miramos si la variable Sesion existe y enviamos a la pagina perfil
	if(isset($_SESSION['login_user'])){
	 	header('location:principal.php');
	} else{
		echo "<div>";
		echo "<form id='form1' action='login.php' method='POST'>";
		echo "<label>Usuario</label>"; 
		echo "<p/><input type='text' class='cuadrostexto' name='usuario'>";
		echo "</br></br>";
		echo "<label>Contraseña</label>"; 
		echo "<p><input type='password' class='cuadrostexto' name='password'></p>";
		echo "<p><input type='submit' name='submit' value='Identificarse'></p>";
		echo "</form>";
		echo "</div>";
	}

	
 ?>

 </body>
 </html>