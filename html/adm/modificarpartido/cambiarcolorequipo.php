<?php
include ('../../../php/conexion.php');

//echo "fecha=".$_POST['fecha'];

	//COJO LOS DATOS DE PARTIDO
	$instruccion="SELECT * FROM partido WHERE fecha='".$_POST['fecha']."'";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");			
	$nfilas = mysql_num_rows ($consulta);
	if ($nfilas>0) {
	$partido=mysql_fetch_array ($consulta);
	}
	//INTERCAMBIO LOS DATOS DE PARTIDO
	if ($partido['estlocal']==''&&$partido['estvisitante']==''){
	$instruccion="UPDATE partido SET 
	marclocal='".$partido['marcvisitante']."',marcvisitante='".$partido['marclocal']."'
	WHERE fecha='".$_POST['fecha']."'";
	}
	else if($partido['estlocal']=='') {
	$instruccion="UPDATE partido SET 
	marclocal='".$partido['marcvisitante']."',marcvisitante='".$partido['marclocal']."',
	estlocal='".$partido['estvisitante']."',estvisitante=NULL
	WHERE fecha='".$_POST['fecha']."'";
	}
	else if($partido['estvisitante']==''){
	$instruccion="UPDATE partido SET 
	marclocal='".$partido['marcvisitante']."',marcvisitante='".$partido['marclocal']."',
	estlocal=NULL,estvisitante='".$partido['estlocal']."'
	WHERE fecha='".$_POST['fecha']."'";
	}
	else {
	$instruccion="UPDATE partido SET 
	marclocal='".$partido['marcvisitante']."',marcvisitante='".$partido['marclocal']."',
	estlocal='".$partido['estvisitante']."',estvisitante='".$partido['estlocal']."'
	WHERE fecha='".$_POST['fecha']."'";
	}
	
	if($partido['caplocal']==''&&$partido['capvisitante']==''){
	
	}
	else if($partido['caplocal']==''){
	$instruccion1="UPDATE partido SET 
	caplocal='".$partido['capvisitante']."',capvisitante=NULL
	WHERE fecha='".$_POST['fecha']."'";
	$consulta= mysql_query ($instruccion1, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion1");	
	}
	else if($partido['capvisitante']==''){
	$instruccion1="UPDATE partido SET 
	caplocal=NULL,capvisitante='".$partido['caplocal']."'
	WHERE fecha='".$_POST['fecha']."'";
	$consulta= mysql_query ($instruccion1, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion1");	
	}
	else {
	$instruccion1="UPDATE partido SET 
	caplocal='".$partido['capvisitante']."',capvisitante='".$partido['caplocal']."'
	WHERE fecha='".$_POST['fecha']."'";
	$consulta= mysql_query ($instruccion1, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion1");	
	}
	
	$consulta= mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");			
	
	//COJO LOS JUGADORES LOCALES
	$instruccion="SELECT jugador,local,color FROM incidencia 
					where fecha='".$_POST['fecha']."' AND local='s'
					ORDER BY `local` ASC,posicion asc";
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
					$nfilas = mysql_num_rows ($consulta);
	
	//COJO LOS JUGADORES VISITANTES
	$instruccion="SELECT jugador,local,color FROM incidencia 
					where fecha='".$_POST['fecha']."' AND local='n'
					ORDER BY `local` ASC,posicion asc";
					$consulta1 = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
					$nfilas1 = mysql_num_rows ($consulta1);
	//INTERCAMBIO DE LOS LOCALES
	if ($nfilas>0) {
		for ($i=0;$i<$nfilas;$i++) {
			$locales=mysql_fetch_array ($consulta);
			if ($locales['color']=='ne') $color='na';
			else if($locales['color']=='na') $color='ne';
			$instruccion="UPDATE incidencia SET local='n',color='".$color."'
					where fecha='".$_POST['fecha']."' AND jugador='".$locales['jugador']."'";
					$consulta2 = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion2");
			
		}
	}
	//INTERCAMBIO DE LOS VISITANTES
	if ($nfilas1>0) {
		for ($i=0;$i<$nfilas1;$i++) {
			$visitantes=mysql_fetch_array ($consulta1);
			if ($visitantes['color']=='ne') $color='na';
			else if($visitantes['color']=='na') $color='ne';
			$instruccion="UPDATE incidencia SET local='s',color='".$color."'
					where fecha='".$_POST['fecha']."' AND jugador='".$visitantes['jugador']."'";
					$consulta2 = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion2");
			
		}
	}
	
	
mysql_close ($conexion);
 ?>
 <h4 style="color:green"><span class="glyphicon glyphicon-ok"></span></h4>
<p>Colores cambiados correctamente</p>