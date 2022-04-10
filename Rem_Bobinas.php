<?php
session_start();
if(!$_SESSION['sistema'])
{
  header("location:Index.php");
}
include ("conex.php");
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
  margin-top: 0;   /* la eliminación del margen superior resuelve un problema que origina que los márgenes escapen de la etiqueta div contenedora. El margen inferior restante lo mantendrá separado de los elementos de que le sigan. */
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
<?php
$datos2=mysqli_query($mysqli,"SELECT id_articulo,descripcion,ancho,largo,precio FROM articulos where tipo='B'");

$bobinasadd = array();
while($row = mysqli_fetch_array($datos2)){
  $bobinasadd[] = $row;
}
$contb=count($bobinasadd);
$arrbob=[];
for ($i=0; $i < $contb; $i++) { 
  $arr=["id"=>$bobinasadd[$i]['id_articulo'],"desc"=>trim($bobinasadd[$i]['descripcion']),"ancho"=>$bobinasadd[$i]['ancho'],"largo"=>trim($bobinasadd[$i]['largo']),"precio"=>trim($bobinasadd[$i]['precio'])];
  $arrbob[$i]=$arr;
}
$contxb=count($arrbob);
// echo $contxb;
$cadbobinas=json_encode($arrbob);
?>
<div class="container">
  <div class="header"><!-- end .header -->
    <table width="336" border="0" align="center">
      <tr>
        
        <td width="300"><img src="Imagnes/Logomrlaminado2021.png" alt="" width="450" height="120" /></td>
      </tr>
    </table>
  </div>
  <div class="content">
   <center>
     <h3>Bobinas</h3>
     <table width="300" border="0" align="right">
       <tr>
         <td width="194" scope="col"><h5><a href="remision_l.php"><span style="float:right;">Ver Registros<i><img src="Imagnes/ver.png" alt="" width="25" height="25"="20" /></i></span></a></h5></td>
         <td width="90" scope="col"><h5><a href="menuprincipal.php"><span style="float:right;">Menu<i><img src="Imagnes/casa.png" alt="" width="25" height="21"="20" /></i></span></a></h5></td>
       </tr>
       <tr>
         
       
       </tr>
     </table>
   </center>
   <center>
    <form method="POST" id="form1" autocomplete="off" action="rem_upbobina.php">
      <table id="tb1" class="table table-condensed">
        <tr>
          <td colspan="5" align="center">Cliente</td>
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
          <td colspan="5" align="center">Fecha</td>
          <td colspan="4"><input name="fecha" class="form-control input-sm" type="date" required="required"/></td>
          <td colspan="2"></td>
        </tr>
        <tr>
          <td colspan="5"></td>
          <td colspan="6">
            <span onclick="crear();" style="float: right; background-color:#1e88e5; border-radius:10px;color: #ffffff; padding: 2px; font-size: 11px;font-weight: bold; cursor: pointer;">Agregar +</span>
          </td>
        </tr>
        <tr class="warning">
            <th width="8%">Cantidad PZ</th>
            <th width="15%">Articulo </th>
            <th width="10%" style="display: none">Pedimiento</th>
            <th width="7%">Ancho</th>
            <th width="7%">Largo</th>
            <th width="7%">M2</th>
            <th width="7%">Precio<br />M2 en UDS</th>
            <th width="10%">Precio x Bobina<br />USD</th>
            <th width="7%">Tipo<br>Cambio</th>
            <th width="7%">Precio<br>unitario</th>
            <th width="20%">Nota</th>
            <th width="5%"></th>
        </tr>
        <tbody id="tbodybobina">
        </tbody>
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
          <input type="text" name="trs" value="0" id="ntr">
          <input type="text" name="idss" value="" id="nid">
          
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
  //bobinas
  var bobina='<?php echo $cadbobinas ?>';
  var jsonbob=JSON.parse(bobina);
function crear()
{
  n=document.getElementById("ntr").value;
  n=parseInt(n);
  nap=n+1
  var tr='<tr id="trbob'+nap+'">';
    tr+='<td>';
    tr+='<input type="text" name="cantidadpz'+nap+'" id="cantidadpz'+nap+'" class="form-control input-sm td" onkeyup="calculam2('+nap+')" value="1"/>';
    tr+='</td>';
    tr+='<td>';
    tr+='<select name="articulo'+nap+'"  id="articulo'+nap+'" tipo="'+nap+'" class="form-control input-sm cambiaart" onchange="cambiarart('+nap+')">';
    tr+='<option value="0">--Selecciona--</option>';
    for (var i = 0; i < jsonbob.length; i++) {
      tr+='<option value="'+jsonbob[i].id+'">'+jsonbob[i].desc+'</option>';
    }
    tr+='</select>';
    tr+='</td>';
    tr+='<td style="display:none">';
    tr+='<select  name="pedimento'+nap+'" id="pedimento'+nap+'" class="form-control input-sm">';
    tr+='<option value="11111">Pedimento 1</option>';
    tr+='<option value="22222">Pedimento 2</option>';
    tr+='<option value="33333">Pedimento 3</option>';
    tr+='<option value="44444">Pedimento 4</option>';
    tr+='<option value="55555">Pedimento 5</option>';
    tr+='<option value="66666">Pedimento 6</option>';
    tr+='</select>';
    tr+='</td>';
    tr+='<td>';
    //tr+='<input type="text" name="anchob'+nap+'" id="anchob'+nap+'" class="form-control input-sm td aut"   value="0"  autocomplete="off" />';
    tr+='<select  name="ancho'+nap+'" id="ancho'+nap+'" class="form-control input-sm" onkeyup="calculam2('+nap+')">';
    //tr+='<option>select</option>';
    tr+='</select>';
    tr+='</td>';
    tr+='<td>';
    tr+='<input type="text" name="largo'+nap+'" id="largo'+nap+'" class="form-control input-sm td"   onkeyup="calculam2('+nap+')" value="3000"/>';
    tr+='</td>';
    tr+='<td>';
    tr+='<input type="hojas" name="m2_'+nap+'" id="m2_'+nap+'" class="form-control input-sm td" disabled="disabled"  onkeyup="calculam2('+nap+')" value="0"/>';
    tr+='</td>';
    tr+='<td>';
    tr+='<input type="text" name="m2_usd'+nap+'" id="m2_usd'+nap+'"  class="form-control input-sm td"  value="0" onkeyup="calculam2('+nap+')"/>';
    tr+='</td>';
    tr+='<td>';
    tr+='<input type="text" required="required" name="precioxbobina_'+nap+'" id="precioxbobina_'+nap+'" class="form-control input-sm td" onkeyup="calculam2('+nap+')" value="0" disabled="disabled">';
    tr+='</td>';
    tr+='<td>';
    tr+='<input type="text" required="required" name="tipocambio_'+nap+'" id="tipocambio_'+nap+'" class="form-control input-sm td" value="0" onkeyup="calculam2('+nap+')">';
    tr+='</td>';
    tr+='<td>';
    tr+='<input type="text" required="required" name="precio_unitario'+nap+'" disabled="disabled" id="precio_unitario'+nap+'" class="form-control input-sm td" value="0">';
    tr+='</td>';
    tr+='<td style="padding: 0">';
    tr+='<textarea  rows="1" name="nota_'+nap+'" id="nota_'+nap+'" class="form-control"></textarea>';
    tr+='</td>';
    tr+='<td style="padding: 0; text-align:center">';
    tr+='<i onclick="elimina('+nap+');" class="glyphicon glyphicon-remove" style="color:#F00"></i>';
    tr+='</td>';
    tr+='</tr>';

    $("#tbodybobina").append(tr);
    //$("#nbob").val(nap);

    

  document.getElementById("ntr").value=nap;
  var val=document.getElementById("nid");
  val.value+=nap+',';
}

function cambiarart(nap) {
  idarticulo=$(this).attr('tipo');
  var valart=$('#articulo'+nap).val();

  function filtrarPorID(jsonbob) {
    if ('id' in jsonbob && jsonbob.id ===valart ) {
      return true;
    } else {
      return false;
    }
  }
    var arrPorID = jsonbob.filter(filtrarPorID);
    medidasx=arrPorID[0].ancho;

    var divmed=medidasx.split('/');

    valopt='';
    $('#ancho'+nap).html('');
    $('#ancho'+nap).append('<option value="0">Select</option>');
    for (var i = 0; i < divmed.length; i++) {
      if(divmed[i]!=''){
        $('#ancho'+nap).append('<option value='+divmed[i]+'>'+divmed[i]+'</option>');
      }
    }
    //$('#ancho'+nap).typeahead({source: divmed });
    $('#m2_usd'+nap).val(arrPorID[0].precio);

};


function elimina(n)
{
  // var el=document.getElementById("div"+n);
  // document.getElementById("cargatr").removeChild(el);
  $("#trbob"+n).remove();
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

  calcula_todo();
}
  
function calculam2(id){

  var cantidad=$("#cantidadpz"+id).val();

  var ancho=$("#ancho"+id).val();
  var largo=$("#largo"+id).val();

  m2=(ancho*largo/100);

  $("#m2_"+id).val(m2.toFixed(2));


  //precio m2
  var pm2=$("#m2_usd"+id).val();

  var pbobina_usd=m2*pm2;

  $("#precioxbobina_"+id).val(pbobina_usd);

  var pxb=$("#precioxbobina_"+id).val();
  var tipo_cambio=$("#tipocambio_"+id).val();

  //tipo_cambio=parseInt(tipo_cambio);
  precio_unitario=(tipo_cambio*pxb)*parseInt(cantidad);
  //precio_unitario=(tipo_cambio*parseInt(pbobina_usd))*parseInt(cantidad);

  $("#precio_unitario"+id).val(precio_unitario.toFixed(2));


  // total=cantidad*precio;

  // $("#total_"+id).val(total.toFixed(2));

  calcula_todo();
}

function calcula_todo(){

  var nid=$("#nid").val();
  divtotal=nid.split(',');
  var sumatodo=0;

  for (var i = 0; i < divtotal.length; i++) {
    if(divtotal[i]!=''){
      
      totalx=$("#precio_unitario"+divtotal[i]).val();
      totalx=parseFloat(totalx);

      sumatodo=sumatodo+totalx;

    }
  }
  //sumatodo=parseInt(sumatodo.toFixed(2));
  //alert(sumatodo);
  sumatodo=sumatodo.toFixed(2);

  // if (sumatodo<=300) {
  //   sumatodo=300.00;
  // }
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

  // if(sub>300){
    $("#tot").val(total_todo);
  // }
  // if(sub<=300){
  //   $("#tot").val(sub);
  // }

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