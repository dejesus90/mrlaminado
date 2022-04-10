<?php
session_start();
include ("conex.php");
date_default_timezone_set('America/Mexico_City');

$iddel=$_POST["id"];
$user=$_SESSION['iduser'];



mysqli_query($mysqli,"DELETE from cotizacion where id='$iddel' ");


?>