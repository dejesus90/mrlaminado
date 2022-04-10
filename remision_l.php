<?php
session_start();
if(!$_SESSION['sistema'])
{
	header("location:Index.php");
	}
 ?>

<?php 
include ("conex.php");

$resz=mysqli_query($mysqli,"SELECT * FROM remision where tipo='R' group by id ORDER BY id DESC");
$rcount=mysqli_num_rows($resz);
// if($rcount==0)
// {
//   header("Location:menuprincipal.php");
// }
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
/*a:link {
	color: #42413C;
	text-decoration: underline; 
}
a:visited {
	color: #6E6C64;
	text-decoration: underline;
}
a:hover, a:active, a:focus { 
	text-decoration: none;
}*/

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
    <table width="200" border="0" align="center">
      <tr>
        <td colspan="2"><table width="324" border="0" align="center">
          <tr>
            <td width="300"><img src="Imagnes/Logomrlaminado2021.png" alt="" width="450" height="120" /></td>
          </tr>
        </table></td>
      </tr>
    </table>
  </div>
  <div class="content">
    <table width="455" border="0" align="right" cellspacing="0">
      <tr>
        <td width="22" height="33" bgcolor="#F4F4F4"><a href="Remisiones.php"><span style="float: right;"><i><img src="Imagnes/regresar.png" width="22" height="20" /></i></span></a></td>
        <td width="23" bgcolor="#F4F4F4">&nbsp;</td>
        <td width="95" valign="middle" bgcolor="#F4F4F4"><h5><a href="Remisiones.php"><span style="float: right;">Agregar<i><img src="Imagnes/agregar.png" width="19" height="19" /></i></span></a></h5></td>
        <td width="98" align="center" valign="middle" bgcolor="#F4F4F4"><h5><a href="buscar.php"><span style="float: right;">Buscar<i><img src="Imagnes/buscar.png" alt="" width="22" height="22" /></i></span></a></h5></td>
        <td width="70" align="center" valign="middle" bgcolor="#F4F4F4"><h5><a href="menuprincipal.php"><span style="float: right;">Menu<i><img src="Imagnes/casa.png" width="30" height="27" /></i></span></a></h5></td>
      </tr>
    </table>
    <!--tab-->
      <div>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Remisiones</a></li>
          <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Bobinas</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane active" id="home">
            <h3>Remisiones</h3>
            <table border="1"  cellspacing="1" class="table table-condensed table-bordered">
              <thead class="thead">
                <tr>
                  <td align="center">Fecha</td>
                  <td>Cantidad</td>
                  <td>Largo</td>
                  <td>Ancho</td>
                  <td>Hojas</td>
                  <td align="center">Costo</td>
                  <td align="center">Total</td>
                  <td>No.Remision</td>
                  <td>Tipo Remision</td>
                  <td>Editar</td>
                  <td>Eliminar</td>
                  <td>PDF</td>
                </tr>
              </thead>
              <tbody>
                <?php
                while ( $resz1=mysqli_fetch_array($resz)) {
                  // echo $resz1[0].'<br>';
                  $res=mysqli_query($mysqli,"SELECT * FROM remision WHERE id=$resz1[11] and tipo='R' limit 1 ");
                  $cont=0;
                  while ($res1=mysqli_fetch_array($res)){

                    ?>
                    <tr>
                      <td bgcolor="#DADADA" onclick='rep(<?php echo $res1[11];?>);'><?php echo $res1[1];?></td>
                      <td bgcolor="#DADADA" onclick='rep(<?php echo $res1[11];?>);'><?php echo $res1[4];?></td>
                      <td bgcolor="#DADADA" onclick='rep(<?php echo $res1[11];?>);'><?php echo $res1[5];?></td>
                      <td bgcolor="#DADADA" onclick='rep(<?php echo $res1[11];?>);'><?php echo $res1[6];?></td>
                      <td bgcolor="#DADADA" onclick='rep(<?php echo $res1[11];?>);'><?php echo $res1[7];?></td>
                      <td bgcolor="#DADADA" onclick='rep(<?php echo $res1[11];?>);'><?php echo $res1[8];?></td>
                      <td bgcolor="#DADADA" onclick='rep(<?php echo $res1[11];?>);'><?php echo $res1[2];?></td>
                      <td align="center" valign="middle" bgcolor="#DADADA" onclick='rep(<?php echo $res1[11];?>);'><?php echo $res1[11];?></td>
                      <td align="center" valign="middle" bgcolor="#DADADA">
                        <?php
                        if($res1['tipo']=='R'){
                          echo 'Remision';
                        }
                        else{
                          echo 'Bobina';
                        }
                        ?>
                      </td>
                      <td valign="left" bgcolor="#CCCCCC" >
                        <a data-toggle="modal" data-target="#myModal<?php echo $res1[11] ?>">
                          <center>
                            <h6><img src="Imagnes/edit.png" width="24" height="18" onclick=""></h6>
                          </center>
                        </a>
                        <div class="modal fade bs-example-modal-sm" id="myModal<?php echo $res1[11] ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Acceso</h4>
                              </div>
                              <div class="modal-body">
                                <h1>Contraseña</h1>
                                <input type="password" class="form-control" id="pass<?php echo $res1[11] ?>" autocomplete="off">
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-info" onclick="validar(<?php echo $res1[11] ?>)">Aceptar</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </td>
                      <td align="center" bgcolor="#CCCCCC" style="cursor: pointer;">
                        
                        <a data-toggle="modal" data-target="#myModal_del<?php echo $res1[11] ?>">
                          <center>
                            <h6><span class="glyphicon glyphicon-remove" style="color: #f00"></span></h6>
                          </center>
                        </a>

                        <div class="modal fade bs-example-modal-sm" id="myModal_del<?php echo $res1[11] ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title pull-left" >Acceso</h4>
                              </div>
                              <div class="modal-body">
                                <h3 style="text-align: left;">Escribe la contraseña </h3>
                                <input type="password" class="form-control" id="pass_del<?php echo $res1[11] ?>" autocomplete="off">
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-info" onclick="eliminar_x(<?php echo $res1[11] ?>)">Aceptar</button>
                                <button type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </td>
                      <td valign="left" bgcolor="#CCCCCC">
                        <a href= "reporte.php?id=<?php echo $res1[11];?>" target="_blank">Pdf</a>
                      </td>
                    </tr>
                    <?php
                    $cont++;
                  }
                } ?>
              </tbody>
            </table>
          </div>
          <div role="tabpanel" class="tab-pane" id="profile">
            <h3>Bobinas</h3>
            <?php
            $resz2=mysqli_query($mysqli,"SELECT * FROM remision where tipo='B' group by id ORDER BY id DESC");
        
            ?>

            <table border="1"  cellspacing="1" class="table table-condensed table-bordered">
              <thead class="thead">
                <tr>
                  <td align="center">Fecha</td>
                  <td>Cantidad</td>
                  <td>Largo</td>
                  <td>Ancho</td>
                  <td>Hojas</td>
                  <td align="center">Costo</td>
                  <td align="center">Total</td>
                  <td>No.Remision</td>
                  <td>Tipo Remision</td>
                  <td>Editar</td>
                  <td>Eliminar</td>
                  <td>PDF</td>
                </tr>
              </thead>
              <tbody>
                <?php
                while ( $resz1=mysqli_fetch_array($resz2)) {
                  $res=mysqli_query($mysqli,"SELECT * FROM remision WHERE id=$resz1[11]  and tipo='B' limit 1");
                  $cont=0;
                  $count=mysqli_query($mysqli,"SELECT COUNT(*) FROM remision where id=$resz1[11] ");
                  $res_count=mysqli_fetch_array($count);

                  while ($res1=mysqli_fetch_array($res)){
                    ?>
                    <tr>
                      <td bgcolor="#DADADA" onclick='rep(<?php echo $res1[11];?>);'><?php echo $res1[1];?></td>
                      <td bgcolor="#DADADA" onclick='rep(<?php echo $res1[11];?>);'><?php echo $res_count[0];?></td>
                      <td bgcolor="#DADADA" onclick='rep(<?php echo $res1[11];?>);'><?php echo $res1[5];?></td>
                      <td bgcolor="#DADADA" onclick='rep(<?php echo $res1[11];?>);'><?php echo $res1[6];?></td>
                      <td bgcolor="#DADADA" onclick='rep(<?php echo $res1[11];?>);'><?php echo $res1[7];?></td>
                      <td bgcolor="#DADADA" onclick='rep(<?php echo $res1[11];?>);'><?php echo $res1[8];?></td>
                      <td bgcolor="#DADADA" onclick='rep(<?php echo $res1[11];?>);'><?php echo $res1[2];?></td>
                      <td align="center" valign="middle" bgcolor="#DADADA" onclick='rep(<?php echo $res1[11];?>);'><?php echo $res1[11];?></td>
                      <td align="center" valign="middle" bgcolor="#DADADA">
                        <?php
                        if($res1['tipo']=='R'){
                          echo 'Remision';
                        }
                        else{
                          echo 'Bobina';
                        }
                        ?>
                      </td>
                      <td valign="left" bgcolor="#CCCCCC" >
                        <a data-toggle="modal" data-target="#myModal<?php echo $res1[11] ?>">
                          <center>
                            <h6><img src="Imagnes/edit.png" width="24" height="18" onclick=""></h6>
                          </center>
                        </a>
                        <div class="modal fade bs-example-modal-sm" id="myModal<?php echo $res1[11] ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Acceso</h4>
                              </div>
                              <div class="modal-body">
                                <h1>Contraseña</h1>
                                <input type="password" class="form-control" id="pass<?php echo $res1[11] ?>" autocomplete="off">
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-info" onclick="validar2(<?php echo $res1[11] ?>)">Aceptar</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </td>
                      <td align="center" bgcolor="#CCCCCC" style="cursor: pointer;">
                        
                        <a data-toggle="modal" data-target="#myModal_del<?php echo $res1[11] ?>">
                          <center>
                            <h6><span class="glyphicon glyphicon-remove" style="color: #f00"></span></h6>
                          </center>
                        </a>

                        <div class="modal fade bs-example-modal-sm" id="myModal_del<?php echo $res1[11] ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title pull-left" >Acceso</h4>
                              </div>
                              <div class="modal-body">
                                <h3 style="text-align: left;">Escribe la contraseña </h3>
                                <input type="password" class="form-control" id="pass_del<?php echo $res1[11] ?>" autocomplete="off">
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-info" onclick="eliminar_x(<?php echo $res1[11] ?>)">Aceptar</button>
                                <button type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </td>
                      <td valign="left" bgcolor="#CCCCCC">
                        <a href= "reportebobina_pdf.php?id=<?php echo $res1[11];?>" target="_blank">Pdf</a>
                      </td>
                    </tr>
                    <?php
                    $cont++;
                  }
                } ?>
              </tbody>
            </table>
          </div>
        </div>

      </div>
    <!--end tab-->


   <center> 
    
    
    
  <!-- end .content --></div>
  <div class="footer">
   <center> <p>Mr laminado</p></center>
    <!-- end .footer --></div>
  <!-- end .container --></div>
</body>
<script >
function validar(id){
  var ingresado=$("#pass"+id).val().trim();
  if(ingresado=='1'){
    window.location='rem_ac.php?id='+id;
  }
  else{
    alert("Contraseña Incorrecta");
  }
}
function validar2(id){ 
  var ingresado=$("#pass"+id).val().trim();
  if(ingresado=='1'){
    window.location='rem_acbobinas.php?id='+id;
  }
  else{
    alert("Contraseña Incorrecta");
  }
}
function eliminar_x(id){
  var pass=$("#pass_del"+id).val();
  if(pass=='1'){

    datos=new FormData();
    datos.append('id',id);
    

    $.ajax({
      url: "eliminaremision.php", //Url a donde la enviaremos
      type:'POST', //Metodo que usaremos
      contentType:false, //Debe estar en false para que pase el objeto sin procesar
      data:datos, //Le pasamos el objeto que creamos con los archivos
      processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
      cache:false //Para que el formulario no guarde cache

    }).done(function(echo){//Escuchamos la respuesta y capturamos el mensaje msg
      location.reload();
      //$("#addpago"+id).html(echo);
    });
  }
  else{
    alert("Contraseña Incorrecta");
  }
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
