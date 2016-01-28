<?php
	session_start();
  if(!isset($_SESSION['mail'])){
    $_SESSION['error']="Tienes que logarte";
    header("location:index.php");
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
        <span>¡Bienvenido <?php echo utf8_encode("<a href='modificarperfil.php?id_usuario=$_SESSION[id]'>$_SESSION[nombre] $_SESSION[apellidos]</a>") ?>!</span>
      </article>
      
      <article id="btnlogout">
        <button><a href="logout.php">LOGOUT</a></button>
      </article>
      <?php
          $sql = "SELECT * FROM usuario WHERE mail_usuario = '$_SESSION[mail]'";
          $datos=mysqli_query($con,$sql);
          $pro=mysqli_fetch_array($datos);
              if ($pro['nivel_usuario'] == 1 OR $pro['nivel_usuario'] == 2) {
                echo "<article id='btnperfil'>";
                echo "<button><a href='administrarusuarios.php'> ADMINISTRAR USERS</a></button>";
                echo "</article>";
              }
      ?>
     <article id="btncontactos">
        <button><a href="gestionarcontactos.php">MIS CONTACTOS</a></button>
</article>
      <article id="btnlista">
        <button><a href="gestionarlistas.php">MIS LISTAS</a></button>
      </article>
      
    </section>
    
    <section id="contenido">
      <div id="mapa"></div>
      <article id="contactos">
        <h3><u>Contactos</u></h3>
        <?php
          
          $sql="SELECT * FROM lista WHERE lista.id_usuario='$_SESSION[id]' OR lista.id_usuario IS NULL ";
          
          $datos=mysqli_query($con,$sql);
          if(mysqli_num_rows($datos)){
            while($lista=mysqli_fetch_array($datos)){
              echo "<h4>".$lista['nombre_lista']."</h4>";
              

              $sql2="SELECT *
                FROM contacto
                  INNER JOIN lista ON lista.id_lista=contacto.id_lista
                  INNER JOIN ubicacion ON ubicacion.id_ubicacion=contacto.id_ubicacion
                WHERE lista.id_lista=$lista[id_lista]";
              
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