<input id="anadirunJUGADORFORM" type="hidden" value="<?php echo $_POST['poshab']; ?>"/>
<script>
var poshabitual=$("#anadirunJUGADORFORM").val();
	var identif;
	switch (poshabitual) {
	 case "por": identif="#por";
		break;
	case "def": identif="#def";
		break;
	case "cen": identif="#cen";
		break;
	case "del": identif="#del";
		break;
	case "A": identif="#arb";
		break;
	}
$("#prueba").attr("id",identif);	

$("ul.droptrue" ).sortable({
	  connectWith: "ul"
	});
	$(identif).disableSelection();
	/*Para cuando haces click en un jugador*/
	var identi=0;
	$(".cajajugador[id]").mousedown(function() {
		identi=$(this).attr("id");
		$("#"+identi+" div").toggleClass("jugadorSelected");
		});
	$(identif).sortable({
		update: function( event, ui ) {
			//si tiene la unica clase posible que puede tener que se la quite
			if ($(identif+" li[id="+identi+"] div").attr("class")) $(identif+" li div").removeClass("jugadorSelected");
				}
	})
	$( "#local" ).sortable({
		update: function() {
			$("#njugadoreslocal").html($("#local li").size());
			//si tiene la unica clase posible que puede tener que se la quite
			if ($("#local li[id="+identi+"] div").attr("class")) $("#local li div").removeClass("jugadorSelected");			
			}	
	});
	$( "#visitante" ).sortable({
		update: function( event, ui ) {
		$("#njugadoresvisitante").html($("#visitante li").size());
			//si tiene la unica clase posible que puede tener que se la quite
			if ($("#visitante li[id="+identi+"] div").attr("class")) $("#visitante li div").removeClass("jugadorSelected");		
		}
	});
	$( "#arbitro" ).sortable({
		update: function( event, ui ) {
			//si tiene la unica clase posible que puede tener que se la quite
			if ($("#arbitro li[id="+identi+"] div").attr("class")) $("#arbitro li div").removeClass("jugadorSelected");		
		}
	});
	
	$( "#espectadores" ).sortable({
		update: function( event, ui ) {
			//si tiene la unica clase posible que puede tener que se la quite
			if ($("#espectadores li[id="+identi+"] div").attr("class")) $("#espectadores li div").removeClass("jugadorSelected");		
		}
	});
</script>
<ul id="prueba" class="droptrue">
<?php 

include ('../../php/conexion.php');
	if (isset($_POST['nombre'])&&isset($_POST['dni'])&&isset($_POST['alias'])){
						mysql_set_charset("utf8");
						if ($_POST['dorsal']!="") $instruccion="INSERT INTO jugador (dni,alias,nombre,dorsal,posicionhab,activo,contrasena) VALUES ('".$_POST['dni']."','".$_POST['alias']."','".$_POST['nombre']."',".$_POST['dorsal'].",'".$_POST['poshab']."','".$_POST['activo']."','avxc')";
						else $instruccion="INSERT INTO jugador (dni,alias,nombre,posicionhab,activo,contrasena) VALUES ('".$_POST['dni']."','".$_POST['alias']."','".$_POST['nombre']."','".$_POST['poshab']."','".$_POST['activo']."','avxc')";
						$consulta = mysql_query ($instruccion, $conexion)
									or die ("
									<div class=\"container col-md-4 col-sm-4 col-xs-12 col-md-offset-4 col-sm-offset-4\" style=\"margin-top:10px;\">
									<div class=\"panel panel-danger\">
									 <div class=\"panel-heading\">
									<h3 class=\"panel-title\">Error</h3>
								  </div>
								  <div class=\"panel-body\"><span class=\"glyphicon glyphicon-remove\" style=\"color:red;\"></span>&nbsp;No se pudo crear el jugador ".$instruccion." </div>
								</div>
								</div>
									");
				$instruccion="SELECT dni,alias,dorsal,foto FROM jugador WHERE posicionhab='".$_POST['poshab']."' ORDER BY activo ASC,dorsal ASC";
						$consulta = mysql_query ($instruccion, $conexion)
									or die ("FALLO EN LA CONSULTA $instruccion");
						$nfilas = mysql_num_rows ($consulta);
						if ($nfilas>0) {
							for ($i=0; $i<$nfilas; $i++){
							$resultado = mysql_fetch_array ($consulta);
							if($resultado['foto']=='') $foto="../../img/jug/sinfoto.png";
							else $foto="../../img/jug/fotosjug/".$resultado['foto'];
							echo "<li id=\"".$resultado['dni']."\" class=\"ui-state-default cajajugador\"><div></div><img src=\"".$foto."\" alt=\"foto del jugador ".$resultado['alias']." \" title=\" ".$resultado['alias']."\"> <span class=\"nombreAliasCajaJugador\">".$resultado['alias']."<span>&nbsp;&nbsp;<span class=\"DorsalCajaJugador\">".$resultado['dorsal']."</span></li>";
							}
						}
mysql_close ($conexion);
}
?>
</ul>