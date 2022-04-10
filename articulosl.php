<?php
session_start();
if(!$_SESSION['sistema'])
{
	header("location:Index.php");
	}
 ?>



<?php 
include ("conex.php");

$res=mysqli_query($mysqli,"SELECT * FROM articulos");
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

<script type="text/javascript" src="jquery-3.2.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<script type="text/javascript" src="js/bootstrap.js"></script>

<title>Mr.Laminado</title>
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
	/*width: 1150px;*/
	background-color: #FFF;
	margin: 0 auto; /* el valor automático de los lados, unido a la anchura, centra el diseño */
}

/* ~~ no se asigna una anchura al encabezado. Se extenderá por toda la anchura del diseño. Contiene un marcador de posición de imagen que debe sustituirse por su propio logotipo vinculado ~~ */
.header {
	background-color: #45a1e5;
	color: #FFF;
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
        <td width="300"><img src="Imagnes/Logomrlaminado2021.png" alt="" width="500" height="125" /></td>
      </tr>
    </table>
  </div>
  <div class="content">
 
   <center> 
     <h2>Articulos</h2>
     <table class="table table-bordered table-condensed">
       <tr>
         <td width="285"><a href="articulos.php"><span style="float: right;"><i><img src="Imagnes/regresar.png" width="23" height="18" /></i></span></a></td>
         <td width="109"><h5><a href="articulos.php"><span style="float: right;">Nuevo<i><img src="Imagnes/agregar.png" width="20" height="19" /></i></span></a></h5></td>
         <td width="92" align="center" valign="middle"><h5><a href="menuprincipal.php"><span style="float: right;">Menu<i><img src="Imagnes/casa.png" width="25" height="19" /></i></span></a></h5></td>
       </tr>
     </table><hr class="colorgraph" /></p>
      <table class="table table-bordered table-condensed">
        <thead class="thead">
        <th>ID</th>
        <th>Articulo</th>
        <th>Descripcion</th>
        <th>Precio</th>
        <th>Tipo</th>
        <th>Ancho</th>
        <th>Largo</th>
        <th>Accion</th>
      </thead>
      <tbody>
      <?php
      while ($res1=mysqli_fetch_array($res))
      {
        
        ?>
        <tr>
          <td><?php echo $res1[0]; ?></td>
          <td><?php echo $res1[1]; ?></td>
          <td><?php echo $res1[2]; ?></td>
          <td><?php echo $res1[6]; ?> </td>
          <td><?php if($res1['tipo']=='A'){ echo 'Aplicacion'; }else{ echo 'Bobina'; } ?></td>
          <td><?php echo $res1['ancho']; ?></td>
          <td><?php echo $res1['largo']; ?></td>
          <td align="center" style="font-size: 18px" >
            <?php
            if($res1['tipo']=='A'){
              ?>
              <i class="glyphicon glyphicon-pencil" data-toggle="modal" data-target="#modalapp<?php echo $res1[0]; ?>" style="color:#668ae0"></i>
              <?php
            }
            if($res1['tipo']=='B'){
              ?>
              <i class="glyphicon glyphicon-pencil" data-toggle="modal" data-target="#modalbob<?php echo $res1[0]; ?>" style="color:#668ae0"></i>
              <?php
            }
            ?>
            
            <?php
            if($res1['tipo']=='A'){
              ?>
              <!-- modal editar app  -->
              <div class="modal fade bs-example-modal-sm" id="modalapp<?php echo $res1[0]; ?>"  tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h3 class="modal-title" id="myModalLabel">Editar Articulo Aplicacion</h3>
                    </div>
                    <div class="modal-body">
                      <form class="form-horizontal">
                        <div class="form-group">
                          <label for="inputEmail3" class="col-sm-3 control-label" style="font-size: 12px;">Nombre del articulo</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="Nombrea<?php echo $res1[0] ?>" placeholder="Nombre articulo" value="<?php echo $res1['nombre'] ?>">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="inputPassword3" class="col-sm-3 control-label" style="font-size: 12px;">Descripcion</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="descrpcionap<?php echo $res1[0] ?>" placeholder="Descripcion" value="<?php echo $res1['descripcion'] ?>">
                          </div>
                        </div>
                      </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" name="Guardar" class="btn btn-info app" id="<?php echo $res1[0] ?>" >Aceptar</button>
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>
                  </div>
                </div>
              </div>
              <?php
            }
            if($res1['tipo']=='B'){
              ?>
              <!-- modal editar app  -->
              <div class="modal fade bs-example-modal-sm" id="modalbob<?php echo $res1[0]; ?>"  tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h3 class="modal-title" id="myModalLabel">Editar Articulo Bobinas</h3>
                    </div>
                    <div class="modal-body">
                      <form class="form-horizontal">
                        <div class="form-group">
                          <label for="inputEmail3" class="col-sm-3 control-label" style="font-size: 12px;">Nombre del articulo</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="Nombreb<?php echo $res1[0] ?>" placeholder="Nombre articulo" value="<?php echo $res1['nombre'] ?>">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="inputEmail3" class="col-sm-3 control-label" style="font-size: 12px;">Ancho</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="ancho<?php echo $res1[0] ?>" placeholder="Nombre articulo" value="<?php echo $res1['ancho'] ?>">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="inputEmail3" class="col-sm-3 control-label" style="font-size: 12px;">Largo</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="largo<?php echo $res1[0] ?>" placeholder="Nombre articulo" value="<?php echo $res1['largo'] ?>">
                          </div>
                        </div>
                         <div class="form-group">
                          <label for="inputEmail3" class="col-sm-3 control-label" style="font-size: 12px;">Precio</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="preciobob<?php echo $res1[0] ?>" placeholder="Nombre articulo" value="<?php echo $res1['precio'] ?>">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="inputPassword3" class="col-sm-3 control-label" style="font-size: 12px;">Descripcion</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="descrpcionb<?php echo $res1[0] ?>" placeholder="Descripcion" value="<?php echo $res1['descripcion'] ?>">
                          </div>
                        </div>
                      </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" name="Guardar" class="btn btn-info bobinasave" id="<?php echo $res1[0] ?>">Aceptar</button>
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>
                  </div>
                </div>
              </div>
              <?php
            }
            ?>

            <i class="glyphicon glyphicon-trash" style="margin-left: 10px; color: #F00;"></i>
          </td>
        </tr>
        <?php
      }
      ?>
      </tbody>
    </table>
    
    </center>
    

  <!-- end .content -->
  </div>
  <div class="footer">
   <center> <p>Mr laminado</p></center>
    <!-- end .footer --></div>
  <!-- end .container --></div>
</body>
<script>
  $(document).ready(function(){
    $(".app").click(function(){
      console.log($(this).attr('id'));
      var id=$(this).attr('id');
      var nombre=$("#Nombrea"+id).val().trim();
      var desc=$("#descrpcionap"+id).val().trim();

      datos=new FormData();

      datos.append('id',id);
      datos.append('nombre',nombre);
      datos.append('desc',desc);

      $.ajax({
        url: "editarapp.php", //Url a donde la enviaremos
        type:'POST', //Metodo que usaremos
        contentType:false, //Debe estar en false para que pase el objeto sin procesar
        data:datos, //Le pasamos el objeto que creamos con los archivos
        processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
        cache:false //Para que el formulario no guarde cache
      }).done(function(echo){//Escuchamos la respuesta y capturamos el mensaje msg
        //$("#alertdel").show();
        location.reload();
      });
    });
    //bobinas
    $(".bobinasave").click(function(){

      console.log($(this).attr('id'));

      var id=$(this).attr('id');
      var nombre=$("#Nombreb"+id).val().trim();
      var ancho=$("#ancho"+id).val().trim();
      var largo=$("#largo"+id).val().trim();
      var precio=$("#preciobob"+id).val().trim();
      var desc=$("#descrpcionb"+id).val().trim();
      //console.log(id+'_'+nombre+'_'+ancho+'_'+largo+'_'+precio+'_'+desc);

      
      datos=new FormData();

      datos.append('id',id);
      datos.append('nombre',nombre);
      datos.append('ancho',ancho);
      datos.append('largo',largo);
      datos.append('precio',precio);
      datos.append('desc',desc);

      $.ajax({
        url: "editarbobina.php", //Url a donde la enviaremos
        type:'POST', //Metodo que usaremos
        contentType:false, //Debe estar en false para que pase el objeto sin procesar
        data:datos, //Le pasamos el objeto que creamos con los archivos
        processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
        cache:false //Para que el formulario no guarde cache
      }).done(function(echo){//Escuchamos la respuesta y capturamos el mensaje msg
        //$("#alertdel").show();
        location.reload();
      });
      
    });

  });
</script>
</html>