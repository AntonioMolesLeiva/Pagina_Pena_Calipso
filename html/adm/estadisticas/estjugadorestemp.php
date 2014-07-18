<script src="../../js/adm/drilldown.js"></script>
<div class="col-md-12 col-sm-12">
	<?php
	include ('../../../php/conexion.php');
	/*$instruccion="SELECT dni,alias,posicionhab FROM jugador ORDER BY alias ASC";
						$consulta = mysql_query ($instruccion, $conexion)
									or die ("FALLO EN LA CONSULTA $instruccion");
					$nfilas = mysql_num_rows ($consulta);
	if($nfilas>0) {
		for($i=0;$i<$nfilas;$i++){
		$resultado=mysql_fetch_array ($consulta);
		}
	}*/
	
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
			$alias[$i]=$resultado['alias'];
			$ganados[$i]=$gan;
			$empatados[$i]=$emp;
			$perdidos[$i]=$per;
			}
	
	}
	
	
	//echo $_POST['anomax'];
	
$instruccion="SELECT 3p, COUNT( * ) AS num
FROM incidencia
WHERE fecha>=\"".($_POST['anomax']-1)."-09-01\" AND fecha<=\"".$_POST['anomax']."-06-30\"
GROUP BY 3p IS NOT NULL ";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");
	
	$nfilas = mysql_num_rows ($consulta);
	if ($nfilas>0) { 
		for ($i=0; $i<$nfilas; $i++){
		$resultado=mysql_fetch_array($consulta);
		if($i==0) $no3p=$resultado['num'];
			else $si3p=$resultado['num'];
		}
	}
$instruccion="SELECT 2p, COUNT( * ) AS num
FROM incidencia
WHERE fecha>=\"".($_POST['anomax']-1)."-09-01\" AND fecha<=\"".$_POST['anomax']."-06-30\"
GROUP BY 2p IS NOT NULL";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");
	
	$nfilas = mysql_num_rows ($consulta);
	if ($nfilas>0) { 
		for ($i=0; $i<$nfilas; $i++){
		$resultado=mysql_fetch_array($consulta);
		if($i==0) $no2p=$resultado['num'];
			else $si2p=$resultado['num'];
		}
	}
$instruccion="SELECT 1p, COUNT( * ) AS num
FROM incidencia
WHERE fecha>=\"".($_POST['anomax']-1)."-09-01\" AND fecha<=\"".$_POST['anomax']."-06-30\"
GROUP BY 1p IS NOT NULL";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");
	
	$nfilas = mysql_num_rows ($consulta);
	if ($nfilas>0) { 
		for ($i=0; $i<$nfilas; $i++){
		$resultado=mysql_fetch_array($consulta);
		if($i==0) $no1p=$resultado['num'];
			else $si1p=$resultado['num'];
		}
	}
	
$instruccion="SELECT i.idsancion,texto,count(idcuota) AS num FROM incidencia i LEFT JOIN cuota c ON i.idsancion=c.idcuota WHERE fecha>=\"".($_POST['anomax']-1)."-09-01\" AND fecha<=\"".$_POST['anomax']."-06-30\" GROUP BY i.idsancion";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");
	
	$nfilas = mysql_num_rows ($consulta);
	if ($nfilas>0) { 
		$j=0;
		for ($i=0; $i<$nfilas; $i++){
			$resultado=mysql_fetch_array($consulta);
			if($resultado['idsancion']!="") {
				$text[$j]=$resultado['texto'];
				$num[$j]=$resultado['num'];
				$j++;
			}
		}
	}
mysql_close ($conexion);
?>
<script>
$(function () {
        $('#partidos').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Partidos de los jugadores activos'
            },
            subtitle: {
                text: 'partidos ganados, empatados y perdidos. (Temp <?php echo ($_POST['anomax']-1)." / ".$_POST['anomax']; ?>) '
            },
            xAxis: {
                categories: [
                    <?php
					for($i=0;$i<count($alias);$i++) {
					 if (($i+1)==count($alias))  echo "'".$alias[$i]."'";
					 else echo "'".$alias[$i]."',";
					}
					?>
                ]
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Nº Partidos'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y} partidos</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Ganado',
                data: [<?php
					for($i=0;$i<count($ganados);$i++) {
					 if (($i+1)==count($ganados))  echo $ganados[$i];
					 else echo $ganados[$i].",";
					}
					?>],color:'#0f0'
    
            }, {
                name: 'Empatado',
                data: [<?php
					for($i=0;$i<count($empatados);$i++) {
					 if (($i+1)==count($empatados))  echo $empatados[$i];
					 else echo $empatados[$i].",";
					}
					?>],color:'#00a'
    
            }, {
                name: 'Perdido',
                data: [<?php
					for($i=0;$i<count($perdidos);$i++) {
					 if (($i+1)==count($perdidos))  echo $perdidos[$i];
					 else echo $perdidos[$i].",";
					}
					?>],color:'#a00'
    
            }]
        });
    });

Highcharts.setOptions({
    lang: {
        drillUpText: '< Volver a {series.name}'
    }
});
	var options = {

    chart: {
        height: 300
    },
    
    title: {
        text: 'Puntos'
    },
	subtitle: {
        text: 'puntos dados y no dados (Temp <?php echo ($_POST['anomax']-1)." / ".$_POST['anomax']; ?>)'
    },
    xAxis: {
        categories: true
    },
    
    drilldown: {
        series: [{
            id: 'dados',
            name: 'dados',
            data: [
                ['3puntos',<?php echo ($si3p*3); ?>],
                ['2puntos', <?php echo ($si2p*2); ?>],
                ['1punto', <?php echo $si1p; ?>]

            ]
        }, {
            id: 'nodados',
            name: 'no dados',
            data: [
            ['3puntos',<?php echo ($no3p*3); ?>],
                ['2puntos', <?php echo ($no2p*2); ?>],
                ['1punto', <?php echo $no1p; ?>]
            ]
        }]
    },
    
    legend: {
        enabled: false
    },
    
    plotOptions: {
        series: {
            dataLabels: {
                enabled: true
            },
            shadow: false
        },
        pie: {
            size: '80%',
			allowPointSelect: true,
                cursor: 'pointer',
               dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %'
					}
        }
    },
    
    series: [{
        name: 'Puntos',
        colorByPoint: true,
        data: [{
            name: 'dados',
            y: <?php echo (($si3p*3)+($si2p*2)+$si1p); ?>,
            drilldown: 'dados'
        }, {
            name: 'no dados',
            y: <?php echo (($no3p*3)+($no2p*2)+$no1p); ?>,
            drilldown: 'nodados'
        }]/*,startAngle: 90*/
    }]
};
// Pie
options.chart.renderTo = 'puntos';
options.chart.type = 'pie';
var chart2 = new Highcharts.Chart(options);

$(function () {
		
		// Build the chart
        $('#tarjetas').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: 'Tarjetas'
            },
           subtitle: {
                text: '% de tarjetas (Temp <?php echo ($_POST['anomax']-1)." / ".$_POST['anomax']; ?>)'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.y}</b>'
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
                name: 'Nº jugadores',
                data: [
                    /*['Con foto', <?php echo 5; ?>],
                    ['Sin foto',<?php echo 20; ?>]*/
					<?php 
					for($i=0;$i<count($text);$i++) {
					if (($i+1)==count($text)) echo "['".$text[$i]."',".$num[$i]."]";
					else echo "['".$text[$i]."',".$num[$i]."],";
					}

					?>
                ]
            }]
        });
});
</script>
<div class="col-md-12 col-sm-12" style="overflow-y:hidden;overflow-x:auto;height:309px;padding:0px;">
<div id="partidos" class="col-md-12 col-sm-12" style="width:945px;height:300px;">
</div>
</div>
<div id="puntos" class="col-md-6 col-sm-6" style="height:300px;">
</div>
<div id="tarjetas" class="col-md-6 col-sm-6" style="height:300px;">
</div>

</div>