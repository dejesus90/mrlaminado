<?php 
$n=$_GET['n'];
?>
<table id="tb1" class="table table-condensed table-bordered" style="margin-bottom: 0">
  <tr>
    <td >
      <select name="articulo<?php echo $n;?>" class="form-control input-sm" id="art_<?php echo $n ?>">
        <option value="0">--Selecciona--</option>
        <?php
        include ("conex.php");
        $datos=mysqli_query($mysqli,"SELECT id_articulo,descripcion,minimo FROM articulos");
        while($datos1=mysqli_fetch_array($datos))
        {
          ?>
          <option value="<?php echo $datos1[0];?>" tipo="<?php echo $datos1[2];?>"> 
          <?php echo $datos1[1];?>
          </option>
          <?php
        }
        ?>
      </select>
    </td>
    <td >
      <select  name="um<?php echo $n; ?>" class="form-control input-sm" id="um<?php echo $n; ?>" onchange="calculam2(<?php echo $n;?>);">
        <option value="1">Frente</option>
        <option value="2">Frente y Vuelta</option>
        <option value="3">Vuelta</option>
      </select>
    </td>
    <td >
      <input type="text" name="largo<?php echo $n;?>" id="largo<?php echo $n;?>" class="form-control input-sm td" onkeyup="calculam2(<?php echo $n;?>)" value="0"/>
    </td>
    <td >
      <input type="text" name="ancho<?php echo $n;?>" id="ancho<?php echo $n;?>" class="form-control input-sm td" onkeyup="calculam2(<?php echo $n;?>)" value="0"/>
    </td>
    <td >
      <input type="hojas" name="hojas<?php echo $n;?>" id="hojas<?php echo $n;?>" class="form-control input-sm td" onkeyup="calculam2(<?php echo $n;?>)" value="0"/>
    </td>
    <td >
      <input type="text" name="precio<?php echo $n;?>" id="precio<?php echo $n;?>" class="form-control input-sm td" readonly="readonly" value="0"/>
    </td>
    <td >
      <input type="text" name="costo<?php echo $n;?>" id="costo<?php echo $n;?>" class="form-control input-sm td" onkeyup="calculam2(<?php echo $n;?>)" value="0"/>
    </td>
    <td >
      <input type="text" required="required" value="0" name="total_<?php echo $n;?>" disabled="disabled" id="total_<?php echo $n;?>" class="form-control input-sm td">
    </td>
    <td  style="padding: 0">
      <textarea  rows="1" name="nota_<?php echo $n; ?>" id="nota_<?php echo $n; ?>" class="form-control"></textarea>
    </td>
    <td >
      <span onclick="elimina(<?php echo $n; ?>);">x</span>
    </td>
  </tr>
</table>