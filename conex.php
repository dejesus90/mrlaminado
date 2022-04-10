<?php
$mysqli = new mysqli("localhost","root","", "laminado");
if ($mysqli -> connect_errno) {
die( "Fallo la conexión a MySQL: (" . $mysqli -> mysqli_connect_errno() 
. ") " . $mysqli -> mysqli_connect_error());
}
//$mysqli -> mysqli_close();
?>