<?php
session_start();

	include ('../../php/conexion.php');
	
	mysql_set_charset("utf8");
	$instruccion="SELECT * FROM jugador WHERE dni=\"".$_SESSION['usu']."\"";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");
			$resultado = mysql_fetch_array ($consulta);
			
		?>
	<style>
	label {color:white;}
	.row{margin-top:20px;margin-bottom:27px;}
	</style>
<div class="col-md-6 col-sm-6 col-md-offset-3 col-sm-offset-3" style="min-height:300px;background-color:rgba(12,12,12,0.3);border-radius:15px;">
	<div class="col-md-12 col-sm-12" style="min-height:300px;">
		
		<div class="col-md-9 col-sm-9" style="border:5px solid black;border-radius:15px;margin-top:10px;">
		<div class="row">
  <div class="col-md-4 col-sm-4">
  <label class="control-label">DNI:</label>
    <input type="text" class="form-control" value="<?php echo $resultado['dni']; ?>" disabled>
  </div>
 <div class="col-md-5 col-sm-5">
  <label class="control-label">Nombre:</label>
    <input type="text" class="form-control" value="<?php echo $resultado['nombre']; ?>" disabled>
  </div>
  <div class="col-md-2 col-sm-2">
  <label class="control-label">Dorsal:</label>
    <input type="text" class="form-control" value="<?php echo $resultado['dorsal']; ?>" disabled>
  </div>
  </div>
  <div class="row">
  <?php if($resultado['activo']=='s') { ?>
	  <div class="col-md-2 col-sm-2">
	  <label class="control-label">Activo:</label>
		<input type="checkbox" class="form-control" checked disabled>
	  </div>
  <?php }
else {?>
	<div class="col-md-2 col-sm-2">
	  <label class="control-label">Activo:</label>
		<input type="checkbox" class="form-control" disabled>
	  </div>
<?php }  ?>
  <div class="col-md-6 col-sm-6">
  <label class="control-label">Apellidos:</label>
    <input type="text" class="form-control" value="<?php echo $resultado['apellidos']; ?>" disabled>
  </div>
  <div class="col-md-4 col-sm-4">
  <label class="control-label">Fecha de alta:</label>
    <input type="text" class="form-control" value="<?php echo substr($resultado['fechalta'],8,2)."-".substr($resultado['fechalta'],5,2)."-".substr($resultado['fechalta'],0,4); ?>" disabled>
  </div>
</div>
		</div>
	<?php
	if ($resultado['foto']!="") {
	echo "<img class=\"col-md-3 col-sm-3 col-xs-12\" src=\"../../img/jug/fotosjug/".$resultado['foto']."\" style=\"border-radius:20px;margin-top:20px;\"/>";
	}
	
	else {?>
	<img class="col-md-3 col-sm-3 col-xs-12" src="../../img/jug/sinfoto.png" style="border-radius:20px;margin-top:20px;" />
	<?php }
	?>	
	
</div>
</div>
<?php 
mysql_close ($conexion);
?>