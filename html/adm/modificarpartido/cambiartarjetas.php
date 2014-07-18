<script>
$(document).ready(function() {
	$("#local").change(function(){
		$.post( "./modificarpartido/cambiartarjetas.php", { 'idjug':$("#idjug").val(),'fecha':$("#fecha").val(),'tarnueva':$("#local option:selected").attr("id"),'idtarAnt':$("#idtarAnt").val(),'a':1}, function (data) { 
		$("#CuerpoEliminado").html(data); //Se muestra el resultado de la operación en la clase 
		});
	});
	
});
</script>
<?php
include ('../../../php/conexion.php');

if (isset($_POST['a'])) {
	
	/*
	$_POST['idjug']
	$_POST['fecha']
	$_POST['tarnueva']
	$_POST['idtarAnt']
	*/
	
	//CONSULTO DEUDA DEL JUGADOR
	$instruccion="SELECT * FROM deudas WHERE fechapartido='".$_POST['fecha']."' AND jugador='".$_POST['idjug']."'";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");	
	$nfilas = mysql_num_rows ($consulta);
	
	if ($nfilas>0) {
		if($_POST['tarnueva']=="") {
		$instruccion="DELETE FROM deudas WHERE fechapartido='".$_POST['fecha']."' AND jugador='".$_POST['idjug']."'";
		$consulta = mysql_query ($instruccion, $conexion)
					or die ("FALLO EN LA CONSULTA $instruccion");
	$instruccion="UPDATE incidencia SET idsancion=NULL WHERE fecha='".$_POST['fecha']."' AND jugador='".$_POST['idjug']."'";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");						
		} 
		else {
		$instruccion="UPDATE deudas SET idcuota=".$_POST['tarnueva'].",pagado='n' WHERE fechapartido='".$_POST['fecha']."' AND jugador='".$_POST['idjug']."'";
		$consulta = mysql_query ($instruccion, $conexion)
					or die ("FALLO EN LA CONSULTA $instruccion");	
		$instruccion="UPDATE incidencia SET idsancion=".$_POST['tarnueva']." WHERE fecha='".$_POST['fecha']."' AND jugador='".$_POST['idjug']."'";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");	
					}
	
	}
	else {
	if($_POST['tarnueva']!="") {
	$instruccion="INSERT INTO deudas (fechapartido,fechadeuda,idcuota,jugador) VALUES('".$_POST['fecha']."','".$_POST['fecha']."',".$_POST['tarnueva'].",'".$_POST['idjug']."')";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");	
	$instruccion="UPDATE incidencia SET idsancion=".$_POST['tarnueva']." WHERE fecha='".$_POST['fecha']."' AND jugador='".$_POST['idjug']."'";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");			
				}
	
	}
	
	 ?>
	
	Cambio de tarjeta correctamente.
	
	<?php }
	else {
	echo "<h4>Tarjeta del jugador</h4>";
	echo "<select id=\"local\" class=\"form-control\"><option id=\"\">Ninguna</option>";
	
	$instruccion="SELECT idcuota,texto from cuota";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");	
	$nfilas = mysql_num_rows ($consulta);
	if($nfilas>0) {
		for($i=0;$i<$nfilas;$i++){
		$resultado=mysql_fetch_array ($consulta);
		if ($resultado['idcuota']==$_POST['idtarAnt']) echo "<option id=\"".$resultado['idcuota']."\" selected>".$resultado['texto']."</option>";
		else echo "<option id=\"".$resultado['idcuota']."\">".$resultado['texto']."</option>";
		}
	}
	echo "</select>";
	
	}
mysql_close ($conexion);

 ?>
<input id="fecha" type="hidden" value="<?php echo $_POST['fecha']; ?>"/>
<input id="idjug" type="hidden" value="<?php echo $_POST['idjug']; ?>"/>
<input id="idtarAnt" type="hidden" value="<?php echo $_POST['idtarAnt']; ?>"/>