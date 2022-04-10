<?php 
include ("conex.php");
$rfcid=$_POST['RFCid'];
mysqli_query($mysqli,"UPDATE cliente SET razon_social='".$_POST['Razon_Social']."',rfc='".$_POST['RFC']."',calle='".$_POST['Calle']."',numero='".$_POST['Numero']."',codigo_postal='".$_POST['Codigo_Postal']."',colonia='".$_POST['Col']."',delegacion='".$_POST["Delegacion"]."',estado='".$_POST['Estado']."',telefono='".$_POST['Telefono']."',contacto='".$_POST['Contacto']."',email='".$_POST['Correo']."',estatus='".$_POST['estatus']."' WHERE id_cliente='".$rfcid."'");
header("Location:clientes.php")
?>