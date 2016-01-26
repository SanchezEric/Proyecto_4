<?php
	session_start();
	include("conexion.php");
	$passwordCod=md5($_REQUEST['password']);
	$sql="SELECT * FROM usuario WHERE mail_usuario='$_REQUEST[mail]' AND password='$passwordCod'";
	$datos=mysqli_query($con,$sql);
	if (mysqli_num_rows($datos)==1){
		while($usu=mysqli_fetch_array($datos)){
			$_SESSION['id']=$usu['id_usuario'];
			$_SESSION['mail']=$usu['mail_usuario'];
			$_SESSION['nombre']=$usu['nombre_usuario'];
			$_SESSION['apellidos']=$usu['apellidos_usuario'];
			$_SESSION['nivel']=$usu['nivel_usuario'];
		}
		header("Location: principal.php");
	}else{
		$_SESSION['error']="Usuario y/o contraseña incorrectas";
		header("Location: index.php");
	}
?>