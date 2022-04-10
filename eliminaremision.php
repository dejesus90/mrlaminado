<?php 
include ("conex.php");

$id=$_POST['id'];

$delete="DELETE from remision where id_remision=$id ";
$eje_g=mysqli_query($mysqli,$delete);

?>