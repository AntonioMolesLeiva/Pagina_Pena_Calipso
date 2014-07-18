<script>
$(document).ready(function(){
	$("a[data-toggle='collapse']").click(function(){
		if($(this).hasClass("collapsed")) {
		//alert("dado temp "+$(this).attr("id"));
		$.post( "./puntos/grafico.php", {'jugador':$("#jug").val(),'temp':$(this).attr("id")}, function (data) { 
		$("#drcha").html(data); //Se muestra el resultado de la operación en la clase 
		});
		}
	});
	$("ol[reversed] li a").click(function(){
		//alert("partido "+$(this).attr("id")+" jugador="+$("#jug").val());
		$("#gCirculo").empty();
		$.post( "./puntos/graficoCircular.php", {'jugador':$("#jug").val(),'partido':$(this).attr("id")}, function (data) { 
		$("#gCirculo").html(data); //Se muestra el resultado de la operación en la clase 
		});
	});
});

</script>
<input id="jug" type="hidden" value="<?php echo $_POST['jugador']; ?>" />
<?php
	include ('../../../php/conexion.php');
	
	mysql_set_charset("utf8");
	$instruccion="SELECT p.fecha
FROM partido p
LEFT JOIN incidencia i ON p.fecha = i.fecha
WHERE jugador =  \"".$_POST['jugador']."\"
ORDER BY p.fecha DESC ";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");
	$nfilas = mysql_num_rows ($consulta);
	if ($nfilas>0) { ?> 
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
					<a id=\"".($ano+1)."\" data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#collapse".$i."\" class=\"collapsed\">
					Temporada ".$ano."-".($ano+1)
					."
					</a>
					</h4>
					</div>
					";
					$instruccion1="SELECT p.fecha,p.marclocal,p.marcvisitante FROM partido p LEFT JOIN incidencia i ON p.fecha=i.fecha WHERE p.fecha>=\"".$ano."-09-01\" AND p.fecha<=\"".($ano+1)."-06-30\" AND jugador='".$_POST['jugador']."' ORDER BY fecha DESC";
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
					<a id=\"".$ano."\" data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#collapse".$i."\"  class=\"collapsed\">
					Temporada ".($ano-1)." - ".$ano."
					</a>
					</h4>
					</div>
					";
					$instruccion1="SELECT p.fecha,p.marclocal,p.marcvisitante FROM partido p LEFT JOIN incidencia i ON p.fecha=i.fecha WHERE p.fecha>=\"".($ano-1)."-09-01\" AND p.fecha<=\"".$ano."-06-30\" AND jugador='".$_POST['jugador']."' ORDER BY fecha DESC";
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
	<?php }
	else { ?>
		<p style="color:white;margin:auto;">ÉSTE JUGADOR NO HA JUGADO AÚN</p>
	<?php }
	mysql_close ($conexion);
	?>