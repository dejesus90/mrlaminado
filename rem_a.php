<?php 
include ("conex.php");
date_default_timezone_set('America/Mexico_City');
$fechahoy = date('Y-m-d');

$id_remision=$_POST['id_remision'];
$idds=$_POST["idss"];
$idr=$_POST['idr'];
$numero=explode(',', $idds);
$id=explode(',', $id_remision);
foreach ($numero as  $valuex) {

	if($valuex!="")
	{
		#selecciona si esta guardado
		$sel_g="SELECT * from remision where id_remision=$id[$valuex] ";
		$eje_g=mysqli_query($mysqli,$sel_g);
		$tiene=mysqli_num_rows($eje_g);
		if($tiene>0){

			mysqli_query($mysqli,"UPDATE remision SET total='".$_POST["tot1"]."',id_articulo='".$_POST["articulo".$valuex]."',cantidad='".$_POST["precio".$valuex]."',largo='".$_POST["largo".$valuex]."',ancho='".$_POST["ancho".$valuex]."',hojas='".$_POST["hojas".$valuex]."',costo='".$_POST["costo".$valuex]."',cliente='".$_POST["cliente"]."',um='".$_POST["um".$valuex]."',nota='".$_POST["nota_".$valuex]."' WHERE id_remision='$id[$valuex]';");
		}
		else{
			$res_q=mysqli_fetch_array($eje_g);
			mysqli_query($mysqli,"INSERT INTO remision(id_remision,fecha,total,id_articulo,cantidad,largo,ancho,hojas,costo,cliente,um,id,fecha_remicion,tipo,nota)values (null,'".$_POST["fecha"]."','".$_POST["tot1"]."','".$_POST["articulo".$valuex]."','".$_POST["precio".$valuex]."','".$_POST["largo".$valuex]."','".$_POST["ancho".$valuex]."','".$_POST["hojas".$valuex]."','".$_POST["costo".$valuex]."','".$_POST["cliente"]."','".$_POST["um".$valuex]."','".$idr."','".$res_q['fecha_remicion']."','R','".$_POST["nota_".$valuex]."');");
		}
                        
		
	}

}
$nota=$_POST['nota'];
mysqli_query($mysqli,"DELETE from notas_remision where id_remision=$idr ");
if ($nota!='') {
	mysqli_query($mysqli,"INSERT into notas_remision(id_remision,nota)values('$idr','$nota')");
}

header("Location:remision_l.php")
?>