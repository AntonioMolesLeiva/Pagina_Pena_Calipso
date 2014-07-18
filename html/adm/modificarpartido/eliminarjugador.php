<?php
include ('../../../php/conexion.php');
$instruccion= "SELECT local FROM incidencia WHERE fecha =\"".$_POST['fecha']."\" AND jugador = \"".$_POST['dnijug']."\"";

					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
				$resultado1=mysql_fetch_array ($consulta);	
				
if($resultado1['local']=='s') {
//A NULL LA ESTRATEGIA
$instruccion="UPDATE  partido SET estlocal =NULL WHERE  fecha =\"".$_POST['fecha']."\"";
$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");

//CONSULTO SI ERA CAPITAN DE SU EQUIPO
$instruccion="SELECT caplocal FROM partido WHERE  fecha =\"".$_POST['fecha']."\" AND caplocal=\"".$_POST['dnijug']."\"";
$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");												
$filascaplocal = mysql_num_rows ($consulta);

//SI ERA CAPITAN LO ELIMINO DE CAPITAN
if ($filascaplocal>0) {
$instruccion="UPDATE  partido SET caplocal=NULL WHERE  fecha =\"".$_POST['fecha']."\"";
$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
}

//CONSULTO LOS GOLES DEL JUGADOR
$instruccion="SELECT gol FROM incidencia WHERE  fecha =\"".$_POST['fecha']."\" AND jugador=\"".$_POST['dnijug']."\"";
$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");												
$goljug=mysql_fetch_array ($consulta);

	if ($goljug['gol']>0) {								
	//CONSULTO EL MARCADOR LOCAL
	$instruccion="SELECT marclocal FROM partido WHERE  fecha =\"".$_POST['fecha']."\"";
	$consulta = mysql_query ($instruccion, $conexion)
									or die ("FALLO EN LA CONSULTA $instruccion");
	$marclocal=mysql_fetch_array ($consulta);

	//ACTUALIZO LOS GOLES DEL PARTIDO
	$instruccion="UPDATE  partido SET marclocal =".($marclocal['marclocal']-$goljug['gol'])." WHERE  fecha =\"".$_POST['fecha']."\"";
	$consulta = mysql_query ($instruccion, $conexion)
									or die ("FALLO EN LA CONSULTA $instruccion");
	}
}
else if($resultado1['local']=='n'){
//A NULL LA ESTRATEGIA
$instruccion="UPDATE  partido SET estvisitante=NULL WHERE  fecha =\"".$_POST['fecha']."\"";
$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
								
//CONSULTO SI ERA CAPITAN DE SU EQUIPO
$instruccion="SELECT capvisitante FROM partido WHERE  fecha =\"".$_POST['fecha']."\" AND capvisitante=\"".$_POST['dnijug']."\"";
$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");												
$filascaplocal = mysql_num_rows ($consulta);

//SI ERA CAPITAN LO ELIMINO DE CAPITAN
if ($filascaplocal>0) {
$instruccion="UPDATE  partido SET capvisitante=NULL WHERE  fecha =\"".$_POST['fecha']."\"";
$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
}

//CONSULTO LOS GOLES DEL JUGADOR
$instruccion="SELECT gol FROM incidencia WHERE  fecha =\"".$_POST['fecha']."\" AND jugador=\"".$_POST['dnijug']."\"";
$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");												
$goljug=mysql_fetch_array ($consulta);

	if ($goljug['gol']>0) {	
	
	//CONSULTO EL MARCADOR LOCAL
	$instruccion="SELECT marcvisitante FROM partido WHERE  fecha =\"".$_POST['fecha']."\"";
	$consulta = mysql_query ($instruccion, $conexion)
									or die ("FALLO EN LA CONSULTA $instruccion");
	$marcvisitante=mysql_fetch_array ($consulta);
	//ACTUALIZO LOS GOLES DEL PARTIDO
	$instruccion="UPDATE  partido SET marcvisitante =".($marcvisitante['marcvisitante']-$goljug['gol'])." WHERE  fecha =\"".$_POST['fecha']."\"";
	$consulta = mysql_query ($instruccion, $conexion)
									or die ("FALLO EN LA CONSULTA $instruccion");
	}
}	
							
//BORRO JUGADOR
$instruccion= "DELETE FROM incidencia WHERE fecha =\"".$_POST['fecha']."\" AND jugador = \"".$_POST['dnijug']."\"";
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");

//COMPRUEBO SI TIENE DEUDA
$instruccion="SELECT * FROM deudas WHERE fechapartido =\"".$_POST['fecha']."\" AND jugador = \"".$_POST['dnijug']."\"";
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
					$nfilas = mysql_num_rows ($consulta);
					//SI TIENE LA BORRO
					if($nfilas>0) {
					$instruccion= "DELETE FROM deudas WHERE fechapartido =\"".$_POST['fecha']."\" AND jugador = \"".$_POST['dnijug']."\"";
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
					}

mysql_close ($conexion);

 ?>
<h4 style="color:green"><span class="glyphicon glyphicon-ok"></span></h4>
<p>Eliminado correctamente</p>