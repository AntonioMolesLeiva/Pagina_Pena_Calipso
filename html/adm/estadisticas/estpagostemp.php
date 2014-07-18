	<?php
	include ('../../../php/conexion.php');
	//echo $_POST['anomax'];
	mysql_set_charset("utf8");
	/*$instruccion="SELECT fecha,marclocal,marcvisitante,ABS(marclocal-marcvisitante) AS DIF FROM partido WHERE fecha>=\"2013-09-01\" AND fecha<=\"2014-06-30\" ORDER BY DIF DESC LIMIT 1";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");
	$nfilas = mysql_num_rows ($consulta);
	if($nfilas>0){
		for ($i=0; $i<$nfilas; $i++){
				$resultado = mysql_fetch_array ($consulta);
				}
		}*/
?>

<div class="col-md-6 col-sm-6" style="height:300px;overflow-y:auto;">
<div class="panel panel-danger">
  <div class="panel-heading">
    <h3 class="panel-title">Top 10 morosos</h3>
  </div>
  <div class="panel-body">
    <table class="table table-striped">
	<thead>
		<tr>
			<th style="text-align:center;">#</th>
			<th style="text-align:center;">Alias</th>
			<th style="text-align:center;">Valor</th>
		</tr>
	</thead>
	<tbody>
	<?php
		$instruccion="SELECT d.jugador,j.alias, (
		IFNULL( SUM( acuenta ) , 0 ) - SUM( c.precio )
		) AS monto
		FROM deudas d
		LEFT JOIN cuota c ON d.idcuota = c.idcuota
		LEFT JOIN pagos p ON d.ideuda = p.ideuda
		LEFT JOIN jugador j ON d.jugador=j.dni
		WHERE d.fechadeuda>=\"".($_POST['anomax']-1)."-09-01\" AND d.fechadeuda<=\"".$_POST['anomax']."-06-30\"
		GROUP BY d.jugador
		ORDER BY monto ASC LIMIT 1, 10";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");
	$nfilas = mysql_num_rows ($consulta);
	if ($nfilas>0) {
		for ($i=0; $i<$nfilas; $i++){
			$resultado = mysql_fetch_array ($consulta);
			echo "
			<tr>
				<td>".($i+1)."</td>
				<td>".$resultado['alias']."</td>
				<td>".$resultado['monto']."&nbsp;€</td>
			</tr>
			";
			}
	}
	else {
	echo "
			<tr>
				<td colspan=\"3\">No hay resultados</td>

			</tr>
			";
	}
	?>
	</tbody>
	</table>
  </div>
</div>
</div>

<div id="" class="col-md-6 col-sm-6" style="height:300px;">
<div class="panel panel-warning">
  <div class="panel-heading">
    <h3 class="panel-title">Meses con mas deudas</h3>
  </div>
  <div class="panel-body">
    <?php
	$mes=array(1=>"Enero",2=>"Febrero",3=>"Marzo",4=>"Abril",5=>"Mayo",6=>"Junio",9=>"Septiembre",10=>"Octubre",11=>"Noviembre",12=>"Diciembre");
	?>
	<table class="table table-striped">
	<thead>
		<tr>
			<th style="text-align:center;">#</th>
			<th style="text-align:center;">Mes</th>
			<th style="text-align:center;">Deuda</th>
		</tr>
	</thead>
	<tbody>
	<?php
		$instruccion="SELECT SUM( precio ) AS debe, SUBSTRING( fechadeuda, 6, 2 ) AS mes
					FROM deudas d
					LEFT JOIN cuota c ON d.idcuota = c.idcuota
					WHERE  d.fechadeuda>=\"".($_POST['anomax']-1)."-09-01\" AND d.fechadeuda<=\"".$_POST['anomax']."-06-30\"
					AND pagado =  \"n\"
					GROUP BY SUBSTRING( fechadeuda, 6, 2 ) 
					ORDER BY debe DESC";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");
	$nfilas = mysql_num_rows ($consulta);
	if ($nfilas>0) {
		for ($i=0; $i<$nfilas; $i++){
			$resultado = mysql_fetch_array ($consulta);
			echo "
			<tr>
				<td>".($i+1)."</td>
				<td>".$mes[(int)$resultado['mes']]."</td>
				<td>".$resultado['debe']."&nbsp;€</td>
			</tr>
			";
			}
	}
	else {
	echo "
			<tr>
				<td colspan=\"3\">No hay resultados</td>

			</tr>
			";
	}
	?>
	</tbody>
	</table>
  </div>
</div>
</div>

<div id="" class="col-md-12 col-sm-12" style="height:500px;">
<div class="panel panel-success">
  <div class="panel-heading">
    <h3 class="panel-title">% deudas de las cuotas</h3>
  </div>
  <div id="mnspagadas" class="panel-body">
    Panel content<br />
	<?php 
	/*
	SELECT c.texto,c.idcuota, SUM( precio ) , pagado
FROM deudas d
LEFT JOIN cuota c ON d.idcuota = c.idcuota
WHERE  d.fechadeuda>=\"".($_POST['anomax']-1)."-09-01\" AND d.fechadeuda<=\"".$_POST['anomax']."-06-30\"
GROUP BY c.idcuota, pagado
ORDER BY d.idcuota ASC , d.pagado DESC 
	*/
	$comp='a';
	$j=0;
	$instruccion="SELECT c.texto,c.idcuota, SUM( precio ) as num , pagado
				FROM deudas d
				LEFT JOIN cuota c ON d.idcuota = c.idcuota
				WHERE  d.fechadeuda>=\"".($_POST['anomax']-1)."-09-01\" AND d.fechadeuda<=\"".$_POST['anomax']."-06-30\"
				GROUP BY c.idcuota, pagado
				ORDER BY d.idcuota ASC , d.pagado DESC";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");
	$nfilas = mysql_num_rows ($consulta);
	if ($nfilas>0) {
		for ($i=0; $i<$nfilas; $i++){
			$resultado = mysql_fetch_array ($consulta);
			if($comp==$resultado['idcuota']) {
			$tot[($j-1)][1]=round(($tot[($j-1)][1]-$resultado['num']),2);
			}
			 else {
			$tot[$j]=array($resultado['texto'],$resultado['num']);
			$j++;
			$comp=$resultado['idcuota'];
			}
		}
	?>
	<script>
		$(function () {
		
		// Build the chart
        $('#mnspagadas').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: '% deudas sobre cuotas'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.y} €</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                        style: {
                            color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                        },
                        connectorColor: 'silver'
                    }
                }
            },
            series: [{
                type: 'pie',
                name: 'Deuda',
                data: [
				<?php
				for($i=0;$i<count($tot);$i++) {
					if(($i+1)==count($tot))	echo "['".$tot[$i][0]."',".$tot[$i][1]."]";
					else echo "['".$tot[$i][0]."',".$tot[$i][1]."],";
					
					}

				?>
                ]
            }]
        });
    });
	</script>
	<?php
	}
	else {
	echo "No hay datos";
	}
	?>
  </div>
</div>
</div>


<?php
mysql_close ($conexion);
?>