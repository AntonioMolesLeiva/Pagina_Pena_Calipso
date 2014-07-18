<?php session_start() ?>
<script>
$(document).ready(function() {

	$("#selectTempTrof li a").click(function(){
		//alert("¿Quieres visitar la temporada? "+$(this).attr("id"));
	$.post( "./pagos/pagosxtemporada.php", { 'ano':$(this).attr("id"),'dnijug':'<?php echo $_SESSION['usu']; ?>'}, function (data) { 
		$("#infopartido").html(data); //Se muestra el resultado de la operación en la clase 
		});
	});
});
</script>

	<?php
	include ('../../php/conexion.php');
	
	mysql_set_charset("utf8");
	$instruccion="SELECT fechadeuda
FROM deudas
WHERE jugador =  \"".$_SESSION['usu']."\"
GROUP BY fechadeuda
ORDER BY fechadeuda DESC ";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");
	$nfilas = mysql_num_rows ($consulta);
	if ($nfilas>0) { ?>
	<div class="col-md-3 col-sm-3">
<div class="panel panel-default negroTransparente">
  <div id="cabeceraSelectPartidos" class="panel-heading" style="text-align:center;">Temporadas</div>
  <div class="panel-body " style="height:480px;overflow:auto;">
	<ul id="selectTempTrof">
	
	<?php	
		for ($i=0; $i<$nfilas; $i++){
			$resultado = mysql_fetch_array ($consulta);
			$mes=substr($resultado['fechadeuda'],5,2);
			$ano=substr($resultado['fechadeuda'],0,4);
			//$dia=substr($resultado['fechadeuda'],8,2);
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
		  </div>
</div>
</div>
<div id="infopartido" class="col-md-9 col-sm-9" style="min-height:536px;background-color:rgba(12,12,12,0.3);">

</div>
		<?php
		}
		else {
		?>
	<div class="jumbotron col-md-6 col-sm-6 col-md-offset-3 col-sm-offset-3" style="border-radius:20px;">
  <h1 style="text-align:center;">Sin datos</h1>
	<p style="text-align:justify;">Aún no tienes ninguna deuda en ninguna temporada.</p>
</div>	

<?php }
mysql_close ($conexion);
?>