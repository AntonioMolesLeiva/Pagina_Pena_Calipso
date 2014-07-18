<?php 
/*
$_POST['jugador']
$_POST['partido']
*/
include ('../../../php/conexion.php');

				$instruccion="SELECT 3p AS jugador, COUNT( * ) AS npuntos3
		FROM  incidencia
		WHERE fecha =  \"".$_POST['partido']."\"
		AND 3p =  \"".$_POST['jugador']."\"
		GROUP BY 3p";
		//echo $instruccion."<br />";
						$consulta1 = mysql_query ($instruccion, $conexion)
									or die ("FALLO EN LA CONSULTA $instruccion");
			$jug3puntos=mysql_fetch_array ($consulta1);

		$instruccion="SELECT 2p AS jugador, COUNT( * ) AS npuntos2
		FROM  incidencia
		WHERE fecha =  \"".$_POST['partido']."\"
		AND 2p =  \"".$_POST['jugador']."\"
		GROUP BY 2p";
		//echo $instruccion."<br />";		
			$consulta1 = mysql_query ($instruccion, $conexion)
									or die ("FALLO EN LA CONSULTA $instruccion");
			$jug2puntos=mysql_fetch_array ($consulta1);
		
		$instruccion="SELECT 1p AS jugador, COUNT( * ) AS npuntos1
		FROM  incidencia 
		WHERE fecha =  \"".$_POST['partido']."\"
		AND 1p =  \"".$_POST['jugador']."\"
		GROUP BY 1p";
		//echo $instruccion."<br />";
						$consulta1 = mysql_query ($instruccion, $conexion)
									or die ("FALLO EN LA CONSULTA $instruccion");
			$jug1puntos=mysql_fetch_array ($consulta1);
			$npuntos3=$jug3puntos['npuntos3'];
			if ($npuntos3=="") $npuntos3=0;
			$npuntos2=$jug2puntos['npuntos2'];
			if ($npuntos2=="") $npuntos2=0;
			$npuntos1=$jug1puntos['npuntos1'];
			if ($npuntos1=="") $npuntos1=0;
			/*echo "Partido=".$_POST['partido']."<br />
			3Puntos=".$npuntos3." 2Puntos=".$npuntos2." 1Puntos=".$npuntos1.
			"<br/>Total puntos:<br />
			3Puntos=".($npuntos3*3)." 2Puntos=".($npuntos2*2)." 1Puntos=".$npuntos1."<br />"
			;*/
if ($npuntos3==0&&$npuntos2==0&&$npuntos1==0) {			
?>
<div class="well well-sm">En éste partido no obtuvo puntos</div>
<?php
}
else {
?>
<script>
$(document).ready(function() {
   
		// Build the chart
        var chart2 = new Highcharts.Chart({
            chart: {
				renderTo: 'gCirculo',
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: 'reparto de los puntos al jugador'
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
                name: 'Puntos',
                data: [
                    ['3 puntos', <?php echo ($npuntos3*3);  ?>],
                    ['2 Puntos', <?php echo ($npuntos2*2);  ?>],
                    ['1 Punto',<?php echo $npuntos1;  ?>]                    
                ]
            }]
        });
    });
	</script>
	
	<?php
	}

mysql_close ($conexion);
	?>