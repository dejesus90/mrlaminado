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
	width: 1300px;
	background-color: #FFF; /* el valor automático de los lados, unido a la anchura, centra el diseño */
	margin-top: 0;
	margin-right: auto;
	margin-bottom: 0;
	margin-left: auto;
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
.container .header table tr td table tr td font {
	color: #FFF;
	font-weight: bold;
}
-->
</style>
<script>

</script>
</head>

<body>

<div class="container">
  <div class="header"><!-- end .header -->
    <table width="200" border="0" align="center">
      <tr>
        <td colspan="2"><table width="324" border="0" align="center">
          <tr>
            
            <td width="73"><img src="Imagnes/mrlaminado blanco.png" alt="" width="500" height="80" /></td>
          </tr>
        </table></td>
      </tr>
    </table>
  </div>
  <div class="content">
    <center>
    <table width="284" border="0" align="right">
       <tr>
         <td width="55"><a href="clientes.php"><span style="float: right;"><i><img src="Imagnes/regresar.png" width="30" height="30" /></i></span></a></td>
         <td width="109"><a href="Alta Clientes.php"><span style="float: right;">Nuevo<i><img src="Imagnes/netvibes_256.png" width="30" height="30" /></i></span></a></td>
         <td width="106"><a href="menuprincipal.php"><span style="float: right;">Menu<i><img src="Imagnes/menu.jpg" width="30" height="30" /></i></span></a></td>
       </tr>
     </table>
    <center>
      <h2> Detalle Cliente</h2></center>
     <p>&nbsp;</p>
     <table align="center">
       <thead class="thead">
     <th>Razon Social</th>
     <th>RFC</th>
     <th>Estado</th>
     <th> Municipio</th>
     <th>Colonia</th>
     <th>Calle</th>
          <th>Numero</th>
               <th>CP</th>
                    <th>Contacto</th>
                         <th>Telefono</th>
                              <th>Email</th>
                              <th>Status</th>


   </thead>
   <tbody>
    <?php 
include ("conex.php");

$res=mysqli_query($mysqli,"SELECT * FROM cliente where id_cliente='$_GET[dato]'");
//echo "SELECT razon_social,rfc,contacto,email,estatus FROM cliente";
while ($res1=mysqli_fetch_array($res)) 
{?>
<tr ><td><?php echo "$res1[1]</td><td>$res1[2]</td><td>$res1[8]</td><td>$res1[7]</td><td>$res1[6]</td><td>$res1[3]</td><td>$res1[4]</td><td>$res1[5]</td><td>$res1[10]</td><td>$res1[9]</td><td>$res1[11]</td><td>";if($res1[12]=="activo"){echo "<span style='color:green;'>$res1[12]</span>";}
else
{echo "<span style='color:red;'>$res1[12]</span>";}
}
    ?>
    </tbody>
</table>
    <a href="Alta Clientes.php"></a> 
    </center>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
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