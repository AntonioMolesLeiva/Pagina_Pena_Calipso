<script>
$(document).ready(function() {

	$("#selectTempTrof li a").click(function(){
			//alert("¿Quieres visitar la temporada?"+$(this).attr("id"));
		$.post( "./estadisticas/estpagostemp.php", { 'anomax':$(this).attr("id")}, function (data) { 
			$("#infopartido").html(data); //Se muestra el resultado de la operación en la clase 
			});
		});
});
</script>
<div class="col-md-3 col-sm-4">
<div class="panel panel-default negroTransparente">
  <div id="cabeceraSelectPartidos" class="panel-heading" style="text-align:center;">Temporadas</div>
  <div class="panel-body " style="height:300px;overflow:auto;">
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
</div>
<?php 
mysql_close ($conexion);
?>

