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
		<meta charset="utf-8"/>
		<title>Usuarios de la pagina web</title>
	    <!-- full d'estils per a fer servir fonts d'icons -->
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	    <link rel="stylesheet" type="text/css" href="style.css">
	    <style>
	    	a {color: blue;}
	    </style>
	</head>
	<body>
		<header></header>
		<section id="contenido">
		<?php
			//realizamos la conexión con mysql
			$con = mysqli_connect('localhost','root','DAW22015','bd_mycontacts');

			//como la sentencia SIEMPRE va a buscar todos los registros de la tabla producto, pongo en la variable $sql esa parte de la sentencia que SI o SI, va a contener
			$sql = "SELECT * FROM contacto, lista, usuario WHERE `contacto`.`id_lista` = `lista`.`id_lista` AND `lista`.`id_usuario` = '$_SESSION[id]' AND `usuario`.`mail_usuario` = '$_SESSION[mail]'";

			//mostramos la consulta para ver por pantalla si es lo que esperábamos o no
			//echo "$sql<br/>";

			//lanzamos la sentencia sql
			$datos = mysqli_query($con, $sql);

			?>
			<table border>
				<tr>
					<th>Nombre</th>
					<th>Apellidos</th>
					<th>Nombre de la lista</th>
					<th>Descripcion de la lista</th>
					<th>Operaciones</th>
				</tr>

				<?php

				//recorremos los resultados y los mostramos por pantalla
				//la función substr devuelve parte de una cadena. A partir del segundo parámetro (aquí 0) devuelve tantos carácteres como el tercer parámetro (aquí 25)
				while ($prod = mysqli_fetch_array($datos)){
					echo utf8_encode("<td>$prod[nombre_contacto]");
					echo utf8_encode("</td><td>$prod[apellidos_contacto]");
					echo utf8_encode("</td><td>$prod[nombre_lista]");
					echo utf8_encode("</td><td>$prod[descripcion_lista]</td><td>");
					
				
					echo "<a href='modificarContacto.php?idCont=$prod[id_contacto]'>Modificar</a>";
					

					//enlace a la página que elimina el producto pasándole la id (clave primaria)
					
					echo " || <a href='eliminarContacto.php?idCont=$prod[id_contacto]'>Eliminar</i></a>";

					echo "</td></tr>";
				}

				?>

			</table>

			<a href="insertContacto.php"><i class='fa fa-plus-square fa-2x fa-pull-left fa-border'></i></a>



				<?php
			//cerramos la conexión con la base de datos
			mysqli_close($con);
		?>
		<br/><br/>
		<article class="myButton1">
		<a href="principal.php">Volver</a>
		</article>
	</section>
		<footer id="piepagina">
      <p id="componentes">Raúl Calvo - Víctor Cruz - Eric Sánchez</p>
      <p id="copyright">2016 &copy; MyContacts</p>
    </footer>
	</body>
</html>