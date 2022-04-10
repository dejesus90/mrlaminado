<?php
session_start();
include ("conex.php");
$datos=mysqli_fetch_array(mysqli_query($mysqli,"SELECT num_cotizacion FROM cotizacion ORDER BY num_cotizacion DESC LIMIT 1"));
date_default_timezone_set('America/Mexico_City');
$datos[0]=$_POST['idcot'];

$idds=$_POST["idapp"];
$idapp=$_POST["idapli"];

$nota=$_POST['nota'];
$fechahoy = date('Y-m-d');

$user=$_SESSION['iduser'];



$numero=explode(',', $idds);
$ida=explode(',', $idapp);
$cont=0;

for ($i=0; $i <count($numero) ; $i++) {
	if($numero[$i]!=''){
		$valuex=$numero[$i];
		$idupdate=$ida[$i];
		if($idupdate!=''){
			//update
			mysqli_query($mysqli,"UPDATE cotizacion set total='".$_POST["tot1"]."', id_articulo='".$_POST["articulo".$valuex]."', cantidad='".$_POST["precio".$valuex]."', largo='".$_POST["largo".$valuex]."', ancho='".$_POST["ancho".$valuex]."', hojas='".$_POST["hojas".$valuex]."', costo='".$_POST["costo".$valuex]."', cliente='".$_POST["cliente"]."', um='".$_POST["um".$valuex]."', nota='".$_POST["nota_".$valuex]."', usuario='".$user."' where id='$idupdate'   ");
		}
		if($idupdate===''){
			mysqli_query($mysqli,"INSERT INTO cotizacion(id,fecha,total,id_articulo,cantidad,largo,ancho,hojas,costo,cliente,um,num_cotizacion,fecha_cotizacion,tipo,nota,usuario)values (null,'".$_POST["fecha"]."','".$_POST["tot1"]."','".$_POST["articulo".$valuex]."','".$_POST["precio".$valuex]."','".$_POST["largo".$valuex]."','".$_POST["ancho".$valuex]."','".$_POST["hojas".$valuex]."','".$_POST["costo".$valuex]."','".$_POST["cliente"]."','".$_POST["um".$valuex]."','".$datos[0]."','".$fechahoy."','A','".$_POST["nota_".$valuex]."','".$user."');");
		}
	}
}
/*
foreach ($numero as  $valuex) {
	if($valuex!="")
	{
		#selecciona si esta guardado
		$sel_g="SELECT * from cotizacion where id=$ida[$cont] and num_cotizacion=$datos[0] and tipo='A' ";
		$eje_g=mysqli_query($mysqli,$sel_g);
		$tiene=mysqli_num_rows($eje_g);
		if($tiene>0){

			

		}
		else{
			//insert

			
		}
		$cont++;
		
	}
	# code...
}
*/
$idds=$_POST["idbob"];
$numero=explode(',', $idds);
$idboibnas=$_POST["idbobinas"];
$ida=explode(',',$idboibnas);
for ($i=0; $i <count($numero) ; $i++) { 
	if($numero[$i]!=''){
		$valuex=$numero[$i];
		$idupdate=$ida[$i];
		if($idupdate!=''){
			mysqli_query($mysqli,"UPDATE cotizacion set total='".$_POST["tot1"]."', id_articulo='".$_POST["articulob".$valuex]."', cantidad='".$_POST["cantidadpz".$valuex]."', largo='".$_POST["largob".$valuex]."', ancho='".$_POST["anchob".$valuex]."', hojas='".$_POST["m2_".$valuex]."', costo='".$_POST["m2_usd".$valuex]."', cliente='".$_POST["cliente"]."', nota='".$_POST["notab_".$valuex]."', usuario='".$user."', tipocambio='".$_POST["tipocambio_".$valuex]."' WHERE id='$idupdate'   ");
		}
		if($idupdate===''){
			//mysqli_query($mysqli,"INSERT INTO cotizacion(id,fecha,total,id_articulo,cantidad,largo,ancho,hojas,costo,cliente,num_cotizacion,fecha_cotizacion,tipo,nota,tipocambio,usuario)values (null,'".$_POST["fecha"]."','".$_POST["tot1"]."','".$_POST["articulob".$valuex]."','".$_POST["cantidadpz".$valuex]."','".$_POST["largob".$valuex]."','".$_POST["anchob".$valuex]."','".$_POST["m2_".$valuex]."','".$_POST["m2_usd".$valuex]."','".$_POST["cliente"]."',".$datos[0]."','".$fechahoy."','B','".$_POST["notab_".$valuex]."','".$_POST["tipocambio_".$valuex]."','".$user."');");

			mysqli_query($mysqli,"INSERT INTO cotizacion(id,fecha,total,id_articulo,cantidad,largo,ancho,hojas,costo,cliente,um,num_cotizacion,fecha_cotizacion,tipo,nota,tipocambio,usuario)values (null,'".$_POST["fecha"]."','".$_POST["tot1"]."','".$_POST["articulob".$valuex]."','".$_POST["cantidadpz".$valuex]."','".$_POST["largob".$valuex]."','".$_POST["anchob".$valuex]."','".$_POST["m2_".$valuex]."','".$_POST["m2_usd".$valuex]."','".$_POST["cliente"]."','".$_POST["pedimento".$valuex]."','".$datos[0]."','".$fechahoy."','B','".$_POST["notab_".$valuex]."','".$_POST["tipocambio_".$valuex]."','".$user."');");
		}
	}
}

// foreach ($numero as  $valuex) {
// 	if($valuex!="")
// 	{

// 		mysqli_query($mysqli,"INSERT INTO cotizacion(id,fecha,total,id_articulo,cantidad,largo,ancho,hojas,costo,cliente,um,num_cotizacion,fecha_cotizacion,tipo,nota,tipocambio,usuario)values (null,'".$_POST["fecha"]."','".$_POST["tot1"]."','".$_POST["articulob".$valuex]."','".$_POST["cantidadpz".$valuex]."','".$_POST["largob".$valuex]."','".$_POST["anchob".$valuex]."','".$_POST["m2_".$valuex]."','".$_POST["m2_usd".$valuex]."','".$_POST["cliente"]."','".$_POST["pedimento".$valuex]."','".$datos[0]."','".$fechahoy."','B','".$_POST["notab_".$valuex]."','".$_POST["tipocambio_".$valuex]."','".$user."');");
// 	}
// }



header("Location:cotizar.php");
?>