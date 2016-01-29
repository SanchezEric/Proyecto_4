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
      var latitud;
      var longitud;
      var latitud2;
      var longitud2;
      var markers = [];
      var directionsDisplay;

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
          title: "Yo",
          animation:google.maps.Animation.DROP  //DROP, BOUNCE
        });
        //cargaContenido();

        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            marker.setPosition(pos);
            map.setCenter(pos);
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        }
        directionsDisplay = new google.maps.DirectionsRenderer();
        directionsDisplay.setMap(map);
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

      function muestraContenido() {
        if(peticion_http.readyState == READY_STATE_COMPLETE) {
          if(peticion_http.status == 200) {
            ///creamos los markers
            datosCargados=eval('('+peticion_http.responseText+')');
            for(var i=0;i<datosCargados.length;i++){
              if(document.formulario.contactoUbic[i].checked){
                if(markers[i] == 'no' || markers[i] == undefined){
                  latitud = parseFloat(datosCargados[i].casa_lat);
                  longitud = parseFloat(datosCargados[i].casa_lon);
                  // alert(latitud+" - "+longitud);
                  var LatLngDestino = {lat: latitud, lng: longitud};
                  var DestinoLatLan = latitud+", "+longitud;
                  var marker = new google.maps.Marker({
                    map: map,
                    position: LatLngDestino,
                    animation:google.maps.Animation.DROP,  //DROP, BOUNCE
                    title: datosCargados[i].nombre
                  });
                  markers[i]=marker;
                  if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                      latitud2=position.coords.latitude;
                      longitud2=position.coords.longitude;
                      var LatLngOrigen = latitud2+", "+longitud2;
                      var directionsService = new google.maps.DirectionsService();
                      //alert(LatLngOrigen+" - "+DestinoLatLan);
                      var request = {
                        origin: LatLngOrigen,
                        destination: DestinoLatLan,
                        travelMode: google.maps.DirectionsTravelMode.DRIVING,
                        provideRouteAlternatives: true
                      };
                      directionsService.route(request,function(response, status){
                        if(status == google.maps.DirectionsStatus.OK){
                          //alert(google.maps.DirectionsStatus.OK);
                          directionsDisplay.setDirections(response);
                        }else{
                          alert("No hay rutas");
                        }
                      });
                    }, function() {
                      handleLocationError(true, infoWindow, map.getCenter());
                    });
                  }
                  //alert(markers[i]);
                }
              }else{
                if((markers[i] != 'no') && (markers[i] != undefined)){
                  //alert(markers[i]);
                  markers[i].setMap(null);
                  directionsDisplay.setMap(null);
                }
                markers[i]='no';
                //alert(markers[i]);
              }
            }
          }
        }
      }

      var contentString = markers[i].title;
      var infowindow = new google.maps.InfoWindow({
        content: contentString
      });
      markers[i].addListener('click', function() {
        infowindow.open(map, markers[i]);
      });

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
        <span>¡Bienvenido <a href='modificarperfil.php?id_usuario=$_SESSION[id]'><?php echo $_SESSION['nombre']." ".$_SESSION['apellidos']; ?></a>!</span>
      </article>
      <article class="myButton">
        <a href="logout.php">LOGOUT</a>
      </article>
      <?php
        $sql = "SELECT * FROM usuario WHERE mail_usuario = '$_SESSION[mail]'";
        $datos=mysqli_query($con,$sql);
        $pro=mysqli_fetch_array($datos);
        if ($pro['nivel_usuario'] == 1 OR $pro['nivel_usuario'] == 2) {
          echo "<article class='myButton'>";
          echo "<a href='administrarusuarios.php'> ADMINISTRAR USERS</a>";
          echo "</article>";
        }
      ?>
     <article class="myButton">
        <a href="gestionarcontactos.php">MIS CONTACTOS</a>
      </article>
      <article class="myButton">
<a href="gestionarlistas.php">MIS LISTAS</a>
      </article>
    </section>
    <section id="contenido">
      <div id="mapa"></div>
      <article id="contactos">
        <h3>Contactos</h3>
        <?php
          $sql="SELECT * FROM lista WHERE lista.id_usuario='$_SESSION[id]' OR lista.id_usuario IS NULL ";
          $datos=mysqli_query($con,$sql);
          $ubicacion = array();
          echo "<form name='formulario'>";
          if(mysqli_num_rows($datos)){
            while($lista=mysqli_fetch_array($datos)){
              echo "<h4><strong>".$lista['nombre_lista']."</strong></h4>";
              $sql2="SELECT *
                FROM contacto
                  INNER JOIN lista ON lista.id_lista=contacto.id_lista
                  INNER JOIN ubicacion ON ubicacion.id_ubicacion=contacto.id_ubicacion
                WHERE lista.id_lista=$lista[id_lista]";
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