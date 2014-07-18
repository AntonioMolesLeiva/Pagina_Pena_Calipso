<?php session_start();

include ('../../../php/conexion.php');
 ?>


<div class="col-md-6 col-sm-6 col-md-offset-3 col-sm-offset-3" style="margin-top:20px;">

    <?php
	$instruccion="SELECT p.fecha, 3p, 2p, 1p, j3.alias AS alias3, j2.alias AS alias2, j1.alias AS alias1
				FROM partido p
				LEFT JOIN incidencia i ON p.fecha = i.fecha
				LEFT JOIN jugador j3 ON i.3p = j3.dni
				LEFT JOIN jugador j2 ON i.2p = j2.dni
				LEFT JOIN jugador j1 ON i.1p = j1.dni
				WHERE jugador =  \"".$_SESSION['usu']."\"
				AND p.fecha=\"".$_POST['fecha']."\"";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");
	$datos = mysql_fetch_array ($consulta);
	?>
	
	<div class="panel panel-info">
  <div class="panel-heading">
    <h3 class="panel-title">Partido ->&nbsp;<?php echo substr($datos['fecha'],8,2)."-".substr($datos['fecha'],5,2)."-".substr($datos['fecha'],0,4); ?></h3>
  </div>
  <div id="GUARDAR" class="panel-body">
  <div class="row">
	<script>
$(document).ready(function() {

	/*$("ol").find("a[id]").click(function(){
		alert("¿Quieres visitar el partido?"+$(this).attr("id"));
		
	$.post( "./vertodospartidos/infopartido.php", { 'fecha':$(this).attr("id")}, function (data) { 
		$("#infopartido").html(data); //Se muestra el resultado de la operación en la clase 
		});
	});*/
	if ($("#opt3").attr("disabled")&&$("#opt2").attr("disabled")&&$("#opt1").attr("disabled")) {
	$("#Guardar").attr("disabled","disabled");
	$("#Guardar").removeClass("btn-info");
	$("#Guardar").addClass("btn-danger");
	$("#Guardar").text("¡Ya has votado!");
	}
	else {
	$("#Guardar").removeAttr("disabled");
	}
	$("#Guardar").click(function(){
		
		//alert("opt1: "+$("#opt1").val()+" opt2: "+$("#opt2").val()+" opt3: "+$("#opt3").val());
		var opt3,opt2,opt1;
		if($("#opt1").val()==$("#opt2").val()&&$("#opt1").val()==$("#opt3").val()) alert("No puedes votar al mismo jugador 3 veces.");
		else if($("#opt1").val()==$("#opt2").val()||$("#opt1").val()==$("#opt3").val()||$("#opt2").val()==$("#opt3").val()) alert("No puedes votar al mismo jugador 2 veces.");
		else {
			//alert("bien! "+"opt3: "+$("#opt3 option:selected").attr("id")+" opt2: "+$("#opt2 option:selected").attr("id")+" opt1: "+$("#opt1 option:selected").attr("id"));
			if($("#opt3 option:selected").attr("id")) opt3=$("#opt3 option:selected").attr("id");
			else opt3=0;
			if($("#opt2 option:selected").attr("id")) opt2=$("#opt2 option:selected").attr("id");
			else opt2=0;
			if($("#opt1 option:selected").attr("id")) opt1=$("#opt1 option:selected").attr("id");
			else opt1=0;
		
		$.post( "./votar/guardarvoto.php", { '3p':opt3,'2p':opt2,'1p':opt1,'fecha':'<?php echo $datos['fecha']; ?>'}, function (data) { 
		$("#GUARDAR").html(data); //Se muestra el resultado de la operación en la clase 
		});	
		}
	});
});
</script>
	
	<?php
	if ($datos['3p']!="") { ?>
	<div class="col-md-4 col-sm-4">
	<label>3 Puntos:</label>
	<input id="opt3" type="text"class="form-control" value="<?php echo $datos['alias3']; ?>" disabled />
	</div>
	<?php }
	else
	{
	echo "<div class=\"col-md-4 col-sm-4\"><label>3 Puntos:</label><select id=\"opt3\" class=\"form-control\">";
	
	$instruccion="SELECT j.alias, j.dni, color, j.activo
				FROM incidencia i
				LEFT JOIN jugador j ON i.jugador = j.dni
				WHERE fecha =  \"".$datos['fecha']."\" AND i.jugador <>\"".$_SESSION['usu']."\"
				ORDER BY i.color DESC , i.posicion ASC ";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");
	$nfilas = mysql_num_rows ($consulta);
	if ($nfilas>0) {
	$color="ne";
	$a=0;
		echo "<option>Ninguno</option>
		<optgroup label=\"Negro\">";
		for ($i=0; $i<$nfilas; $i++){
			$resultado = mysql_fetch_array ($consulta);
			if ($resultado['color']!=$color&&$a==0) {echo "</optgroup><optgroup label=\"Naranja\">";$a++;}
			if ($resultado['color']!="na"&&$a>0)echo "</optgroup><optgroup label=\"Otros\">";
			if ($resultado['activo']=='n') $extra="(extra)";
			else $extra="";
			if($datos['3p']==$resultado['dni']) echo "<option id=\"".$resultado['dni']."\" selected>".$resultado['alias']." ".$extra."</option>";
			else echo "<option id=\"".$resultado['dni']."\">".$resultado['alias']." ".$extra."</option>";
			$color=$resultado['color'];
			}
			echo "</optgroup>";
	}
	
	echo "</select></div>";
	}
	
	if ($datos['2p']!="") { ?>
	<div class="col-md-4 col-sm-4">
	<label>2 Puntos:</label>
	<input id="opt2" type="text"class="form-control" value="<?php echo $datos['alias2']; ?>" disabled />
	</div>
	<?php }
	else
	{
	echo "<div class=\"col-md-4 col-sm-4\"><label>2 Puntos:</label><select  id=\"opt2\" class=\"form-control\">";
	
	$instruccion="SELECT j.alias, j.dni, color, j.activo
				FROM incidencia i
				LEFT JOIN jugador j ON i.jugador = j.dni
				WHERE fecha =  \"".$datos['fecha']."\" AND i.jugador <>\"".$_SESSION['usu']."\"
				ORDER BY i.color DESC , i.posicion ASC ";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");
	$nfilas = mysql_num_rows ($consulta);
	if ($nfilas>0) {
	$color="ne";
	$a=0;
		echo "<option>Ninguno</option>
		<optgroup label=\"Negro\">";
		for ($i=0; $i<$nfilas; $i++){
			$resultado = mysql_fetch_array ($consulta);
			if ($resultado['color']!=$color&&$a==0) {echo "</optgroup><optgroup label=\"Naranja\">";$a++;}
			if ($resultado['color']!="na"&&$a>0)echo "</optgroup><optgroup label=\"Otros\">";
			if ($resultado['activo']=='n') $extra="(extra)";
			else $extra="";
			if($datos['2p']==$resultado['dni']) echo "<option id=\"".$resultado['dni']."\" selected>".$resultado['alias']." ".$extra."</option>";
			else echo "<option id=\"".$resultado['dni']."\">".$resultado['alias']." ".$extra."</option>";
			$color=$resultado['color'];
			}
			echo "</optgroup>";
	}
	
	echo "</select></div>";
	}
	if ($datos['1p']!="") { ?>
	<div class="col-md-4 col-sm-4">
	<label>1 Puntos:</label>
	<input id="opt1" type="text"class="form-control" value="<?php echo $datos['alias1']; ?>" disabled />
	</div>
	<?php }
	else
	{
	echo "<div class=\"col-md-4 col-sm-4\"><label>1 Puntos:</label><select id=\"opt1\" class=\"form-control\">";
	
	$instruccion="SELECT j.alias, j.dni, color, j.activo
				FROM incidencia i
				LEFT JOIN jugador j ON i.jugador = j.dni
				WHERE fecha =  \"".$datos['fecha']."\" AND i.jugador <>\"".$_SESSION['usu']."\"
				ORDER BY i.color DESC , i.posicion ASC ";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");
	$nfilas = mysql_num_rows ($consulta);
	if ($nfilas>0) {
	$color="ne";
	$a=0;
		echo "<option>Ninguno</option>
		<optgroup label=\"Negro\">";
		for ($i=0; $i<$nfilas; $i++){
			$resultado = mysql_fetch_array ($consulta);
			if ($resultado['color']!=$color&&$a==0) {echo "</optgroup><optgroup label=\"Naranja\">";$a++;}
			if ($resultado['color']!="na"&&$a>0)echo "</optgroup><optgroup label=\"Otros\">";
			if ($resultado['activo']=='n') $extra="(extra)";
			else $extra="";
			if($datos['1p']==$resultado['dni']) echo "<option id=\"".$resultado['dni']."\" selected>".$resultado['alias']." ".$extra."</option>";
			else echo "<option id=\"".$resultado['dni']."\">".$resultado['alias']." ".$extra."</option>";
			$color=$resultado['color'];
			}
			echo "</optgroup>";
	}
	
	echo "</select></div>";
	}
	?>
  </div>
  <button id="Guardar" class="btn btn-info btn-lg btn-block"style="margin-top:20px;">Guardar</button>
  </div>
</div>
</div>

<?php 
mysql_close ($conexion);
?>