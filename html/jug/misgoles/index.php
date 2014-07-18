<?php session_start() ?>
<script>
$(document).ready(function() {

	$("ol").find("a[id]").click(function(){
		/*alert("¿Quieres visitar el partido?"+$(this).attr("id"));*/
		
	$.post( "./vertodospartidos/infopartido.php", { 'fecha':$(this).attr("id")}, function (data) { 
		$("#infopartido").html(data); //Se muestra el resultado de la operación en la clase 
		});
	});
});
</script>

	<?php
	include ('../../php/conexion.php');
	
	mysql_set_charset("utf8");
	$instruccion="SELECT p.fecha FROM partido p LEFT JOIN incidencia i ON p.fecha = i.fecha
WHERE jugador =  \"".$_SESSION['usu']."\" and i.gol>0 ORDER BY fecha DESC";	
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");
	$nfilas = mysql_num_rows ($consulta);
	if ($nfilas>0) { ?> 
	<div class="col-md-3 col-sm-3">
<div class="panel panel-default negroTransparente">
  <div id="cabeceraSelectPartidos" class="panel-heading" style="text-align:center;">Partidos</div>
  <div class="panel-body " style="height:480px;overflow:auto;">
	<div  id="selectPartido" class="panel-group" id="accordion">
	
	<?php	
		for ($i=0; $i<$nfilas; $i++){
			$resultado = mysql_fetch_array ($consulta);
			$mes=substr($resultado['fecha'],5,2);
			$ano=substr($resultado['fecha'],0,4);
			$dia=substr($resultado['fecha'],8,2);
			if ($mes>=9) {
				if($ano!=$cAno) {
					echo "
					<div class=\"panel panel-default\">
					<div class=\"panel-heading\">
					<h4 class=\"panel-title\">
					<a data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#collapse".$i."\">
					Temporada ".$ano."-".($ano+1)
					."
					</a>
					</h4>
					</div>
					";
					$instruccion1="SELECT p.fecha,p.marclocal,p.marcvisitante FROM partido p LEFT JOIN incidencia i ON p.fecha = i.fecha WHERE p.fecha>=\"".$ano."-09-01\" AND p.fecha<=\"".($ano+1)."-06-30\" AND jugador =  \"".$_SESSION['usu']."\" AND i.gol>0 ORDER BY fecha DESC";
					$consulta1 = mysql_query ($instruccion1, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion1");
					$nfilas1 = mysql_num_rows ($consulta1);
					if ($nfilas1>0) {
					echo "
					<div id=\"collapse".$i."\" class=\"panel-collapse collapse\">
						<div class=\"panel-body\">
					";
					echo "<ol reversed=\"reversed\" style=\"width:180px;margin:auto;\">";
						for ($s=0; $s<$nfilas1; $s++){
							$resultado1=mysql_fetch_array ($consulta1);
							$mes1=substr($resultado1['fecha'],5,2);
							$ano1=substr($resultado1['fecha'],0,4);
							$dia1=substr($resultado1['fecha'],8,2);
							echo "<li><a id=\"".$resultado1['fecha']."\">".$dia1."/".$mes1."/".$ano1."&nbsp;&nbsp;&nbsp;&nbsp;".$resultado1['marclocal']." - ".$resultado1['marcvisitante']."</a></li>";
						}
					echo "</ol>
					</div>
					</div>
				  </div>";
					}
				$cAno=$ano;	
				}
			}
			else if ($mes<=5) {
				if(($ano-1)!=$cAno) {
					echo "<div class=\"panel panel-default\">
					<div class=\"panel-heading\">
					<h4 class=\"panel-title\">
					<a data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#collapse".$i."\">
					Temporada ".($ano-1)." - ".$ano."
					</a>
					</h4>
					</div>
					";
					$instruccion1="SELECT p.fecha,p.marclocal,p.marcvisitante FROM partido p LEFT JOIN incidencia i ON p.fecha = i.fecha WHERE p.fecha>=\"".($ano-1)."-09-01\" AND p.fecha<=\"".$ano."-06-30\" AND jugador =  \"".$_SESSION['usu']."\" AND i.gol>0 ORDER BY fecha DESC";
					$consulta1 = mysql_query ($instruccion1, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion1");
					$nfilas1 = mysql_num_rows ($consulta1);
					if ($nfilas1>0) {
					echo "
					<div id=\"collapse".$i."\" class=\"panel-collapse collapse\">
						<div class=\"panel-body\">
					";
					echo "<ol reversed=\"reversed\" style=\"width:180px;margin:auto;\">";
						for ($j=0; $j<$nfilas1; $j++){
							$resultado1=mysql_fetch_array ($consulta1);
							$mes1=substr($resultado1['fecha'],5,2);
							$ano1=substr($resultado1['fecha'],0,4);
							$dia1=substr($resultado1['fecha'],8,2);
							echo "<li><a id=\"".$resultado1['fecha']."\">".$dia1."/".$mes1."/".$ano1."&nbsp;&nbsp;&nbsp;&nbsp;".$resultado1['marclocal']." - ".$resultado1['marcvisitante']."</a></li>";
						}
					echo "</ol></div>
					</div>
				  </div>";
					}
				$cAno=($ano-1);
				}
			}
		} ?>
	</div>
  </div>
</div>
</div>
<div id="infopartido" class="col-md-9 col-sm-9" style="min-height:536px;background-color:rgba(12,12,12,0.3);">
</div>
	<?php }
	else { ?>
	<div class="jumbotron col-md-6 col-sm-6 col-md-offset-3 col-sm-offset-3" style="border-radius:20px;">
  <h1>Aún no has marcado ningún gol.¡Ánimo!</h1>
</div>
	<?php }
	?>

<?php 
mysql_close ($conexion);
?>