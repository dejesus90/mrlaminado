<?php 
include ("conex.php");

$tipo=$_POST['tipo'];

if($tipo=='A'){
	mysqli_query($mysqli,"INSERT INTO articulos(id_articulo,nombre,descripcion,tipo)values (null,'".$_POST["nombre"]."','".$_POST["descripcion"]."','A')");
}
if($tipo=='B'){
	mysqli_query($mysqli,"INSERT INTO articulos(id_articulo,nombre,descripcion,tipo,ancho,largo,precio)values (null,'".$_POST["nombre"]."','".$_POST["descripcion"]."','B','".$_POST["ancho"]."','".$_POST["largo"]."','".$_POST["preciobob"]."')");
}


//echo "INSERT INTO articulos(id_articulo,nombre,descripcion)values (null,'".$_POST["nombre"]."','".$_POST["descripcion"]."')";
header("Location:articulosl.php")
?>