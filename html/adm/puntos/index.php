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
	$.post( "./puntos/elegirtemporada-partido.php", {'jugador':$(this).attr("id")}, function (data) { 
		$("#elegirTemp").html(data); //Se muestra el resultado de la operación en la clase 
		});
	
	});
});
</script>
<div class="col-md-3 col-sm-3">
<div class="panel panel-default negroTransparente">
  <div id="cabeceraSelectPartidos" class="panel-heading" style="text-align:center;">Jugadores</div>
  <div class="panel-body " style="height:480px;overflow:auto;">
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
<div id="infopartido" class="col-md-9 col-sm-9" style="min-height:536px;background-color:rgba(12,12,12,0.3);">
<div id="elegirTemp" class="col-md-4 col-sm-4" style="height:400px;overflow-y:auto;">

</div>
<div id="drcha" class="col-md-8 col-sm-8"  style="min-height:520px;max-height:500px;overflow-y:auto;">

</div>
</div>
<?php 
mysql_close ($conexion);
?>