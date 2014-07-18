	<?php
	//echo "<p>anomax->".$_POST['anomax']." idjuag->".$_POST['idjug']."</p>";
	
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
	
?>
<div class="col-md-6 col-sm-6" style="height:300px;border-bottom:3px solid orange;border-right:3px solid orange;border-radius:5px;overflow-y:auto;">
<div class="table-responsive">
  <table class="table table-striped">
   <thead>
   <tr>
   <th colspan="3"><h4>Nº de veces que ha jugado con los siguientes jugadores</h4></th>
   </tr>
   <tr>
   <th  style="text-align:center;">#</th>
   <th  style="text-align:center;">Alias</th>
   <th  style="text-align:center;">Nº veces</th>
   </tr>
   </thead>
   <tbody>
   <?php
	$instruccion="SELECT j.alias,COUNT(*) as num FROM incidencia i LEFT JOIN (
					SELECT fecha as fecharr FROM incidencia WHERE jugador=\"".$_POST['idjug']."\"
					) AS i1 ON i.fecha=i1.fecharr
					LEFT JOIN jugador j ON i.jugador=j.dni
					WHERE i.fecha>=\"".($_POST['anomax']-1)."-09-01\" AND i.fecha<=\"".$_POST['anomax']."-06-30\" AND i.jugador<>\"".$_POST['idjug']."\"
					GROUP BY i.jugador
					ORDER BY num DESC";
							$consulta = mysql_query ($instruccion, $conexion)
										or die ("FALLO EN LA CONSULTA $instruccion");
						$nfilas = mysql_num_rows ($consulta);
		if($nfilas>0) {
			for($i=0;$i<$nfilas;$i++){
			$resultado=mysql_fetch_array ($consulta);
			echo "<tr>
			<td>".($i+1)."</td>
			<td>".$resultado['alias']."</td>
			<td>".$resultado['num']."</td>
			</tr>";
			}
		}
   ?>
   </tbody>
  </table>
</div>
</div>
<div id="nvecespos" class="col-md-6 col-sm-6" style="height:300px;">
<?php
$instruccion="SELECT posicion, COUNT( * ) AS num
				FROM incidencia
				WHERE jugador = \"".$_POST['idjug']."\" 
				AND fecha>=\"".($_POST['anomax']-1)."-09-01\" AND fecha<=\"".$_POST['anomax']."-06-30\"
				GROUP BY posicion";
							$consulta = mysql_query ($instruccion, $conexion)
										or die ("FALLO EN LA CONSULTA $instruccion");
						$nfilas = mysql_num_rows ($consulta);
		if($nfilas>0) {
			?>
<script>
$(function () {
    $('#nvecespos').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: 1,//null,
            plotShadow: false
        },
        title: {
            text: 'posiciones del jugador'
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
            name: 'N veces',
            data: [
				<?php
				for($i=0;$i<$nfilas;$i++){
			$resultado=mysql_fetch_array ($consulta);
			if (($i+1)==$nfilas) echo "['".$resultado['posicion']."',".$resultado['num']."]";
			else echo "['".$resultado['posicion']."',".$resultado['num']."],";
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
		echo "<h3>En ésta temporada (".($_POST['anomax']-1)." / ".$_POST['anomax'].") no has cambiado de posición</h3>";
		}
 ?>
</div>
 <div id="cap" class="col-md-6 col-sm-6" style="height:300px;">
 <?php
$instruccion="SELECT i.color, COUNT( * ) AS num
FROM partido p
LEFT JOIN incidencia i ON p.fecha = i.fecha
WHERE i.jugador =  \"".$_POST['idjug']."\"
AND (
p.caplocal =  \"".$_POST['idjug']."\"
OR p.capvisitante =  \"".$_POST['idjug']."\"
) AND i.fecha>=\"".($_POST['anomax']-1)."-09-01\" AND i.fecha<=\"".$_POST['anomax']."-06-30\"
GROUP BY i.color";


							$consulta = mysql_query ($instruccion, $conexion)
										or die ("FALLO EN LA CONSULTA $instruccion");
						$nfilas = mysql_num_rows ($consulta);
		if($nfilas>0) {
			?>
<script>
$(function () {
    $('#cap').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: 1,//null,
            plotShadow: false
        },
        title: {
            text: 'Partidos de capitán'
        },
		subtitle: {
            text: 'Según el color de la camiseta, NEgro y NAranja'
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
            name: 'N veces',
            data: [
				<?php
				for($i=0;$i<$nfilas;$i++){
			$resultado=mysql_fetch_array ($consulta);
			if ($i==0) echo "{
                name: '".$resultado['color']."',
                color: '#f26721',
                y: ".$resultado['num']."
            },";
			else echo "{
                name: '".$resultado['color']."',
                color: '#000',
                y: ".$resultado['num']."
            },";
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
		echo "<h3>En ésta temporada (".($_POST['anomax']-1)." / ".$_POST['anomax'].") no has sido capitán</h3>";
		}
 ?>
</div>
<div id="partjug" class="col-md-6 col-sm-6" style="height:300px;border-top:3px solid black;border-left:3px solid black;border-radius:5px;">
 <?php
		$instruccion="SELECT color, COUNT( * ) AS num
		FROM incidencia
		WHERE jugador =  \"".$_POST['idjug']."\"
		AND fecha>=\"".($_POST['anomax']-1)."-09-01\" AND fecha<=\"".$_POST['anomax']."-06-30\"
		GROUP BY color";
		$consulta = mysql_query ($instruccion, $conexion)
					or die ("FALLO EN LA CONSULTA $instruccion");
		$nfilas = mysql_num_rows ($consulta);
		if($nfilas>0) {
			?>
<script>
$(function () {
    $('#partjug').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: 1,//null,
            plotShadow: false
        },
        title: {
            text: 'Partidos jugados del jugador'
        },
		subtitle: {
            text: 'Según el color de la camiseta, NEgro y NAranja'
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
            name: 'N veces',
            data: [
				<?php
				for($i=0;$i<$nfilas;$i++){
			$resultado=mysql_fetch_array ($consulta);
			if ($i==0) echo "{
                name: '".$resultado['color']."',
                color: '#f26721',
                y: ".$resultado['num']."
            },";
			else echo "{
                name: '".$resultado['color']."',
                color: '#000',
                y: ".$resultado['num']."
            },";
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
		echo "<h3>No has jugado en la temporada (".($_POST['anomax']-1)." / ".$_POST['anomax'].") ningún partido</h3>";
		}
 ?>
</div>

<?php
mysql_close ($conexion);
  ?>
