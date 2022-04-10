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
<title>Mrlaminado</title>

<script type="text/javascript" src="jquery-3.2.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<script type="text/javascript" src="js/bootstrap.js"></script>

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
  /*width: 960px;*/
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
.container .header table tr td table tr td font {
	font-weight: bold;
	color: #FFF;
}
-->
</style></head>

<body>

<div class="container">
  <div class="header"><!-- end .header -->
    <table width="200" border="0" align="center">
      <tr>
        <td colspan="2"><table width="324" border="0" align="center">
          <tr>
            
            <td width="300"><img src="Imagnes/Logomrlaminado2021.png" alt="" width="500" height="120" /></td>
          </tr>
        </table></td>
      </tr>
    </table>
  </div>
  <div class="content">
   <center> 
     <table width="624" border="0">
       <tr>
         <td width="300" height="14" bgcolor="#FFFFFF"><h4><center>
           <p>Agregar Articulos</p>
           </center>
         </h4></td>
        </tr>
     </table>
     <table class="table table-condensed table-bordered">
       <tr>
         <td width="193"><h5><a href="articulosl.php"><span style="float:right;">Ver Registros<i><img src="Imagnes/ver.png" alt="" width="22" height="22"="20" /></i></span></a></h5></td>
         <td width="95"><h5><a href="menuprincipal.php"><span style="float: right;">Menu<i><img src="Imagnes/casa.png" alt="" width="29" height="23" /></i></span></a></h5></td>
         <td width="90"><h5><a href="index.php"><span style="float:right;">Salir<i><img src="Imagnes/exit.png" alt="" width="27" height="23"="20" /></i></span></a></h5></td>
       </tr>
     </table>
   </center>
  <form id="form1" name="clientes" method="post" action="art.php" autocomplete="off">
    <table class="table table-condensed table-bordered">
      <tr>
        <td align="right"><b>Tipo Articulo</b></td>
        <td>
          <select class="form-control" name="tipo" id="tipo">
            <option value="A">Aplicacion</option>
            <option value="B">Bobina</option>
          </select>
        </td>
      </tr>
      <tr>
        <td align="right"><b>Nombre Articulo</b></td>
        <td><input type="text" class="form-control" name="nombre"></td>
      </tr>
      <tr id="ancho_b" style="display: none;">
        <td align="right"><b>Ancho</b></td>
        <td><input type="text" class="form-control" name="ancho" placeholder="100/200/300/400/500"></td>
      </tr>
      <tr id="largo_b" style="display: none;">
        <td align="right"><b>Largo</b></td>
        <td><input type="text" class="form-control" name="largo" placeholder="3000/4000/5000"></td>
      </tr>
      <tr id="precio_b" style="display: none;">
        <td align="right"><b>Precio</b></td>
        <td><input type="text" class="form-control" name="preciobob" placeholder="200" value="0.00"></td>
      </tr>
      <tr>
        <td align="right"><b>Descripcion</b></td>
        <td>
          <textarea class="form-control" rows="3" name="descripcion"></textarea>
        </td>
      </tr>
      <tr>
        <td colspan="2" align="right"><input type="submit" class="btn btn-success" name="Enviar"></td>
      </tr>
    </table>
  </form>
  </div>
  <div class="footer">
   <center> <p>Mr laminado</p></center>
    <!-- end .footer --></div>
  <!-- end .container --></div>
</body>
<script>
  $(document).ready(function(){
    $( "#tipo" ).change(function() {
      var tipo=$(this).val();

      if(tipo=='A'){
        $("#ancho_b").hide();
        $("#largo_b").hide();
        $("#precio_b").hide();
      }
      else{
        $("#ancho_b").show();
        $("#largo_b").show();
        $("#precio_b").show();
      }
    });
  })
</script>
</html>