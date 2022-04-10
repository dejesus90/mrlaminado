<?php

$connect = new PDO("mysql:host=localhost; dbname=laminado", "root", "");
$id= $_POST['id'];

$query = "UPDATE remision SET estatus='0' WHERE id_remision = '$id';";
$statement = $connect->prepare($query);
$statement->execute();

echo $query;


?>