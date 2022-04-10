<?php
session_start();
include ("conex.php");
$datos=mysqli_fetch_array(mysqli_query($mysqli,"SELECT num_cotizacion FROM cotizacion ORDER BY num_cotizacion DESC LIMIT 1"));
date_default_timezone_set('America/Mexico_City');
$datos[0]=$_POST['idcot'];

$nota=$_POST['nota'];
$fechahoy = date('Y-m-d');
$user=$_SESSION['iduser'];

$idrem=$_POST['idr'];
$idds=$_POST["idss"];
$numero=explode(',', $idds);
$idboibnas=$_POST["id_remision"];
$ida=explode(',',$idboibnas);

for ($i=0; $i <count($numero) ; $i++) { 
	if($numero[$i]!=''){

		$valuex=$numero[$i];
		$idupdate=$ida[$i];
		if($idupdate!=''){

			mysqli_query($mysqli,"UPDATE remision set total='".$_POST["tot1"]."', id_articulo='".$_POST["articulo".$valuex]."', cantidad='".$_POST["cantidadpz".$valuex]."', largo='".$_POST["largo".$valuex]."', ancho='".$_POST["ancho".$valuex]."', hojas='".$_POST["m2_".$valuex]."', costo='".$_POST["m2_usd".$valuex]."', cliente='".$_POST["cliente"]."', nota='".$_POST["nota_".$valuex]."', usuario='".$user."', tipo_cambio='".$_POST["tipocambio_".$valuex]."' WHERE id_remision='$idupdate'   ");

			//mysqli_query($mysqli,"INSERT INTO remision(id_remision,fecha,total,id_articulo,cantidad,largo,ancho,hojas,costo,cliente,um,id,fecha_remicion,tipo,nota,tipo_cambio)values (null,'".$_POST["fecha"]."','".$_POST["tot1"]."','".$_POST["articulo".$valuex]."','".$_POST["cantidadpz".$valuex]."','".$_POST["largo".$valuex]."','".$_POST["ancho".$valuex]."','".$_POST["m2_".$valuex]."','".$_POST["m2_usd".$valuex]."','".$_POST["cliente"]."','".$_POST["pedimento".$valuex]."','".$datos[0]."','".$fechahoy."','B','".$_POST["nota_".$valuex]."','".$_POST["tipocambio_".$valuex]."');");

		}
		if($idupdate===''){

			mysqli_query($mysqli,"INSERT INTO remision(id_remision,fecha,total,id_articulo,cantidad,largo,ancho,hojas,costo,cliente,id,fecha_remicion,tipo,nota,tipo_cambio,usuario)values (null,'".$_POST["fecha"]."','".$_POST["tot1"]."','".$_POST["articulo".$valuex]."','".$_POST["cantidadpz".$valuex]."','".$_POST["largo".$valuex]."','".$_POST["ancho".$valuex]."','".$_POST["m2_".$valuex]."','".$_POST["m2_usd".$valuex]."','".$_POST["cliente"]."','".$idrem."','".$fechahoy."','B','".$_POST["nota_".$valuex]."','".$_POST["tipocambio_".$valuex]."','".$user."');");
		}
	}
}


header("Location:cotizar.php");
?>