	<?php
	include ('../../../php/conexion.php');
	
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

<div class="col-md-4 col-sm-4">
<div class="panel panel-info">
  <div class="panel-heading">
    <h3 class="panel-title">Estadísticas en números</h3>
  </div>
  <div class="panel-body">
<p>
  Partido con mayor diferencia de goles:<br />
  <?php

	$instruccion="SELECT fecha,ABS(marclocal-marcvisitante) AS DIF FROM partido WHERE fecha>=\"".($_POST['anomax']-1)."-09-01\" AND fecha<=\"".$_POST['anomax']."-06-30\" ORDER BY DIF DESC LIMIT 1";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");
	$nfilas = mysql_num_rows ($consulta);
	if($nfilas>0){
				$resultado = mysql_fetch_array ($consulta);
				echo substr($resultado['fecha'],8,2)."-".substr($resultado['fecha'],5,2)."-".substr($resultado['fecha'],0,4)."    (".$resultado['DIF']." goles).";
		}
	else echo "Aún no hay introducidos partidos en ésta temporada";
  ?><br />
  Partido con mas sanciones:<br />
  
  <?php
  $instruccion="SELECT fecha, COUNT( idsancion ) AS ntarjetas FROM incidencia
WHERE fecha>=\"".($_POST['anomax']-1)."-09-01\" AND fecha<=\"".$_POST['anomax']."-06-30\" GROUP BY fecha
ORDER BY ntarjetas DESC LIMIT 1";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");
	$nfilas = mysql_num_rows ($consulta);
	if($nfilas>0){
				$resultado = mysql_fetch_array ($consulta);
				echo substr($resultado['fecha'],8,2)."-".substr($resultado['fecha'],5,2)."-".substr($resultado['fecha'],0,4)."    (".$resultado['ntarjetas']." tarjetas).";
		}
	else echo "Aún no hay introducidos partidos en ésta temporada";
  ?><br />
  Media de jugadores por equipo:<br />
  <?php

  $instruccion="SELECT fecha, (
				COUNT( jugador ) /2
				)njugadores
				FROM incidencia
				WHERE fecha>=\"".($_POST['anomax']-1)."-09-01\" AND fecha<=\"".$_POST['anomax']."-06-30\"
				GROUP BY fecha
				ORDER BY njugadores DESC ";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");
	$nfilas = mysql_num_rows ($consulta);
	if($nfilas>0){
	$tot=0;
		for ($i=0; $i<$nfilas; $i++){
				$resultado = mysql_fetch_array ($consulta);
				$tot=$tot+$resultado['njugadores'];
				}
		echo round(($tot/$nfilas),2)." jugadores.";
		}
	else echo "Aún no hay introducidos partidos en ésta temporada";
  
  ?>
  </p>
  </div>
</div>
</div>
<?php
/*
SELECT fecha, COUNT( IF( posicion =  'A', 1, NULL ) ) AS narbi
FROM incidencia
WHERE fecha >=  "2013-09-01"
AND fecha <=  "2014-06-30"
GROUP BY fecha
ORDER BY fecha DESC 
*/
$instruccion="SELECT fecha, COUNT( IF( posicion =  'A', 1, NULL ) ) AS narbi
FROM incidencia
				WHERE fecha>=\"".($_POST['anomax']-1)."-09-01\" AND fecha<=\"".$_POST['anomax']."-06-30\"
				GROUP BY fecha
				ORDER BY fecha DESC ";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");
	$nfilas = mysql_num_rows ($consulta);
	if($nfilas>0){
	$totarb=0;
	$totsinarb=0;
		for ($i=0; $i<$nfilas; $i++){
		$resultado = mysql_fetch_array ($consulta);
		if ($resultado['narbi']>0) $totarb++;
		else $totsinarb++;
		}
	}

	$instruccion="SELECT caplocal,capvisitante FROM partido WHERE fecha>=\"".($_POST['anomax']-1)."-09-01\" AND fecha<=\"".$_POST['anomax']."-06-30\"";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");
	$nfilas = mysql_num_rows ($consulta);
	if ($nfilas>0) {
	$concap=0;
	$sincap=0;
	$algcap=0;
		for ($i=0; $i<$nfilas; $i++){
			$resultado = mysql_fetch_array ($consulta);
			if ($resultado['caplocal']!=""&&$resultado['capvisitante']!="") $concap++;
			else if ($resultado['caplocal']!=""&&$resultado['capvisitante']=="") $algcap++;
			else if ($resultado['caplocal']==""&&$resultado['capvisitante']!="") $algcap++;
			else $sincap++;
			}
		}

	$instruccion="SELECT estlocal,estvisitante FROM partido WHERE fecha>=\"".($_POST['anomax']-1)."-09-01\" AND fecha<=\"".$_POST['anomax']."-06-30\"";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");
	$nfilas = mysql_num_rows ($consulta);
	if ($nfilas>0) {
	$conestr=0;
	$sinestr=0;
	$algestr=0;
		for ($i=0; $i<$nfilas; $i++){
			$resultado = mysql_fetch_array ($consulta);
			if ($resultado['estlocal']!=""&&$resultado['estvisitante']!="") $conestr++;
			else if ($resultado['estlocal']!=""&&$resultado['estvisitante']=="") $algestr++;
			else if ($resultado['estlocal']==""&&$resultado['estvisitante']!="") $algestr++;
			else $sinestr++;
			}
		}
//		echo "<br />".$conestr." ".$sinestr." ".$algestr."<br />";

	$instruccion="SELECT p.fecha, p.marclocal, p.marcvisitante, i.local, i.color
				FROM partido p
				LEFT JOIN incidencia i ON p.fecha = i.fecha
				WHERE p.fecha>=\"".($_POST['anomax']-1)."-09-01\" AND p.fecha<=\"".$_POST['anomax']."-06-30\"
				GROUP BY fecha
				ORDER BY  p.fecha DESC ";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");
	$nfilas = mysql_num_rows ($consulta);
	if ($nfilas>0) {
	$totgolesnaranja=0;
	$totgolesnegro=0;
		for ($i=0; $i<$nfilas; $i++){
				$resultado = mysql_fetch_array ($consulta);
				if($resultado['local']=='s') {
					if ($resultado['color']=="ne") {
						$totgolesnegro=$totgolesnegro+$resultado['marclocal'];
						$totgolesnaranja=$totgolesnaranja+$resultado['marcvisitante'];
					}
					else if ($resultado['color']=="na"){
						$totgolesnaranja=$totgolesnaranja+$resultado['marclocal'];
						$totgolesnegro=$totgolesnegro+$resultado['marcvisitante'];
						
					}
				}
				else if($resultado['local']=='n') {
					
					if ($resultado['color']=="ne") {
						$totgolesnegro=$totgolesnegro+$resultado['marcvisitante'];
						$totgolesnaranja=$totgolesnaranja+$resultado['marclocal'];
					}
					else if($resultado['color']=="na"){
						$totgolesnaranja=$totgolesnaranja+$resultado['marcvisitante'];
						$totgolesnegro=$totgolesnegro+$resultado['marclocal'];
						
					}
				}
		}
	}
 ?>
<script>
$(function () {
    $('#arbi').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: 1,//null,
            plotShadow: false
        },
        title: {
            text: 'Presencia de árbitro en los equipos'
        },
         subtitle: {
        text: 'En cuantos partidos hemos tenido árbitro'
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
                    }
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Nº Partidos',
            data: [
                ['Con',<?php echo $totarb; ?>],
                ['Sin',<?php echo $totsinarb; ?>]
              
            ]
        }]
    });
});
$(function () {
    $('#cap').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: 1,//null,
            plotShadow: false
        },
        title: {
            text: 'Presencia de capitán en los equipos'
        },
         subtitle: {
        text: 'En cuantos partidos hemos tenido capitanes'
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
                    }
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Nº Partidos',
            data: [
                ['Con',<?php echo $concap; ?>],
                ['Sin',<?php echo $sincap; ?>],
                ['alguno',<?php echo $algcap; ?>]
              
            ]
        }]
    });
});
$(function () {
    $('#estr').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: 1,//null,
            plotShadow: false
        },
        title: {
            text: 'Partidos con estrategia'
        },
         subtitle: {
        text: 'En cuantos partidos ha habido alguna estrategia'
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
                    }
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Nº Partidos',
            data: [
                ['Con',<?php echo $conestr; ?>],
                ['Sin',<?php echo $sinestr; ?>],
                ['alguno',<?php echo $algestr; ?>]
              
            ]
        }]
    });
});
$(function () {
        $('#totGoles').highcharts({
            chart: {
                type: 'bar'
            },
            title: {
                text: 'Total de goles por color'
            },
            subtitle: {
                text: '(Goles de la <?php echo "Temp ".($_POST['anomax']-1)." / ".$_POST['anomax']; ?>)'
            },
            xAxis: {
                categories: ['Equipos'],
                title: {
                    text: null
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Goles',
                    align: 'high'
                },
                labels: {
                    overflow: 'justify'
                }
            },
            tooltip: {
                valueSuffix: ' goles'
            },
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: true
                    }
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -40,
                y: 40,
                floating: true,
                borderWidth: 1,
                backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor || '#FFFFFF'),
                shadow: true
            },
            credits: {
                enabled: false
            },
            series: [{
				name:'Naranja',
                data: [<?php echo $totgolesnaranja; ?>],
				color: '#f26721'
            },
			{
				name:'Negro',
                data: [<?php echo $totgolesnegro; ?>],
				color: '#000'
            }]
        });
    });
</script>
<div id="arbi" class="col-md-4 col-sm-4" style="height:300px;">

</div>
<div id="cap" class="col-md-4 col-sm-4" style="height:300px;">

</div>
<div id="estr" class="col-md-6 col-sm-6" style="height:300px;">

</div>
<div id="totGoles" class="col-md-6 col-sm-6" style="height:300px;">

</div>

<?php
mysql_close ($conexion);
?>