<?php
session_start();
if(!$_SESSION['sistema'])
{
	header("location:Index.php");
}
include ("conex.php");

##aplicaciones
$datos=mysqli_query($mysqli,"SELECT id_articulo,descripcion FROM articulos where tipo='A'");

$MiembrosRegistrados = array();
while($row = mysqli_fetch_array($datos)){
  $MiembrosRegistrados[] = $row;
}

$cont=count($MiembrosRegistrados);
$arrp=[];
for ($i=0; $i < $cont; $i++) { 
  $arr=["id"=>$MiembrosRegistrados[$i]['id_articulo'],"desc"=>trim($MiembrosRegistrados[$i]['descripcion'])];
  $arrp[$i]=$arr;
}
$contx=count($arrp);
$cad=json_encode($arrp);

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

$idcot=$_GET['id'];

$sel_clienteco=mysqli_query($mysqli,"SELECT cliente,fecha,total from cotizacion where num_cotizacion=$idcot limit 1 ");
$res_cli=mysqli_fetch_array($sel_clienteco);


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">

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
</style>
</head>
 
<body>

<div class="container">
  <div class="header"><!-- end .header -->
    <table width="324" border="0" align="center">
      <tr>
        
        <td width="73"><img src="Imagnes/Logomrlaminado2021.png" alt="" width="450" height="120" /></td>
      </tr>
    </table>
  </div>
  <div class="content">
   <center> 
     <h3>Cotizacion</h3>
     <table width="300" border="0" align="right">
       <tr>
         <td width="194" scope="col"><h5><a href="registrocotizar.php"><span style="float:right;">Ver Registros<i><img src="Imagnes/ver.png" alt="" width="25" height="25"="20" /></i></span></a></h5></td>
         <td width="90" scope="col"><h5><a href="menuprincipal.php"><span style="float:right;">Menu<i><img src="Imagnes/casa.png" alt="" width="25" height="21"="20" /></i></span></a></h5></td>
       </tr>
     </table>
   </center>
    <center>
    <form method="POST" id="form1" autocomplete="off" action="cotizarupdate.php">
      <table id="tb1" class="table table-condensed table-bordered" style="margin-bottom: 0">
        <tr>
          <td colspan="4" align="center">Cliente</td>
          <td colspan="6">
            <select name="cliente" class="form-control input-sm">
              <option value="0">--Selecciona--</option>
              <?php
              $dt=mysqli_query($mysqli,"SELECT id_cliente,razon_social FROM cliente");
              while ($dt1=mysqli_fetch_array($dt)) 
              {
                ?>
                <option value="<?php echo $dt1[0]; ?>" <?php if($dt1['id_cliente']==$res_cli[0]){ echo 'selected="selected"'; } ?>><?php echo $dt1[1]; ?></option>
                <?php
              }
              ?>
            </select>
          </td>
        </tr>
        <tr>
          <td colspan="4" align="center">Fecha</td>
          <td colspan="6"><input name="fecha" class="form-control input-sm" type="date" required="required" value="<?php echo $res_cli['fecha'] ?>" /></td>
        </tr>
        <tr>
          <td colspan="4"></td>
          <td colspan="6">
            <div class="btn-group btn-group-sm pull-right" role="group" >
              <button type="button" class="btn btn-info" id="addapp"><i class=" glyphicon glyphicon-plus "></i> Aplicacion</button>
              <button type="button" class="btn btn-warning" id="addbob"><i class=" glyphicon glyphicon-plus "></i> Bobinas</button>
            </div>
          </td>
        </tr>
        <tr>
          <td colspan="10">
            <div class="alert alert-danger" role="alert" id="alertdel" style="display: none">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Eliminado Correctamente en la base de datos</strong>
            </div>
          </td>
        </tr>
        <tr>
          <th colspan="10">
            Aplicaciones(0)
          </th>
        </tr>
        <tr class="info">
          <th width="20%">Articulo</th>
          <th width="15%">Tipo</th>
          <th width="10%">Largo</th>
          <th width="10%">Ancho</th>
          <th width="5%">Pliegos</th>
          <th width="10%">Cantidad<br />M2</th>
          <th width="10%">Precio</th>
          <th width="10%">Costo</th>
          <th width="20%">Nota</th>
          <th width="5%"></th>
        </tr>
        <tbody id="tbodyapli">
          <?php
          $contapp=0;
          $cadapp='';
          $idapp='';
          $sel_app=mysqli_query($mysqli,"SELECT * from cotizacion where num_cotizacion=$idcot and tipo='A'");
          while ($res_cotap=mysqli_fetch_array($sel_app)) {
            $contapp++;
            $cadapp=$cadapp.$contapp.',';
            $idapp=$idapp.$res_cotap['id'].',';
            # code...
            $total_linea=$res_cotap['cantidad']*$res_cotap['costo'];
            ?>
            <tr id="trap<?php echo $contapp ?>" name="<?php echo $res_cotap['id']; ?>">
              <td>
                <select name="articulo<?php echo $contapp; ?>" class="form-control input-sm">
                  <option value="0">--Selecciona--</option>
                  <?php

                  for ($i=0; $i < count($arrp); $i++) { 
                    ?>
                    <option value="<?php echo $arrp[$i]['id']; ?>" <?php if($arrp[$i]['id']==$res_cotap['id_articulo']){ ?> selected="selected" <?php } ?> ><?php echo $arrp[$i]['desc']; ?></option>
                    <?php
                  }
                  ?>
                </select>
              </td>
              <td>
                <select  name="um<?php echo $contapp; ?>" class="form-control input-sm" id="um<?php echo $contapp; ?>" onchange="calculam2(<?php echo $contapp; ?>);">
                  <option value="1" <?php if(1==$res_cotap['um']){ ?> selected="selected" <?php } ?> >Frente</option>';
                  <option value="2" <?php if(2==$res_cotap['um']){ ?> selected="selected" <?php } ?> >Frente y Vuelta</option>';
                  <option value="3" <?php if(3==$res_cotap['um']){ ?> selected="selected" <?php } ?> >Vuelta</option>';
                </select>
              </td>
              <td>
                <input type="text" name="largo<?php echo $contapp; ?>" id="largo<?php echo $contapp; ?>" class="form-control input-sm td" onkeyup="calculam2(<?php echo $contapp; ?>)" value="<?php echo $res_cotap['largo'] ?>"/>
              </td>
              <td>
                <input type="text" name="ancho<?php echo $contapp; ?>" id="ancho<?php echo $contapp; ?>" class="form-control input-sm td" onkeyup="calculam2(<?php echo $contapp; ?>)" value="<?php echo $res_cotap['ancho'] ?>"/>
              </td>
              <td>
                <input type="hojas" name="hojas<?php echo $contapp; ?>" id="hojas<?php echo $contapp; ?>" class="form-control input-sm td" onkeyup="calculam2(<?php echo $contapp; ?>)" value="<?php echo $res_cotap['hojas'] ?>"/>
              </td>
              <td>
                <input type="text" name="precio<?php echo $contapp; ?>" id="precio<?php echo $contapp; ?>" class="form-control input-sm td" readonly="readonly" value="<?php echo $res_cotap['cantidad'] ?>"/>
              </td>
              <td>
                <input type="text" name="costo<?php echo $contapp; ?>" id="costo<?php echo $contapp; ?>" class="form-control input-sm td" onkeyup="calculam2(<?php echo $contapp; ?>)" value="<?php echo $res_cotap['costo'] ?>"/>
              </td>
              <td>
                <input type="text" required="required" value="<?php echo number_format($total_linea, 2, '.', '');?>" name="total_<?php echo $contapp; ?>" disabled="disabled" id="total_<?php echo $contapp; ?>" class="form-control input-sm td">
              </td>
              <td>
                <textarea  rows="1" name="nota_<?php echo $contapp; ?>" id="nota_<?php echo $contapp; ?>" class="form-control"><?php echo $res_cotap['nota'] ?></textarea>
              </td>
              <td>
                <i onclick="elimina(<?php echo $contapp; ?>,1);" class="glyphicon glyphicon-remove" style="color:#F00"></i>
              </td>
            </tr>
            <?php
          }

          ?>
        </tbody>
      </table>
      <input type="hidden" id="numap" value="<?php echo $contapp ?>">
      <input type="hidden" id="idapp" name="idapp" value="<?php echo $cadapp; ?>">
      <input type="hidden" id="idapli" name="idapli" value="<?php echo $idapp; ?>">

      <table class="table table-condensed table-bordered">
        <thead>
          <tr>
            <th>
              Bobinas(0)
            </th>
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
            <th width="5%"></th>
          </tr>
        </thead>
        <tbody id="tbodybobina">
          <?php
          $contbob=0;
          $cadbob='';
          $idbob='';
          $sel_app=mysqli_query($mysqli,"SELECT * from cotizacion where num_cotizacion=$idcot and tipo='B'");
          while ($res_cotap=mysqli_fetch_array($sel_app)) {
            $contbob++;
            $cadbob=$cadbob.$contbob.',';
            $idbob=$idbob.$res_cotap['id'].',';
            $m2=($res_cotap['ancho']*$res_cotap['largo']/100);
            #precio por bobina
            $pbobina_usd=$m2*$res_cotap['costo'];
            #precio unitario
            $precio_unitario=($res_cotap['tipocambio']*$pbobina_usd)*$res_cotap['cantidad'];
            ?>
            <tr id="trbob<?php echo $contbob; ?>" name="<?php echo $res_cotap['id'] ?>">
              <td>
                <input type="text" name="cantidadpz<?php echo $contbob ?>" id="cantidadpz<?php echo $contbob ?>" class="form-control input-sm td" onkeyup="calculam2_bobinas(<?php echo $contbob ?>)" value="<?php echo $res_cotap['cantidad'] ?>"/>
              </td>
              <td>
                <select name="articulob<?php echo $contbob ?>"  id="articulob<?php echo $contbob ?>" class="form-control input-sm cambiaart changebob" data="<?php echo $contbob ?>">
                  <option value="0">--Selecciona--</option>
                  <?php
                  for ($i=0; $i < count($arrbob); $i++) { 
                    # code...
                    ?>
                    <option value="<?php echo $arrbob[$i]['id'] ?>" <?php if($arrbob[$i]['id']==$res_cotap['id_articulo']){ ?> selected="selected" <?php } ?>><?php echo $arrbob[$i]['desc'] ?></option>
                    <?php
                  }
                  ?>
                </select>
              </td>
              <td style="display: none;">
                <select  name="pedimento<?php echo $contbob ?>" id="pedimento<?php echo $contbob ?>" class="form-control input-sm">
                  <option value="0">--Selecciona--</option>
                </select>
              </td>
              <td>
                <select  name="anchob<?php echo $contbob ?>" id="anchob<?php echo $contbob ?>" class="form-control input-sm">
                  <?php
                  for ($i=0; $i < count($arrbob); $i++) {
                    if($arrbob[$i]['id']==$res_cotap['id_articulo']){
                      $divanchos=explode('/', $arrbob[$i]['ancho']);
                      foreach ($divanchos as $keyancho) {
                        if($keyancho!=''){
                          ?>
                          <option value="<?php echo $keyancho ?>" <?php if($keyancho==$res_cotap['ancho']){ echo 'selected="selected"'; }?>><?php echo $keyancho ?></option>
                          <?php
                        }
                      }
                    }
                  }
                  ?>
                </select>
              </td>
              <td>
                <input type="text" name="largob<?php echo $contbob ?>" id="largob<?php echo $contbob ?>" class="form-control input-sm td"   onkeyup="calculam2_bobinas(<?php echo $contbob ?>)" value="<?php echo $res_cotap['largo']; ?>"/>
              </td>
              <td>
                <input type="hojas" name="m2_<?php echo $contbob ?>" id="m2_<?php echo $contbob ?>" class="form-control input-sm td" disabled="disabled"  onkeyup="calculam2_bobinas(<?php echo $contbob ?>)" value="<?php echo $m2; ?>"/>
              </td>
              <td>
                <input type="text" name="m2_usd<?php echo $contbob ?>" id="m2_usd<?php echo $contbob ?>"  class="form-control input-sm td"  value="<?php echo $res_cotap['costo']; ?>" onkeyup="calculam2_bobinas(<?php echo $contbob ?>)"/>
              </td>
              <td>
                <input type="text" required="required" name="precioxbobina_<?php echo $contbob ?>" id="precioxbobina_<?php echo $contbob ?>" class="form-control input-sm td" onkeyup="calculam2_bobinas(<?php echo $contbob ?>)" value="<?php echo number_format($pbobina_usd, 2, '.', ''); ?>" disabled="disabled">
              </td>
              <td>
                <input type="text" required="required" name="tipocambio_<?php echo $contbob ?>" id="tipocambio_<?php echo $contbob ?>" class="form-control input-sm td" value="<?php echo $res_cotap['tipocambio']; ?>" onkeyup="calculam2_bobinas(<?php echo $contbob ?>)">
              </td>
              <td>
                <input type="text" required="required" name="precio_unitario<?php echo $contbob ?>" disabled="disabled" id="precio_unitario<?php echo $contbob ?>" class="form-control input-sm td" value="<?php echo number_format($precio_unitario, 2, '.', ''); ?>">
              </td>
              <td>
                <textarea  rows="1" name="notab_<?php echo $contbob ?>" id="notab_<?php echo $contbob ?>" class="form-control"><?php echo $res_cotap['nota']; ?></textarea>
              </td>
              <td>
                <i onclick="elimina_bob(<?php echo $contbob ?>,1);" class="glyphicon glyphicon-remove" style="color:#F00"></i>
              </td>
            </tr>
            <?php
          }
          ?>
        </tbody>
      </table>
      <input type="hidden" id="nbob" value="<?php echo $contbob ?>">
      <input type="hidden" id="idbob" name="idbob" value="<?php echo $cadbob ?>">
      <input type="hidden" id="idbobinas" name="idbobinas" value="<?php echo $idbob; ?>">

      <table width="467" border="0" align="center" >
        <tr style="display: none;">
          <td >Subtotal </td>
          <td colspan="2" >
            <input name="subtotalp" class="form-control input-sm" type="text" required="required" id="subtotalp" disabled="disabled" value="0" />
          </td>
        </tr>
        <tr style="display: none;">
          <td >Iva </td>
          <td colspan="2" >
            <input name="sub" type="text" class="form-control input-sm"  required="required" id="sub" disabled="disabled" value="0" />
          </td>
        </tr>
        <tr>
          <td>Total</td>
          <td colspan="2" >
            <input name="tot1" type="text"  class="form-control input-sm"  required="required" id="tot" readonly="readonly"  value="<?php echo $res_cli['total']; ?>"  />
          </td>
        </tr>
        <tr>
          <td>NOTA*</td>
          <td colspan="2">
            <textarea class="form-control" rows="2" name="nota" disabled="disabled" id="nota"></textarea>
          </td>
        </tr>
        <tr>
          <td  >
            <input type="hidden" name="trs" value="1" id="ntr">
            <input type="hidden" name="idss" value="1," id="nid">
            <input type="hidden" name="idcot" value="<?php echo $idcot ?>" id="idcot">
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
<script type="text/javascript" src="jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/jquery.mockjax.js"></script>
<script type="text/javascript" src="js/bootstrap-typeahead.js"></script>

</html>
<script>



$(document).ready(function(){
  var pro='<?php echo $cad; ?>';
  var jsoon=JSON.parse(pro);
  cont=jsoon.length;

  //bobinas
  var bobina='<?php echo $cadbobinas ?>';
  jsonbob=JSON.parse(bobina);
  console.log(jsonbob)

  $("#addapp").click(function(){
    var nap=$("#numap").val();
    nap=parseInt(nap);
    nap=nap+1

    var tr='<tr id="trap'+nap+'">';
    tr+='<td>';
    tr+='<select name="articulo'+nap+'" class="form-control input-sm">';
    tr+='<option value="0">--Selecciona--</option>';
    for (var i = 0; i < jsoon.length; i++) {
      tr+='<option value="'+jsoon[i].id+'">'+jsoon[i].desc+'</option>';
    }
    
    tr+='</select>';
    tr+='</td>';
    tr+='<td>';
    tr+='<select  name="um'+nap+'" class="form-control input-sm" id="um'+nap+'" onchange="calculam2('+nap+');">';
    tr+='<option value="1">Frente</option>';
    tr+='<option value="2">Frente y Vuelta</option>';
    tr+='<option value="3">Vuelta</option>';
    tr+='</select>';
    tr+='</td>';
    tr+='<td>';
    tr+='<input type="text" name="largo'+nap+'" id="largo'+nap+'" class="form-control input-sm td" onkeyup="calculam2('+nap+')" value="0"/>';
    tr+='</td>';
    tr+='<td>';
    tr+='<input type="text" name="ancho'+nap+'" id="ancho'+nap+'" class="form-control input-sm td" onkeyup="calculam2('+nap+')" value="0"/>';
    tr+='</td>';
    tr+='<td>';
    tr+='<input type="hojas" name="hojas'+nap+'" id="hojas'+nap+'" class="form-control input-sm td" onkeyup="calculam2('+nap+')" value="0"/>';
    tr+='</td>';
    tr+='<td>';
    tr+='<input type="text" name="precio'+nap+'" id="precio'+nap+'" class="form-control input-sm td" readonly="readonly" value="0"/>';
    tr+='</td>';
    tr+='<td>';
    tr+='<input type="text" name="costo'+nap+'" id="costo'+nap+'" class="form-control input-sm td" onkeyup="calculam2('+nap+')" value="0"/>';
    tr+='</td>';
    tr+='<td>';
    tr+='<input type="text" required="required" value="0" name="total_'+nap+'" disabled="disabled" id="total_'+nap+'" class="form-control input-sm td">';
    tr+='</td>';
    tr+='<td style="padding: 0">';
    tr+='<textarea  rows="1" name="nota_'+nap+'" id="nota_'+nap+'" class="form-control"></textarea>';
    tr+='</td>';
    tr+='<td>';
    tr+='<i onclick="elimina('+nap+',0);" class="glyphicon glyphicon-remove" style="color:#F00"></i>';
    tr+='</td>';
    tr+='</tr>';

    $("#tbodyapli").append(tr);
    $("#numap").val(nap);

    var val=document.getElementById("idapp");
    val.value+=nap+',';

  });
  //bobinas
  $("#addbob").click(function(){
    var nap=$("#nbob").val();
    nap=parseInt(nap);
    nap=nap+1;

    var tr='<tr id="trbob'+nap+'">';
    tr+='<td>';
    tr+='<input type="text" name="cantidadpz'+nap+'" id="cantidadpz'+nap+'" class="form-control input-sm td" onkeyup="calculam2_bobinas('+nap+')" value="1"/>';
    tr+='</td>';
    tr+='<td>';
    tr+='<select name="articulob'+nap+'"  id="articulob'+nap+'" class="form-control input-sm cambiaart">';
    tr+='<option value="0">--Selecciona--</option>';
    for (var i = 0; i < jsonbob.length; i++) {
      tr+='<option value="'+jsonbob[i].id+'">'+jsonbob[i].desc+'</option>';
    }
    tr+='</select>';
    tr+='</td>';
    tr+='<td style="display:none;">';
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
    tr+='<select  name="anchob'+nap+'" id="anchob'+nap+'" class="form-control input-sm">';
    tr+='</select>';
    tr+='</td>';
    tr+='<td>';
    tr+='<input type="text" name="largob'+nap+'" id="largob'+nap+'" class="form-control input-sm td"   onkeyup="calculam2_bobinas('+nap+')" value="3000"/>';
    tr+='</td>';
    tr+='<td>';
    tr+='<input type="hojas" name="m2_'+nap+'" id="m2_'+nap+'" class="form-control input-sm td" disabled="disabled"  onkeyup="calculam2_bobinas('+nap+')" value="0"/>';
    tr+='</td>';
    tr+='<td>';
    tr+='<input type="text" name="m2_usd'+nap+'" id="m2_usd'+nap+'"  class="form-control input-sm td"  value="0" onkeyup="calculam2_bobinas('+nap+')"/>';
    tr+='</td>';
    tr+='<td>';
    tr+='<input type="text" required="required" name="precioxbobina_'+nap+'" id="precioxbobina_'+nap+'" class="form-control input-sm td" onkeyup="calculam2_bobinas('+nap+')" value="0" disabled="disabled">';
    tr+='</td>';
    tr+='<td>';
    tr+='<input type="text" required="required" name="tipocambio_'+nap+'" id="tipocambio_'+nap+'" class="form-control input-sm td" value="0" onkeyup="calculam2_bobinas('+nap+')">';
    tr+='</td>';
    tr+='<td>';
    tr+='<input type="text" required="required" name="precio_unitario'+nap+'" disabled="disabled" id="precio_unitario'+nap+'" class="form-control input-sm td" value="0">';
    tr+='</td>';
    tr+='<td style="padding: 0">';
    tr+='<textarea  rows="1" name="notab_'+nap+'" id="notab_'+nap+'" class="form-control"></textarea>';
    tr+='</td>';
    tr+='<td style="padding: 0">';
    tr+='<i onclick="elimina_bob('+nap+',0);" class="glyphicon glyphicon-remove" style="color:#F00"></i>';
    tr+='</td>';
    tr+='</tr>';

    $("#tbodybobina").append(tr);
    $("#nbob").val(nap);

    var val=document.getElementById("idbob");
    val.value+=nap+',';

    

    $( "#articulob"+nap).change(function() {
      idarticulo=$(this).attr('id');
      var valart=$("#"+idarticulo).val();
      
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
      $('#anchob'+nap).html('');
      $('#anchob'+nap).append('<option value="0">Select</option>');
      for (var i = 0; i < divmed.length; i++) {
        if(divmed[i]!=''){
          $('#anchob'+nap).append('<option value='+divmed[i]+'>'+divmed[i]+'</option>');
        }
      }
      //$('#anchob'+nap).typeahead({source: divmed });
      $('#m2_usd'+nap).val(arrPorID[0].precio);

    });


    // 
  });

  

});

$(".changebob").change(function(){
  valart=$(this).val();

  var nap=$(this).attr('data');

  function filtrarPorID(jsonbob) {
    if ('id' in jsonbob && jsonbob.id ===valart ) {
      return true;
    } else {
      return false;
    }
  }

  arrPorID = jsonbob.filter(filtrarPorID);
  medidasx=arrPorID[0].ancho;

  var divmed=medidasx.split('/');



  valopt='';
  $('#anchob'+nap).html('');
  $('#anchob'+nap).append('<option value="0">Select</option>');
  for (var i = 0; i < divmed.length; i++) {
    if(divmed[i]!=''){
      $('#anchob'+nap).append('<option value='+divmed[i]+'>'+divmed[i]+'</option>');
    }
  }

})
/*
$( "#articulob"+nap).change(function() {
      idarticulo=$(this).attr('id');
      var valart=$("#"+idarticulo).val();
      
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
      $('#anchob'+nap).html('');
      $('#anchob'+nap).append('<option value="0">Select</option>');
      for (var i = 0; i < divmed.length; i++) {
        if(divmed[i]!=''){
          $('#anchob'+nap).append('<option value='+divmed[i]+'>'+divmed[i]+'</option>');
        }
      }
      //$('#anchob'+nap).typeahead({source: divmed });
      $('#m2_usd'+nap).val(arrPorID[0].precio);

    });*/

function elimina(n,tipo)
{

  //eliminar en la base de datos
  if(tipo==1){
    //elimina db
    //eliminar en id
    var idel=$("#trap"+n).attr('name');
    
    datos=new FormData();
    datos.append('id',idel);

    
    $.ajax({
      url: "eliminararticulo.php", //Url a donde la enviaremos
      type:'POST', //Metodo que usaremos
      contentType:false, //Debe estar en false para que pase el objeto sin procesar
      data:datos, //Le pasamos el objeto que creamos con los archivos
      processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
      cache:false //Para que el formulario no guarde cache

    }).done(function(echo){//Escuchamos la respuesta y capturamos el mensaje msg
      $("#alertdel").show();
    });


    ///eliminar
    $("#trap"+n).remove()

    var cadena=document.getElementById("idapp").value;

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
    document.getElementById("idapp").value="";
    document.getElementById("idapp").value=ncad;
    calculabob();
  }
  //eliminar tr nomas
  if(tipo==0){
    console.log('elim')
    $("#trap"+n).remove()

    var cadena=document.getElementById("idapp").value;

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
    document.getElementById("idapp").value="";
    document.getElementById("idapp").value=ncad;
    calculabob();
  }
  
}

function elimina_bob(n,tipo)
{
  if(tipo==1){
     var idel=$("#trbob"+n).attr('name');
    
    datos=new FormData();
    datos.append('id',idel);

    
    $.ajax({
      url: "eliminararticulo.php", //Url a donde la enviaremos
      type:'POST', //Metodo que usaremos
      contentType:false, //Debe estar en false para que pase el objeto sin procesar
      data:datos, //Le pasamos el objeto que creamos con los archivos
      processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
      cache:false //Para que el formulario no guarde cache

    }).done(function(echo){//Escuchamos la respuesta y capturamos el mensaje msg
      $("#alertdel").show();
    });

    $("#trbob"+n).remove()
    var cadena=document.getElementById("idbob").value;
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
    document.getElementById("idbob").value="";
    document.getElementById("idbob").value=ncad;
    calculabob();

  }
  if(tipo==0){
    $("#trbob"+n).remove()
    var cadena=document.getElementById("idbob").value;
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
    document.getElementById("idbob").value="";
    document.getElementById("idbob").value=ncad;
    calculabob();
  }
  
}

function calculam2(id,tipo){
  var aplicacion=$("#um"+id).val();
  if(aplicacion==3){
    aplicacion=1;
  }

  var ancho=$("#ancho"+id).val();
  var largo=$("#largo"+id).val();
  var pliego=$("#hojas"+id).val();

  m2=(ancho/100)*(largo/100)*pliego*aplicacion;

  //cantidad
  $("#precio"+id).val(m2.toFixed(2));

  var cantidad=$("#precio"+id).val();
  var precio=$("#costo"+id).val();


  total=cantidad*precio;

  $("#total_"+id).val(total.toFixed(2));

  calcula_todo();
}

function calcula_todo(){

  var sumatodo=0;
  //aplicaciones
  var nid=$("#idapp").val();
  divtotal=nid.split(',');
  for (var i = 0; i < divtotal.length; i++) {
    if(divtotal[i]!=''){
      totalx=$("#total_"+divtotal[i]).val();
      totalx=parseFloat(totalx);
      sumatodo=sumatodo+totalx;
    }
  }
  //bobinas
  var nid=$("#idbob").val();
  divtotal=nid.split(',');
  for (var i = 0; i < divtotal.length; i++) {
    if(divtotal[i]!=''){
      totalx=$("#precio_unitario"+divtotal[i]).val();
      totalx=parseFloat(totalx);
      sumatodo=sumatodo+totalx;
    }
  }

  sumatodo=sumatodo.toFixed(2);

  // if(sumatodo<=300) {
  //   sumatodo=300.00;
  // }
  $("#tot").val(sumatodo);
  // valact=parseFloat(valact)
  // var nval=sumatodo+valact;
  /*
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
  */
}

function calculam2_bobinas(id){

  var cantidad=$("#cantidadpz"+id).val();

  var ancho=$("#anchob"+id).val();
  var largo=$("#largob"+id).val();

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

  calculabob()
}
function calculabob(){
  var sumatodo=0;

  //bobinas
  var nid=$("#idbob").val();
  divtotal=nid.split(',');
  for (var i = 0; i < divtotal.length; i++) {
    if(divtotal[i]!=''){
      totalx=$("#precio_unitario"+divtotal[i]).val();
      totalx=parseFloat(totalx);
      sumatodo=sumatodo+totalx;
    }
  }
  //aplicaciones
  var nid=$("#idapp").val();
  divtotal=nid.split(',');
  for (var i = 0; i < divtotal.length; i++) {
    if(divtotal[i]!=''){
      totalx=$("#total_"+divtotal[i]).val();
      totalx=parseFloat(totalx);
      sumatodo=sumatodo+totalx;
    }
  }

  sumatodo=sumatodo.toFixed(2);

  // if (sumatodo<=300) {
  //   sumatodo=300.00;
  // }
  $("#tot").val(sumatodo);
  // valactual=$("#subtotalp").val();
  // sumatodo=sumatodo+valactual;
  /*
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
  */
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