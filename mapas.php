<?php
 session_start();
 include("conexion.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <title>My Contacts</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">

 <link rel="stylesheet" type="text/css" href="css/css-maps.css">
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
  <h2>Crear Contacto</h2>
  </article>
  <article>  
   <form action="add_cont_proc.php" method="GET">
    <p><input type="text" name="cont_name" maxlength="25" placeholder="Nombre del contacto" title="Ejemplo: tudireccion@dominio.es"></p>
    <p><input type="text" name="cont_surname" maxlength="25" placeholder="Apellido del contacto"></p>
    <p><input type="email" name="cont_correo" maxlength="35" placeholder="Correo electronico del contacto"></p>
    <p><input type="text" name="cont_dir" placeholder="Direccion del contacto"></p>
    <p><input type="text" name="cont_mv" maxlength="9" placeholder="Telefono Movil"></p>
    <p><input type="text" name="cont_house" maxlength="9" placeholder="Telefono Casa"></p>
    <p><input type="text" name="cont_job" maxlength="9" placeholder="Telefono trabajo"></p>
    
    <p> Latitud: <input type="text" id="x" />
         <p>Longitud: <input type="text" id="y" />
         <br/>
         <input type="submit" value="Terminado">
         <br />
         <input id="address" type="textbox" value="" />
         <input type="button" value="Localizar" onclick="codeAddress()">
    
    <div id="map_canvas" style="height:90%;"></div>

   </form> 
   <div id="map_canvas" style="height:90%;"></div>
    <br/><br/>
  </article>
 <div id="map_canvas" style="height:90%;"></div>
    

</body>
</html>