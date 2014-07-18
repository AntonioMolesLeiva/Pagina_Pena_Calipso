<script>
$(document).ready(function(){
	$(".panel-heading").click(function(){
	
	var ah=$(this).find("a").attr("href");
	//alert("anomax-> "+$(this).find("a").attr("href").substr(9,4)+" ah="+ah);
	$.post( "./estadisticas/estjugadoresJugCollapse.php", { 'anomax':$(this).find("a").attr("href").substr(9,4),'idjug':$("#jugador").val()}, function (data) { 
			$(ah).find(".panel-body").html(data); //Se muestra el resultado de la operación en la clase 
			});
	});
});
</script>
<input type="hidden" id="jugador" value="<?php echo $_POST['jugador']; ?>" />
<div class="col-md-12 col-sm-12">
	<?php
	//echo $_POST['jugador'];
	
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
<div class="panel-group" id="accordion">
  <?php
$instruccion="SELECT * FROM incidencia WHERE jugador =\"".$_POST['jugador']."\" ORDER BY fecha DESC ";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("<p style=\"color:white;\">FALLO EN LA CONSULTA $instruccion</p>");
	$nfilas = mysql_num_rows ($consulta);
	if ($nfilas>0) {
		for ($i=0; $i<$nfilas; $i++){
			$resultado = mysql_fetch_array ($consulta);
			$mes=substr($resultado['fecha'],5,2);
			$ano=substr($resultado['fecha'],0,4);
			//$dia=substr($resultado['fecha'],8,2);
			if ($mes>=9) {
				if($ano!=$cAno) {
					?>
	<div class="panel panel-default">
		<div class="panel-heading buttontemp azul ancho100">
		  <h4 class="panel-title">
			<a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo ($ano+1); ?>">
			  <?php echo "Temporada ".$ano." / ".($ano+1); ?>
			</a>
		  </h4>
		</div>
		<div id="collapse<?php echo ($ano+1); ?>" class="panel-collapse collapse">
		  <div class="panel-body">
		  </div>
		</div>
	</div>
					<?php
					}
				$cAno=$ano;	
				}
			else if ($mes<=5) {
				if(($ano-1)!=$cAno) {
					?>
	<div class="panel panel-default">
		<div class="panel-heading buttontemp azul ancho100">
		  <h4 class="panel-title">
			<a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $ano; ?>">
			  <?php echo "Temporada ".($ano-1)." / ".$ano; ?>
			</a>
		  </h4>
		</div>
		<div id="collapse<?php echo $ano; ?>" class="panel-collapse collapse">
		  <div class="panel-body">
		  </div>
		</div>
	</div>
					<?php
				$cAno=($ano-1);
				}
			}
				
			}
	}
mysql_close ($conexion);
  ?>
</div>
