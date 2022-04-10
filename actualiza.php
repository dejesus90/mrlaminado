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
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<script type="text/javascript" src="jquery-3.2.1.min.js"></script>
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
	width: 960px;
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
tr td table tr td font {
	color: #FFF;
	font-weight: bold;
}
-->
</style></head>

<body>
<?php 
include ("conex.php");
$datos=mysqli_query($mysqli,"SELECT * FROM cliente WHERE id_cliente='$_GET[rfc]'");
$datos1=mysqli_fetch_array($datos);
?>
<div class="container">
  <div class="header"><!-- end .header -->
    <table class="table table-bordered table-condensed">
      <tr>
        <td colspan="2"><table width="324" border="0" align="center">
          <tr>
            
            <td width="73"><img src="Imagnes/Logomrlaminado2021.png" alt="" width="500" height="120" /></td>
          </tr>
        </table></td>
      </tr>
    </table>
  </div>
  <div class="content">
   <center> 
     <h3>Actualizar</h3>
   </center>
   <form id="form1" class="form-horizontal" name="clientes" method="post" action="update.php">
    <div class="form-group">
      <label for="inputEmail3" class="col-sm-2 control-label">Razon Social</label>
      <div class="col-sm-10">
        <input name="Razon_Social" type="text" class="form-control" id="Razon Social2" size="15" value="<?php echo $datos1['razon_social']; ?>" />
      </div>
    </div>

    <div class="form-group">
      <label for="inputEmail3" class="col-sm-2 control-label">R.F.C</label>
      <div class="col-sm-10">
        <input name="RFC"  class="form-control" type="text" id="RFC" size="15"   value="<?php echo $datos1['rfc']; ?>"/>
        <input name="RFCid" class="form-control" type="hidden" id="RFCid" size="15"   value="<?php echo $_GET['rfc']; ?>"/>
      </div>
    </div>

    <div class="form-group">
      <label for="inputEmail3" class="col-sm-2 control-label">Estado</label>
      <div class="col-sm-10">
        <input name="Estado" class="form-control" type="text" id="Estado" size="15"  value="<?php echo $datos1['estado']; ?>"/>
      </div>
    </div>

    <div class="form-group">
      <label for="inputEmail3" class="col-sm-2 control-label">Delegacion</label>
      <div class="col-sm-10">
        <input name="Delegacion" class="form-control" type="text" id="Delegacion" size="15"  value="<?php echo $datos1['delegacion']; ?>"/>
      </div>
    </div>

    <div class="form-group">
      <label for="inputEmail3" class="col-sm-2 control-label">Colonia</label>
      <div class="col-sm-10">
        <input name="Col" class="form-control" type="text" id="Col" size="15" value="<?php echo $datos1['colonia']; ?>"/>
      </div>
    </div>

    <div class="form-group">
      <label for="inputEmail3" class="col-sm-2 control-label">Calle</label>
      <div class="col-sm-10">
        <input name="Calle" class="form-control" type="text" id="Calle" size="15" value="<?php echo $datos1['calle']; ?>"/>
      </div>
    </div>

    <div class="form-group">
      <label for="inputEmail3" class="col-sm-2 control-label">Numero</label>
      <div class="col-sm-10">
        <input name="Numero" type="text" class="form-control" id="Numero" size="15" value="<?php echo $datos1['numero']; ?>"/>
      </div>
    </div>

    <div class="form-group">
      <label for="inputEmail3" class="col-sm-2 control-label">C.P</label>
      <div class="col-sm-10">
        <input name="Codigo_Postal" class="form-control" type="number" id="Codigo Postal" size="15" value="<?php echo $datos1['codigo_postal']; ?>"/>
      </div>
    </div>

    <div class="form-group">
      <label for="inputEmail3" class="col-sm-2 control-label">Telefono</label>
      <div class="col-sm-10">
        <input name="Telefono" class="form-control" type="number" id="Telefono" size="15" value="<?php echo $datos1['telefono']; ?>"/>
      </div>
    </div>

    <div class="form-group">
      <label for="inputEmail3" class="col-sm-2 control-label">Correo</label>
      <div class="col-sm-10">
        <input name="Correo" type="email" id="Correo" class="form-control" value="<?php echo $datos1['email']; ?>"/>
      </div>
    </div>

    <div class="form-group">
      <label for="inputEmail3" class="col-sm-2 control-label">Contacto</label>
      <div class="col-sm-10">
        <input name="Contacto" type="text" id="Contacto" class="form-control" size="15" value="<?php echo $datos1['contacto']; ?>"/>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-8 col-sm-4">
        <button type="submit" class="btn btn-success">Guardar</button>
        <a class="btn btn-danger" href="clientes.php" role="button">Cancelar</a>
      </div>
    </div>
   </form>
    <p>&nbsp;</p>
   
    <h4>&nbsp;</h4>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
  <!-- end .content --></div>
  <div class="footer">
   <center> <p>Mr.Laminado</p></center>
    <!-- end .footer --></div>
  <!-- end .container --></div>
</body>

<script type="text/javascript" src="js/bootstrap.js"></script>
</html>