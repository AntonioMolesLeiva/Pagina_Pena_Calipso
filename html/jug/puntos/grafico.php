<div id="miChart" class="col-md-12 col-sm-12 col-xs-12" style="height:300px;">

<?php
	include ('../../../php/conexion.php');
	/*
	$_POST['jugador'];
	$_POST['temp'];
	*/
	/*$instruccion="SELECT 3p AS jugador, COUNT( * ) AS npuntos3
		FROM  incidencia
		WHERE fecha >=  \"".($_POST['temp']-1)."-09-01\"
		AND fecha <=  \"".$_POST['temp']."-06-30\"
		AND 3p =  \"".$_POST['jugador']."\"
		GROUP BY 3p";
						$consulta = mysql_query ($instruccion, $conexion)
									or die ("FALLO EN LA CONSULTA $instruccion");
			$jug3puntos=mysql_fetch_array ($consulta);

		$instruccion="SELECT 2p AS jugador, COUNT( * ) AS npuntos2
		FROM  incidencia
		WHERE fecha >=  \"".($_POST['temp']-1)."-09-01\"
		AND fecha <=  \"".$_POST['temp']."-06-30\"
		AND 2p =  \"".$_POST['jugador']."\"
		GROUP BY 2p";
						$consulta = mysql_query ($instruccion, $conexion)
									or die ("FALLO EN LA CONSULTA $instruccion");
			$jug2puntos=mysql_fetch_array ($consulta);
		
		$instruccion="SELECT 1p AS jugador, COUNT( * ) AS npuntos1
		FROM  incidencia 
		WHERE fecha >=  \"".($_POST['temp']-1)."-09-01\"
		AND fecha <=  \"".$_POST['temp']."-06-30\"
		AND 1p =  \"".$_POST['jugador']."\"
		GROUP BY 1p";
						$consulta = mysql_query ($instruccion, $conexion)
									or die ("FALLO EN LA CONSULTA $instruccion");
			$jug1puntos=mysql_fetch_array ($consulta);
	$npuntos3=$jug3puntos['npuntos3'];
	$npuntos2=$jug2puntos['npuntos2'];
	$npuntos1=$jug1puntos['npuntos1'];*/
		
	$instruccion="SELECT fecha
		FROM  incidencia
		WHERE fecha >=  \"".($_POST['temp']-1)."-09-01\"
		AND fecha <=  \"".$_POST['temp']."-06-30\"
		AND jugador =  \"".$_POST['jugador']."\"";
						$consulta1 = mysql_query ($instruccion, $conexion)
									or die ("FALLO EN LA CONSULTA $instruccion");
		$nfilas = mysql_num_rows ($consulta1);
			
	
	?>
</div>
<script>
$(document).ready(function() {
    var chart1 = new Highcharts.Chart({
			chart: {
            renderTo: 'miChart',
            type: 'line'
			},
            title: {
                text: 'Puntos del jugador',
                x: -20 //center
            },
			subtitle: {
			text: 'AÑO/MES/DIA',
			 x: -20 //center
			},
            xAxis: {
                categories: [<?php
				for($i=0;$i<$nfilas;$i++){
				$fechasjug=mysql_fetch_array ($consulta1);
				if($i+1==$nfilas) echo "'".$fechasjug['fecha']."'";
				else echo "'".$fechasjug['fecha']."',";
				}
				?>],
					max:<?php echo $nfilas-1; ?>
            },
            yAxis: {
                title: {
                    text: 'Puntos'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }],
				tickInterval: 10
            },
			plotOptions: {
                series: {
                    cursor: 'pointer',
					allowPointSelect: true,
                    point: {
                        events: {
                            click: function () {
                                //alert('jugador:<?php echo $_POST['jugador']; ?>partido:'+this.category);
								$.post( "./puntos/graficoCircular.php", {'jugador':'<?php echo $_POST['jugador']; ?>','partido':this.category}, function (data) { 
								$("#gCirculo").html(data); //Se muestra el resultado de la operación en la clase 
								});
								
								
                            }
                        }
                    }
					}
				},
            tooltip: {
				crosshairs: [true]
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: [{
                name: <?php
					$instruccion="SELECT alias	FROM  jugador	WHERE dni =  \"".$_POST['jugador']."\"";
						$consulta = mysql_query ($instruccion, $conexion)
									or die ("FALLO EN LA CONSULTA $instruccion");
					$aliasjug=mysql_fetch_array ($consulta);
					echo "'".$aliasjug['alias']."'";
				?> ,
                data: [<?php
					$instruccion="SELECT fecha
		FROM  incidencia
		WHERE fecha >=  \"".($_POST['temp']-1)."-09-01\"
		AND fecha <=  \"".$_POST['temp']."-06-30\"
		AND jugador =  \"".$_POST['jugador']."\"";
						$consulta = mysql_query ($instruccion, $conexion)
									or die ("FALLO EN LA CONSULTA $instruccion");
		$nfilas = mysql_num_rows ($consulta);
			
		$instruccion="SELECT fecha
		FROM  incidencia
		WHERE fecha >=  \"".($_POST['temp']-1)."-09-01\"
		AND fecha <=  \"".$_POST['temp']."-06-30\"
		AND jugador =  \"".$_POST['jugador']."\"";
		//echo $instruccion."<br />";
						$consulta = mysql_query ($instruccion, $conexion)
									or die ("FALLO EN LA CONSULTA $instruccion");
		$nfilas = mysql_num_rows ($consulta);
		$totalpuntos=0;
		for($i=0;$i<$nfilas;$i++){
				//fecha de los partidos que ha jugado el jugador X
				$fechaJUG=mysql_fetch_array ($consulta);

				$instruccion="SELECT 3p AS jugador, COUNT( * ) AS npuntos3
		FROM  incidencia
		WHERE fecha =  \"".$fechaJUG['fecha']."\"
		AND 3p =  \"".$_POST['jugador']."\"
		GROUP BY 3p";
		//echo $instruccion."<br />";
						$consulta1 = mysql_query ($instruccion, $conexion)
									or die ("FALLO EN LA CONSULTA $instruccion");
			$jug3puntos=mysql_fetch_array ($consulta1);

		$instruccion="SELECT 2p AS jugador, COUNT( * ) AS npuntos2
		FROM  incidencia
		WHERE fecha =  \"".$fechaJUG['fecha']."\"
		AND 2p =  \"".$_POST['jugador']."\"
		GROUP BY 2p";
		//echo $instruccion."<br />";		
			$consulta1 = mysql_query ($instruccion, $conexion)
									or die ("FALLO EN LA CONSULTA $instruccion");
			$jug2puntos=mysql_fetch_array ($consulta1);
		
		$instruccion="SELECT 1p AS jugador, COUNT( * ) AS npuntos1
		FROM  incidencia 
		WHERE fecha =  \"".$fechaJUG['fecha']."\"
		AND 1p =  \"".$_POST['jugador']."\"
		GROUP BY 1p";
		//echo $instruccion."<br />";
						$consulta1 = mysql_query ($instruccion, $conexion)
									or die ("FALLO EN LA CONSULTA $instruccion");
			$jug1puntos=mysql_fetch_array ($consulta1);
			$npuntos3=$jug3puntos['npuntos3'];
			$npuntos2=$jug2puntos['npuntos2'];
			$npuntos1=$jug1puntos['npuntos1'];
			/*echo "Partido=".$fechaJUG['fecha']."<br />
			3Puntos=".$npuntos3." 2Puntos=".$npuntos2." 1Puntos=".$npuntos1.
			"<br/>Total puntos:<br />
			3Puntos=".($npuntos3*3)." 2Puntos=".($npuntos2*2)." 1Puntos=".$npuntos1."<br />"
			;*/
			
			$totalpuntos+=($npuntos3*3)+($npuntos2*2)+$npuntos1;
				if($i+1==$nfilas) echo $totalpuntos;
				else echo $totalpuntos.",";
				}
				?>
]
            }]
        });
	});
	

</script>
<div id="gCirculo" class="col-md-12 col-sm-12 col-xs-12" style="height:218px;">

</div>
<?php mysql_close ($conexion); ?>