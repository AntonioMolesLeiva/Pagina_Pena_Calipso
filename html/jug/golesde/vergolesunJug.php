<style>
th {text-align:center;vertical-align:middle !important;}
td {text-align:center;vertical-align:middle !important;}
</style>
	<?php
	include ('../../../php/conexion.php');

//echo $_POST['jugador'];
mysql_set_charset("utf8");
	$instruccion="SELECT p.fecha FROM partido p LEFT JOIN incidencia i ON p.fecha = i.fecha
WHERE jugador =  \"".$_POST['jugador']."\" and i.gol>0 ORDER BY p.fecha DESC";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");
	$nfilas = mysql_num_rows ($consulta);
	if ($nfilas>0) { ?> 
	<?php	
		for ($i=0; $i<$nfilas; $i++){
			$resultado = mysql_fetch_array ($consulta);
			$mes=substr($resultado['fecha'],5,2);
			$ano=substr($resultado['fecha'],0,4);
			//$dia=substr($resultado['fecha'],8,2);
			if ($mes>=9) {
				if($ano!=$cAno) {
					
					echo "
					<div class=\"table-responsive\">
					<table class=\"table table-striped\">
					<thead>
					<tr>
						<th colspan=\"6\">Temporada ".$ano."-".($ano+1)."</th>
					</tr>
					</thead>
					";
					$instruccion1="SELECT * FROM partido p LEFT JOIN incidencia i ON p.fecha = i.fecha WHERE p.fecha>=\"".$ano."-09-01\" AND p.fecha<=\"".($ano+1)."-06-30\" AND jugador =  \"".$_POST['jugador']."\" AND i.gol>0 ORDER BY p.fecha DESC";
					$consulta1 = mysql_query ($instruccion1, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion1");
					$nfilas1 = mysql_num_rows ($consulta1);
					if ($nfilas1>0) {
					echo "<tbody>
					<tr>
						<th>Fecha</th>
						<th>Local</th>
						<th>Marcador</th>
						<th>Visitante</th>
						<th>Goles</th>
						<th>Color</th>
					</tr>
					";
						for ($s=0; $s<$nfilas1; $s++){
							$resultado1=mysql_fetch_array ($consulta1);
							$mes1=substr($resultado1['fecha'],5,2);
							$ano1=substr($resultado1['fecha'],0,4);
							$dia1=substr($resultado1['fecha'],8,2);
							echo "<tr>
									<td>".$dia1."/".$mes1."/".$ano1."</td>";
							if ($resultado1['local']=='s') {
							
								if ($resultado1['color']=="na") {
									echo "<td><img src=\"../../img/adm/cnaranja.png\" /></td>
									<td><h2>".$resultado1['marclocal']." - ".$resultado1['marcvisitante']."</h2></td>
									<td><img src=\"../../img/adm/cnegra.png\" /></td>";
								}
								else {
									echo "<td><img src=\"../../img/adm/cnegra.png\" /></td>
									<td><h2>".$resultado1['marclocal']." - ".$resultado1['marcvisitante']."</h2></td>
									<td><img src=\"../../img/adm/cnaranja.png\" /></td>";
								}
							
							}
							
							else {
								if ($resultado1['color']=="na") {
									echo "<td><img src=\"../../img/adm/cnegra.png\" /></td>
									<td><h2>".$resultado1['marclocal']." - ".$resultado1['marcvisitante']."</h2></td>
									<td><img src=\"../../img/adm/cnaranja.png\" /></td>";
									}
									else {
									echo "<td><img src=\"../../img/adm/cnaranja.png\" /></td>
									<td><h2>".$resultado1['marclocal']." - ".$resultado1['marcvisitante']."</h2></td>
									<td><img src=\"../../img/adm/cnegra.png\" /></td>";
									}
							}
							
							echo "<td>".$resultado1['gol']."</td>
									<td>".$resultado1['color']."</td>
								</tr>";
						}
					echo "</tbody>";
					}
				$cAno=$ano;	
				echo "</table></div>";
				}
			}
			else if ($mes<=5) {
				if(($ano-1)!=$cAno) {
					echo "
					<div class=\"table-responsive\">
					<table class=\"table table-striped\">
					<thead>
					<tr>
						<th colspan=\"6\">Temporada ".($ano-1)."-".$ano."</th>
					</tr>
					</thead>
					";
					$instruccion1="SELECT * FROM partido p LEFT JOIN incidencia i ON p.fecha = i.fecha WHERE p.fecha>=\"".($ano-1)."-09-01\" AND p.fecha<=\"".$ano."-06-30\" AND jugador =  \"".$_POST['jugador']."\" AND i.gol>0 ORDER BY p.fecha DESC";
					$consulta1 = mysql_query ($instruccion1, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion1");
					$nfilas1 = mysql_num_rows ($consulta1);
					if ($nfilas1>0) {
					echo "<tbody>
					<tr>
						<th>Fecha</th>
						<th>Local</th>
						<th>Marcador</th>
						<th>Visitante</th>
						<th>Goles</th>
						<th>Color</th>
					</tr>";
						for ($s=0; $s<$nfilas1; $s++){
							$resultado1=mysql_fetch_array ($consulta1);
							$mes1=substr($resultado1['fecha'],5,2);
							$ano1=substr($resultado1['fecha'],0,4);
							$dia1=substr($resultado1['fecha'],8,2);
							echo "<tr>
									<td>".$dia1."/".$mes1."/".$ano1."</td>";
							if ($resultado1['local']=='s') {
							
								if ($resultado1['color']=="na") {
									echo "<td><img src=\"../../img/adm/cnaranja.png\" /></td>
									<td><h2>".$resultado1['marclocal']." - ".$resultado1['marcvisitante']."</h2></td>
									<td><img src=\"../../img/adm/cnegra.png\" /></td>";
								}
								else {
									echo "<td><img src=\"../../img/adm/cnegra.png\" /></td>
									<td><h2>".$resultado1['marclocal']." - ".$resultado1['marcvisitante']."</h2></td>
									<td><img src=\"../../img/adm/cnaranja.png\" /></td>";
								}
							
							}
							
							else {
								if ($resultado1['color']=="na") {
									echo "<td><img src=\"../../img/adm/cnegra.png\" /></td>
									<td><h2>".$resultado1['marclocal']." - ".$resultado1['marcvisitante']."</h2></td>
									<td><img src=\"../../img/adm/cnaranja.png\" /></td>";
									}
									else {
									echo "<td><img src=\"../../img/adm/cnaranja.png\" /></td>
									<td><h2>".$resultado1['marclocal']." - ".$resultado1['marcvisitante']."</h2></td>
									<td><img src=\"../../img/adm/cnegra.png\" /></td>";
									}
							}
							echo "<td>".$resultado1['gol']."</td>
									<td>".$resultado1['color']."</td>
								</tr>";
						}
					echo "</tbody>";
					}
				$cAno=($ano-1);
				}
			}
		} ?>

	<?php }
	else { ?>
<div class="jumbotron col-md-6 col-sm-6 col-md-offset-3 col-sm-offset-3" style="border-radius:20px;">
  <h1>Éste jugador aún no ha marcado en ninguna temporada</h1>
</div>
	<?php }

mysql_close ($conexion);
?>