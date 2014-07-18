<script>
$(document).ready(function() {

	$(".def").click(function(){
	if($(this).hasClass("active")) {
		$(".DEF").remove();
		}
	else {
		$.post( "./puntos/filtrarnombres.php", {'pos':'def'}, function (data) { 
		$("#mostrarJug").prepend(data); //Se muestra el resultado de la operación en la clase 
		});

	}
	});
	$(".por").click(function(){
	if($(this).hasClass("active")) {
		$(".POR").remove();
		}
	else {
		$.post( "./puntos/filtrarnombres.php", {'pos':'por'}, function (data) { 
		$("#mostrarJug").prepend(data); //Se muestra el resultado de la operación en la clase 
		});
		
	}
	});
	$(".cen").click(function(){
	if($(this).hasClass("active")) {
		$(".CEN").remove();
		}
	else {
		$.post( "./puntos/filtrarnombres.php", {'pos':'cen'}, function (data) { 
		$("#mostrarJug").prepend(data); //Se muestra el resultado de la operación en la clase 
		});
		
	}
	});
	$(".del").click(function(){
	if($(this).hasClass("active")) {
		$(".DEL	").remove();
		}
	else {
		$.post( "./puntos/filtrarnombres.php", {'pos':'del'}, function (data) { 
		$("#mostrarJug").prepend(data); //Se muestra el resultado de la operación en la clase 
		});
		
	}
	});
	$(".arb").click(function(){
	if($(this).hasClass("active")) {
		$(".ARB").remove();
		}
	else {
		$.post( "./puntos/filtrarnombres.php", {'pos':'arb'}, function (data) { 
		$("#mostrarJug").prepend(data); //Se muestra el resultado de la operación en la clase 
		});
		
	}
	});
	$(".extra").click(function(){
	if($(this).hasClass("active")) {
		$(".ARB,.DEL,.CEN,.DEF,.POR").remove();
		$.post( "./puntos/filtrarnombres.php", {'pos':'extran'}, function (data) { 
		$("#mostrarJug").prepend(data); //Se muestra el resultado de la operación en la clase 
		});
		}
	else {
		$(".ARB,.DEL,.CEN,.DEF,.POR").remove();
		$.post( "./puntos/filtrarnombres.php", {'pos':'extras'}, function (data) { 
		$("#mostrarJug").prepend(data); //Se muestra el resultado de la operación en la clase 
		});
		
	}
	});
	/* SE HACE ASÍ POR QUE SE GENERA DINÁMICAMENTE */
	$("#mostrarJug").on("click","li",function(){
    //alert("Mostrar jugador "+$(this).attr("id"));
	$.post( "./estadisticas/estjugadoresjug.php", {'jugador':$(this).attr("id")}, function (data) { 
		$("#infopartido").html(data); //Se muestra el resultado de la operación en la clase 
		});
	
	});
	$("#selectTempTrof li a").click(function(){
			//alert("¿Quieres visitar la temporada?"+$(this).attr("id"));
		$.post( "./estadisticas/estjugadorestemp.php", { 'anomax':$(this).attr("id")}, function (data) { 
			$("#infopartido").html(data); //Se muestra el resultado de la operación en la clase 
			});
		});
});
</script>
<div class="col-md-3 col-sm-3">
<div class="col-md-12 col-sm-12">
<div class="panel panel-default negroTransparente">
  <div id="cabeceraSelectPartidos" class="panel-heading" style="text-align:center;">Jugadores</div>
  <div class="panel-body " style="height:210px;overflow:auto;">
	<span style="color:white;">
	Mostrar
	</span>
<div class="btn-group col-md-12 col-sm-12 " data-toggle="buttons">
  <label class="btn col-md-4  col-md-4  col-xs-4 por active">
    <input type="checkbox"> Por.
  </label>
  <label class="btn col-md-4  col-md-4  col-xs-4 def active">
    <input type="checkbox"> Def.
  </label>
  <label class="btn col-md-4  col-md-4  col-xs-4 cen active">
    <input type="checkbox"> Cen.
  </label>
</div>
<div class="btn-group col-md-12 col-sm-12 " data-toggle="buttons">
  <label class="btn col-md-4  col-md-4  col-xs-4 del active">
    <input type="checkbox"> Del.
  </label>
  <label class="btn col-md-4  col-md-4  col-xs-4 arb active">
    <input type="checkbox"> Arb.
  </label>
  <label class="btn col-md-4  col-md-4  col-xs-4 extra active">
    <input type="checkbox"> Extra.
  </label>
</div>
 <br /><br /><br /><br /><br />
 <ul id="mostrarJug">
	<?php
	include ('../../php/conexion.php');
	$instruccion="SELECT dni,alias,posicionhab FROM jugador ORDER BY alias ASC";
						$consulta = mysql_query ($instruccion, $conexion)
									or die ("FALLO EN LA CONSULTA $instruccion");
					$nfilas = mysql_num_rows ($consulta);
	if($nfilas>0) {
		for($i=0;$i<$nfilas;$i++){
		$resultado=mysql_fetch_array ($consulta);
			switch($resultado['posicionhab']) {
				case 'por': echo "<li id=".$resultado['dni']." class=\"POR\"><span>".$resultado['alias']."</span></li>";
						break;
				case 'def': echo "<li id=".$resultado['dni']." class=\"DEF\"><span>".$resultado['alias']."</span></li>";
						break;
				case 'cen': echo "<li id=".$resultado['dni']." class=\"CEN\"><span>".$resultado['alias']."</span></li>";
						break;
				case 'del': echo "<li id=".$resultado['dni']." class=\"DEL\"><span>".$resultado['alias']."</span></li>";
						break;
				case 'A': echo "<li id=".$resultado['dni']." class=\"ARB\"><span>".$resultado['alias']."</span></li>";
						break;
			}
		}
		
		}
	?>
	</ul>
  </div>
</div>
</div>
<div class="col-md-12 col-sm-12">
<div class="panel panel-default negroTransparente">
  <div id="cabeceraSelectPartidos" class="panel-heading" style="text-align:center;">Temporadas</div>
  <div class="panel-body " style="height:210px;overflow:auto;">
	<?php
	include ('../../php/conexion.php');
	
	mysql_set_charset("utf8");
	$instruccion="SELECT fecha FROM partido ORDER BY fecha DESC";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");
	$nfilas = mysql_num_rows ($consulta);
	if ($nfilas>0) {
	?>
	<ul id="selectTempTrof">
	
	<?php	
		for ($i=0; $i<$nfilas; $i++){
			$resultado = mysql_fetch_array ($consulta);
			$mes=substr($resultado['fecha'],5,2);
			$ano=substr($resultado['fecha'],0,4);
			//$dia=substr($resultado['fecha'],8,2);
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
</div>
<div id="infopartido" class="col-md-9 col-sm-9" style="min-height:536px;background-color:rgba(12,12,12,0.3);">
<?php
mysql_set_charset("utf8");
	$instruccion="SELECT activo, COUNT( activo ) AS num
					FROM jugador
					GROUP BY activo";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");
	$nfilas = mysql_num_rows ($consulta);
	if ($nfilas>0) {
		for($i=0;$i<$nfilas;$i++){
			$resultado=mysql_fetch_array ($consulta);
			if($i==0) $jugadores=$resultado['num'];
			else $extras=$resultado['num'];
			}
			//echo "<p style=\"color:white;\">jugadores-> ".$jugadores." extras->".$extras."</p>";
	}
	
	$instruccion="SELECT foto,count(*) as num FROM jugador GROUP BY foto IS NOT NULL";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");
	$nfilas = mysql_num_rows ($consulta);
	if ($nfilas>0) {
		for($i=0;$i<$nfilas;$i++){
			$resultado=mysql_fetch_array ($consulta);
			if($i==0) $nofoto=$resultado['num'];
			else $foto=$resultado['num'];
			}
			//echo "<p style=\"color:white;\">foto-> ".$foto." nofoto->".$nofoto."</p>";
	}
	
 ?>
<script>
$(function () {
    		
		// Build the chart
        $('#jugadores').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: 'Nº de jugadores activos'
            },
           subtitle: {
                text: 'jugadores activos vs extras'
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
                    ['Jugadores', <?php echo $jugadores; ?>],
                    ['Extras',<?php echo $extras; ?>]
                ]
            }]
        });
    });
	$(function () {
		
		// Build the chart
        $('#jugfoto').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: 'Nº de jugadores con foto'
            },
           subtitle: {
                text: 'jugadores activos con y sin foto'
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
                    ['Con foto', <?php echo $foto; ?>],
                    ['Sin foto',<?php echo $nofoto; ?>]
                ]
            }]
        });
    });
</script>
<div id="jugadores" class="col-md-6 col-sm-6" style="height:500px;">
</div>
<div id="jugfoto" class="col-md-6 col-sm-6" style="height:500px;">
</div>
</div>
<?php 
mysql_close ($conexion);
?>