<?php
include ('../../../php/conexion.php');

$portero=$_POST['portero'];
$portero=explode(',', $portero[0]);
$defensa=$_POST['defensa'];
$defensa=explode(',', $defensa[0]);
$centrocampista=$_POST['centrocampista'];
$centrocampista=explode(',', $centrocampista[0]);
$delantero=$_POST['delantero'];
$delantero=explode(',', $delantero[0]);

$fecha=$_POST['fecha'];
$local=$_POST['local'];
$localstr=$_POST['localstr'];
$visitantestr=$_POST['visitantestr'];

	foreach($portero as $por) {
	$instruccion="UPDATE incidencia SET posicion='por' WHERE fecha='".$fecha."' AND jugador='".$por."'";
	$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
				$resultado=mysql_fetch_array ($consulta);
	}
	foreach($defensa as $def) {
	$instruccion="UPDATE incidencia SET posicion='def' WHERE fecha='".$fecha."' AND jugador='".$def."'";
	$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
				$resultado=mysql_fetch_array ($consulta);
	}
foreach($centrocampista as $cen) {
	$instruccion="UPDATE incidencia SET posicion='cen' WHERE fecha='".$fecha."' AND jugador='".$cen."'";
	$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
				$resultado=mysql_fetch_array ($consulta);
	}

foreach($delantero as $del) {
	$instruccion="UPDATE incidencia SET posicion='del' WHERE fecha='".$fecha."' AND jugador='".$del."'";
	$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
				$resultado=mysql_fetch_array ($consulta);
	}	

if($local=='s') {
$instruccion="UPDATE partido SET estlocal=".$localstr." WHERE fecha='".$fecha."'";
	$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
				$resultado=mysql_fetch_array ($consulta);
}
else if($local=='n'){
$instruccion="UPDATE partido SET estvisitante=".$visitantestr." WHERE fecha='".$fecha."'";
	$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
				$resultado=mysql_fetch_array ($consulta);
}	

mysql_close ($conexion);

 ?>
<h4 style="color:green"><span class="glyphicon glyphicon-ok"></span></h4>
<p>estrategia modificada correctamente</p>