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
    function load() {
      if (GBrowserIsCompatible()) {
        var latitud = 41.349580;
        var longitud =  2.107734;
        var zoom = 18;
        var mapa = new GMap2(document.getElementById("mapa"));
        mapa.setCenter(new GLatLng(latitud, longitud), zoom);
      }
      cargarMarcador(mapa);
    }
    function cargarMarcador(mapa) {
      var punto = new GPoint(2.108516,41.349665);
      var nuevoMarcador = new GMarker(punto);
      GEvent.addListener(nuevoMarcador,"click",function(){
        this.openInfoWindowHtml(nombre+" "+apellidos);
      });
      mapa.addOverlay(nuevoMarcador);
    }
    </script>
	</head>
	<body onload="load()" onunload="GUnload()">
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
                  echo "<button>".utf8_encode($contacto['nombre_contacto'])." ".utf8_encode($contacto['apellidos_contacto'])."</button>";
                }
              }
            }
          }
        ?>
      </article>
    </section>
    <footer id="piepagina">
      <p id="componentes">Raúl Calvo - Víctor Cruz - Eric Sánchez</p>
      <p id="copyright">2016 &copy; MyContacts</p>
    </footer>
	</body>
</html>