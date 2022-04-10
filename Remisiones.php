<?php
session_start();
if(!$_SESSION['sistema'])
{
	header("location:Index.php");
	}
 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />



<script type="text/javascript" src="jquery-3.2.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<script type="text/javascript" src="js/bootstrap.js"></script>
<title>Mrlaminado</title>
<style type="text/css">
<!--
body {
	font: 100%/1.4 Verdana, Arial, Helvetica, sans-serif;
	background-color: #42413C;
	margin: 0;
	padding: 0;
	color: #000;
}

/* ~~ Selectores de elemento/etiqueta ~~ */
ul, ol, dl { /* Debido a las diferencias existentes entre los navegadores, es recomendable no añadir relleno ni márgenes en las listas. Para lograr coherencia, puede especificar las cantidades deseadas aquí o en los elementos de lista (LI, DT, DD) que contienen. Recuerde que lo que haga aquí se aplicará en cascada en la lista .nav, a no ser que escriba un selector más específico. */
	padding: 0;
	margin: 0;
}
h1, h2, h3, h4, h5, h6, p {
	margin-top: 0;	 /* la eliminación del margen superior resuelve un problema que origina que los márgenes escapen de la etiqueta div contenedora. El margen inferior restante lo mantendrá separado de los elementos de que le sigan. */
	padding-right: 15px;
	padding-left: 15px; /* la adición de relleno a los lados del elemento dentro de las divs, en lugar de en las divs propiamente dichas, elimina todas las matemáticas de modelo de cuadro. Una div anidada con relleno lateral también puede usarse como método alternativo. */
}
a img { /* este selector elimina el borde azul predeterminado que se muestra en algunos navegadores alrededor de una imagen cuando está rodeada por un vínculo */
	border: none;
}
/* ~~ La aplicación de estilo a los vínculos del sitio debe permanecer en este orden (incluido el grupo de selectores que crea el efecto hover -paso por encima-). ~~ */
a:link {
	color: #42413C;
	text-decoration: underline; /* a no ser que aplique estilos a los vínculos para que tengan un aspecto muy exclusivo, es recomendable proporcionar subrayados para facilitar una identificación visual rápida */
}
a:visited {
	color: #6E6C64;
	text-decoration: underline;
}
a:hover, a:active, a:focus { /* este grupo de selectores proporcionará a un usuario que navegue mediante el teclado la misma experiencia de hover (paso por encima) que experimenta un usuario que emplea un ratón. */
	text-decoration: none;
}

/* ~~ este contenedor de anchura fija rodea a las demás divs ~~ */
.container {
	
	background-color: #FFF;
	margin: 0 auto; /* el valor automático de los lados, unido a la anchura, centra el diseño */
}

/* ~~ no se asigna una anchura al encabezado. Se extenderá por toda la anchura del diseño. Contiene un marcador de posición de imagen que debe sustituirse por su propio logotipo vinculado ~~ */
.header {
	background-color: #45a1e5;
}

/* ~~ Esta es la información de diseño. ~~ 

1) El relleno sólo se sitúa en la parte superior y/o inferior de la div. Los elementos situados dentro de esta div tienen relleno a los lados. Esto le ahorra las "matemáticas de modelo de cuadro". Recuerde que si añade relleno o borde lateral a la div propiamente dicha, éste se añadirá a la anchura que defina para crear la anchura *total*. También puede optar por eliminar el relleno del elemento en la div y colocar una segunda div dentro de ésta sin anchura y el relleno necesario para el diseño deseado.

*/

.content {

	padding: 10px 0;
}

/* ~~ El pie de página ~~ */
.footer {
	padding: 10px 0;
	background-color: #CCC49F;
}

/* ~~ clases float/clear varias ~~ */
.fltrt {  /* esta clase puede utilizarse para que un elemento flote en la parte derecha de la página. El elemento flotante debe preceder al elemento junto al que debe aparecer en la página. */
	float: right;
	margin-left: 8px;
}
.fltlft { /* esta clase puede utilizarse para que un elemento flote en la parte izquierda de la página. El elemento flotante debe preceder al elemento junto al que debe aparecer en la página. */
	float: left;
	margin-right: 8px;
}
.clearfloat { /* esta clase puede situarse en una <br /> o div vacía como elemento final tras la última div flotante (dentro de #container) si #footer se elimina o se saca fuera de #container */
	clear:both;
	height:0;
	font-size: 1px;
	line-height: 0px;
}
.td
{
width:90px;
}
a:hover {
	color: #FFF;
}
.container .header table tr td font {
	color: #FFF;
	font-weight: bold;
}
-->
</style>
</head>

<body>

<div class="container">
  <div class="header"><!-- end .header -->
    <table width="324" border="0" align="center">
      <tr>
        <td width="300"><img src="Imagnes/Logomrlaminado2021.png" alt="" width="500" height="120" /></td>
      </tr>
    </table>
  </div>
  <div class="content">
   <center> 
     <h3>Remisiones</h3>
     <table width="300" border="0" align="right">
       <tr>
         <td width="194" scope="col"><h5><a href="remision_l.php"><span style="float:right;">Ver Registros<i><img src="Imagnes/ver.png" alt="" width="25" height="25"/></i></span></a></h5></td>
         <td width="90" scope="col"><h5><a href="menuprincipal.php"><span style="float:right;">Menu<i><img src="Imagnes/casa.png" alt="" width="25" height="21" /></i></span></a></h5></td>
       </tr>
       <tr>
         
       
       </tr>
     </table>
   </center>
   <center>
    <form method="POST" id="form1" autocomplete="off" action="rem_up.php">
      <table id="tb1" class="table table-condensed table-bordered" style="margin-bottom: 0">
        <tr>
          <td colspan="3" align="center">Cliente</td>
          <td colspan="4">
            <select name="cliente" class="form-control input-sm">
              <option value="0">--Selecciona--</option>
              <?php
              include ("conex.php");
              $dt=mysqli_query($mysqli,"SELECT id_cliente,razon_social FROM cliente ORDER BY razon_social");
              while ($dt1=mysqli_fetch_array($dt)) 
              {
              echo "<option value='$dt1[0]'>$dt1[1]</option>";
              }
              ?>
            </select>
          </td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td colspan="3" align="center">Fecha</td>
          <td colspan="4"><input name="fecha" class="form-control input-sm" type="date" required="required"/></td>
          <td colspan="2"></td>
        </tr>
        <tr>
          <td colspan="3"></td>
          <td colspan="6">
            <span onclick="crear();" style="float: right; background-color:#1e88e5; border-radius:10px;color: #ffffff; padding: 2px; font-size: 11px;font-weight: bold; cursor: pointer;">Agregar +</span>
          </td>
        </tr>
        <tr>
          <td>Articulo</td>
          <td style="display: none;">Tipo de APli</td>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;Tipo</td>
          <td>Largo</td>
          <td>Ancho</td>
          <td>Pliegos</td>
          <td>Cantidad<br />&nbsp;&nbsp;&nbsp;&nbsp;M2</td>
          <td>Precio</td>
          
          <td>Costo</td>
          <td>Nota</td>
        </tr>
        <tr>
          <td>
            <select name="articulo1" class="form-control input-sm" id="art_1">
              <option value="0">--Selecciona--</option>
              <?php
              include ("conex.php");
              $datos=mysqli_query($mysqli,"SELECT id_articulo,descripcion,minimo FROM articulos where id_articulo in ('1','2','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21')");
              while($datos1=mysqli_fetch_array($datos))
              {
                ?>
                <option value="<?php echo $datos1[0];?>" tipo="<?php echo $datos1[2];?>"> 
                <?php echo $datos1[1];?>
                </option>
                <?php
              }?>
            </select>
          </td>
          <td style="display: none">
            <input type="text" required="required" name="cantidad1" id="cantidad1" class="td" onclick="pre('1')" value="0" />
          </td>
          <td>
            <select  name="um1" id="um1" class="form-control input-sm" onchange="calculam2(1);">
              <option value="1">Frente</option>
              <option value="2">Frente y Vuelta</option>
              <option value="3">Vuelta</option>
            </select>
          </td>
          <td>
            <input type="text" name="largo1" id="largo1" class="form-control input-sm td"   onkeyup="calculam2(1)" value="0"/>
          </td>
          <td>
            <input type="text" name="ancho1" id="ancho1" class="form-control input-sm td"  onkeyup="calculam2(1)" value="0"/>
          </td>
          <td>
            <input type="hojas" name="hojas1" id="hojas1" class="form-control input-sm td"  onkeyup="calculam2(1)" value="0"/>
          </td>
          <td>
            <input type="text" name="precio1" id="precio1" readonly="readonly" class="form-control input-sm td"  value="0"/>
          </td>
          <td>
            <input type="text" required="required" name="costo1" id="costo1" class="form-control input-sm td" onkeyup="calculam2(1)" value="0">
          </td>
          
          <td>
            <input type="text" required="required" name="total_1" disabled="disabled" id="total_1" class="form-control input-sm td" value="0">
          </td>
          <td style="padding: 0">
            <textarea  rows="1" name="nota_1" id="nota_1" class="form-control"></textarea>
          </td>
          <td>&nbsp; </td>
        </tr>
   </table>
   <div id="cargatr">
     
   </div>

    <table width="467" border="0" align="center" >

      <tr>
        <td >Subtotal </td>
        <td colspan="2" >
          <input name="subtotalp" class="form-control input-sm" type="text" required="required" id="subtotalp" disabled="disabled" value="0" />
        </td>
      </tr>
      <tr>
        <td >Iva </td>
        <td colspan="2" >
          <input name="sub" type="text" class="form-control input-sm"  required="required" id="sub" disabled="disabled" value="0" />
        </td>
      </tr>
      <tr>
        <td>Total</td>
        <td colspan="2" >
          <input name="tot1" type="text"  class="form-control input-sm"  required="required" id="tot" readonly="readonly" value="0"  />
        </td>
      </tr>
      <tr>
        <td>NOTA*</td>
        <td colspan="2">
          <textarea class="form-control" rows="2" name="nota" id="nota"></textarea>
        </td>
      </tr>
      <tr>
        <td  >
          <input type="hidden" name="trs" value="1" id="ntr">
          <input type="hidden" name="idss" value="1," id="nid">
          
          <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal" >Enviar</button>
        </td>
      </tr>     
    </table>
    <div class="modal fade bs-example-modal-sm" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title" id="myModalLabel">Confirmar</h3>
          </div>
          <div class="modal-body">
            <h4>Guardar Datos</h4>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnenv" name="Guardar" class="btn btn-info" >Aceptar</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
          </div>
        </div>
      </div>
    </div>
   </form>

    

   </center>
   
  </div>
  <div class="footer">
    <p></p></div>
</div>
</body>
</html>
<script>
function crear()
{
  n=document.getElementById("ntr").value;
  n=parseInt(n);
  n=n+1
  var div=document.createElement("div");
  div.id="div"+n;
  document.getElementById("cargatr").appendChild(div);
  $("#div"+n).load('tr.php?n='+n);
  document.getElementById("ntr").value=n;
  var val=document.getElementById("nid");
  val.value+=n+',';
}
function elimina(n)
{
  var el=document.getElementById("div"+n);
  document.getElementById("cargatr").removeChild(el);
  var cadena=document.getElementById("nid").value;
  dividri=cadena.split(',');
  for(i=0;i<dividri.length;i++)
  {
    if(dividri[i]==n)
    {
      dividri[i]="";
    }
  }

  ncad="";
  for(z=0;z<dividri.length;z++)
  {
    if(dividri[z]!="")
    {
      ncad=ncad+dividri[z]+',';
    }
  }
  document.getElementById("nid").value="";
  document.getElementById("nid").value=ncad;
}
	
function calculam2(id,tipo){
//obtenemos id de articulo
var idArticulo = $('[name=articulo'+id+']').val();


  var aplicacion=$("#um"+id).val();
  if(aplicacion==3){
    aplicacion=1;
  }

  var ancho=$("#ancho"+id).val();
  var largo=$("#largo"+id).val();
  var pliego=$("#hojas"+id).val();

  m2=(ancho/100)*(largo/100)*pliego*aplicacion;
 if(idArticulo == 1){
    m2=0;
  }
  //cantidad
  $("#precio"+id).val(m2.toFixed(2));

  var cantidad=$("#precio"+id).val();
  var precio=$("#costo"+id).val();


  total=cantidad*precio;
  if(idArticulo == 1){
    total=pliego*precio;
  }

  $("#total_"+id).val(total.toFixed(2));

  calcula_todo();
}

function calcula_todo(){
  var nid=$("#nid").val();
  divtotal=nid.split(',');
  var sumatodo=0;

  for (var i = 0; i < divtotal.length; i++) {
    if(divtotal[i]!=''){
      totalx=$("#total_"+divtotal[i]).val();
      totalx=parseFloat(totalx);
      tipoart=$("#art_"+divtotal[i]+" option:selected").attr('tipo');
      console.log('tipo='+tipoart);
      // si es minimo  3,5,7,8,9,13
      if(tipoart==4){
      	if(totalx<=1000){
      		totalx=1000;
      	}
      }
      
     else

      if(tipoart==3){
      	if(totalx<=1000){
      		totalx=1000;
      	}
      }

    else

     if(tipoart==2){
      if (totalx<=300){
        totalx=300;
      }
     }
     else

      if(tipoart==1){
        if(totalx<=1000){
          totalx=1000;
        }
      }
      else{
        if(totalx<=500){
          totalx=500;
        }
      }

      sumatodo=sumatodo+totalx;



    }
  }
  //sumatodo=parseInt(sumatodo.toFixed(2));
  //alert(sumatodo);
  sumatodo=sumatodo.toFixed(2);

  if (sumatodo<=300) {
    sumatodo=300.00;
  }
  $("#subtotalp").val(sumatodo);

  sub=$("#subtotalp").val();

  sub=parseFloat(sub);

  

  iva=sub*0.16;
  iva=parseFloat(iva);
  iva=iva.toFixed(2);

  $("#sub").val(iva);

  tot_iva=$("#sub").val();
  tot_iva=parseFloat(tot_iva);
  
  
  total_todo=sub+tot_iva;
  total_todo=total_todo.toFixed(2);

  if(sub>300){
    $("#tot").val(total_todo);
  }
  if(sub<=300){
    $("#tot").val(sub);
  }

}

$(document).ready(function(){
  
  $(document).keyup(function(e){
    var code = e.which;
    if(code==13){
      e.preventDefault();
      $("#myModal").modal('show');
    }

  });

  $("#btnenv").click(function(){
    $("#form1").submit();
  });

});

</script>