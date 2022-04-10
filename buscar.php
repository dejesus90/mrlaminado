
<?php
session_start();
if(!$_SESSION['sistema'])
{
	header("location:Index.php");
	}
 ?>

<?php
include("conex.php");
error_reporting(0);

if(isset($_REQUEST['busca'])&& isset($_REQUEST['option'])){
	$buscar=$_REQUEST['busca'];
	$campo=$_REQUEST['option'];
	$consulta="WHERE $campo LIKE'%$buscar%'";
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="jquery-3.2.1.min.js"></script>
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
	color: #FFF;
	font-weight: bold;
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
	width: 1150px;
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
.thead
{
  background-color: #000;
  color: #fff;
  border-color: #ff0;
}
.container .header table tr td {
	color: #FFF;
	font-weight: bold;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
-->
</style>

</head>

<body>

<div class="container">
  <div class="header"><!-- end .header -->
    <table width="324" border="0" align="center">
      <tr>
        <td width="241" height="55" align="center"><font size="6">MR.Laminado</font></td>
        <td width="73"><img src="Imagnes/monito.jpg" width="73" height="49" /></td>
      </tr>
    </table>
  </div>
  <div class="content">
   <center> 
    <h3>&nbsp;</h3>
    <table width="300" border="0" align="right">
      <tr>
        <th width="85" scope="col"><a href="Remisiones.php"><i><img src="Imagnes/regresar.png" alt="" width="22" height="20" /></i></a></th>
        <th width="105" scope="col"><h5><a href="Remisiones.php"><span style="float: right;">Agregar<i><img src="Imagnes/agregar.png" alt="" width="19" height="19" /></i></span></a></h5></th>
        <th width="96" scope="col"><h5><a href="menuprincipal.php"><span style="float: right;">Menu<i><img src="Imagnes/casa.png" alt="" width="30" height="27" /></i></span></a></h5></th>
      </tr>
    </table>
    <table width="379" border="0">
      <tr>
        <th colspan="2" scope="col">Busqueda </th>
        <th width="110" scope="col">&nbsp;</th>
      </tr>
      <tr>
        <td width="110"><select name="option">
          <option value="">BUSCAR POR</option>
          <option value="id">ID</option>
          <option value="cliente">Cliente</option>
          <option value="fecha">Fecha</option>
          <option value="articulo">Cantidad</option>
          <option value="largo">Largo</option>
          <option value="ancho">Ancho</option>
          <option value="hojas">Hojas</option>
          <option value="costo">Costo</option>
          <option value="total">Total</option>
          <option value="id">No.Remision</option>
        </select></td>
        <td width="145"><input name="input" type="text" id="buscar"/></td>
        <td><form id="form1" name="form1" method="post" action="">
          <input type="submit" name="button" id="button" value="Buscar" />
        </form></td>
      </tr>
    </table>
    <form action="reporte.php" method="POST">
      <table border="0" cellspacing="1">
        <thead class="thead">
   <td>ID</td>
   <td>Cliente</td>
     <td align="center">Fecha</td>
     <td>Articulo</td>
     <td>Cantidad</td>
     <td>Largo</td>
     <td>Ancho</td>
     <td>Hojas</td>
     <th align="center">Costo</th>
     <td align="center">Total</td>
     <td>No.Remision</td>
     <td>Editar</td>
   </thead>
   <tbody> 
	<?php
	$busca="";
$busca=$_POST['busca'];
   $buscar=mysqli_query($mysqli,"SELECT * FROM remision WHERE id=$resz1[0] limit 1");
while ($res1=mysqli_fetch_array($res)) 
{
 ?><tr><td bgcolor="#DADADA" onclick='rep(<?php echo $res1[11];?>);'><?php echo $res1[0];?></td><td bgcolor="#DADADA" onclick='rep(<?php echo $res1[11];?>);'><?php echo $res1[9];?></td><td bgcolor="#DADADA" onclick='rep(<?php echo $res1[11];?>);'><?php echo $res1[1];?></td><td bgcolor="#DADADA" onclick='rep(<?php echo $res1[11];?>);'><?php echo $res1[3];?></td><td bgcolor="#DADADA" onclick='rep(<?php echo $res1[11];?>);'><?php echo $res1[4];?></td><td bgcolor="#DADADA" onclick='rep(<?php echo $res1[11];?>);'><?php echo $res1[5];?></td><td bgcolor="#DADADA" onclick='rep(<?php echo $res1[11];?>);'><?php echo $res1[6];?></td><td bgcolor="#DADADA" onclick='rep(<?php echo $res1[11];?>);'><?php echo $res1[7];?></td><td bgcolor="#DADADA" onclick='rep(<?php echo $res1[11];?>);'><?php echo $res1[8];?></td><td bgcolor="#DADADA" onclick='rep(<?php echo $res1[11];?>);'><?php echo $res1[2];?></td><td align="center" valign="middle" bgcolor="#DADADA" onclick='rep(<?php echo $res1[11];?>);'><?php echo $res1[11];?>
      </td><td valign="left" bgcolor="#CCCCCC"><a href="rem_ac.php?id=<?php echo $res1[11]; ?>"><center>
        <h6><img src="Imagnes/edit.png" width="24" height="18" onclick=""></h6>
      </center></a></td></tr>
  <?php
  $cont++;
}


    ?>
    
    </tbody>
    
</table>
   <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p><img src="Imagenes/edit-icon-png-24.png">
  </form>
  <!-- end .content --></div>
  <div class="footer">
   <center> <p>Mr lam</p></center>
    <!-- end .footer --></div>
  <!-- end .container --></div>
</body>
<script type="text/javascript">

function rep(v)
{
location.href="reporte.php?id="+v;
}
/*
  $("input[type=checkbox]").on("click",function(){ 
var valor=$(this).val();
var check=$(this).prop("checked");
var oculto=$("#id").val();
dividir=oculto.split(',');
if(check==true)
{
  var val=document.getElementById('id');
  val.value+=valor+",";
}
else
{
  for(i=0;i<dividir.length;i++)
  {
    if(dividir[i]==valor)
    {
      dividir[i]='';
    }
  }
  var nvalor="";
  for(x=0;x<dividir.length;x++)
  {
    if (dividir[x]!="") 
    {
      nvalor=nvalor+dividir[x]+',';
    }
  }
  $("#id").val(nvalor);
}


  });*/

</script>
</html>
