<?php
//Conectamos con el servidor y la base de datos
$conexion = mysqli_connect('localhost','root','DAW22015','bd_proyecto_david');

//Inciamos la sesion
session_start();

//Guardamos la sesion es un variable
$user = $_SESSION['login_user'];

//Creamos la consulta 
$sql = ("SELECT * FROM tbl_usuario WHERE usu_id ='$user'");

$datos = mysqli_query($conexion,$sql);

$row = mysqli_fetch_assoc($datos);

$login_sesion = $row['usu_id'];

?>