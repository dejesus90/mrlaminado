<?php
session_start();
if(!$_SESSION['sistema'])
{
  header("location:Index.php");
}
include ("conex.php");
#bobinas
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

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="jquery-3.2.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<script type="text/javascript" src="js/bootstrap.js"></script>
<title>Mr.Laminado</title>
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
	background-color: #C40000;
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
.container .header table tr td font {
	color: #FFF;
	font-weight: bold;
}
-->
</style>
</head>

<body>
<?php 

$id=$_GET['id'];
$consulta=mysqli_query($mysqli,"SELECT* FROM remision WHERE id='$id'");

$cons=mysqli_fetch_array($consulta);
?>
<div class="container">
  <div class="header"><!-- end .header -->
    <table width="324" border="0" align="center">
      <tr>
        <td width="241" height="55" align="center"><font size="6">MR.Laminado</font></td>
        <td width="73"><img src="Imagnes/monito.jpg" alt="" width="73" height="49" /></td>
      </tr>

    </table>
  </div>
  <div class="content">
   <center> 
     <h2>Remisiones</h2>
   </center>
   <center>
   <form method="POST" id="form1" autocomplete="off" action="rem_updatebob.php">
   <table id="tb1" class="table table-condensed table-bordered">
    <tr>
      <td colspan="10">
          <h5>
            <a href="remision_l.php"><span style="float:right;">Ver Registros<i><img src="Imagnes/ver.png" width="24" height="16"="20" /></i></span></a>
          </h5>
        </td>
        <td colspan="2">
          <h5>
            <a href="menuprincipal.php"><span style="float:right;">Salir<i><img src="Imagnes/exit.png" width="27" height="27"="20" /></i></span></a>
          </h5>
        </h4>
      </td>
    </tr>
    <tr>
      <td colspan="6">Cliente</td>
      <td colspan="6">
        <select name="cliente" class="form-control input-sm">
          <option value="0">--Selecciona--</option>
          <?php
          $dt=mysqli_query($mysqli,"SELECT id_cliente,razon_social FROM cliente");
          while ($dt1=mysqli_fetch_array($dt)) 
          {
            if($dt1[0]==$cons[9])
            {
              echo "<option value='$dt1[0]' selected>$dt1[1]</option>";
            }
            else
            {
              echo "<option value='$dt1[0]'>$dt1[1]</option>";
            }
          }
          ?>
        </select>
      </td>
    </tr>
    <tr>
      <td colspan="6">Fecha</td>
      <td colspan="6">
        <input name="fecha" type="date" class="form-control input-sm" required="required" value="<?php echo $cons[1]; ?>" />
      </td>
      
    </tr>
    <tr>
      <td colspan="12" style="text-align: right;">
        <button class="btn bnt-sm btn-info" type="button" onclick="crear();">Agregar</button>
      </td>
    </tr>
    <tr>
      <td colspan="11">
        <div class="alert alert-danger" role="alert" id="alertdel" style="display: none">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <strong>Eliminado Correctamente en la base de datos</strong>
        </div>
      </td>
    </tr>
    <tr class="warning">
      <th width="8%">Cantidad PZ</th>
      <th width="15%">Articulo </th>
      <th width="10%" style="display: none;">Pedimiento</th>
      <th width="10%">Ancho</th>
      <th width="10%">Largo</th>
      <th width="10%">M2</th>
      <th width="7%">Precio<br />M2 en UDS</th>
      <th width="10%">Precio x Bobina<br />USD</th>
      <th width="7%">Tipo<br>Cambio</th>
      <th width="7%">Precio<br>unitario</th>
      <th width="20%">Nota</th>
      <th width="2%" align="center"></th>
    </tr>
    <tbody id="tbodybobina">
    <?php 
    $consulta1=mysqli_query($mysqli,"SELECT* FROM remision WHERE id='$id'");
    $cont=0;
    $contx="";
    $id_remision="";
    $subg=0;
    $sub_total=0;
    $idr='';
    $contbob=0;
    while($cons1=mysqli_fetch_array($consulta1))
    {
      $contbob++;
      $idr=$cons1['id'];
      $cont++;
      $contx=$contx.$cont.',';
      $id_remision=$id_remision.$cons1[0].',';

      $m2=($cons1['ancho']*$cons1['largo']/100);

      #precio por bobina
      $pbobina_usd=$m2*$cons1['costo'];
      #precio unitario
      $precio_unitario=($cons1['tipo_cambio']*$pbobina_usd)*$cons1['cantidad'];

      ?>
      <tr id="trbob<?php echo $contbob; ?>" name="<?php echo $cons1[0] ?>">
        <td>
          <input type="text" name="cantidadpz<?php echo $contbob ?>" id="cantidadpz<?php echo $contbob ?>" class="form-control input-sm td" onkeyup="calculam2(<?php echo $contbob ?>)" value="<?php echo $cons1['cantidad'] ?>"/>
        </td>
        <td>
          <select name="articulo<?php echo $contbob ?>"  onchange="cambiarart('<?php echo $contbob ?>')" id="articulo<?php echo $contbob ?>" class="form-control input-sm cambiaart changebob" data="<?php echo $contbob ?>">
            <option value="0">--Selecciona--</option>
            <?php
            for ($i=0; $i < count($arrbob); $i++) { 
                    # code...
              ?>
              <option value="<?php echo $arrbob[$i]['id'] ?>" <?php if($arrbob[$i]['id']==$cons1['id_articulo']){ ?> selected="selected" <?php } ?>><?php echo $arrbob[$i]['desc'] ?></option>
              <?php
            }
            ?>
          </select>
        </td>
        <td style="display: none;">
          <select  name="pedimento<?php echo $contbob ?>" onchange="calculam2('<?php echo $contbo ?>')" id="pedimento<?php echo $contbob ?>" class="form-control input-sm">
            <option value="0">--Selecciona--</option>
          </select>
        </td>
        <td>
          <select  name="ancho<?php echo $contbob ?>" id="ancho<?php echo $contbob ?>" class="form-control input-sm">
            <?php
            for ($i=0; $i < count($arrbob); $i++) {
              if($arrbob[$i]['id']==$cons1['id_articulo']){
                $divanchos=explode('/', $arrbob[$i]['ancho']);
                foreach ($divanchos as $keyancho) {
                  if($keyancho!=''){
                    ?>
                    <option value="<?php echo $keyancho ?>" <?php if($keyancho==$cons1['ancho']){ echo 'selected="selected"'; }?>><?php echo $keyancho ?></option>
                    <?php
                  }
                }
              }
            }
            ?>
          </select>
        </td>
        <td>
          <input type="text" name="largo<?php echo $contbob ?>" id="largo<?php echo $contbob ?>" class="form-control input-sm td"   onkeyup="calculam2(<?php echo $contbob ?>)" value="<?php echo $cons1['largo']; ?>"/>
        </td>
        <td>
          <input type="text" name="m2_<?php echo $contbob ?>" id="m2_<?php echo $contbob ?>" class="form-control input-sm td" disabled="disabled"  onkeyup="calculam2(<?php echo $contbob ?>)" value="<?php echo $m2; ?>"/>
        </td>
        <td>
          <input type="text" name="m2_usd<?php echo $contbob ?>" id="m2_usd<?php echo $contbob ?>"  class="form-control input-sm td"  value="<?php echo $cons1['costo']; ?>" onkeyup="calculam2(<?php echo $contbob ?>)"/>
        </td>
        <td>
          <input type="text" required="required" name="precioxbobina_<?php echo $contbob ?>" id="precioxbobina_<?php echo $contbob ?>" class="form-control input-sm td" onkeyup="calculam2(<?php echo $contbob ?>)" value="<?php echo number_format($pbobina_usd, 2, '.', ''); ?>" disabled="disabled">
        </td>
        <td>
          <input type="text" required="required" name="tipocambio_<?php echo $contbob ?>" id="tipocambio_<?php echo $contbob ?>" class="form-control input-sm td" value="<?php echo $cons1['tipo_cambio']; ?>" onkeyup="calculam2(<?php echo $contbob ?>)">
        </td>
        <td>
          <input type="text" required="required" name="precio_unitario<?php echo $contbob ?>" disabled="disabled" id="precio_unitario<?php echo $contbob ?>" class="form-control input-sm td" value="<?php echo number_format($precio_unitario, 2, '.', ''); ?>">
        </td>
        <td style="padding: 0">
          <textarea  rows="1" name="nota_<?php echo $contbob ?>" id="nota_<?php echo $contbob ?>" class="form-control"><?php echo $cons1['nota']; ?></textarea>
        </td>
        <td align="center" width="5%">
          <i onclick="elimina(<?php echo $contbob ?>,1);" class="glyphicon glyphicon-remove" style="color:#F00"></i>
        </td>
        </tr>
        <?php
        $formato_tot=number_format($cons1['cantidad']*$cons1['costo'], 2, '.', '');
        $sub_total=$sub_total+number_format($precio_unitario, 2, '.', '');
      }
      ?>
    </tbody>
    </table>
    <div id="cargatr">
      
    </div>

    <table width="467" border="0" align="center">
      <tr>
        <td colspan="3">Subtotal</td>
        <td width="149" colspan="4">
          <input name="subtotalp"  class="form-control" type="text" required="required" id="subtotalp" disabled="disabled" value="<?php echo number_format($sub_total, 2, '.', '');?>" />
        </td>
      </tr>
       <tr>
        <td colspan="3">IVA</td>
        <td width="149" colspan="4">
          <?php
          $iva=$sub_total*0.16;
          $iva=number_format($iva, 2, '.', '');
          ?>
          <input name="sub" class="form-control"  type="text" required="required" id="sub" disabled="disabled" value="<?php echo $iva;?>" />
        </td>
      </tr>
      <tr>
        <td colspan="3">Total</td>
        <td  colspan="4">
          <?php
          $totaltodo=$sub_total+$iva;
          $totaltodo=number_format($totaltodo,2,'.','');
          ?>
          <input name="tot1" class="form-control"  type="text" required="required" id="tot" readonly="readonly" value="<?php echo $totaltodo;?>" />
        </td>
      </tr>
      <tr>
        <?php
        $sel_nota="SELECT * FROM notas_remision WHERE id_remision=$idr";
        $sql_nota=mysqli_query($mysqli,$sel_nota);
        $res_nota=mysqli_fetch_array($sql_nota);
        ?>
        <td colspan="3">NOTA*</td>
        <td colspan="4">
          <textarea class="form-control" rows="2" name="nota" disabled="disabled" id="nota"><?php echo $res_nota['nota'] ?></textarea>
        </td>
      </tr>
      <tr>
        <td  colspan="3">
          <input type="text" name="trs" value="<?php echo $cont;?>" id="ntr">
          <input type="text" name="idss" value="<?php echo $contx;?>" id="nid">
          <input type="text" name="id_remision" value="<?php echo $id_remision;?>">
          <input type="text" name="idr" value="<?php echo $idr;?>">
          <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal" >Enviar</button>
        </td>
        <td colspan="4"></td>
      </tr>
      
</table>
    <div class="modal fade bs-example-modal-sm" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Confirmar</h4>
          </div>
          <div class="modal-body">
            <h1>Guardar Datos</h1>
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
    <p>Mr laminado</p>
    <!-- end .footer --></div>
  <!-- end .container --></div>
</body>
</html>
<script>
  var bobina='<?php echo $cadbobinas ?>';
  var jsonbob=JSON.parse(bobina);
function crear()
{
  /*
  n=document.getElementById("ntr").value;
  n=parseInt(n);
  n=n+1;
  var div=document.createElement("div");
  div.id="div"+n;
  document.getElementById("cargatr").appendChild(div);
  $("#div"+n).load('tr.php?n='+n);
  document.getElementById("ntr").value=n;
  var val=document.getElementById("nid");
  val.value+=n+',';*/


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
    tr+='<i onclick="elimina('+nap+',0);" class="glyphicon glyphicon-remove" style="color:#F00"></i>';
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
    // $('#ancho'+nap).append('<option value="0">Select</option>');
    for (var i = 0; i < divmed.length; i++) {
      if(divmed[i]!=''){
        $('#ancho'+nap).append('<option value='+divmed[i]+'>'+divmed[i]+'</option>');
      }
    }
    //$('#ancho'+nap).typeahead({source: divmed });
    $('#m2_usd'+nap).val(arrPorID[0].precio);

};

function elimina(n,tipo)
{
  if(tipo==1){
    var idel=$("#trbob"+n).attr('name');
    
    datos=new FormData();
    datos.append('id',idel);

    
    $.ajax({
      url: "eliminararticulo_bob.php", //Url a donde la enviaremos
      type:'POST', //Metodo que usaremos
      contentType:false, //Debe estar en false para que pase el objeto sin procesar
      data:datos, //Le pasamos el objeto que creamos con los archivos
      processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
      cache:false //Para que el formulario no guarde cache

    }).done(function(echo){//Escuchamos la respuesta y capturamos el mensaje msg
      $("#alertdel").show();
    });
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
    $("#trbob"+n).remove()

  }
  if(tipo==0){
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
    $("#trbob"+n).remove()
  }
  calcula_todo()
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

  var tipo_cambio=$("#tipocambio_"+id).val();
  tipo_cambio=parseInt(tipo_cambio);

  precio_unitario=(tipo_cambio*parseInt(pbobina_usd))*parseInt(cantidad);

  $("#precio_unitario"+id).val(precio_unitario);


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