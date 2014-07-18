<script>
$(document).ready(function() {
	$("#locals").blur(function(){
	$.post( "./modificarpartido/cambiarcapitan.php", { 'dnijug':$("#locals option:selected").attr("id"),'local':'s','fecha':$("#fecha").val(),'a':1}, function (data) { 
		$("#CuerpoEliminado").html(data); //Se muestra el resultado de la operación en la clase 
		});
	$("#caplocal").html("<span>"+$("#locals option:selected").val()+"</span>");
	});
	$("#localn").blur(function(){
	$.post( "./modificarpartido/cambiarcapitan.php", { 'dnijug':$("#localn option:selected").attr("id"),'local':'n','fecha':$("#fecha").val(),'a':1}, function (data) { 
		$("#CuerpoEliminado").html(data); //Se muestra el resultado de la operación en la clase 
		});
	$("#capvisitante").html("<span>"+$("#localn option:selected").val()+"</span>");
	});
	
});
</script>
<?php
include ('../../../php/conexion.php');

if (isset($_POST['a'])) {
	if ($_POST['local']=='s') {
		if($_POST['dnijug']=="") {
		$instruccion="UPDATE partido SET caplocal=NULL WHERE fecha='".$_POST['fecha']."'";
	$consulta = mysql_query ($instruccion, $conexion)
		or die ("FALLO EN LA CONSULTA $instruccion");
		}
		else {
	$instruccion="UPDATE partido SET caplocal='".$_POST['dnijug']."' WHERE fecha='".$_POST['fecha']."'";
	$consulta = mysql_query ($instruccion, $conexion)
		or die ("FALLO EN LA CONSULTA $instruccion");
		}
	}
	else if($_POST['local']=='n') {
		if ($_POST['dnijug']=="") {
		$instruccion="UPDATE partido SET capvisitante=NULL WHERE fecha='".$_POST['fecha']."'";
	$consulta = mysql_query ($instruccion, $conexion)
		or die ("FALLO EN LA CONSULTA $instruccion");
		}
		else {
	$instruccion="UPDATE partido SET capvisitante='".$_POST['dnijug']."' WHERE fecha='".$_POST['fecha']."'";
	$consulta = mysql_query ($instruccion, $conexion)
		or die ("FALLO EN LA CONSULTA $instruccion");
		}
	}
	}
	else {
$instruccion="SELECT j.alias,i.jugador from incidencia i
LEFT JOIN jugador j ON j.dni=i.jugador
 WHERE fecha='".$_POST['fecha']."' AND local='".$_POST['local']."' ORDER BY posicion ASC";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");			
	$nfilas = mysql_num_rows ($consulta);
	
	if ($nfilas>0) {
	echo "<select id=\"local".$_POST['local']."\"><option id=\"\">Ninguno</option>";
	for ($i=0;$i<$nfilas;$i++) {
	$jugadores=mysql_fetch_array ($consulta);
	if (strcmp(trim($_POST['idjug']),$jugadores['alias'])==0)echo "<option id=\"".$jugadores['jugador']."\" selected>".$jugadores['alias']."</option>";
	else echo "<option id=\"".$jugadores['jugador']."\">".$jugadores['alias']."</option>";
	}
	echo "</select>";
	}
	}
mysql_close ($conexion);

 ?>
<input id="fecha" type="hidden" value="<?php echo $_POST['fecha']; ?>"/>
<input id="idjug" type="hidden" value="<?php echo $_POST['idjug']; ?>"/>