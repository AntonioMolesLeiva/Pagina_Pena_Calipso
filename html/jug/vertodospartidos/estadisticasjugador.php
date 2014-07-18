<div class="panel panel-primary">
<?php 
include ('../../../php/conexion.php');

$instruccion="SELECT nombre,apellidos,dorsal FROM jugador WHERE dni='".$_POST['idjug']."'";	
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
					$resultado=mysql_fetch_array ($consulta);
					
?>
  <div class="panel-heading"><?php echo $resultado['nombre']." ".$resultado['apellidos']; ?> <span style="float:right;"><?php 
echo $resultado['dorsal'];
?></span></div>
  <div class="panel-body" style="min-height:100px;">
   
	<table class="table">
	<tr>
	<td colspan="2">Temp.<?php 
	$mes=substr($_POST['fecha'],5,2);
	$ano=substr($_POST['fecha'],0,4);
	$dia=substr($_POST['fecha'],8,2);
	if ($mes>=9) {
	echo substr($ano,2,2)."/".substr($ano+1,2,2);
		$instruccion="SELECT i.fecha,i.local, p.marclocal, p.marcvisitante, i.gol, i.color
FROM partido p
LEFT JOIN incidencia i ON p.fecha = i.fecha 
WHERE i.fecha>=\"".$ano."-09-01\" AND i.fecha<=\"".($ano+1)."-06-30\" AND i.jugador =  '".$_POST['idjug']."' ORDER BY i.fecha DESC";
	}
	else if ($mes<=6) {
	echo substr(($ano-1),2,2)."/".substr($ano,2,2);
		$instruccion="SELECT i.fecha,i.local, p.marclocal, p.marcvisitante, i.gol, i.color
FROM partido p
LEFT JOIN incidencia i ON p.fecha = i.fecha 
WHERE i.fecha>=\"".($ano-1)."-09-01\" AND i.fecha<=\"".$ano."-06-30\" AND i.jugador =  '".$_POST['idjug']."' ORDER BY i.fecha DESC";
	}
	
					$ganane=0;
					$ganana=0;
					$empne=0;
					$empna=0;
					$piene=0;
					$piena=0;
					$golna=0;
					$golne=0;
					
					//echo $instruccion;
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
					$nfilas = mysql_num_rows ($consulta);
					if ($nfilas>0) {
					for ($i=0; $i<$nfilas; $i++){
							$resultado=mysql_fetch_array ($consulta);
						if ($resultado['marclocal']>$resultado['marcvisitante']) {
							if ($resultado['local']=='s') {
								if($resultado['color']=="na") {
								$ganana++;
									if ($resultado['gol']>0) {
										$golna+=$resultado['gol'];
									}
								}
								else if ($resultado['color']=="ne") {
								$ganane++;
									if ($resultado['gol']>0) {
											$golne+=$resultado['gol'];
										}
								}
							}
							else {
								if($resultado['color']=='na') {
								$piena++;
								if ($resultado['gol']>0) {
										$golna+=$resultado['gol'];
									}
								}
								else if ($resultado['color']=='ne') {
								$piene++;
								if ($resultado['gol']>0) {
											$golne+=$resultado['gol'];
										}
								}
							}
						
						}
						else if($resultado['marclocal']<$resultado['marcvisitante']) {
						if ($resultado['local']=='n') {
								if($resultado['color']=='na') {
								$ganana++;
									if ($resultado['gol']>0) {
										$golna+=$resultado['gol'];
									}
								}
								else if ($resultado['color']=='ne') {
								$ganane++;
									if ($resultado['gol']>0) {
											$golne+=$resultado['gol'];
										}
								}
							}
							else {
								if($resultado['color']=='na') {
								$piena++;
								if ($resultado['gol']>0) {
										$golna+=$resultado['gol'];
									}
								}
								else if ($resultado['color']=='ne') {
								$piene++;
								if ($resultado['gol']>0) {
											$golne+=$resultado['gol'];
										}
								}
							}
						}
						else {
						if($resultado['color']=='na') {
								$empna++;
								if ($resultado['gol']>0) {
										$golna+=$resultado['gol'];
									}
								}
								else if ($resultado['color']=='ne') {
								$empne++;
								if ($resultado['gol']>0) {
											$golne+=$resultado['gol'];
										}
								}
						}
						
						}
					}
	
	?></td>
	<td class="negro">Ne</td>
	<td class="naranja">Na</td>
	<td>Tot.</td>
	</tr>
	<tr>
	<td rowspan="4" style="vertical-align:inherit;">Partidos</td>
	</tr>
	<tr>
	<td>Gan.</td>
	<td class="negro"><?php echo $ganane; ?></td>
	<td  class="naranja"><?php echo $ganana; ?></td>
	<td><?php echo $ganane+$ganana; ?></td>
	</tr>
	<tr>
	<td>Emp.</td>
	<td class="negro"><?php echo $empne; ?></td>
	<td  class="naranja"><?php echo $empna; ?></td>
	<td><?php echo $empna+$empne; ?></td>
	</tr>
	<tr>
	<td>Per.</td>
	<td class="negro"><?php echo $piene; ?></td>
	<td  class="naranja"><?php echo $piena; ?></td>
	<td><?php echo $piena+$piene; ?></td>
	</tr>
	<tr>
	<td colspan="2">Goles</td>
	<td class="negro"><?php echo $golne; ?></td>
	<td  class="naranja"><?php echo $golna; ?></td>
	<td><?php echo $golna+$golne; ?></td>
	</tr>
	</table>
  </div>
</div>
<?php mysql_close ($conexion); ?>