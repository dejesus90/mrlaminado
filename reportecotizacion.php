<?php // Include autoloader
require_once 'dompdf/autoload.inc.php';
include ("conex.php");
// Reference the Dompdf namespace
use Dompdf\Dompdf;

$id=$_GET["id"];
#consulta
$dts=mysqli_query($mysqli,"SELECT * FROM cotizacion WHERE num_cotizacion='$id' GROUP BY tipo");

// Instantiate and use the dompdf class
//$dompdf = new Dompdf();

$datoscot=mysqli_query($mysqli,"SELECT * FROM cotizacion WHERE num_cotizacion='$id'");
$resdcot=mysqli_fetch_array($datoscot);

$dtsc=mysqli_fetch_array(mysqli_query($mysqli,"SELECT * FROM cliente WHERE id_cliente='$resdcot[16]'"));
##usuario
$sel_user=mysqli_query($mysqli,"SELECT * from usuarios where iduser=$resdcot[17] ");
$resuser=mysqli_fetch_array($sel_user);






// Introducimos HTML de prueba
$html="<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
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

		<img src='Imagnes/Logo mr laminado azul 1943x358.png' height='68px'>
	</td>
</tr>
<tr>
	<td>
	 <br>
		<h5 style='margin-top:0px;margin-bottom:0px;'>No. de cotizacion ".$resdcot['num_cotizacion']."</h5>
	</td>
</tr>
</table>
<table style='font-family: arial, sans-serif; font-size:14px; width:100%'>
<tr>
	<td>
		<b>Lugar y fecha de expedicion</b>
	</td>
</tr>
<tr>
	<td>
		".$resdcot['fecha_cotizacion']."
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
<table style='font-family: arial, sans-serif; font-size:13px; width:100%'>
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
		<p style='margin:0px;'>".$dtsc['calle'].' '.$dtsc['numero'].' '.$dtsc['colonia'].' '.$dtsc['delegacion'].' '.$dtsc['estado'].' C.P.'.$dtsc['codigo_postal']."</p>
	</td>
</tr>
<tr>
	<td colspan='2'>
		<b>Atencion: </b>".$dtsc['contacto']."
	</td>
</tr>
<tr>
	<td colspan='2'>
		Por este conducto, le envio un cordial saludo y nuestra cotizacion esperando sea de su agrado
	</td>
</tr>


</table>
<hr>";
$tot=0;
$tienebona=0;
while ($grupo=mysqli_fetch_array($dts)) {
	# code...
	if($grupo['tipo']=='A'){
		$html.="<table style='font-family: arial, sans-serif; font-size:13px; width:100%; border-collapse: collapse;'>
			<tr><td colspan='9'><b>Aplicaciones</b></td></tr>
			<tr>
				<td style='text-align:left;' width='10%'><b>M2</b></td>
				<td style='text-align:left;' width='10%'><b>Tipo</b></td>
				<td style='text-align:left;' width='15%'><b>Descripcion</b></td>
				<td style='text-align:center;' width='10%'><b>Largo</b></td>
				<td style='text-align:center;' width='10%'><b>Ancho</b></td>
				<td style='text-align:center;' width='5%'><b>Hojas</b></td>
				<td style='text-align:center;' width='10%'><b>Costo</b></td>
				<td style='text-align:center;' width='10%'><b>Importe</b></td>
				<td style='text-align:justify;' width='20%'><b>Nota</b></td>
			</tr>";
			
		$mdts=mysqli_query($mysqli,"SELECT * FROM cotizacion WHERE num_cotizacion='$id' and tipo='A'");

		
		$cont=0;
		while($mdts1=mysqli_fetch_array($mdts)){
			$valx="";
			if($mdts1['um']==1)
			{
		        $valx="Frente";
			}
			if($mdts1['um']==2)
			{
		        $valx="Frente y Vuelta";
			}
		    if($mdts1['um']==3)
		    {
		        $valx="Vuelta";
		    }
		    $total_linea=$mdts1['cantidad']*$mdts1['costo'];
		    $mdat=mysqli_query($mysqli,"SELECT descripcion FROM articulos WHERE id_articulo='$mdts1[3]'");

		    
$total_linea=$mdts1['cantidad']*$mdts1['costo'];
    $mdat=mysqli_query($mysqli,"SELECT descripcion,minimo FROM articulos WHERE id_articulo='$mdts1[3]'");
    $mdat1=mysqli_fetch_array($mdat);
    if($mdat1['minimo']==1){
        if($total_linea<=1000){
            $total_linea=1000;
        }
    }

else


if($mdat1['minimo']==2){
        if($total_linea<=300){
            $total_linea=300;
        }
    }

else {
			//$mdat1=mysqli_fetch_array($mdat);
             $gar=1;

			if($total_linea<=500){
                   $total_linea=500;

			               }
			           }

			//solo si el total de m2 == 0.00
			if($mdts1['cantidad'] == '0.00'){
				$total_linea = $mdts1['hojas'] * $mdts1['costo'];
			}
			$html.="<tr>";
			$html.="<td valign='top'>".$mdts1['cantidad']."</td>";
			$html.="<td valign='top' style='text-align:left'>".$valx."</td>";
			$html.="<td valign='top'>".$mdat1['descripcion']."</td>";
			$html.="<td valign='top' style='text-align:center'>".$mdts1['largo']."</td>";
			$html.="<td valign='top' style='text-align:center'>".$mdts1['ancho']."</td>";
			$html.="<td valign='top' style='text-align:center'>".$mdts1['hojas']."</td>";
			$html.="<td valign='top' style='text-align:center'>$".number_format($mdts1['costo'], 2, '.', '')."</td>";
			$html.="<td valign='top' style='text-align:center'> $".number_format($total_linea, 2, '.', '')."</td>";
			$html.="<td valign='top' style='text-align:justify'>".utf8_decode($mdts1['nota'])."</td>";

			

			$html.="</tr>";

			$tot=$tot+(number_format($total_linea, 2, '.', '')); //total
		}
		
		$html.="</table>";

	}
	if($grupo['tipo']=='B'){
		$tienebona++;
		$html.="<hr>";
		$html.="<table style='font-family: arial, sans-serif; font-size:13px; width:100%; border-collapse: collapse;'>
			<tr><td colspan='9'><b>Bobina</b></td></tr>
			<tr>
				<td valign='top' style='text-align:left;' width='5%'><b>Cant.</b></td>
				<td valign='top' style='text-align:left;' width='10%'><b>Bobina</b></td>
				<td valign='top' style='text-align:center;' width='7%'><b>Ancho</b></td>
				<td valign='top' style='text-align:center;' width='7%'><b>Largo</b></td>
				<td valign='top' style='text-align:center;' width='6%'><b>M2</b></td>
				<td valign='top' style='text-align:center;' width='10%'><b>Precio m2 USD</b></td>
				<td valign='top' style='text-align:center;' width='10%'><b>Precio X Bobina USD</b></td>
				<td valign='top' style='text-align:center;' width='10%'><b>Tipo de Cambio</b></td>
				<td valign='top' style='text-align:center;' width='15%'><b>Precio Unitario</b></td>
				<td valign='top' style='text-align:center;' width='15%'><b>Nota</b></td>
			</tr>";
		$mdts=mysqli_query($mysqli,"SELECT * FROM cotizacion WHERE num_cotizacion='$id' and tipo='B'");
		
		$cont=0;
		while($mdts1=mysqli_fetch_array($mdts)){
			
		    $mdat=mysqli_query($mysqli,"SELECT descripcion FROM articulos WHERE id_articulo='$mdts1[3]'");
			$mdat1=mysqli_fetch_array($mdat);

			$m2=($mdts1['ancho']*$mdts1['largo']/100);
			#precio por bobina
    		$pbobina_usd=$m2*$mdts1['costo'];
    		#precio unitario
    		$precio_unitario=($mdts1['tipocambio']*$pbobina_usd)*$mdts1['cantidad'];

			$html.="<tr>";
			$html.="<td valign='top'>".$mdts1['cantidad']."</td>";
			$html.="<td valign='top'>".$mdat1['descripcion']."</td>";
			$html.="<td style='text-align:center' valign='top'>".$mdts1['ancho']."</td>";
                        $html.="<td style='text-align:center' valign='top'>".$mdts1['largo']."</td>";
			$html.="<td style='text-align:center' valign='top'>".$m2."</td>";
			$html.="<td style='text-align:center' valign='top'>$".$mdts1['costo']."</td>";
			$html.="<td valign='top'>$".number_format(($pbobina_usd), 2, '.', ',')."</td>";
			$html.="<td style='text-align:center' valign='top'>$".$mdts1['tipocambio']."</td>";
			$html.="<td style='text-align:center' valign='top'>$".number_format(($precio_unitario),2,'.',',')."</td>";
			$html.="<td valign='top'>".utf8_decode($mdts1['nota'])."</td>";

			$html.="</tr>";

			$tot=$tot+(number_format($precio_unitario, 2, '.', '')); //total
		}

		$html.="</table>";

	}
}

 


if($tot<=300){
	$tot=300;
}
if($tot>=300)
{
	$iva_add=$tot*0.16;
}


$html.="
<hr>";
if($tienebona>=0){
	$html.='<h4 style="color:#OOO; font-size:12px;"> Estos precios son de acuerdo al tipo de cambio oficial, al dia su compra </h4>';
}
$html.="

<table style='font-family: arial, sans-serif; font-size:13px; width:100%; border-collapse: collapse;'>
	
	<tr>
		<td width='70%'></td>
		<td width='30%; text-align:center; border-bottom:solid 1px #00'>Total<br>$".number_format(($tot),2,'.',',')."</td>
		

         


	</tr>
	
	
	 <tr>
		<td width='70%'></td>
		<td width='30%; text-align:center; border-bottom:solid 0px #00'>MAS I.V.A<br>
		</td>
	 </tr>
	
		
	<tr>
		<td colspan='2' style='text-align:center; padding-top:15px;'>
			<p>A T E N T A M E N T E</p>
			<p>Departamento de Cotizaciones</p>
			<p>".$resuser['nombre'].' '.$resuser['apellidos']."</p>
			<p>Movil.".$resuser['movil']."</p>
                        <p>Oficina.".$resuser['oficina']."</p>
                        <p>".$resuser['email']."</p>

                                       
		</td>
	</tr>


<tr>
	<td colspan='2'>
		<b>Nota: </b>
	</td>
</tr>
<tr>
	<td colspan='2'>
		".utf8_decode($resdcot['nota2']).";
	</td>
</tr>




</table>




";

$html.="</body>";



 
// Instanciamos un objeto de la clase DOMPDF.
$pdf = new Dompdf();
 
// Definimos el tamaño y orientación del papel que queremos.
$pdf->set_paper("A4", "portrait");
 
// Cargamos el contenido HTML.
$pdf->load_html(utf8_encode($html));
 
// Renderizamos el documento PDF.
$pdf->render();
 
// Enviamos el fichero PDF al navegador.
$pdf->stream("Webslesson", array("Attachment"=>0))

?>