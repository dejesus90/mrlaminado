<?php 
include ("conex.php");

mysqli_query($mysqli,"DELETE FROM `cliente` WHERE rfc='$_GET[rfc1]'");

header("Location:clientes.php")
?>