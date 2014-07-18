<script>
$(document).ready(function() {

	$("#selectTempTrof li a").click(function(){
		//alert("¿Quieres visitar la temporada?"+$(this).attr("id"));
	$.post( "./gestionarpagos/pagos.php", { 'anomax':$(this).attr("id")}, function (data) { 
		$("#infopartido").html(data); //Se muestra el resultado de la operación en la clase 
		});
	});
	
	$("#generarMES").click(function (event) {
	$('#infoPag').modal('show');
	$.post( "./gestionarpagos/generarmes.php", { 'mes':$("#elegirMes option:selected").attr("id"),'ano':+$("#elegirAno option:selected").attr("id")}, function (data) { 
		$('#infoPag').find('.modal-body').html(data); //Se muestra el resultado de la operación en la clase 
		});
	});
	
	//Para que no se propague el evento
	$("#elegirMes,#elegirAno").click(function(e){
	  e.stopPropagation();
	});
});
</script>
<style>
#elegirMes,#elegirAno{color:black;}
</style>
<div class="col-md-3 col-sm-4">
<div class="panel panel-default negroTransparente">
  <div id="cabeceraSelectPartidos" class="panel-heading" style="text-align:center;">Temporadas</div>
  <div class="panel-body " style="height:480px;overflow:auto;">
  <button id="generarMES" class="btn btn-large btn-warning">Generar mes &nbsp;
  <select id="elegirMes">
	<?php
	$mes=array(1=>"Enero",2=>"Febrero",3=>"Marzo",4=>"Abril",5=>"Mayo",6=>"Junio",9=>"Septiembre",10=>"Octubre",11=>"Noviembre",12=>"Diciembre");
	if ((date (n)>=1&&date (n)<=6)||(date (n)>=9&&date (n)<=12)) {
		foreach ($mes as $i=>$valor) {
			if (date(n)==$i) {
			echo "<option id=\"".$i."\" selected>".$valor."</option>";
			}
			else {
			echo "<option id=\"".$i."\">".$valor."</option>";
			}
		}
	}
	else {
	foreach ($mes as $i=>$valor) {
			if ($i==9) {
			echo "<option id=\"".$i."\" selected>".$valor."</option>";
			}
			else {
			echo "<option id=\"".$i."\">".$valor."</option>";
			}
			
		}
	}

 ?>
  </select>
  <br />
  <select id="elegirAno" style="margin-top:4px;">
  <?php for($i=date(Y);$i>=2012;$i--) {
  echo "<option id=\"".$i."\">".$i."</option>";
  } ?>
  </select>
  </button>
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
<div id="infopartido" class="col-md-9 col-sm-8" style="min-height:536px;background-color:rgba(12,12,12,0.3);">

</div>
<div id="infoPag" class="modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Información</h4>
      </div>
      <div class="modal-body">
        ...
      </div>
  </div>
</div>
<?php 
mysql_close ($conexion);
?>