<?php session_start(); ?>

	<?php
	include ('../../../php/conexion.php');
	
	/*mysql_set_charset("utf8");
	$instruccion="SELECT p.fecha FROM partido p LEFT JOIN incidencia i ON p.fecha = i.fecha
WHERE jugador =  \"".$_SESSION['usu']."\" ORDER BY fecha DESC";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");
	$nfilas = mysql_num_rows ($consulta);
	if ($nfilas>0) { 
		for ($i=0; $i<$nfilas; $i++){
			$resultado = mysql_fetch_array ($consulta);
			}
	}*/
	//echo "3p-> ".$_POST['3p']." 2p-> ".$_POST['2p']." 1p-> ".$_POST['1p']." usu-> ".$_SESSION['usu']." fecha-> ".$_POST['fecha'];			
 if ($_POST['3p']!=0) {
 $instruccion="UPDATE incidencia SET 3p=\"".$_POST['3p']."\" WHERE fecha=\"".$_POST['fecha']."\" AND jugador=\"".$_SESSION['usu']."\"";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");
	}
 if ($_POST['2p']!=0) {
 $instruccion="UPDATE incidencia SET 2p=\"".$_POST['2p']."\" WHERE fecha=\"".$_POST['fecha']."\" AND jugador=\"".$_SESSION['usu']."\"";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");
	}
 if ($_POST['1p']!=0) {
 $instruccion="UPDATE incidencia SET 1p=\"".$_POST['1p']."\" WHERE fecha=\"".$_POST['fecha']."\" AND jugador=\"".$_SESSION['usu']."\"";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");
	}
mysql_close ($conexion);
?>
<h4 style="color:green;"><span class="glyphicon glyphicon-ok"></span></h4>
<p>Se ha introducido los votos correctamente</p>