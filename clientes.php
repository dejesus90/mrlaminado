<?php
session_start();
if(!$_SESSION['sistema'])
{
	header("location:Index.php");
	}
 ?>





<?php 
include ("conex.php");

$res=mysqli_query($mysqli,"SELECT razon_social,rfc,contacto,email,id_cliente FROM cliente ORDER BY razon_social");
$rcount=mysqli_num_rows($res);
if($rcount==0)
{
header("Location:Index.php");
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
.container .header table tr td font {
	color: #FFF;
	font-weight: bold;
}
-->
</style>
<script>
function redi(valor)
{
 // alert(valor);
location.href="cliente_det.php?dato="+valor;
}
function elimina(rfc1)
{
  var r = confirm("Estas seguro que deseas eliminar");
if (r == true) {
     location.href="elimina.php?rfc1="+rfc1;
} else {
   return 0;
}
}
function act(rfc)
{
 location.href="actualiza.php?rfc="+rfc;
}

</script>
</head>

<body>

<div class="container">
  <div class="header"><!-- end .header -->
    <table width="324" border="0" align="center">
      <tr>
        <td width="300"><img src="Imagnes/Logomrlaminado2021.png" alt="" width="500" height="130" /></td>
      </tr>
    </table>
  </div>
  <div class="content">
 
   <center> 
     <h2>Clientes</h2>
     <table width="300" height="37" border="0" align="right">
       <tr>
         <td width="82" height="33"><a href="Alta Clientes.php"><span style="float: right;"><i><img src="Imagnes/regresar.png" width="27" height="21" /></i></span></a></td>
         <td width="105"><h5><a href="Alta Clientes.php"><span style="float: right;">Agregar<i><img src="Imagnes/agregar.png" width="20" height="20" /></i></span></a></h5></td>
         <td width="99"><h5><a href="menuprincipal.php"><span style="float: right;">Menu<i><img src="Imagnes/casa.png" width="33" height="20" /></i></span></a></h5></td>
       </tr>
     </table>
     <h2>&nbsp;</h2>
   <table border="0">
   <thead class="thead">
     <th>Cliente</th>
     <th>RFC</th>
     <th>Contacto</th>
     <th>Email</th>
     <th>Actualizar</th>

   </thead>
   <tbody>
    <?php 


//echo "SELECT razon_social,rfc,contacto,email,estatus FROM cliente";
while ($res1=mysqli_fetch_array($res)) 
{?>
<tr><td  onclick="redi('<?php echo "$res1[4]</td>";?></td><td onclick="redi('<?php echo $res1['id_cliente'];?>');"><?php echo "$res1[0]</td>";?><td onclick="redi('<?php echo $res1['id_cliente'];?>');"><?php echo "$res1[1]</td>";?><td onclick="redi('<?php echo $res1['id_cliente'];?>');"> <?php echo "$res1[2]</td>";?><td onclick="redi('<?php echo $res1['id_cliente'];?>');"><?php echo "$res1[3]</td>";?> 
<?php
echo "<td><center>";?><img src='Imagnes/edit.png' width='28' height='22' onclick="act('<?php echo $res1['id_cliente'];?>');"><img src='Imagnes/close_delete-128.png' width='20' height='20' onclick="elimina('<?php echo $res1[1];?>');">

<?php echo"</center></td></tr>";
}

    ?>
    </tbody>
    </table>
    
    </center>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
  <!-- end .content --></div>
  <div class="footer">
   <center> <p>Mr laminado</p></center>
    <!-- end .footer --></div>
  <!-- end .container --></div>
</body>
</html>