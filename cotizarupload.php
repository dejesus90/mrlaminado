<?php
session_start();
include ("conex.php");
$datos=mysqli_fetch_array(mysqli_query($mysqli,"SELECT num_cotizacion FROM cotizacion ORDER BY num_cotizacion DESC LIMIT 1"));
date_default_timezone_set('America/Mexico_City');
$datos[0]=$datos[0]+1;

$idds=$_POST["idapp"];

$nota=$_POST['nota'];
$nota2=$_POST['nota2'];
$fechahoy = date('Y-m-d');

$user=$_SESSION['iduser'];

$numero=explode(',', $idds);
foreach ($numero as  $valuex) {
	if($valuex!="")
	{

		mysqli_query($mysqli,"INSERT INTO cotizacion(id,fecha,total,id_articulo,cantidad,largo,ancho,hojas,costo,cliente,um,num_cotizacion,fecha_cotizacion,tipo,nota,usuario,nota2)
			values (null,'".$_POST["fecha"]."','".$_POST["tot1"]."','".$_POST["articulo".$valuex]."','".$_POST["precio".$valuex]."','".$_POST["largo".$valuex]."','".$_POST["ancho".$valuex]."','".$_POST["hojas".$valuex]."','".$_POST["costo".$valuex]."','".$_POST["cliente"]."','".$_POST["um".$valuex]."','".$datos[0]."','".$fechahoy."','A','".$_POST["nota_".$valuex]."','".$user."','".$nota2."');");
	}
	# code...
}

$idds=$_POST["idbob"];

$numero=explode(',', $idds);
foreach ($numero as  $valuex) {
	if($valuex!="")
	{

		mysqli_query($mysqli,"INSERT INTO cotizacion(id,fecha,total,id_articulo,cantidad,largo,ancho,hojas,costo,cliente,um,num_cotizacion,fecha_cotizacion,tipo,nota,tipocambio,usuario,nota2)values (null,'".$_POST["fecha"]."','".$_POST["tot1"]."','".$_POST["articulob".$valuex]."','".$_POST["cantidadpz".$valuex]."','".$_POST["largob".$valuex]."','".$_POST["anchob".$valuex]."','".$_POST["m2_".$valuex]."','".$_POST["m2_usd".$valuex]."','".$_POST["cliente"]."','".$_POST["pedimento".$valuex]."','".$datos[0]."','".$fechahoy."','B','".$_POST["notab_".$valuex]."','".$_POST["tipocambio_".$valuex]."','".$user."','".$nota2."');");
	}
}


header("Location:cotizar.php");
?>