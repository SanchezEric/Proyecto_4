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
		<script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
	    <script>
        var geocoder;
        var map;
        function initialize() {
          var latlng = new google.maps.LatLng(41.3659286, 2.1769215);
          var mapOptions = {
            zoom: 12,
            center: latlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
          }
          map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);
        }
   
        function codeAddress() {
          geocoder = new google.maps.Geocoder();
          var address = document.getElementById('address').value;
          geocoder.geocode( { 'address': address}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
              document.getElementById('x').value = results[0].geometry.location.lat().toFixed(6);
              document.getElementById('y').value = results[0].geometry.location.lng().toFixed(6);
              map.setCenter(results[0].geometry.location);
              var marker = new google.maps.Marker({
                  map: map,
                  position: results[0].geometry.location
              });
            } else {
              alert('No se ha encontrado tu direccion:');
            }
          });
      }
    </script>
	</head>
	<body onload="initialize()">

		<article>
				<h3>Insertar Contacto</h3>
			</article>

			<article id = "Contactform">			
				<form name="formInserContacto" action="InsertContacto.proc.php" method="get">
					
					<strong>Nombre:</strong><br/>
					<input type="text" name="nomCont" size="20" maxlength="25" required/><br/><br/>

					<strong>Apellido:</strong><br/>
					<input type="text" name="apellCont" size="20" maxlength="25"/><br/><br/>
					
					<strong>Lista:</strong><br/>
					<select name="idlista" value="3">

							<?php
							/*hacemos un form y rellenamos el select o combobox*/
							/*include conexion.php etc.... la conexion antes que nada......*/
							$con = mysqli_connect('localhost', 'root', 'DAW22015', 'bd_mycontacts');
							$sql = mysqli_query($con, "SELECT * FROM lista, usuario WHERE `lista`.`id_usuario` = '$_SESSION[id]' AND `usuario`.`mail_usuario` = '$_SESSION[mail]'");


							while($dato=mysqli_fetch_array($sql)) {
							echo "<option value=\"$dato[id_lista]\">$dato[nombre_lista]</option>";
							}
							
							?>

					</select>
					<br/>

					<strong>ubicación:</strong><br/>
					<!-- Casa ubicacion -->
					C.lat<input type="text" id="x" name="casalatCont" size="5" maxlength="8" /><br/><br/>
					C.long<input type="text" id="y" name="casalonCont" size="5" maxlength="8" /><br/><br/>		

					<!-- Trabajo ubicacion -->
					T.lat<input type="text" name="trabajolatCont" size="5" maxlength="8" /><br/><br/>
					T.long<input type="text" name="trabajolonCont" size="5" maxlength="8" /><br/><br/>
					<input id="botonFormModContacto" type="submit" value="Submit">
						 </br></br>
						 Tambien puedes seleccionar tu ubicación mediante el mapa:
						</br>
						 <input id="address" type="textbox" value="" />
						<input type="button" value="Localizar" onclick="codeAddress()"></br>
						</div>	
    				<div id="map_canvas" style="width:50%;height:50%;"></div>
				</form>
			</article>
		<?php
		
			
		mysqli_close($con);
		?>
		<br/><br/>
		<article>
			<a font color= "black" href="gestionarcontactos.php">Volver</a>
		</article>
	</body>
</html>
