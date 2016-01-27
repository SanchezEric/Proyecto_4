<?php
	session_start();
	if(!isset($_SESSION['mail'])){
		$_SESSION['error']="Tienes que logarte";
		header("Location: index.php");
	}
	include("conexion.php");
	$sql="SELECT * FROM usuario INNER JOIN lista ON lista.id_usuario=usuario.id_usuario WHERE usuario.id_usuario=$_SESSION[id]";
	$datos=mysqli_query($con,$sql);
	$ubicacion = array();
	if(mysqli_num_rows($datos)){
		while($lista=mysqli_fetch_array($datos)){
			$sql2="SELECT * FROM contacto INNER JOIN lista ON lista.id_lista=contacto.id_lista INNER JOIN ubicacion ON ubicacion.id_ubicacion=contacto.id_ubicacion WHERE lista.id_usuario=$_SESSION[id] AND lista.id_lista=$lista[id_lista]";
			$datos2=mysqli_query($con,$sql2);
			if(mysqli_num_rows($datos2)){
				while($contacto=mysqli_fetch_array($datos2)){
					$idUbicacion=$contacto['id_ubicacion'];
					$latitud=$contacto['casa_lat'];
					$longitud=$contacto['casa_lon'];
					$ubicacion[] = array('id_ubicacion'=> $idUbicacion, 'casa_lat'=> $latitud, 'casa_lon'=> $longitud);
				}
			}
		}
	}
	$json_string = json_encode($ubicacion);
	echo $json_string;
?>