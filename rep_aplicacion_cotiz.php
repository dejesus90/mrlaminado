<?php 
require "fpdf/fpdf.php";
include ("conex.php");
date_default_timezone_set('America/Mexico_City');
$id=$_GET["id"];
$ids=explode(',', $id);
 $suma2=0; 
 
	$dts=mysqli_query($mysqli,"SELECT * FROM remision WHERE id='$ids[0]'");
	

	//echo "SELECT * FROM remision WHERE id_remision='$ids[0]'";

$dts1=mysqli_fetch_array($dts);  

//echo "SELECT * FROM cliente WHERE id_cliente='$dts1[9]'";
$dtsc=mysqli_fetch_array(mysqli_query($mysqli,"SELECT * FROM cliente WHERE id_cliente='$dts1[9]'"));

	foreach ($ids as  $value1) 
	{
	# code...
	$suma=mysqli_query($mysqli,"SELECT * FROM remision WHERE id_remision='$value1'");
	$suma1=mysqli_fetch_array($suma);
	$suma2=$suma2+($suma1[8]*$suma1[4]);
}

$yy=number_format($suma2,2,'.',',');

class PDF extends FPDF {

	//Cabecera de página
	
	function Header() {
		//    	$this->Image('../img/snobchedron.jpg',0,0,33);
		$this -> SetFont('Arial', 'B', 8);
		$this -> Cell(10);
	    $this->Image('Imagnes/logo.png',78,15,50);
		$this->Ln(7);
		$this->Cell(186,18,'No. de Cotizacion: '.$_GET["id"],0,1,'C');
			
	 }

	//Pie de página
	function Footer() {
			//Posición: a 1,5 cm del final
		$this -> SetY(10);
		//'45

		//Arial italic 8

		//Número de página
		//$this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
	}

}


#$pdf=new PDF('P','mm','A4');
$pdf=new PDF(); 
#$pdf->SetMargins(22, 20 , 22);  
#$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Ln(1);
$pdf->SetFont('Arial','b',9);
$pdf-> Cell(44,3.5,'Lugar y fecha de expedicion:',0,0,"L");
$pdf->SetFont('Arial','',9);
$pdf->Cell(40,4,$dts1['fecha_remicion'],0,1,'R');              
$pdf->SetFont('Arial','',8);
$pdf->Ln(1); 
$pdf-> Cell(60,3.5, 'Mr.Laminado,Manuel J.othon #142B Obrera,',0,0, "L");
$pdf->Ln(4);
$pdf-> Cell(60,3.5, ' 06800 Cuauhtemoc.',0,0, "L");
$pdf->Ln(2);
$pdf-> Cell(41,3.5, '______________________________________________________________________________________________________________________', 0,0 , "L");
$pdf->Ln(3);
//$pdf-> Cell(41,3.5, '______________________________________________________________________________________________________________________', 0,0 , "L");
$pdf->Ln(2);
$pdf->SetFont('Arial','B',9);
$pdf-> Cell(30,3.5, 'Empresa:', 0,0 , "L"); //tabla cliente
$pdf-> Cell(96,13.5, 'R.F.C:', 0,0 , "R");
$pdf->SetFont('Arial','',9);
$pdf->Ln(5);
$pdf-> Cell(72,3.5,"".utf8_decode($dtsc[1]), 0,0 , "L");
$pdf-> Cell(78,3.5,"".$dtsc[2], 0,0 , "R");
$pdf->Ln(5);
$pdf->SetFont('Arial','B',9);
$pdf-> Cell(41,3.5, 'Domicilio:', 0,0 , "L");
$pdf->SetFont('Arial','',9);
$pdf->Ln(5);
$pdf-> Cell(59,3.5,$dtsc[3].", ".$dtsc[4].", ".$dtsc[6] , 0,0 , "L");  //calle, numero
$pdf->Ln(5);
$pdf-> Cell(65,3.5,$dtsc[7].", ".$dtsc[8].",C.P. ".$dtsc[5] , 0,0 , "L"); // colonia, municipio, delegaion
$pdf->Ln(5);
$pdf-> Cell(30,3.5,'Atencion:', 0,0 , "L");
$pdf->SetFont('Arial','B',9);
$pdf->Cell(-14);
$pdf-> Cell(1,3.5,"".$dtsc[10], 0,0 , "L");
$pdf->SetFont('Arial','',9);
$pdf->Ln(8);
$pdf->Cell(5);
$pdf->Multicell(165,5.0,"".utf8_decode('Por este conducto, le envió un cordial saludo y nuestra cotización esperando sea de su agrado '),"multi-line text string\nNew line\nNew line",1,0,"C");





$pdf->Ln(9);

#$pdf->SetFillColor(20,25,40);
#$pdf->SetDrawColor(11,2,1);
#$pdf->SetTextColor(255,255,255);
$pdf->Cell(20,3.5,'M2',0,0,'L');
$pdf->Cell(25,3.5,'Tipo',0,0,'L');
$pdf->Cell(46,3.5,'Descripcion',0,0,'C');
$pdf->Cell(39,3.5,'Largo',0,0,'C');
$pdf->Cell(-14,3.5,'Ancho',0,0,'C');
$pdf->Cell(42,3.5,'Hojas',0,0,'C');
$pdf->Cell(-10,3.5,'Precio',0,0,'C');
$pdf->Cell(49,3.5,'Importe',0,0,'C');
//$pdf->Cell(23,3.5,'Nota',0,0,'C'); Se oculto al campo
$pdf->Ln(3);

$pdf->SetTextColor(2, 15, 24);

# code...
$mdts=mysqli_query($mysqli,"SELECT * FROM remision WHERE id='$id'");
$tot=0;
$cont=0;
// width of the firs cell
$w1 = 20;
// width of the second cell
$w2 = 25;
// width of the third cell
$w3 = 46;
$w4 = 10;
$w5 = 10;
$w6 = 15;
$w7 = 17;
$w8 = 23;
$w8 = 30;

while($mdts1=mysqli_fetch_array($mdts)){
    $y1 = $pdf->GetY();
    $x1 = $pdf->GetX();

	$cont++;
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
    // find the cursor's position and store it
    /*
    $x = $pdf->x;
    $y = $pdf->y;
    $push_right = 0;

    $pdf->MultiCell($w = 20,3,"Column Number 1",0,0,'C');

    $push_right += $w;
    $pdf->SetXY($x + $push_right, $y);

    $pdf->MultiCell($w = 25,3,"Column Number 2",0,0,'C');

    $push_right += $w;
    $pdf->SetXY($x + $push_right, $y);

    $pdf->MultiCell(46,3,"Column 3 Filling in the Rest",0,0,'C');
    */
    $pdf->Ln(5); 
	$pdf->Setfont('Arial','','8.3');
    $pdf-> Cell(20,3.6, $mdts1['cantidad'], 0,0 , "L");  
    $pdf-> Cell(28,3.6, $valx, 0,0 , "L");
    $pdf->Cell(46,3.6,$mdat1[0],0,0,"L");
    $pdf->SetFont('Arial','',9); //descri
    $pdf-> Cell(33,3.6,$mdts1[5],0,0,"C"); // largo
    $pdf-> Cell(-11,3.6,$mdts1[6],0,0,"C"); // ancho
    $pdf-> Cell(42,3.6,$mdts1[7],0,0,"C");// Pertenece Array [7]
    $pdf->Cell(-12,3.6,"$".number_format($mdts1[8], 2, '.', ''),0,0,'C');     //Precio Unitario
    $pdf->Cell(52,3.6,"$".number_format($total_linea, 2, '.', ''),0,0,'C'); //Importe
    $pdf->Ln(4); //nota
	$pdf->SetFont('Arial','',7.5);
	$pdf->Cell(49);
	//mover el texto en el campo de descripcion 
	$pdf->MultiCell(58,3.5,"".utf8_decode($mdts1['nota']),"multi-line text string\nNew line\nNew line",30,0,'C');
	
	$pdf->Ln(1);
	
	$tot=$tot+(number_format($total_linea, 2, '.', '')); //total
	
	 

}


if($tot<=300){
        $tot=300;
    }
if($cont>=50)
{
	$pdf->AddPage();
}
$pdf->Ln(5);
//$pdf->SetFont('Arial','',9);
$pdf-> Cell(11,3.5,"" , 0,0 , "L");
$pdf->SetFont('Arial','',9);
$pdf-> Cell(160,3.5,"Subtotal" , 0,0 , "R");
$pdf->Ln(6);
//$pdf-> Cell(15,3.5,numtoletras($tot), 0,0 , "L");
$pdf->SetFont('Arial','B',7.5);
$pdf->Cell(79,3.5,"Estos precios no incluyen el impuesto al valor agregado",0,0,"R");
$pdf->SetFont('Arial','',9);
$pdf-> Cell(94,3.5,"$".number_format($tot,2,'.',',') , 0,0 , "R");//Sub
//$pdf-> Cell(165,3.5,"________________" , 0,0 , "R");

$pdf->Ln(10);
$pdf->SetFont('Arial','',9);
$pdf->Cell(5);
$pdf->Multicell(165,5.0,"".utf8_decode('Agradezco enormemente su atención y deseo de poder ser favorecidos con su confianza quedo a sus apreciables órdenes '),"multi-line text string\nNew line\nNew line",1,0,"C");



//$pdf-> Cell(15,3.5,"" , 0,0 , "L"); OCULTO IVA 
//$pdf->SetFont('Arial','',7);
//$pdf-> Cell(137,3.5,"IVA" , 0,0 , "R");
$pdf->Ln(25);
$iva_add=0;
if($tot>=300)
   {
    $iva_add=$tot*0.16;
  }
  
//$pdf-> Cell(15,3.5); OCULTO IVA
//$pdf->SetFont('Arial','',9);
//$pdf-> Cell(140,3.5,"$".number_format($iva_add,2,'.',',') , 0,0 , "R");
//$pdf->Ln(5);
//$pdf-> Cell(165,3.5,"________________" , 0,0 , "R");

//$pdf->Ln(5);  oculto fin

/*
$pdf-> Cell(140,3.5,"IVA" , 0,0 , "R");
$pdf->Ln(5);
$iva_add=0;
if($tot>300){
    $iva_add=$tot*0.16;
}
$pdf-> Cell(143,3.5,"$".number_format(($iva_add),2,'.',',') , 0,0 , "R");
$pdf->Ln(5);
$pdf-> Cell(165,3.5,"_________________" , 0,0 , "R");
*/



 // TOTAL OULTO
/*$pdf-> Cell(15,3.5,"" , 0,0 , "L");
$pdf->SetFont('Arial','',7);
$pdf-> Cell(140,3.5,"TOTAL" , 0,0 , "R");
$pdf->Ln(5);
$pdf-> Cell(15,3.5);
$pdf->SetFont('Arial','',9);
$pdf-> Cell(143,3.5,"$".number_format(($tot+($iva_add)),2,'.',',') , 0,0 , "R");
$pdf->Ln(5);
$pdf-> Cell(165,3.5,"________________" , 0,0 , "R");

$pdf->Ln(5);
$pdf-> Cell(152,3.5,"" , 0,0 , "J");  //linea para mover el titulo-----------------
$pdf->SetFont('Arial','',9);
$pdf->Ln(5);
*/




$sel_nota="SELECT * FROM notas_remision WHERE id_remision=$id";
$sql_nota=mysqli_query($mysqli,$sel_nota);
$res_nota=mysqli_fetch_array($sql_nota);

$nota='';
if($res_nota['nota']!=''){
    $nota=$res_nota['nota'];
}
$pdf-> Cell(160,3.5,utf8_decode($nota), 0,0 , "J");
$pdf->Ln(-25);
/*
$pdf-> Cell(165,3.5,"_________________" , 0,0 , "R");
*/

//$pdf->Ln(-10);
//$pdf->SetFont('Arial','',9);
//$pdf->Ln(5);
//$pdf-> Cell(70,3.5,"Recibio: ____________________________ " , 0,0 , "R");
//$pdf->Ln(5);
//$pdf->SetFont('Arial','',9);
//$pdf->Ln(5);
//$pdf-> Cell(73,3.5,"Firma: _______________________________ " , 0,0 , "R");

$pdf->Ln(20);
$pdf->SetFont('Arial','',9);
$pdf-> Cell(114,3.5,"A T E N T A M E N T E" , 0,0 , "R"); 
$pdf->Ln(4);
$pdf->SetFont('Arial','',9);
$pdf-> Cell(120,3.5,"Departamento de Cotizaciones" , 0,0 , "R"); 
$pdf->Ln(4);
$pdf->SetFont('Arial','',9);
$pdf-> Cell(111,3.5,"Isabel Resendiz " , 0,0 , "R");
$pdf->Ln(4);
$pdf->SetFont('Arial','',9);
$pdf-> Cell(112,3.5,"Movil. 1801 0502 " , 0,0 , "R");
$pdf->Ln(4);
$pdf->SetFont('Arial','',9);
$pdf-> Cell(117,3.5,"clientes@mrlaminado.mx " , 0,0 , "R");













$pdf->Output();

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
//
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

// END FUNCTION

?>