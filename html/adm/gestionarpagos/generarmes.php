<?php
/*
SELECT d.jugador,SUM(c.precio) AS cantidad FROM deudas d LEFT JOIN cuota c ON d.idcuota=c.idcuota WHERE d.fechadeuda>="2013-09-01" AND and d.jugador="1" d.fechadeuda<="2014-06-30" GROUP BY d.jugador="1"
*/
include ('../../../php/conexion.php');
	mysql_set_charset("utf8");
	
	//CONSULTO SI YA HABÍA EN ÉSE MES
	$instruccion="SELECT * FROM  deudas WHERE fechadeuda =  \"".$_POST['ano']."-".$_POST['mes']."-01\"AND idcuota =0";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");
	$nfilas = mysql_num_rows ($consulta);
	if ($nfilas>0) {
		echo "<h4 style=\"color:red;\"><span class=\"glyphicon glyphicon-remove\"></span></h4>
		<p style=\"text-align:justify;\">No se puede hacer automáticamente por que algunos jugadores ya tienen éste mes como deuda</p>";
	}
	else {
	
	$instruccion="SELECT dni FROM jugador WHERE activo='s'";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");
	$nfilas = mysql_num_rows ($consulta);
	if ($nfilas>0) {
	for ($i=0; $i<$nfilas; $i++){
			$resultado = mysql_fetch_array ($consulta);
			$instruccion="INSERT INTO deudas (fechadeuda,idcuota,jugador) VALUES (\"".$_POST['ano']."-".$_POST['mes']."-01\",0,\"".$resultado['dni']."\");";
			$consulta1 = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");
			}
		echo "<h4 style=\"color:green;\"><span class=\"glyphicon glyphicon-ok\"></span></h4>
		<p>Se han introducido la cuota mes correctamente a los jugadores</p>";
	}


}
mysql_close ($conexion);
?>
