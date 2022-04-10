<?php
session_start();
include ("conex.php");

//$datos=mysqli_fetch_array(mysqli_query($mysqli,"SELECT num_cotizacion FROM cotizacion ORDER BY num_cotizacion DESC LIMIT 1"));
date_default_timezone_set('America/Mexico_City');
$fechahoy = date('Y-m-d');
$user=$_SESSION['iduser'];

$id=$_POST["id"];
$nombre=$_POST["nombre"];
$desc=$_POST['desc'];


$update=mysqli_query($mysqli,"UPDATE articulos set nombre='$nombre', descripcion='$desc' where id_articulo='$id'  ");



?>