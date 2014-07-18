<script>
$(document).ready(function() {

	$("#selectTempTrof li a").click(function(){
			//alert("¿Quieres visitar la temporada?"+$(this).attr("id"));
		$.post( "./estadisticas/estpartidotemp.php", { 'anomax':$(this).attr("id")}, function (data) { 
			$("#infopartido").html(data); //Se muestra el resultado de la operación en la clase 
			});
		});
});
</script>
<div class="col-md-3 col-sm-4">
<div class="panel panel-default negroTransparente">
  <div id="cabeceraSelectPartidos" class="panel-heading" style="text-align:center;">Temporadas</div>
  <div class="panel-body " style="height:480px;overflow:auto;">
	<?php
	include ('../../php/conexion.php');
	
	mysql_set_charset("utf8");
	$instruccion="SELECT fecha FROM partido ORDER BY fecha DESC";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");
	$nfilas = mysql_num_rows ($consulta);
	if ($nfilas>0) { ?>
	<ul id="selectTempTrof">
	
	<?php	
		for ($i=0; $i<$nfilas; $i++){
			$resultado = mysql_fetch_array ($consulta);
			$mes=substr($resultado['fecha'],5,2);
			$ano=substr($resultado['fecha'],0,4);
			$dia=substr($resultado['fecha'],8,2);
			if ($mes>=9) {
				if($ano!=$cAno) {
					echo "
					<li>
					<a id=\"".($ano+1)."\" class=\"buttontemp azul\">Temporada ".$ano." - ".($ano+1)."</a>
					</li>";
					}
				$cAno=$ano;	
				}
			else if ($mes<=5) {
				if(($ano-1)!=$cAno) {
					echo "<li>
					<a id=\"".$ano."\" class=\"buttontemp azul\">	Temporada ".($ano-1)." - ".$ano."</a>
					</li>";
					
				$cAno=($ano-1);
				}
			}
			
		} 
		?>
		</ul>
		<?php
		}?>
	
  </div>
</div>
</div>
<div id="infopartido" class="col-md-9 col-sm-9" style="min-height:536px;background-color:rgba(12,12,12,0.3);">
<?php
/*TOT GOLES POR COLOR*/
	$instruccion="SELECT p.fecha, p.marclocal, p.marcvisitante, i.local, i.color
				FROM partido p
				LEFT JOIN incidencia i ON p.fecha = i.fecha
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
/* /TOT GOLES POR COLOR/ */

/* PARTIDOS CON-SIN CAP */

$instruccion="SELECT caplocal,capvisitante FROM partido";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");
	$nfilas = mysql_num_rows ($consulta);
	if ($nfilas>0) {
	$concap=0;
	$sincap=0;
		for ($i=0; $i<$nfilas; $i++){
			$resultado = mysql_fetch_array ($consulta);
			if ($resultado['caplocal']!=""&&$resultado['capvisitante']!="") {
			$concap++;
			}
			else {
			$sincap++;
			}
			}
		}
/* /PARTIDOS CON-SIN CAP/ */

/* PARTIDOS CON-SIN ESTR */

$instruccion1="SELECT estlocal,estvisitante FROM partido";
	$consulta1 = mysql_query ($instruccion1, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");
	$nfilas = mysql_num_rows ($consulta1);
	if ($nfilas>0) {
	$conest=0;
	$sinest=0;
	$algest=0;
		for ($i=0; $i<$nfilas; $i++){
			$resultado1 = mysql_fetch_array ($consulta1);
			if ($resultado1['estlocal']!=""&&$resultado1['estvisitante']!="") {
			$conest++;
			}
			else if ($resultado1['estlocal']!=""&&$resultado1['estvisitante']=="") {
			$algest++;
			}
			else if ($resultado1['estlocal']==""&&$resultado1['estvisitante']!="") {
			$algest++;
			}
			else if($resultado1['estlocal']==""&&$resultado1['estvisitante']=="") {
			$sinest++;
			}
			  }	
		 
		 }
//echo "<p style=\"color:White;\"> concap-> ".$concap." sincap-> ".$sincap."concap->".$concap."concap-> ".$concap."concap-> ".$concap."</p>"
/* /PARTIDOS CON-SIN ESTR/ */
 ?>

<script>
$(function () {
        $('#totGoles').highcharts({
            chart: {
                type: 'bar'
            },
            title: {
                text: 'Total de goles por color'
            },
            subtitle: {
                text: '(Goles de todas las temporadas)'
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
                y: 20,
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
	
	
$(function () {
    $('#capitan').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: 1,//null,
            plotShadow: false
        },
        title: {
            text: 'Presencia de capitanes en los equipos'
        },
         subtitle: {
        text: 'Qué porcentaje de equipos que han tenido ambos capitanes'
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
                ['Con capitán',<?php echo $concap; ?>],
                ['Sin capitán',<?php echo $sincap; ?>]
              
            ]
        }]
    });
});

$(function () {
    $('#estrategia').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: 1,//null,
            plotShadow: false
        },
        title: {
            text: 'Estrategia de los partidos'
        },
         subtitle: {
        text: 'Partidos con y sin estrategia.'
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
                ['Con estrategia',<?php echo $conest; ?>],
                ['Sin estrategia',<?php echo $sinest; ?>],
				['con alguna estrategia',<?php echo $algest; ?>]
              
            ]
        }]
    });
});
	
</script>
<div id="totGoles" class="col-md-12 col-sm-12" style="height:300px;">
</div>
<div id="capitan" class="col-md-6 col-sm-6" style="height:300px;"></div>
<div id="estrategia" class="col-md-6 col-sm-6" style="height:300px;"></div>
</div>
<?php 
mysql_close ($conexion);
?>

