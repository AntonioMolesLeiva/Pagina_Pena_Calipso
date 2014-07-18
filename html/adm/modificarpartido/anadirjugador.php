<?php

if (isset($_POST['b'])) {
include ('../../../php/conexion.php');

// CONSULTO COLOR DEL JUGADOR
$instruccion= "SELECT color FROM incidencia WHERE fecha='".$_POST['fecha']."' AND `local`='".$_POST['local']."' LIMIT 1";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTRA $instruccion");
	$color=mysql_fetch_array ($consulta);

	// CONSULTO POSICION JUGADOR
	$instruccion= "SELECT posicionhab FROM jugador WHERE dni='".$_POST['jug']."'";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");
	$posicion=mysql_fetch_array ($consulta);
	if ($_POST['cuota']=="") $cuota='NULL'; 
	else $cuota=$_POST['cuota'];
// INSERTO JUGADOR
	$instruccion= "INSERT INTO incidencia(fecha,jugador,idsancion,gol,local,color,posicion) VALUES ('".$_POST['fecha']."','".$_POST['jug']."',".$cuota.",".$_POST['goles'].",'".$_POST['local']."','".$color['color']."','".$posicion['posicionhab']."')";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");

// CONSULTO GOLES
	if($_POST['local']=='s') {
	
	$instruccion="SELECT marclocal FROM partido WHERE fecha='".$_POST['fecha']."'";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");
	$marcador=mysql_fetch_array ($consulta);
	}
	else if($_POST['local']=='n') {
	$instruccion="SELECT marcvisitante FROM partido WHERE fecha='".$_POST['fecha']."'";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");
	$marcador=mysql_fetch_array ($consulta);
	}

// ACTUALIZO GOLES
	if($_POST['local']=='s') {
	$instruccion="UPDATE partido SET marclocal=".($marcador['marclocal']+$_POST['goles'])." WHERE fecha='".$_POST['fecha']."'";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");
	}
	else if($_POST['local']=='n') {
	$instruccion="UPDATE partido SET marcvisitante=".($marcador['marcvisitante']+$_POST['goles'])." WHERE fecha='".$_POST['fecha']."'";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");
	}
// INSERTO DEUDA SI TIENE
		if($_POST['cuota']!="") {
		$instruccion="INSERT INTO deudas(fechapartido,fechadeuda,idcuota,jugador) VALUES('".$_POST['fecha']."','".$_POST['fecha']."',".$_POST['cuota'].",'".$_POST['jug']."')";
		$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");
		}
//ESTRATEGIA A NULL
if($_POST['local']=='s') {
	$instruccion="UPDATE partido SET estlocal=NULL WHERE fecha='".$_POST['fecha']."'";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");
	}
	else if($_POST['local']=='n') {
	$instruccion="UPDATE partido SET estvisitante=NULL WHERE fecha='".$_POST['fecha']."'";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");
	}
	
echo "<h4 style=\"color:green;\"><span class=\"glyphicon glyphicon-ok\"></span></h4>
<p>jugador guardado correctamente</p>";
mysql_close ($conexion);	
}
else {

include ('../../../php/conexion.php');
mysql_set_charset("utf8");
	
	$instruccion= "SELECT j.dni,j.alias FROM jugador j
	left OUTER JOIN (SELECT i.jugador FROM incidencia i WHERE fecha='".$_POST['fecha']."') i ON j.dni=i.jugador
	WHERE i.jugador is null";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");			
	$nfilas = mysql_num_rows ($consulta);
	if ($nfilas>0) {
		echo "
		<div class=\"form-group\">
		<label for=\"jugador\">Jugador:</label><select id=\"jugador\" class=\"form-control\">";
		for($i=0;$i<$nfilas;$i++) {
		$jugador=mysql_fetch_array ($consulta);
		echo "<option id=\"".$jugador['dni']."\">".$jugador['alias']."</option>";
		}
		echo "</select></div>";
	} ?>
	<div class="form-group">
		<label for="goles">Goles</label>
		<select id="goles" class="form-control">
		<?php 
		for($i=0;$i<=10;$i++) {
		echo "<option>".$i."</option>";
		}
		?>
		</select>
	</div>
<?php 
$instruccion= "SELECT idcuota, texto FROM cuota";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");			
	$nfilas = mysql_num_rows ($consulta);
	if ($nfilas>0) {
		echo "
		<div class=\"form-group\">
		<label for=\"cuota\">Sanción:</label><select id=\"cuota\" class=\"form-control\">
		<option>Ninguna</option>
		";
		for($i=0;$i<$nfilas;$i++) {
		$jugador=mysql_fetch_array ($consulta);
		echo "<option id=\"".$jugador['idcuota']."\">".$jugador['texto']."</option>";
		}
		echo "</select></div>";
	}
	
mysql_close ($conexion);
 ?>
 <script>
	$("#gJug").click(function(){
	 //alert("Quieres guardar");
	 $.post( "./modificarpartido/anadirjugador.php", {'fecha':$("#fecha").val(),'jug':$("#jugador option:selected").attr("id"),'goles':$("#goles option:selected").val(),'cuota':$("#cuota option:selected").attr("id"),'local':$("#local").val(),'b':1}, function (data) { 
		$("#CuerpoEliminado").html(data);
	});
	});

 </script>
<button id="gJug" class="btn btn-info btn-lg">Guardar jugador</button>
<input id="fecha" type="hidden" value="<?php echo $_POST['fecha']; ?>" />
<input id="local" type="hidden" value="<?php echo $_POST['local']; ?>" />

<?php } ?>