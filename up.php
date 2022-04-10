<?php 
include ("conex.php");
mysqli_query($mysqli,"INSERT INTO cliente(id_cliente,razon_social,rfc,calle,numero,codigo_postal,colonia,delegacion,estado,telefono,contacto,email)values (null,'".$_POST["Razon_Social"]."','".$_POST["RFC"]."','".$_POST["Calle"]."','".$_POST["Numero"]."','".$_POST["Codigo_Postal"]."','".$_POST["Col"]."','".$_POST["Delegacion"]."','".$_POST["Estado"]."','".$_POST["Telefono"]."','".$_POST["Contacto"]."','".$_POST["Correo"]."');");
header("Location:clientes.php")
?>