<?php 
include ("conex.php");
$datos=mysqli_fetch_array(mysqli_query($mysqli,"SELECT id FROM remision ORDER BY id DESC LIMIT 1"));
date_default_timezone_set('America/Mexico_City');
$datos[0]=$datos[0]+1;
$idds=$_POST["idss"];
$nota=$_POST['nota'];
$fechahoy = date('Y-m-d');

$numero=explode(',', $idds);
foreach ($numero as  $valuex) {
	if($valuex!="")
	{

		mysqli_query($mysqli,"INSERT INTO remision(id_remision,fecha,total,id_articulo,cantidad,largo,ancho,hojas,costo,cliente,um,id,fecha_remicion,tipo,nota)values (null,'".$_POST["fecha"]."','".$_POST["tot1"]."','".$_POST["articulo".$valuex]."','".$_POST["precio".$valuex]."','".$_POST["largo".$valuex]."','".$_POST["ancho".$valuex]."','".$_POST["hojas".$valuex]."','".$_POST["costo".$valuex]."','".$_POST["cliente"]."','".$_POST["um".$valuex]."','".$datos[0]."','".$fechahoy."','R','".$_POST["nota_".$valuex]."');");
	}
	# code...
}
if ($nota!='') {
	mysqli_query($mysqli,"INSERT into notas_remision(id_remision,nota)values('$datos[0]','$nota')");
}


header("Location:remision_l.php");
?>