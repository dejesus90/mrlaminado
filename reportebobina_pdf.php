<?php // Include autoloader
require_once 'dompdf/autoload.inc.php';
include ("conex.php");
// Reference the Dompdf namespace
use Dompdf\Dompdf;

$id=$_GET["id"];
#consulta
$dts=mysqli_query($mysqli,"SELECT * FROM remision WHERE id='$id'");
// $dts=mysqli_query($mysqli,"SELECT * FROM cotizacion WHERE num_cotizacion='$id' GROUP BY tipo");

// Instantiate and use the dompdf class
//$dompdf = new Dompdf();

$datoscot=mysqli_query($mysqli,"SELECT * FROM remision WHERE id='$id'");
$resdcot=mysqli_fetch_array($datoscot);

$dtsc=mysqli_fetch_array(mysqli_query($mysqli,"SELECT * FROM cliente WHERE id_cliente='$resdcot[9]'"));
##usuario
$sel_user=mysqli_query($mysqli,"SELECT * from usuarios where iduser=$resdcot[16] ");
$resuser=mysqli_fetch_array($sel_user);

// Introducimos HTML de prueba
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
		<img src='Imagnes/Logo mr laminado azul 1943x358.png' height='68px'>
	</td>
</tr>
<tr>
	<td>
           <br>
		<h5 style='margin-top:0px;margin-bottom:0px;'>No. Remision ".$resdcot['id']."</h5>
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
		".$resdcot['fecha_remicion']."
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
		<p style='margin:0px;'>".$dtsc['calle'].' '.$dtsc['numero'].' '.$dtsc['colonia'].' '.$dtsc['delegacion'].' '.$dtsc['estado'].' C.P.'.$dtsc['codigo_postal']."</p>
	</td>
</tr>
<tr>
	<td colspan='2'>
		<b>Atencion: </b>".$dtsc['contacto']."
	</td>
</tr>


</table>
<hr>";
$html.="<table style='font-family: arial, sans-serif; font-size:12px; width:100%; border-collapse: collapse;'>
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
$tot=0;
while($mdts1=mysqli_fetch_array($dts)){

	$mdat=mysqli_query($mysqli,"SELECT descripcion FROM articulos WHERE id_articulo='$mdts1[3]'");
	$mdat1=mysqli_fetch_array($mdat);
	$m2=($mdts1['ancho']*$mdts1['largo']/100);

	#precio por bobina
    $pbobina_usd=$m2*$mdts1['costo'];

    #precio unitario
    $precio_unitario=($mdts1['tipo_cambio']*$pbobina_usd)*$mdts1['cantidad'];

	$html.="<tr>";
	$html.="<td valign='top'>".$mdts1['cantidad']."</td>";
	$html.="<td valign='top'>".$mdat1['descripcion']."</td>";
	$html.="<td style='text-align:center' valign='top'>".$mdts1['largo']."</td>";
	$html.="<td style='text-align:center' valign='top'>".$mdts1['ancho']."</td>";
	$html.="<td style='text-align:center' valign='top'>".$m2."</td>";
	$html.="<td style='text-align:center' valign='top'>$".$mdts1['costo']."</td>";
	$html.="<td valign='top'>$".number_format($pbobina_usd, 2, '.', '')."</td>";
	$html.="<td style='text-align:center' valign='top'>$".$mdts1['tipo_cambio']."</td>";
	$html.="<td style='text-align:center' valign='top'>$".number_format($precio_unitario, 2, '.', '')."</td>";
	$html.="<td valign='top'>".utf8_decode($mdts1['nota'])."</td>";
	$html.="</tr>";
	$tot=$tot+(number_format($precio_unitario, 2, '.', '')); //total
}
$iva_add=$tot*0.16;
$html.="</table>";
$html.="

<h5>Estos precios son de acuerdo al tipo de cambio oficial, al dia su compra</h5>


<table style='font-family: arial, sans-serif; font-size:12px; width:100%; border-collapse: collapse;'>
	<tr>
		<td width='70%'>".numtoletras($tot)."</td>
		<td width='30%; text-align:center; border-bottom:solid 1px #00'><br>Importe<br>$".number_format(($tot),2,'.',',')."</td>
	</tr>
	


	<tr>
		<td width='70%'></td>
		<td width='30%; text-align:center; border-bottom:solid 0px #00'>MAS I.V.A<br>
		</td>
	 </tr>
	
	
	
	
	
	<tr>
		<td colspan='2' style='text-align:center; padding-top:15px;'>
			<p>A T E N T A M E N T E</p>
            <p>".utf8_encode('Jerico Briseño')."</p>
            <p>Gerente General</P>
			<p>Movil: 55 1801 0502</p>
			<p>clientes@mrlaminado.mx </p>
			<p>".$resuser['nombre'].' '.$resuser['apellidos']."</p>
			<p>".$resuser['movil']."</p>
			<p>".$resuser['email']."</p>
		</td>
	</tr>


<tr>   
		<td colspan='2' style='text-align:left; padding-top:15px;'>
	Recibio:_____________________
	  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nombre,Firma y Fecha</p><br>
	Entrego:_____________________
	  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nombre, Firma</p>
         
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
$pdf->load_html(utf8_decode($html));
 
// Renderizamos el documento PDF.
$pdf->render();
 
// Enviamos el fichero PDF al navegador.
$pdf->stream("Webslesson", array("Attachment"=>0));

//------    CONVERTIR NUMEROS A LETRAS         ---------------
//------    Máxima cifra soportada: 18 dígitos con 2 decimales
//------    999,999,999,999,999,999.99
// NOVECIENTOS NOVENTA Y NUEVE MIL NOVECIENTOS NOVENTA Y NUEVE BILLONES
// NOVECIENTOS NOVENTA Y NUEVE MIL NOVECIENTOS NOVENTA Y NUEVE MILLONES
// NOVECIENTOS NOVENTA Y NUEVE MIL NOVECIENTOS NOVENTA Y NUEVE PESOS 99/100 M.N.
//------    Creada por:                        ---------------
//------             ULTIMINIO RAMOS GALÁN     ---------------
//------            uramos@gmail.com           ---------------
//------    10 de junio de 2009. México, D.F.  ---------------
//------    PHP Version 4.3.1 o mayores (aunque podría funcionar en versiones anteriores, tendrías que probar)
function numtoletras($xcifra)
{
    $xarray = array(0 => "Cero",
        1 => "UN", "DOS", "TRES", "CUATRO", "CINCO", "SEIS", "SIETE", "OCHO", "NUEVE",
        "DIEZ", "ONCE", "DOCE", "TRECE", "CATORCE", "QUINCE", "DIECISEIS", "DIECISIETE", "DIECIOCHO", "DIECINUEVE",
        "VEINTI", 30 => "TREINTA", 40 => "CUARENTA", 50 => "CINCUENTA", 60 => "SESENTA", 70 => "SETENTA", 80 => "OCHENTA", 90 => "NOVENTA",
        100 => "CIENTO", 200 => "DOSCIENTOS", 300 => "TRESCIENTOS", 400 => "CUATROCIENTOS", 500 => "QUINIENTOS", 600 => "SEISCIENTOS", 700 => "SETECIENTOS", 800 => "OCHOCIENTOS", 900 => "NOVECIENTOS"
    );

    $xcifra = trim($xcifra);
    $xlength = strlen($xcifra);
    $xpos_punto = strpos($xcifra, ".");
    $xaux_int = $xcifra;
    $xdecimales = "00";
    if (!($xpos_punto === false)) {
        if ($xpos_punto == 0) {
            $xcifra = "0" . $xcifra;
            $xpos_punto = strpos($xcifra, ".");
        }
        $xaux_int = substr($xcifra, 0, $xpos_punto); // obtengo el entero de la cifra a covertir
        $xdecimales = substr($xcifra . "00", $xpos_punto + 1, 2); // obtengo los valores decimales
    }

    $XAUX = str_pad($xaux_int, 18, " ", STR_PAD_LEFT); // ajusto la longitud de la cifra, para que sea divisible por centenas de miles (grupos de 6)
    $xcadena = "";
    for ($xz = 0; $xz < 3; $xz++) {
        $xaux = substr($XAUX, $xz * 6, 6);
        $xi = 0;
        $xlimite = 6; // inicializo el contador de centenas xi y establezco el límite a 6 dígitos en la parte entera
        $xexit = true; // bandera para controlar el ciclo del While
        while ($xexit) {
            if ($xi == $xlimite) { // si ya llegó al límite máximo de enteros
                break; // termina el ciclo
            }

            $x3digitos = ($xlimite - $xi) * -1; // comienzo con los tres primeros digitos de la cifra, comenzando por la izquierda
            $xaux = substr($xaux, $x3digitos, abs($x3digitos)); // obtengo la centena (los tres dígitos)
            for ($xy = 1; $xy < 4; $xy++) { // ciclo para revisar centenas, decenas y unidades, en ese orden
                switch ($xy) {
                    case 1: // checa las centenas
                        if (substr($xaux, 0, 3) < 100) { // si el grupo de tres dígitos es menor a una centena ( < 99) no hace nada y pasa a revisar las decenas
                            
                        } else {
                            $key = (int) substr($xaux, 0, 3);
                            if (TRUE === array_key_exists($key, $xarray)){  // busco si la centena es número redondo (100, 200, 300, 400, etc..)
                                $xseek = $xarray[$key];
                                $xsub = subfijo($xaux); // devuelve el subfijo correspondiente (Millón, Millones, Mil o nada)
                                if (substr($xaux, 0, 3) == 100)
                                    $xcadena = " " . $xcadena . " CIEN " . $xsub;
                                else
                                    $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                                $xy = 3; // la centena fue redonda, entonces termino el ciclo del for y ya no reviso decenas ni unidades
                            }
                            else { // entra aquí si la centena no fue numero redondo (101, 253, 120, 980, etc.)
                                $key = (int) substr($xaux, 0, 1) * 100;
                                $xseek = $xarray[$key]; // toma el primer caracter de la centena y lo multiplica por cien y lo busca en el arreglo (para que busque 100,200,300, etc)
                                $xcadena = " " . $xcadena . " " . $xseek;
                            } // ENDIF ($xseek)
                        } // ENDIF (substr($xaux, 0, 3) < 100)
                        break;
                    case 2: // checa las decenas (con la misma lógica que las centenas)
                        if (substr($xaux, 1, 2) < 10) {
                            
                        } else {
                            $key = (int) substr($xaux, 1, 2);
                            if (TRUE === array_key_exists($key, $xarray)) {
                                $xseek = $xarray[$key];
                                $xsub = subfijo($xaux);
                                if (substr($xaux, 1, 2) == 20)
                                    $xcadena = " " . $xcadena . " VEINTE " . $xsub;
                                else
                                    $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                                $xy = 3;
                            }
                            else {
                                $key = (int) substr($xaux, 1, 1) * 10;
                                $xseek = $xarray[$key];
                                if (20 == substr($xaux, 1, 1) * 10)
                                    $xcadena = " " . $xcadena . " " . $xseek;
                                else
                                    $xcadena = " " . $xcadena . " " . $xseek . " Y ";
                            } // ENDIF ($xseek)
                        } // ENDIF (substr($xaux, 1, 2) < 10)
                        break;
                    case 3: // checa las unidades
                        if (substr($xaux, 2, 1) < 1) { // si la unidad es cero, ya no hace nada
                            
                        } else {
                            $key = (int) substr($xaux, 2, 1);
                            $xseek = $xarray[$key]; // obtengo directamente el valor de la unidad (del uno al nueve)
                            $xsub = subfijo($xaux);
                            $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                        } // ENDIF (substr($xaux, 2, 1) < 1)
                        break;
                } // END SWITCH
            } // END FOR
            $xi = $xi + 3;
        } // ENDDO

        if (substr(trim($xcadena), -5, 5) == "ILLON") // si la cadena obtenida termina en MILLON o BILLON, entonces le agrega al final la conjuncion DE
            $xcadena.= " DE";

        if (substr(trim($xcadena), -7, 7) == "ILLONES") // si la cadena obtenida en MILLONES o BILLONES, entoncea le agrega al final la conjuncion DE
            $xcadena.= " DE";

        // ----------- esta línea la puedes cambiar de acuerdo a tus necesidades o a tu país -------
        if (trim($xaux) != "") {
            switch ($xz) {
                case 0:
                    if (trim(substr($XAUX, $xz * 6, 6)) == "1")
                        $xcadena.= "UN BILLON ";
                    else
                        $xcadena.= " BILLONES ";
                    break;
                case 1:
                    if (trim(substr($XAUX, $xz * 6, 6)) == "1")
                        $xcadena.= "UN MILLON ";
                    else
                        $xcadena.= " MILLONES ";
                    break;
                case 2:
                    if ($xcifra < 1) {
                        $xcadena = "CERO PESOS $xdecimales/100 M.N.";
                    }
                    if ($xcifra >= 1 && $xcifra < 2) {
                        $xcadena = "UN PESO $xdecimales/100 M.N. ";
                    }
                    if ($xcifra >= 2) {
                        $xcadena.= " PESOS $xdecimales/100 M.N. "; //
                    }
                    break;
            } // endswitch ($xz)
        } // ENDIF (trim($xaux) != "")
        // ------------------      en este caso, para México se usa esta leyenda     ----------------
        $xcadena = str_replace("VEINTI ", "VEINTI", $xcadena); // quito el espacio para el VEINTI, para que quede: VEINTICUATRO, VEINTIUN, VEINTIDOS, etc
        $xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles
        $xcadena = str_replace("UN UN", "UN", $xcadena); // quito la duplicidad
        $xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles
        $xcadena = str_replace("BILLON DE MILLONES", "BILLON DE", $xcadena); // corrigo la leyenda
        $xcadena = str_replace("BILLONES DE MILLONES", "BILLONES DE", $xcadena); // corrigo la leyenda
        $xcadena = str_replace("DE UN", "UN", $xcadena); // corrigo la leyenda
    } // ENDFOR ($xz)
    return trim($xcadena);
}

// END FUNCTION

function subfijo($xx)
{ // esta función regresa un subfijo para la cifra
    $xx = trim($xx);
    $xstrlen = strlen($xx);
    if ($xstrlen == 1 || $xstrlen == 2 || $xstrlen == 3)
        $xsub = "";
    //
    if ($xstrlen == 4 || $xstrlen == 5 || $xstrlen == 6)
        $xsub = "MIL";
    //
    return $xsub;
}

?>