<?php
/*
$_POST['anomax'];
*/
include ('../../../php/conexion.php');
 ?>
<div class="col-md-4 col-sm-4 TablasTrofeos">
<div class="table-responsive">
<?php
?>
  <table id="maxgol" class="table table-striped">
   <thead>
   <tr>
   <th colspan="3"><img src="../../img/adm/gol.png" class="img-responsive"/><span>Max Goleador</span></th>
   </tr>
   <tr>
   <th>#</th>
   <th>Jugador</th>
   <th>Goles</th>
   </tr>
   </thead>
   <tbody>
   <?php
	mysql_set_charset("utf8");
	$instruccion="SELECT j.alias,SUM(i.gol) AS totgoles FROM incidencia i LEFT JOIN jugador j ON i.jugador=j.dni WHERE i.fecha>=\"".($_POST['anomax']-1)."-09-01\" AND i.fecha<=\"".$_POST['anomax']."-06-30\" AND j.activo=\"s\" GROUP BY i.jugador ORDER BY totgoles DESC";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");
	$nfilas = mysql_num_rows ($consulta);
	if ($nfilas>0) { 
		for ($i=0; $i<$nfilas; $i++){
			$resultado = mysql_fetch_array ($consulta);
			if ($resultado['totgoles']=="") $resultado['totgoles']=0;
			echo "<tr>
		   <td>".($i+1)."</td>
		   <td>".$resultado['alias']."</td>
		   <td>".$resultado['totgoles']."</td>
		   </tr>";
			
			}
	}
   ?>
   </tbody>
  </table>
</div>
</div>
<div id="mvp" class="col-md-4 col-sm-4 TablasTrofeos">
<table class="table table-striped">
   <thead>
   <tr>
   <th colspan="3"><img src="../../img/adm/trofeo.png" class="img-responsive"/><span>MVP</span></th>
   </tr>
   <tr>
   <th>#</th>
   <th>Jugador</th>
   <th>Puntos</th>
   </tr>
   </thead>
   <tbody>
  <?php
	mysql_set_charset("utf8");
	$instruccion="SELECT j.alias,j.dni FROM incidencia i LEFT JOIN jugador j ON i.jugador=j.dni WHERE i.fecha>=\"".($_POST['anomax']-1)."-09-01\" AND i.fecha<=\"".$_POST['anomax']."-06-30\" AND j.activo=\"s\" GROUP BY i.jugador";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");
	$nfilas = mysql_num_rows ($consulta);
	if ($nfilas>0) { 
		for ($i=0; $i<$nfilas; $i++){
			$resultado = mysql_fetch_array ($consulta);
			/*
			$resultado['alias'];
			$resultado['dni'];
			*/
			$instruccion="SELECT 3p AS jugador, COUNT( * ) AS npuntos3
		FROM  incidencia
		WHERE fecha >=  \"".($_POST['anomax']-1)."-09-01\"
		AND fecha <=  \"".$_POST['anomax']."-06-30\"
		AND 3p =  \"".$resultado['dni']."\"
		GROUP BY 3p";
						$consulta1 = mysql_query ($instruccion, $conexion)
									or die ("FALLO EN LA CONSULTA $instruccion");
			$jug3puntos=mysql_fetch_array ($consulta1);

		$instruccion="SELECT 2p AS jugador, COUNT( * ) AS npuntos2
		FROM  incidencia
		WHERE fecha >=  \"".($_POST['anomax']-1)."-09-01\"
		AND fecha <=  \"".$_POST['anomax']."-06-30\"
		AND 2p =  \"".$resultado['dni']."\"
		GROUP BY 2p";
						$consulta1 = mysql_query ($instruccion, $conexion)
									or die ("FALLO EN LA CONSULTA $instruccion");
			$jug2puntos=mysql_fetch_array ($consulta1);
		
		$instruccion="SELECT 1p AS jugador, COUNT( * ) AS npuntos1
		FROM  incidencia 
		WHERE fecha >=  \"".($_POST['anomax']-1)."-09-01\"
		AND fecha <=  \"".$_POST['anomax']."-06-30\"
		AND 1p =  \"".$resultado['dni']."\"
		GROUP BY 1p";
						$consulta1 = mysql_query ($instruccion, $conexion)
									or die ("FALLO EN LA CONSULTA $instruccion");
			$jug1puntos=mysql_fetch_array ($consulta1);
	$npuntos3=$jug3puntos['npuntos3'];
	$npuntos2=$jug2puntos['npuntos2'];
	$npuntos1=$jug1puntos['npuntos1'];
	
	$alias[$i]=$resultado['alias'];
	$puntos[$i]=($npuntos3*3)+($npuntos2*2)+$npuntos1;
	}
	
	//ordena por burbuja
	for($i=1;$i<$nfilas;$i++){
		for($j=0;$j<($nfilas-$i);$j++){
			if(($puntos[$j])<($puntos[$j+1])){
				
				//cambio de posicion los puntos
				$aux=$puntos[$j];
				$puntos[$j]=$puntos[$j+1];
				$puntos[$j+1]=$aux;
				
				//cambio de posicion los alias
				$aux2=$alias[$j];
				$alias[$j]=$alias[$j+1];
				$alias[$j+1]=$aux2;
			
			}
		}
	}
	
	//impresión de nombres
	for($i=0;$i<$nfilas;$i++){
	echo "
	<tr>
   <td>".($i+1)."</td>
   <td>".$alias[$i]."</td>
   <td>".$puntos[$i]."</td>
   </tr>";
	}
	}
   ?>
   </tbody>
  </table>
</div>
<div class="col-md-4 col-sm-4 TablasTrofeos">
<table id="punt" class="table table-striped">
   <thead>
   <tr>
   <th colspan="3"><img src="../../img/adm/estadio.png" class="img-responsive"/><span>Puntos</span></th>
   </tr>
   <tr>
   <th>#</th>
   <th>Jugador</th>
   <th>Puntos</th>
   </tr>
   </thead>
   <tbody>
   <?php
	mysql_set_charset("utf8");
	$instruccion="SELECT j.alias,j.dni FROM incidencia i LEFT JOIN jugador j ON i.jugador=j.dni WHERE i.fecha>=\"".($_POST['anomax']-1)."-09-01\" AND i.fecha<=\"".$_POST['anomax']."-06-30\" AND j.activo=\"s\" GROUP BY i.jugador";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");
	
	$nfilas = mysql_num_rows ($consulta);
	if ($nfilas>0) { 
		for ($i=0; $i<$nfilas; $i++){
			$resultado = mysql_fetch_array ($consulta);
			$instruccion="SELECT p.fecha, p.marclocal, p.marcvisitante, i.local
			FROM partido p
			LEFT JOIN incidencia i ON p.fecha = i.fecha
			WHERE jugador =  \"".$resultado['dni']."\"
			AND i.fecha>=\"".($_POST['anomax']-1)."-09-01\" AND i.fecha<=\"".$_POST['anomax']."-06-30\"
			ORDER BY p.fecha DESC ";
			$consulta1 = mysql_query ($instruccion, $conexion)
						or die ("FALLO EN LA CONSULTA $instruccion");
			$nfilas1 = mysql_num_rows ($consulta1);
			if ($nfilas1>0) {
				$gan=0;
				$emp=0;
				$per=0;
				for ($j=0; $j<$nfilas1; $j++){
					$resultado1 = mysql_fetch_array ($consulta1);
					if ($resultado1['marclocal']>$resultado1['marcvisitante']) {
						if ($resultado1['local']=='s') {
							$gan++;
						}
						else if($resultado1['local']=='n') {
							$per++;
						}
						else {
							$per++;
						}
					}
					else if($resultado1['marclocal']<$resultado1['marcvisitante']) {
						if ($resultado1['local']=='s') {
							$per++;
						}
						else if($resultado1['local']=='n') {
							$gan++;
						}
						else {
							$per++;
						}
					}
					else {
					$emp++;
					}
				}
			}
			$alias1[$i]=$resultado['alias'];
			$puntos1[$i]=($gan*4)+($emp*2)+($per);
			}
	
	}
	//ordena por burbuja
	for($i=1;$i<$nfilas;$i++){
		for($j=0;$j<($nfilas-$i);$j++){
			if(($puntos1[$j])<($puntos1[$j+1])){
				
				//cambio de posicion los puntos
				$aux=$puntos1[$j];
				$puntos1[$j]=$puntos1[$j+1];
				$puntos1[$j+1]=$aux;
				
				//cambio de posicion los alias
				$aux2=$alias1[$j];
				$alias1[$j]=$alias1[$j+1];
				$alias1[$j+1]=$aux2;
			}
		}
	}
		//impresión de nombres
		for($i=0;$i<$nfilas;$i++){
		echo "
		<tr>
	   <td>".($i+1)."</td>
	   <td>".$alias1[$i]."</td>
	   <td>".$puntos1[$i]."</td>
	   </tr>";
		}

	
	
   ?>
   </tbody>
  </table>
</div>

<?php 
mysql_close ($conexion);

/*
START TRANSACTION;
SELECT 3p AS jugador, COUNT( * ) AS npuntos3
		FROM  incidencia
		WHERE fecha >= "2013-09-01"
		AND fecha <="2014-06-30"
		AND 3p ="75486070R"
		GROUP BY 3p;
SELECT 2p AS jugador, COUNT( * ) AS npuntos2
		FROM  incidencia
		WHERE fecha >= "2013-09-01"
		AND fecha <="2014-06-30"
		AND 2p ="75486070R"
		GROUP BY 2p;
SELECT 1p AS jugador, COUNT( * ) AS npuntos1
		FROM  incidencia
		WHERE fecha >= "2013-09-01"
		AND fecha <="2014-06-30"
		AND 1p ="75486070R"
		GROUP BY 1p;
COMMIT;
*/

?>