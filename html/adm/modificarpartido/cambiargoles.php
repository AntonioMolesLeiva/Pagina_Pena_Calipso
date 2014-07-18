<script>
$(document).ready(function() {
	$("#locals").change(function(){
		$.post( "./modificarpartido/cambiargoles.php", { 'idjug':$("#idjug").val(),'local':'s','fecha':$("#fecha").val(),'golnuevo':$("#locals option:selected").val(),'a':1}, function (data) { 
		$("#CuerpoEliminado").html(data); //Se muestra el resultado de la operación en la clase 
		});
	});
	$("#localn").change(function(){
	$.post( "./modificarpartido/cambiargoles.php", { 'idjug':$("#idjug").val(),'local':'n','fecha':$("#fecha").val(),'golnuevo':$("#localn option:selected").val(),'a':1}, function (data) { 
		$("#CuerpoEliminado").html(data); //Se muestra el resultado de la operación en la clase 
		});
	});
	
});
</script>
<?php
include ('../../../php/conexion.php');

//CONSULTO GOLES PREVIOS JUGADOR 
	$instruccion="SELECT gol from incidencia WHERE fecha='".$_POST['fecha']."' AND local='".$_POST['local']."' AND jugador='".$_POST['idjug']."'";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");	
	$golAntJug=mysql_fetch_array ($consulta);

if (isset($_POST['a'])) {
	
	
	if($_POST['local']=='s') {
	
	$instruccion="SELECT marclocal from partido WHERE fecha='".$_POST['fecha']."'";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");	
	$marcador=mysql_fetch_array ($consulta);
	if($golAntJug['gol']=="") $golAntJug['gol']=0;
	$total=$marcador['marclocal']+($_POST['golnuevo']-$golAntJug['gol']);
	$instruccion="UPDATE partido set marclocal=".$total." WHERE fecha='".$_POST['fecha']."'";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");
	
	$instruccion="UPDATE incidencia set gol=".$_POST['golnuevo']." WHERE fecha='".$_POST['fecha']."' AND jugador='".$_POST['idjug']."'";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");	
	}
	else if($_POST['local']=='n') {
	
	$instruccion="SELECT marcvisitante from partido WHERE fecha='".$_POST['fecha']."'";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");	
	$marcador=mysql_fetch_array ($consulta);
	if($golAntJug['gol']=="") $golAntJug['gol']=0;
	$total=$marcador['marcvisitante']+($_POST['golnuevo']-$golAntJug['gol']);
	
	$instruccion="UPDATE partido set marcvisitante=".$total." WHERE fecha='".$_POST['fecha']."'";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");
	
	$instruccion="UPDATE incidencia set gol=".$_POST['golnuevo']." WHERE fecha='".$_POST['fecha']."' AND jugador='".$_POST['idjug']."'";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");
	} ?>
	
	Cambio de gol correctamente.
	
	<?php }
	else {
	echo "<h4>Goles del jugador</h4>";
	echo "<select id=\"local".$_POST['local']."\" class=\"form-control\">";
	for ($i=0;$i<=10;$i++) {
	if ($golAntJug['gol']==$i) echo "<option value=\"".$i."\" selected>".$i."</option>";
	else echo "<option value=\"".$i."\">".$i."</option>";
	}
	echo "</select>";
	
	}
mysql_close ($conexion);

 ?>
<input id="fecha" type="hidden" value="<?php echo $_POST['fecha']; ?>"/>
<input id="idjug" type="hidden" value="<?php echo $_POST['idjug']; ?>"/>