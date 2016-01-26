<!-- conexion a la base de datos -->
<?php
$servidor = 'localhost';
$usuario = 'root';
$password = 'DAW22015';
$base_datos = 'bd_mycontacts';
$con = mysqli_connect($servidor,$usuario,$password,$base_datos) or die ("No se puede conectar a la base de datos!!");
?>