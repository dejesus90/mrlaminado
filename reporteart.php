<?php // Include autoloader
require_once 'dompdf/autoload.inc.php';
include ("conex.php");
// Reference the Dompdf namespace
use Dompdf\Dompdf;

#consulta
$dts=mysqli_query($mysqli,"SELECT * FROM remision WHERE id='1'");
$dts1=mysqli_fetch_array($dts);
$dtsc=mysqli_fetch_array(mysqli_query($mysqli,"SELECT * FROM cliente WHERE id_cliente='$dts1[9]'"));


// Instantiate and use the dompdf class
//$dompdf = new Dompdf();


// Introducimos HTML de prueba
/*
$html = '
<style>
	table {
	    font-family: arial, sans-serif;
	    border-collapse: collapse;
	    width: 100%;
	}

	td, th {
	    border: 1px solid #dddddd;
	    text-align: left;
	    padding: 8px;
	}

	tr:nth-child(even) {
	    background-color: #dddddd;
	}
</style>
<table>
  <tr>
    <th>Company</th>
    <th>Contact</th>
    <th>Country</th>
  </tr>
  <tr>
    <td>Alfreds Futterkiste</td>
    <td>Maria Anders</td>
    <td>Germany</td>
  </tr>
  <tr>
    <td>Centro comercial Moctezuma</td>
    <td>Francisco Chang</td>
    <td>Mexico</td>
  </tr>
  <tr>
    <td>Ernst Handel</td>
    <td>Roland Mendel</td>
    <td>Austria</td>
  </tr>
  <tr>
    <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
          tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
          quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
          consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
          cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
          proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</td>
    <td>Helen Bennett</td>
    <td>UK</td>
  </tr>
  <tr>
    <td>Laughing Bacchus Winecellars</td>
    <td>Yoshi Tannamuri</td>
    <td>Canada</td>
  </tr>
  <tr>
    <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
          tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
          quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
          consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
          cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
          proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
          tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
          quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
          consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
          cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
          proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</td>
    <td>Giovanni Rovelli</td>
    <td>Italy</td>
  </tr>
</table>
';
*/
$html="<head>
<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
<title>Informe Resultados</title>
<style type='text/css'>

	.table1 {
	    font-family: arial, sans-serif;
	    border-collapse: collapse;
	    width: 100%;
	    text-align:center;
	}
</style>
</head>";

$html.="<body>
<table class='table1'>
<tr>
	<td>
		<img src='Imagnes/logo.png' height='30px'>
	</td>
</tr>
<tr>
	<td>
		<h5 style='margin-top:0px;margin-bottom:0px;'>Nota(s) de Remision No. 1</h5>
	</td>
</tr>
</table>
<table style='font-family: arial, sans-serif; font-size:12px; width:100%'>
<tr>
	<td>
		<b>Lugar y fecha de expedicion</b>
	</td>
</tr>
<tr>
	<td>
		".$dts1['fecha_remicion']."
	</td>
</tr>
<tr>
	<td>
		<p style='margin-top:0px;margin-bottom:0px;'>Mr.Laminado,Manuel J.othon #142B Obrera</p>
		<p style='margin-top:0px;margin-bottom:0px;'>06800 Cuauhtemoc.</p>
	</td>
</tr>
</table>
<hr>
<table style='font-family: arial, sans-serif; font-size:12px; width:100%'>
<tr>
	<td width='50%' style='width:50%;'>
		<b>Cliente</b>
	</td>
	<td width='50%' style='width:50%;'>
		<b>R.F.C.</b>
	</td>
</tr>
<tr>
	<td>
		".$dtsc['razon_social']."
	</td>
	<td>
		".$dtsc['rfc']."
	</td>
</tr>
<tr>
	<td>
		<b>Domicilio</b>
	</td>
</tr>
<tr>
	<td>
		<p style='margin-top:0px;'>".$dtsc['calle'].' '.$dtsc['numero'].' '.$dtsc['colonia'].' '.$dtsc['delegacion'].' '.$dtsc['estado'].' C.P.'.$dtsc['codigo_postal']."</p>
	</td>
</tr>
</table>
<hr>
<table style='font-family: arial, sans-serif; font-size:12px; width:100%; border-collapse: collapse;'>
	<tr>
		<td style='border:solid 1px #000; text-align:center;' width='5%'><b>M2</b></td>
		<td style='border:solid 1px #000; text-align:center;' width='10%'><b>Tipo</b></td>
		<td style='border:solid 1px #000; text-align:center;' width='20%'><b>Descripcion</b></td>
		<td style='border:solid 1px #000; text-align:center;' width='10%'><b>Largo</b></td>
		<td style='border:solid 1px #000; text-align:center;' width='10%'><b>Ancho</b></td>
		<td style='border:solid 1px #000; text-align:center;' width='5%'><b>Hojas</b></td>
		<td style='border:solid 1px #000; text-align:center;' width='10%'><b>Costo</b></td>
		<td style='border:solid 1px #000; text-align:center;' width='10%'><b>Importe</b></td>
		<td style='border:solid 1px #000; text-align:center;' width='20%'><b>Nota</b></td>
	</tr>";
	$mdts=mysqli_query($mysqli,"SELECT * FROM remision WHERE id='1'");
	$tot=0;
	$cont=0;
	while($mdts1=mysqli_fetch_array($mdts)){
		$valx="";
		if($mdts1[10]==1)
		{
	        $valx="Frente";
		}
		if($mdts1[10]==2)
		{
	        $valx="Frente y Vuelta";
		}
	    if($mdts1[10]==3)
	    {
	        $valx="Vuelta";
	    }
	    $total_linea=$mdts1['cantidad']*$mdts1['costo'];
	    $mdat=mysqli_query($mysqli,"SELECT descripcion FROM articulos WHERE id_articulo='$mdts1[3]'");
		$mdat1=mysqli_fetch_array($mdat);

		$html.="<tr>";
		$html.="<td>".$mdts1['cantidad']."</td>";
		$html.="<td>".$valx."</td>";
		$html.="<td>".$mdat1[0]."</td>";
		$html.="<td>".$mdts1[5]."</td>";
		$html.="<td>".$mdts1[6]."</td>";
		$html.="<td>".$mdts1[7]."</td>";
		$html.="<td>$".number_format($mdts1[8], 2, '.', '')."</td>";
		$html.="<td>$".number_format($total_linea, 2, '.', '')."</td>";
		$html.="<td>".utf8_decode($mdts1['nota'])."</td>";

		$html.="</tr>";

		$tot=$tot+(number_format($total_linea, 2, '.', '')); //total
	}
	if($tot<=300){
        $tot=300;
    }
    if($tot>=300)
   	{
    	$iva_add=$tot*0.16;
  	}
$html.="</table>";

$html.="
<hr>
<table style='font-family: arial, sans-serif; font-size:12px; width:100%; border-collapse: collapse;'>
	<tr>
		<td width='70%'></td>
		<td width='30%; text-align:center; border-bottom:solid 1px #00'>Subtotal<br>$".number_format($tot,2,'.',',')."</td>
	</tr>
	<tr>
		<td width='70%'></td>
		<td width='30%; text-align:center; border-bottom:solid 1px #00'>IVA<br>$".number_format($iva_add,2,'.',',')."</td>
	</tr>
	<tr>
		<td width='70%'></td>
		<td width='30%; text-align:center; border-bottom:solid 1px #00'>Total<br>$".number_format(($tot+($iva_add)),2,'.',',')."</td>
	</tr>
</table>
";

$html.="</body>";

 
// Instanciamos un objeto de la clase DOMPDF.
$pdf = new Dompdf();
 
// Definimos el tamaño y orientación del papel que queremos.
$pdf->set_paper("A4", "portrait");
 
// Cargamos el contenido HTML.
$pdf->load_html(utf8_decode($html));
 
// Renderizamos el documento PDF.
$pdf->render();
 
// Enviamos el fichero PDF al navegador.
$pdf->stream("Webslesson", array("Attachment"=>0))

?>