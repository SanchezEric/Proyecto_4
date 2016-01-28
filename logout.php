<?php
session_start();
	if(session_destroy()) //Destruimos la sesion del usuario
	{
		header('location:index.php'); // Lo devolvemos a la pagina index
	}
?>