<?php
session_start();
$usuario=$_POST['usuario'];
$clave=$_POST['clave'];

//conetar a la base de datos

$conexion = mysqli_connect("localhost","root","","laminado");

$consulta = "SELECT * FROM usuarios WHERE usuario='$usuario' and clave='$clave'";

$resultado=mysqli_query($conexion, $consulta);
$filas=mysqli_num_rows($resultado);
$cons=mysqli_fetch_array($resultado);

if($filas>0){
	$_SESSION['sistema']= true;
	$_SESSION['usuario']=$usuario;
	$_SESSION['iduser']=$cons[0];
	header("location:menuprincipal.php");
	
}
else {
		
		header("location:errorclave.php");
		echo "Error en la Autentificacion ";

	
}

mysqli_free_result($resultado);
mysqli_close($conexion);
?>