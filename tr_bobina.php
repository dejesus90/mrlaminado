<?php 
$n=$_GET['n'];
?>
<table class="table table-condensed">
  <tr>
    <td>
      <input type="text" name="cantidadpz<?php echo $n; ?>" id="cantidadpz<?php echo $n; ?>" class="form-control input-sm td" onkeyup="calculam2(<?php echo $n ?>)" value="1"/>
    </td>
    <td>
      <select name="articulo<?php echo $n ?>" class="form-control input-sm">
        <option value="0">--Selecciona--</option>
        <?php
        include ("conex.php");
        $datos=mysqli_query($mysqli,"SELECT id_articulo,descripcion FROM articulos");
        while($datos1=mysqli_fetch_array($datos))
        {
          ?>
          <option value="<?php echo $datos1[0];?>"> 
            <?php echo $datos1[1];?>
          </option>
          <?php
        }?>
      </select>
    </td>
    <td>
      <select  name="pedimento<?php echo $n ?>" id="pedimento<?php echo $n ?>" class="form-control input-sm">
        <option value="11111">Pedimento 1</option>
        <option value="22222">Pedimento 2</option>
        <option value="33333">Pedimento 3</option>
        <option value="44444">Pedimento 4</option>
        <option value="55555">Pedimento 5</option>
        <option value="66666">Pedimento 6</option>
      </select>
    </td>

    <td>
      <input type="text" name="ancho<?php echo $n ?>" id="ancho<?php echo $n ?>" class="form-control input-sm td"  onkeyup="calculam2(<?php echo $n ?>)" value="0"/>
    </td>
    <td>
      <input type="text" name="largo<?php echo $n ?>" id="largo<?php echo $n ?>" class="form-control input-sm td"   onkeyup="calculam2(<?php echo $n ?>)" value="3000"/>
    </td>
    <td>
      <input type="hojas" name="m2_<?php echo $n ?>" id="m2_<?php echo $n ?>" class="form-control input-sm td" disabled="disabled"  onkeyup="calculam2(<?php echo $n ?>)" value="0"/>
    </td>
    <td>
      <input type="text" name="m2_usd<?php echo $n ?>" id="m2_usd<?php echo $n ?>" class="form-control input-sm td"  value="0" onkeyup="calculam2(<?php echo $n ?>)"/>
    </td>
    <td>
      <input type="text" required="required" name="precioxbobina_<?php echo $n ?>" id="precioxbobina_<?php echo $n ?>" class="form-control input-sm td" onkeyup="calculam2(<?php echo $n ?>)" value="0" disabled="disabled">
    </td>

    <td>
      <input type="text" required="required" name="tipocambio_<?php echo $n ?>" id="tipocambio_<?php echo $n ?>" class="form-control input-sm td" value="0" onkeyup="calculam2(<?php echo $n ?>)">
    </td>
    <td>
      <input type="text" required="required" name="precio_unitario<?php echo $n ?>" disabled="disabled" id="precio_unitario<?php echo $n ?>" class="form-control input-sm td" value="0">
    </td>
    <td style="padding: 0">
      <textarea  rows="1" name="nota_<?php echo $n ?>" id="nota_<?php echo $n ?>" class="form-control"></textarea>
    </td>
    <td>&nbsp; </td>
  </tr>
</table>