<?php
	session_start();

		//realizamos la conexión con mysql
		include("conexion.php");

		//Creamos la ubicación
		$sql="INSERT INTO `ubicacion`(`casa_lat`, `casa_lon`, `trabajo_lat`, `trabajo_lon`) VALUES ('$_REQUEST[casalatCont]','$_REQUEST[casalonCont]','$_REQUEST[trabajolatCont]','$_REQUEST[trabajolonCont]')";
		$datos = mysqli_query($con, $sql);

		 // echo $sql;
		 echo "<br>";

		//Buscamos el registro que acabamos de crear
		$sql1="SELECT * FROM `ubicacion` WHERE `ubicacion`.`casa_lat`= '$_REQUEST[casalatCont]' AND ubicacion.casa_lon= '$_REQUEST[casalonCont]' AND ubicacion.trabajo_lat= '$_REQUEST[trabajolatCont]' AND ubicacion.trabajo_lon= '$_REQUEST[trabajolonCont]' ORDER BY ubicacion.id_ubicacion DESC limit 1";
		$datos1 = mysqli_query($con, $sql1);

		// echo $sql1;
		
	 
		 echo "<br>";
		if(mysqli_num_rows($datos1)>0){
			$prod=mysqli_fetch_array($datos1);
			$ubicacionid = $prod['id_ubicacion'];
			// echo $ubicacionid;
			 

		// echo "<br>";

		$sql2="INSERT INTO `contacto`(`nombre_contacto`, `apellidos_contacto`, `id_ubicacion`, `id_lista`) VALUES ('$_REQUEST[nomCont]','$_REQUEST[apellCont]',$ubicacionid,'$_REQUEST[idlista]')";
			$datos2 = mysqli_query($con, $sql2);
			
			echo $sql2;
			echo "</br>";
			
			  header("Location: gestionarcontactos.php");




				} else{
			echo "Error";
		}

?>