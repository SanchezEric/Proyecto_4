<?php
	session_start();
	include("conexion.php");
	$pass_md5 = md5($_REQUEST['passwordUS']);
	$sql="INSERT INTO `usuario`(`password`, `nombre_usuario`, `apellidos_usuario`, `mail_usuario`, `direccion_usuario`, `telefono_usuario`, `nivel_usuario`) VALUES ('$pass_md5','$_REQUEST[nomUsuario]','$_REQUEST[apellidoUsuario]','$_REQUEST[mailUsuario]','$_REQUEST[direccionUsuario]','$_REQUEST[telefonoUsuario]',3)";
	$datos = mysqli_query($con, $sql);
	echo $sql;
	 header("location: index.php")

?>