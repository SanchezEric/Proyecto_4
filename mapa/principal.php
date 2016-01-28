<?php
	session_start();
  if(!isset($_SESSION['mail'])){
    $_SESSION['error']="Tienes que logarte";
    header("Location: index.php");
  }
  include("conexion.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Mycontacts</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="style.css">
		
    <script src="http://maps.google.com/maps?file=api&amp;v=2&amp;hl=es&amp;key=ABQIAAAA30JtKUU8se-7KKPRGSfCMBT2yXp_ZAY8_ufC3CFXhHIE1NvwkxRZNdns2BwZvEY-V68DvlyUYwi1-Q" type="text/javascript"></script>
    <script type="text/javascript">
      var map;
      var latitud, longitud;
      var markers = [];

      function initMap() {
        map = new google.maps.Map(document.getElementById('mapa'), {
          center: {lat: 41.3495464, lng: 2.1076887},
          //mapTypeId: google.maps.MapTypeId.SATELLITE,
          mapTypeId:google.maps.MapTypeId.ROADMAP,
          zoom: 16
        });
        var marker = new google.maps.Marker({
          map: map,
          position: {lat: 41.3495464, lng: 2.1076887},
          animation:google.maps.Animation.DROP  //DROP, BOUNCE
        });
        setTimeout("cambiar()", 3000);
        //cargaContenido();
      }
      function cambiar(){
        var myLL = {lat: 41.3495450, lng: 2.1076887};
        marker.setPosition(myLL);
      }

      var READY_STATE_UNINITIALIZED=0;
      var READY_STATE_LOADING=1;
      var READY_STATE_LOADED=2;
      var READY_STATE_INTERACTIVE=3;
      var READY_STATE_COMPLETE=4;

      var peticion_http,datosCargados;

      function inicializa_xhr() {
        if(window.XMLHttpRequest) {
          return new XMLHttpRequest();
        }
        else if(window.ActiveXObject) {
          return new ActiveXObject("Microsoft.XMLHTTP");
        }
      }

      function cargaContenido() {
        peticion_http = inicializa_xhr();
        if(peticion_http) {
          peticion_http.onreadystatechange = muestraContenido;
          peticion_http.open("GET", "ubicacion.php", true);
          peticion_http.send(null);
        }
      }

      // function clearMarkers() {
      //   alert("entra clear");
      //   setMapOnAll(null);
      //   alert("sale clear");
      // }

      // function deleteMarkers() {
      //   alert("entra delete");
      //   clearMarkers();
      //   alert("sale clear2");
      //   var markers = [];
      // }

      function muestraContenido() {
        //deleteMarkers();
        //alert("nos vemos");
        if(peticion_http.readyState == READY_STATE_COMPLETE) {
          if(peticion_http.status == 200) {
            ///creamos los markers
            datosCargados=eval('('+peticion_http.responseText+')');
            for(var i=0;i<datosCargados.length;i++){
              if(document.formulario.contactoUbic[i].checked){
                if(markers[i] == 'no' || markers[i] == undefined){
                  //alert("entra");
                  latitud = parseFloat(datosCargados[i].casa_lat);
                  longitud = parseFloat(datosCargados[i].casa_lon);
                  // alert(latitud+" - "+longitud);
                  var myLatLng = {lat: latitud, lng: longitud};
                  var marker = new google.maps.Marker({
                    map: map,
                    position: myLatLng,
                    animation:google.maps.Animation.DROP,  //DROP, BOUNCE
                    title: datosCargados[i].id_ubicacion
                  });
                  markers[i]=marker;
                  //alert(markers[i]);
                  //alert(markers[i].title);
                }
              }else{
                if((markers[i] != 'no') && (markers[i] != undefined)){
                  //alert(markers[i]);
                  markers[i].setMap(null);
                }
                markers[i]='no';
                //alert(markers[i]);
              }
            }
          }
        }
      }

        /*var latLng = new google.maps.LatLng(obj[1].casa_lat,obj[1].casa_lon); 
        // Creating a marker and putting it on the map
        var marker = new google.maps.Marker({
          position: latLng,
          animation:google.maps.Animation.DROP,
          title: "hola"
        });
        marker.setMap(map);*/
    </script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBnwgpiAPeTVeXIsKprG8ZFZ4dir7YhEf4&signed_in=true&callback=initMap"></script>
    
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script> 
	</head>
	<body>
		<header>
		</header>
    <section id="menu">
      <article id="bienvenida">
        <span>¡Bienvenido <?php echo utf8_encode($_SESSION['nombre'])." ".utf8_encode($_SESSION['apellidos']) ?>!</span>
      </article>
      <article id="btnlogout">
        <button><a href="logout.php">LOGOUT</a></button>
      </article>
    </section>
    <section id="contenido">
      <div id="mapa"></div>
      <article id="contactos">
        <h3><u>Contactos</u></h3>
        <?php
          $sql="SELECT *
                FROM usuario
                  INNER JOIN lista ON lista.id_usuario=usuario.id_usuario
                WHERE usuario.id_usuario=$_SESSION[id]";
          $datos=mysqli_query($con,$sql);
          $ubicacion = array();
          echo "<form name='formulario'>";
          if(mysqli_num_rows($datos)){
            while($lista=mysqli_fetch_array($datos)){
              echo "<h4>".$lista['nombre_lista']."</h4>";
              $sql2="SELECT *
                FROM contacto
                  INNER JOIN lista ON lista.id_lista=contacto.id_lista
                  INNER JOIN ubicacion ON ubicacion.id_ubicacion=contacto.id_ubicacion
                WHERE lista.id_usuario=$_SESSION[id] AND lista.id_lista=$lista[id_lista]";
              $datos2=mysqli_query($con,$sql2);
              if(mysqli_num_rows($datos2)){
                while($contacto=mysqli_fetch_array($datos2)){
                  echo "<p>".utf8_encode($contacto['nombre_contacto'])." ".utf8_encode($contacto['apellidos_contacto'])."<input name='contactoUbic' type='checkbox' onclick='cargaContenido();'></p>";
                }
              }
            }
          }
          echo "</form>";
        ?>
      </article>
    </section>
    <footer id="piepagina">
      <p id="componentes">Raúl Calvo - Víctor Cruz - Eric Sánchez</p>
      <p id="copyright">2016 &copy; MyContacts</p>
    </footer>
	</body>
</html>