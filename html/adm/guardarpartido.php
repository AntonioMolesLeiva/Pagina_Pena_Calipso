<?php
	$idjugadores=$_POST['idjugadores'];
	$Sancion=$_POST['Sancion'];
	$posHab=$_POST['posHab'];
	$GOLES=$_POST['GOLES'];
	$arbitro=$_POST['arbitro'];
	$espectador=$_POST['espectador'];
	$cap=$_POST['cap'];
	
	$fechPartido=$_POST['fechPartido'];
	
	$dia=substr($fechPartido,0,2);
	$mes=substr($fechPartido,3,2);
	$ano=substr($fechPartido,6,4);
	$fechabd=$ano."-".$mes."-".$dia;
	
	
	
	$color=$_POST['color'];
	$Njugadoreslocal=$_POST['Njugadoreslocal'];
	$Njugadoresvisitante=$_POST['Njugadoresvisitante'];
	$estLOCAL=$_POST['estLOCAL'];
	$estVISITANTE=$_POST['estVISITANTE'];
		
	$idjugadores=explode(',', $idjugadores[0]);
	$Sancion=explode(',', $Sancion[0]);
	$posHab=explode(',', $posHab[0]);
	$GOLES=explode(',', $GOLES[0]);
	$arbitro=explode(',', $arbitro[0]);
	$espectador=explode(',', $espectador[0]);
	$cap=explode(',', $cap[0]);
	include ('../../php/conexion.php');
	
	// para almacenar los capitanes correctamente(TIENE QUE HABER 2) si no NULL
	if($cap[0]==""||$cap[1]==""||($cap[0]==""&&$cap[1]=="")) {
	 $cap[0]='NULL';
	 $cap[1]='NULL';
	}
	else  {
	$cap[0]="'".$cap[0]."'";
	 $cap[1]="'".$cap[1]."'";
	}
	
	//estrategia
	if($estLOCAL=="") $estLOCAL='NULL';
	
	else {
	$instruccion="SELECT def,cen,del FROM estrategia WHERE idestrategia='".$estLOCAL."'";
						$consulta = mysql_query ($instruccion, $conexion)
									or die ("FALLO EN LA CONSULTA $instruccion");
		$resultado = mysql_fetch_array ($consulta);
		$def=$resultado['def'];
		$cen=$resultado['cen'];
		$del=$resultado['del'];
		for($i=0;$i<$del;$i++) {$posHab[$i]='del';}
		for($i=$del;$i<$del+$cen;$i++) {$posHab[$i]='cen';}
		for($i=$del+$cen;$i<$del+$cen+$def;$i++) {$posHab[$i]='def';}
		$posHab[$i++]='por';	
	}
	if($estVISITANTE=="") $estVISITANTE='NULL';
	else {
	$instruccion="SELECT def,cen,del FROM estrategia WHERE idestrategia='".$estVISITANTE."'";
						$consulta = mysql_query ($instruccion, $conexion)
									or die ("FALLO EN LA CONSULTA $instruccion");
		$resultado = mysql_fetch_array ($consulta);
		$def=$resultado['def'];
		$cen=$resultado['cen'];
		$del=$resultado['del'];
		for($i=$Njugadoreslocal;$i<$Njugadoreslocal+$del;$i++) {$posHab[$i]='del';}
		for($i=$Njugadoreslocal+$del;$i<$Njugadoreslocal+$del+$cen;$i++) {$posHab[$i]='cen';}
		for($i=$Njugadoreslocal+$del+$cen;$i<$Njugadoreslocal+$del+$cen+$def;$i++) {$posHab[$i]='def';}
		$posHab[$i++]='por';	
	}
	
	
	
	
	$instruccion="INSERT INTO partido(`fecha`,`marclocal`,`marcvisitante`,`caplocal`,`capvisitante`,`estlocal`,`estvisitante`) VALUES ('".$fechabd."', 0, 0,".$cap[0].",".$cap[1].",".$estLOCAL.",".$estVISITANTE.")";
						$consulta = mysql_query ($instruccion, $conexion)
									or die ("FALLO EN LA CONSULTA $instruccion");
	
	
	if($color=="negro") {
	$golesLoc=0;
	$golesVis=0;
	for($i=0;$i<$Njugadoreslocal;$i++) {
		if ($GOLES[$i]=="")$GOLES[$i]=0; 
		if ($Sancion[$i]=="")$Sancion[$i]='NULL';
		else{
		
		$instruccion="INSERT INTO deudas (`fechapartido`,`fechadeuda`,`idcuota`,`jugador`) VALUES ('".$fechabd."','".$fechabd."',".$Sancion[$i].",'".$idjugadores[$i]."')";
						$consulta = mysql_query ($instruccion, $conexion)
									or die ("FALLO EN LA CONSULTA $instruccion");
		
		}	
	$instruccion="INSERT INTO incidencia (`fecha`,`jugador`,`idsancion`,`gol`,`local`,`color`,`posicion`) VALUES ('".$fechabd."','".$idjugadores[$i]."',".$Sancion[$i].",".$GOLES[$i].",'s','ne','".$posHab[$i]."')";
						$consulta = mysql_query ($instruccion, $conexion)
									or die ("FALLO EN LA CONSULTA $instruccion");
	$golesLoc=$golesLoc+$GOLES[$i];
	}
	echo "<br />";
for($i=$Njugadoreslocal;$i<$Njugadoreslocal+$Njugadoresvisitante;$i++) {
		if ($GOLES[$i]=="")$GOLES[$i]=0; 
		if ($Sancion[$i]=="")$Sancion[$i]='NULL';
		else{
		
		$instruccion="INSERT INTO deudas (`fechapartido`,`fechadeuda`,`idcuota`,`jugador`) VALUES ('".$fechabd."','".$fechabd."',".$Sancion[$i].",'".$idjugadores[$i]."')";
						$consulta = mysql_query ($instruccion, $conexion)
									or die ("FALLO EN LA CONSULTA $instruccion");
		
		}		
	$instruccion="INSERT INTO incidencia (`fecha`,`jugador`,`idsancion`,`gol`,`local`,`color`,`posicion`) VALUES ('".$fechabd."','".$idjugadores[$i]."',".$Sancion[$i].",".$GOLES[$i].",'n','na','".$posHab[$i]."')";
						$consulta = mysql_query ($instruccion, $conexion)
									or die ("FALLO EN LA CONSULTA $instruccion");
	$golesVis=$golesVis+$GOLES[$i];
	}
	
	
	$instruccion="UPDATE  partido SET  marclocal = ".$golesLoc.",marcvisitante = ".$golesVis." WHERE  fecha='".$fechabd."'";
						$consulta = mysql_query ($instruccion, $conexion)
									or die ("FALLO EN LA CONSULTA $instruccion");
	
	}
	
	else {
	
	$golesLoc=0;
	$golesVis=0;
	for($i=0;$i<$Njugadoreslocal;$i++) {
		if ($GOLES[$i]=="")$GOLES[$i]=0; 
		if ($Sancion[$i]=="")$Sancion[$i]='NULL';
		else{
		
		$instruccion="INSERT INTO deudas (`fechapartido`,`fechadeuda`,`idcuota`,`jugador`) VALUES ('".$fechabd."','".$fechabd."',".$Sancion[$i].",'".$idjugadores[$i]."')";
						$consulta = mysql_query ($instruccion, $conexion)
									or die ("FALLO EN LA CONSULTA $instruccion");
		
		}		
	$instruccion="INSERT INTO incidencia (`fecha`,`jugador`,`idsancion`,`gol`,`local`,`color`,`posicion`) VALUES ('".$fechabd."','".$idjugadores[$i]."',".$Sancion[$i].",".$GOLES[$i].",'s','na','".$posHab[$i]."')";
						$consulta = mysql_query ($instruccion, $conexion)
									or die ("FALLO EN LA CONSULTA $instruccion");
	$golesLoc=$golesLoc+$GOLES[$i];
	}
	echo "<br />";
for($i=$Njugadoreslocal;$i<$Njugadoreslocal+$Njugadoresvisitante;$i++) {
		if ($GOLES[$i]=="")$GOLES[$i]=0; 
		if ($Sancion[$i]=="")$Sancion[$i]='NULL';
		else{
		
		$instruccion="INSERT INTO deudas (`fechapartido`,`fechadeuda`,`idcuota`,`jugador`) VALUES ('".$fechabd."','".$fechabd."',".$Sancion[$i].",'".$idjugadores[$i]."')";
						$consulta = mysql_query ($instruccion, $conexion)
									or die ("FALLO EN LA CONSULTA $instruccion");
		
		}		
	$instruccion="INSERT INTO incidencia (`fecha`,`jugador`,`idsancion`,`gol`,`local`,`color`,`posicion`) VALUES ('".$fechabd."','".$idjugadores[$i]."',".$Sancion[$i].",".$GOLES[$i].",'n','ne','".$posHab[$i]."')";
						$consulta = mysql_query ($instruccion, $conexion)
									or die ("FALLO EN LA CONSULTA $instruccion");
	$golesVis=$golesVis+$GOLES[$i];
	}
	
	
	$instruccion="UPDATE  partido SET  marclocal = ".$golesLoc.",marcvisitante = ".$golesVis." WHERE  fecha='".$fechabd."'";
						$consulta = mysql_query ($instruccion, $conexion)
									or die ("FALLO EN LA CONSULTA $instruccion");
	
	
	}
	if ($arbitro[0]!="") {
for ($i=0;$i<count($arbitro);$i++){
		$instruccion="INSERT INTO incidencia (`fecha`,`jugador`,`idsancion`,`gol`,`local`,`color`,`posicion`) VALUES ('".$fechabd."','".$arbitro[$i]."',".$Sancion[$i].",NULL,NULL,NULL,'A')";
							$consulta = mysql_query ($instruccion, $conexion)
										or die ("FALLO EN LA CONSULTA $instruccion");
		
		}
	}
	if ($espectador[0]!="") {
		for ($i=0;$i<count($espectador);$i++){
		$instruccion="INSERT INTO incidencia (`fecha`,`jugador`,`idsancion`,`gol`,`local`,`color`,`posicion`) VALUES ('".$fechabd."','".$espectador[$i]."',".$Sancion[$i].",NULL,NULL,NULL,NULL)";
							$consulta = mysql_query ($instruccion, $conexion)
										or die ("FALLO EN LA CONSULTA $instruccion");
		
		}
	}
	
echo "Todo introducido correctamente.";
	mysql_close ($conexion);
?>