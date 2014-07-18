<?php
include ('../../php/conexion.php');
	$esPorteroLContent=$_POST['esPorteroLContent'];
	$eesPorteroLContent=explode(',', $esPorteroLContent[0]);
	$esDefensaLContent=$_POST['esDefensaLContent'];
	$eesDefensaLContent=explode(',', $esDefensaLContent[0]);
	$esCentrocampistaLContent=$_POST['esCentrocampistaLContent'];
	$eesCentrocampistaLContent=explode(',', $esCentrocampistaLContent[0]);
	$esDelanteroLContent=$_POST['esDelanteroLContent'];
	$eesDelanteroLContent=explode(',', $esDelanteroLContent[0]);
	$esPorteroVContent=$_POST['esPorteroVContent'];
	$eesPorteroVContent=explode(',', $esPorteroVContent[0]);
	$esDefensaVContent=$_POST['esDefensaVContent'];
	$eesDefensaVContent=explode(',', $esDefensaVContent[0]);
	$esCentrocampistaVContent=$_POST['esCentrocampistaVContent'];
	$eesCentrocampistaVContent=explode(',', $esCentrocampistaVContent[0]);
	$esDelanteroVContent=$_POST['esDelanteroVContent'];
	$eesDelanteroVContent=explode(',', $esDelanteroVContent[0]);
	
$local=$_POST['local'];
$visitante=$_POST['visitante'];

?>

<script>
if($("#color option:selected").attr("value")=="naranja") {
	$(".local").parent().removeClass("colorNegro").addClass("colorNaranja");
	$(".visitante").parent().removeClass("colorNaranja").addClass("colorNegro");	
	}
</script>
<?php
$elocal=explode(',', $local[0]);
$evisitante=explode(',', $visitante[0]);
  echo "<form id=\"guardarTodo\">";
 if ($_POST['njugadoreslocalActual']==$_POST['njugadoreslocal']&&$_POST['njugadoresvisitanteActual']==$_POST['njugadoresvisitante']) {
 /*echo "no hay estrategia de ninguno";*/
 ?>

 <div class="panel panel-default colorNegro">
  <div class="panel-heading local">Local</div>
  <div class="panel-body">

  <ul class="col-sm12 col-md-12" style="list-style-type:none;">
     <?php
	 for($i=0;$i<sizeof($elocal);$i++) {
			
		mysql_set_charset("utf8");
		$instruccion="SELECT dni,alias,dorsal,foto,posicionhab FROM jugador WHERE dni='".$elocal[$i]."'";
		$consulta = mysql_query ($instruccion, $conexion)
					or die ("FALLO EN LA CONSULTA $instruccion");
			$resultado1 = mysql_fetch_array ($consulta);
			if($resultado1['foto']=='') $foto="../../img/jug/sinfoto.png";
			else $foto="../../img/jug/fotosjug/".$resultado1['foto'];
			echo "<li style=\"overflow:auto;\" id=\"".$resultado1['dni']."\" class=\"cajajugador\">
			<div class=\"col-sm-3 col-md-3\"><img src=\"".$foto."\" style=\"border-radius:5px\" alt=\"foto del jugador ".$resultado1['alias']." \" title=\" ".$resultado1['alias']."\">
			<span class=\"nombreAliasCajaJugador\">".$resultado1['alias']."</span>&nbsp;&nbsp;<span class=\"DorsalCajaJugador\">".$resultado1['dorsal']."</span>
			</div>
			";
			
			$instruccion="SELECT idcuota,texto FROM cuota";
		$consulta = mysql_query ($instruccion, $conexion)
					or die ("FALLO EN LA CONSULTA $instruccion");
			$nfilas = mysql_num_rows ($consulta);
		if ($nfilas>0) {
			echo "	<div class=\"col-sm-4 col-md-4\">
			 <div class=\"form-group\">
				<label class=\" control-label\">Sanción</label>
					<select name=\"Sancionn\" class=\"form-control input-sm\">
					<option value=\"\">Ninguna</option>";
					for ($j=0; $j<$nfilas; $j++){
					$resultado = mysql_fetch_array ($consulta);
					echo "<option value=\"".$resultado['idcuota']."\">".$resultado['texto']."</option>";
					}
					echo "</select>
					</div>
					</div>
					";
			}
			echo "	<div class=\"col-sm-3 col-md-3\">
			 <div class=\"form-group\">
				<label class=\" control-label\">Gol/es</label>
					<select name=\"Goles\" class=\"form-control input-sm\">
					<option value=\"\">Ningún</option>";
					for ($j=1; $j<=10; $j++){
					
					echo "<option value=\"".$j."\">".$j."</option>";
					}
					echo "</select>
					</div>
					</div>
					";
			echo "	<div class=\"col-sm-1 col-md-1\">
			 <div class=\"form-group\">
				<label class=\" control-label\">Cap.</label>
					<input type=\"checkbox\" name=\"cap\" value=\"".$resultado1['dni']."\" />
					</div>
					</div>
					";
			echo "
			<input name=\"ID\" type=\"hidden\" value=\"".$resultado1['dni']."\" />
			<input type=\"hidden\" name=\"posHab\" value=\"".$resultado1['posicionhab']."\"/>
			</li>";

		} ?>
</ul>
</div> <!-- / panel body -->
</div> <!-- / panel -->

  <div class="panel panel-default colorNaranja">
  <div class="panel-heading visitante">Visitante</div>
  <div class="panel-body">
  <ul class="col-sm12 col-md-12" style="list-style-type:none;">
     <?php
	 for($i=0;$i<sizeof($evisitante);$i++) {
			
		mysql_set_charset("utf8");
		$instruccion="SELECT dni,alias,dorsal,foto,posicionhab FROM jugador WHERE dni='".$evisitante[$i]."'";
		$consulta = mysql_query ($instruccion, $conexion)
					or die ("FALLO EN LA CONSULTA $instruccion");
			$resultado1 = mysql_fetch_array ($consulta);
			if($resultado1['foto']=='') $foto="../../img/jug/sinfoto.png";
			else $foto="../../img/jug/fotosjug/".$resultado1['foto'];
			echo "<li style=\"overflow:auto;\" id=\"".$resultado1['dni']."\" class=\"cajajugador\">
			<div class=\"col-sm-3 col-md-3\"><img src=\"".$foto."\" style=\"border-radius:5px\" alt=\"foto del jugador ".$resultado1['alias']." \" title=\" ".$resultado1['alias']."\">
			<span class=\"nombreAliasCajaJugador\">".$resultado1['alias']."</span>&nbsp;&nbsp;<span class=\"DorsalCajaJugador\">".$resultado1['dorsal']."</span>
			</div>
			";
			
			$instruccion="SELECT idcuota,texto FROM cuota";
		$consulta = mysql_query ($instruccion, $conexion)
					or die ("FALLO EN LA CONSULTA $instruccion");
			$nfilas = mysql_num_rows ($consulta);
		if ($nfilas>0) {
			echo "	<div class=\"col-sm-4 col-md-4\">
			 <div class=\"form-group\">
				<label class=\" control-label\">Sanción</label>
					<select name=\"Sancionn\" class=\"form-control input-sm\">
					<option value=\"\">Ninguna</option>";
					for ($j=0; $j<$nfilas; $j++){
					$resultado = mysql_fetch_array ($consulta);
					echo "<option value=\"".$resultado['idcuota']."\">".$resultado['texto']."</option>";
					}
					echo "</select>
					</div>
					</div>
					";
			}
			echo "	<div class=\"col-sm-3 col-md-3\">
			 <div class=\"form-group\">
				<label class=\" control-label\">Gol/es</label>
					<select name=\"Goles\" class=\"form-control input-sm\">
					<option value=\"\">Ningún</option>";
					for ($j=1; $j<=10; $j++){
					
					echo "<option value=\"".$j."\">".$j."</option>";
					}
					echo "</select>
					</div>
					</div>
					";
			echo "	<div class=\"col-sm-1 col-md-1\">
			 <div class=\"form-group\">
				<label class=\" control-label\">Cap.</label>
					<input type=\"checkbox\" name=\"cap\" value=\"".$resultado1['dni']."\" />
					</div>
					</div>
					";
			echo "
			<input name=\"ID\" type=\"hidden\" value=\"".$resultado1['dni']."\" />
			<input type=\"hidden\" name=\"posHab\" value=\"".$resultado1['posicionhab']."\"/>
			</li>";

		} ?>
</ul>
</div> <!-- / panel body -->
</div> <!-- / panel -->

<?php		
	
 } /* </SI NO HAY ESTRATEGIA>*/
 
 else if ($_POST['njugadoreslocalActual']==0&&$_POST['njugadoresvisitanteActual']==0) {
	/*echo "hay estrategia de los dos";*/ ?>
	
		  <div class="panel panel-default colorNegro">
  <div class="panel-heading local">Local</div>
  <div class="panel-body">
  <ul class="col-sm12 col-md-12" style="list-style-type:none;">
     <?php
	 for($i=0;$i<sizeof($eesDelanteroLContent);$i++) {
		mysql_set_charset("utf8");
		$instruccion="SELECT dni,alias,dorsal,foto,posicionhab FROM jugador WHERE dni='".$eesDelanteroLContent[$i]."'";
		$consulta = mysql_query ($instruccion, $conexion)
					or die ("FALLO EN LA CONSULTA $instruccion");
			$resultado1 = mysql_fetch_array ($consulta);
			if($resultado1['foto']=='') $foto="../../img/jug/sinfoto.png";
			else $foto="../../img/jug/fotosjug/".$resultado1['foto'];
			echo "<li style=\"overflow:auto;\" id=\"".$resultado1['dni']."\" class=\"cajajugador\">
			<div class=\"col-sm-3 col-md-3\"><img src=\"".$foto."\" style=\"border-radius:5px\" alt=\"foto del jugador ".$resultado1['alias']." \" title=\" ".$resultado1['alias']."\">
			<span class=\"nombreAliasCajaJugador\">".$resultado1['alias']."</span>&nbsp;&nbsp;<span class=\"DorsalCajaJugador\">".$resultado1['dorsal']."</span>
			</div>
			";
			
			$instruccion="SELECT idcuota,texto FROM cuota";
		$consulta = mysql_query ($instruccion, $conexion)
					or die ("FALLO EN LA CONSULTA $instruccion");
			$nfilas = mysql_num_rows ($consulta);
		if ($nfilas>0) {
			echo "	<div class=\"col-sm-4 col-md-4\">
			 <div class=\"form-group\">
				<label class=\" control-label\">Sanción</label>
					<select name=\"Sancionn\" class=\"form-control input-sm\">
					<option value=\"\">Ninguna</option>";
					for ($j=0; $j<$nfilas; $j++){
					$resultado = mysql_fetch_array ($consulta);
					echo "<option value=\"".$resultado['idcuota']."\">".$resultado['texto']."</option>";
					}
					echo "</select>
					</div>
					</div>
					";
			}
			echo "	<div class=\"col-sm-3 col-md-3\">
			 <div class=\"form-group\">
				<label class=\" control-label\">Gol/es</label>
					<select name=\"Goles\" class=\"form-control input-sm\">
					<option value=\"\">Ningún</option>";
					for ($j=1; $j<=10; $j++){
					
					echo "<option value=\"".$j."\">".$j."</option>";
					}
					echo "</select>
					</div>
					</div>
					";
			echo "	<div class=\"col-sm-1 col-md-1\">
			 <div class=\"form-group\">
				<label class=\" control-label\">Cap.</label>
					<input type=\"checkbox\" name=\"cap\" value=\"".$resultado1['dni']."\" />
					</div>
					</div>
					";
			echo "
			<input name=\"ID\" type=\"hidden\" value=\"".$resultado1['dni']."\" />
			<input type=\"hidden\" name=\"posHab\" value=\"".$resultado1['posicionhab']."\"/>
			</li>";
		}
	for($i=0;$i<sizeof($eesCentrocampistaLContent);$i++) {
		mysql_set_charset("utf8");
		$instruccion="SELECT dni,alias,dorsal,foto,posicionhab FROM jugador WHERE dni='".$eesCentrocampistaLContent[$i]."'";
		$consulta = mysql_query ($instruccion, $conexion)
					or die ("FALLO EN LA CONSULTA $instruccion");
			$resultado1 = mysql_fetch_array ($consulta);
			if($resultado1['foto']=='') $foto="../../img/jug/sinfoto.png";
			else $foto="../../img/jug/fotosjug/".$resultado1['foto'];
			echo "<li style=\"overflow:auto;\" id=\"".$resultado1['dni']."\" class=\"cajajugador\">
			<div class=\"col-sm-3 col-md-3\"><img src=\"".$foto."\" style=\"border-radius:5px\" alt=\"foto del jugador ".$resultado1['alias']." \" title=\" ".$resultado1['alias']."\">
			<span class=\"nombreAliasCajaJugador\">".$resultado1['alias']."</span>&nbsp;&nbsp;<span class=\"DorsalCajaJugador\">".$resultado1['dorsal']."</span>
			</div>
			";
			
			$instruccion="SELECT idcuota,texto FROM cuota";
		$consulta = mysql_query ($instruccion, $conexion)
					or die ("FALLO EN LA CONSULTA $instruccion");
			$nfilas = mysql_num_rows ($consulta);
		if ($nfilas>0) {
			echo "	<div class=\"col-sm-4 col-md-4\">
			 <div class=\"form-group\">
				<label class=\" control-label\">Sanción</label>
					<select name=\"Sancionn\" class=\"form-control input-sm\">
					<option value=\"\">Ninguna</option>";
					for ($j=0; $j<$nfilas; $j++){
					$resultado = mysql_fetch_array ($consulta);
					echo "<option value=\"".$resultado['idcuota']."\">".$resultado['texto']."</option>";
					}
					echo "</select>
					</div>
					</div>
					";
			}
			echo "	<div class=\"col-sm-3 col-md-3\">
			 <div class=\"form-group\">
				<label class=\" control-label\">Gol/es</label>
					<select name=\"Goles\" class=\"form-control input-sm\">
					<option value=\"\">Ningún</option>";
					for ($j=1; $j<=10; $j++){
					
					echo "<option value=\"".$j."\">".$j."</option>";
					}
					echo "</select>
					</div>
					</div>
					";
			echo "	<div class=\"col-sm-1 col-md-1\">
			 <div class=\"form-group\">
				<label class=\" control-label\">Cap.</label>
					<input type=\"checkbox\" name=\"cap\" value=\"".$resultado1['dni']."\" />
					</div>
					</div>
					";
			echo "
			<input name=\"ID\" type=\"hidden\" value=\"".$resultado1['dni']."\" />
			<input type=\"hidden\" name=\"posHab\" value=\"".$resultado1['posicionhab']."\"/>
			</li>";
		
		}
	for($i=0;$i<sizeof($eesDefensaLContent);$i++) {
		mysql_set_charset("utf8");
		$instruccion="SELECT dni,alias,dorsal,foto,posicionhab FROM jugador WHERE dni='".$eesDefensaLContent[$i]."'";
		$consulta = mysql_query ($instruccion, $conexion)
					or die ("FALLO EN LA CONSULTA $instruccion");
			$resultado1 = mysql_fetch_array ($consulta);
			if($resultado1['foto']=='') $foto="../../img/jug/sinfoto.png";
			else $foto="../../img/jug/fotosjug/".$resultado1['foto'];
			echo "<li style=\"overflow:auto;\" id=\"".$resultado1['dni']."\" class=\"cajajugador\">
			<div class=\"col-sm-3 col-md-3\"><img src=\"".$foto."\" style=\"border-radius:5px\" alt=\"foto del jugador ".$resultado1['alias']." \" title=\" ".$resultado1['alias']."\">
			<span class=\"nombreAliasCajaJugador\">".$resultado1['alias']."</span>&nbsp;&nbsp;<span class=\"DorsalCajaJugador\">".$resultado1['dorsal']."</span>
			</div>
			";
			
			$instruccion="SELECT idcuota,texto FROM cuota";
		$consulta = mysql_query ($instruccion, $conexion)
					or die ("FALLO EN LA CONSULTA $instruccion");
			$nfilas = mysql_num_rows ($consulta);
		if ($nfilas>0) {
			echo "	<div class=\"col-sm-4 col-md-4\">
			 <div class=\"form-group\">
				<label class=\" control-label\">Sanción</label>
					<select name=\"Sancionn\" class=\"form-control input-sm\">
					<option value=\"\">Ninguna</option>";
					for ($j=0; $j<$nfilas; $j++){
					$resultado = mysql_fetch_array ($consulta);
					echo "<option value=\"".$resultado['idcuota']."\">".$resultado['texto']."</option>";
					}
					echo "</select>
					</div>
					</div>
					";
			}
			echo "	<div class=\"col-sm-3 col-md-3\">
			 <div class=\"form-group\">
				<label class=\" control-label\">Gol/es</label>
					<select name=\"Goles\" class=\"form-control input-sm\">
					<option value=\"\">Ningún</option>";
					for ($j=1; $j<=10; $j++){
					
					echo "<option value=\"".$j."\">".$j."</option>";
					}
					echo "</select>
					</div>
					</div>
					";
			echo "	<div class=\"col-sm-1 col-md-1\">
			 <div class=\"form-group\">
				<label class=\" control-label\">Cap.</label>
					<input type=\"checkbox\" name=\"cap\" value=\"".$resultado1['dni']."\" />
					</div>
					</div>
					";
			echo "
			<input name=\"ID\" type=\"hidden\" value=\"".$resultado1['dni']."\" />
			<input type=\"hidden\" name=\"posHab\" value=\"".$resultado1['posicionhab']."\"/>
			</li>";
		
		}
	for($i=0;$i<sizeof($eesPorteroLContent);$i++) {
		mysql_set_charset("utf8");
		$instruccion="SELECT dni,alias,dorsal,foto,posicionhab FROM jugador WHERE dni='".$eesPorteroLContent[$i]."'";
		$consulta = mysql_query ($instruccion, $conexion)
					or die ("FALLO EN LA CONSULTA $instruccion");
			$resultado1 = mysql_fetch_array ($consulta);
			if($resultado1['foto']=='') $foto="../../img/jug/sinfoto.png";
			else $foto="../../img/jug/fotosjug/".$resultado1['foto'];
			echo "<li style=\"overflow:auto;\" id=\"".$resultado1['dni']."\" class=\"cajajugador\">
			<div class=\"col-sm-3 col-md-3\"><img src=\"".$foto."\" style=\"border-radius:5px\" alt=\"foto del jugador ".$resultado1['alias']." \" title=\" ".$resultado1['alias']."\">
			<span class=\"nombreAliasCajaJugador\">".$resultado1['alias']."</span>&nbsp;&nbsp;<span class=\"DorsalCajaJugador\">".$resultado1['dorsal']."</span>
			</div>
			";
			
			$instruccion="SELECT idcuota,texto FROM cuota";
		$consulta = mysql_query ($instruccion, $conexion)
					or die ("FALLO EN LA CONSULTA $instruccion");
			$nfilas = mysql_num_rows ($consulta);
		if ($nfilas>0) {
			echo "	<div class=\"col-sm-4 col-md-4\">
			 <div class=\"form-group\">
				<label class=\" control-label\">Sanción</label>
					<select name=\"Sancionn\" class=\"form-control input-sm\">
					<option value=\"\">Ninguna</option>";
					for ($j=0; $j<$nfilas; $j++){
					$resultado = mysql_fetch_array ($consulta);
					echo "<option value=\"".$resultado['idcuota']."\">".$resultado['texto']."</option>";
					}
					echo "</select>
					</div>
					</div>
					";
			}
			echo "	<div class=\"col-sm-3 col-md-3\">
			 <div class=\"form-group\">
				<label class=\" control-label\">Gol/es</label>
					<select name=\"Goles\" class=\"form-control input-sm\">
					<option value=\"\">Ningún</option>";
					for ($j=1; $j<=10; $j++){
					
					echo "<option value=\"".$j."\">".$j."</option>";
					}
					echo "</select>
					</div>
					</div>
					";
			echo "	<div class=\"col-sm-1 col-md-1\">
			 <div class=\"form-group\">
				<label class=\" control-label\">Cap.</label>
					<input type=\"checkbox\" name=\"cap\" value=\"".$resultado1['dni']."\" />
					</div>
					</div>
					";
			echo "
			<input name=\"ID\" type=\"hidden\" value=\"".$resultado1['dni']."\" />
			<input type=\"hidden\" name=\"posHab\" value=\"".$resultado1['posicionhab']."\"/>
			</li>";
		
		}
 ?>
 </ul>
 
 
 
 
  </div>
</div>
		  <div class="panel panel-default colorNaranja">
  <div class="panel-heading visitante">Visitante</div>
  <div class="panel-body">
  <ul  class="col-sm12 col-md-12" style="list-style-type:none;">
     <?php
	 for($i=0;$i<sizeof($eesDelanteroVContent);$i++) {
		mysql_set_charset("utf8");
		$instruccion="SELECT dni,alias,dorsal,foto,posicionhab FROM jugador WHERE dni='".$eesDelanteroVContent[$i]."'";
		$consulta = mysql_query ($instruccion, $conexion)
					or die ("FALLO EN LA CONSULTA $instruccion");
			$resultado1 = mysql_fetch_array ($consulta);
			if($resultado1['foto']=='') $foto="../../img/jug/sinfoto.png";
			else $foto="../../img/jug/fotosjug/".$resultado1['foto'];
			echo "<li style=\"overflow:auto;\" id=\"".$resultado1['dni']."\" class=\"cajajugador\">
			<div class=\"col-sm-3 col-md-3\"><img src=\"".$foto."\" style=\"border-radius:5px\" alt=\"foto del jugador ".$resultado1['alias']." \" title=\" ".$resultado1['alias']."\">
			<span class=\"nombreAliasCajaJugador\">".$resultado1['alias']."</span>&nbsp;&nbsp;<span class=\"DorsalCajaJugador\">".$resultado1['dorsal']."</span>
			</div>
			";
			
			$instruccion="SELECT idcuota,texto FROM cuota";
		$consulta = mysql_query ($instruccion, $conexion)
					or die ("FALLO EN LA CONSULTA $instruccion");
			$nfilas = mysql_num_rows ($consulta);
		if ($nfilas>0) {
			echo "	<div class=\"col-sm-4 col-md-4\">
			 <div class=\"form-group\">
				<label class=\" control-label\">Sanción</label>
					<select name=\"Sancionn\" class=\"form-control input-sm\">
					<option value=\"\">Ninguna</option>";
					for ($j=0; $j<$nfilas; $j++){
					$resultado = mysql_fetch_array ($consulta);
					echo "<option value=\"".$resultado['idcuota']."\">".$resultado['texto']."</option>";
					}
					echo "</select>
					</div>
					</div>
					";
			}
			echo "	<div class=\"col-sm-3 col-md-3\">
			 <div class=\"form-group\">
				<label class=\" control-label\">Gol/es</label>
					<select name=\"Goles\" class=\"form-control input-sm\">
					<option value=\"\">Ningún</option>";
					for ($j=1; $j<=10; $j++){
					
					echo "<option value=\"".$j."\">".$j."</option>";
					}
					echo "</select>
					</div>
					</div>
					";
			echo "	<div class=\"col-sm-1 col-md-1\">
			 <div class=\"form-group\">
				<label class=\" control-label\">Cap.</label>
					<input type=\"checkbox\" name=\"cap\" value=\"".$resultado1['dni']."\" />
					</div>
					</div>
					";
			echo "
			<input name=\"ID\" type=\"hidden\" value=\"".$resultado1['dni']."\" />
			<input type=\"hidden\" name=\"posHab\" value=\"".$resultado1['posicionhab']."\"/>
			</li>";	
		}
	for($i=0;$i<sizeof($eesCentrocampistaVContent);$i++) {
		mysql_set_charset("utf8");
		$instruccion="SELECT dni,alias,dorsal,foto,posicionhab FROM jugador WHERE dni='".$eesCentrocampistaVContent[$i]."'";
		$consulta = mysql_query ($instruccion, $conexion)
					or die ("FALLO EN LA CONSULTA $instruccion");
			$resultado1 = mysql_fetch_array ($consulta);
			if($resultado1['foto']=='') $foto="../../img/jug/sinfoto.png";
			else $foto="../../img/jug/fotosjug/".$resultado1['foto'];
			echo "<li style=\"overflow:auto;\" id=\"".$resultado1['dni']."\" class=\"cajajugador\">
			<div class=\"col-sm-3 col-md-3\"><img src=\"".$foto."\" style=\"border-radius:5px\" alt=\"foto del jugador ".$resultado1['alias']." \" title=\" ".$resultado1['alias']."\">
			<span class=\"nombreAliasCajaJugador\">".$resultado1['alias']."</span>&nbsp;&nbsp;<span class=\"DorsalCajaJugador\">".$resultado1['dorsal']."</span>
			</div>
			";
			
			$instruccion="SELECT idcuota,texto FROM cuota";
		$consulta = mysql_query ($instruccion, $conexion)
					or die ("FALLO EN LA CONSULTA $instruccion");
			$nfilas = mysql_num_rows ($consulta);
		if ($nfilas>0) {
			echo "	<div class=\"col-sm-4 col-md-4\">
			 <div class=\"form-group\">
				<label class=\" control-label\">Sanción</label>
					<select name=\"Sancionn\" class=\"form-control input-sm\">
					<option value=\"\">Ninguna</option>";
					for ($j=0; $j<$nfilas; $j++){
					$resultado = mysql_fetch_array ($consulta);
					echo "<option value=\"".$resultado['idcuota']."\">".$resultado['texto']."</option>";
					}
					echo "</select>
					</div>
					</div>
					";
			}
			echo "	<div class=\"col-sm-3 col-md-3\">
			 <div class=\"form-group\">
				<label class=\" control-label\">Gol/es</label>
					<select name=\"Goles\" class=\"form-control input-sm\">
					<option value=\"\">Ningún</option>";
					for ($j=1; $j<=10; $j++){
					
					echo "<option value=\"".$j."\">".$j."</option>";
					}
					echo "</select>
					</div>
					</div>
					";
			echo "	<div class=\"col-sm-1 col-md-1\">
			 <div class=\"form-group\">
				<label class=\" control-label\">Cap.</label>
					<input type=\"checkbox\" name=\"cap\" value=\"".$resultado1['dni']."\" />
					</div>
					</div>
					";
			echo "
			<input name=\"ID\" type=\"hidden\" value=\"".$resultado1['dni']."\" />
			<input type=\"hidden\" name=\"posHab\" value=\"".$resultado1['posicionhab']."\"/>
			</li>";
		
		}
	for($i=0;$i<sizeof($eesDefensaVContent);$i++) {
		mysql_set_charset("utf8");
		$instruccion="SELECT dni,alias,dorsal,foto,posicionhab FROM jugador WHERE dni='".$eesDefensaVContent[$i]."'";
		$consulta = mysql_query ($instruccion, $conexion)
					or die ("FALLO EN LA CONSULTA $instruccion");
			$resultado1 = mysql_fetch_array ($consulta);
			if($resultado1['foto']=='') $foto="../../img/jug/sinfoto.png";
			else $foto="../../img/jug/fotosjug/".$resultado1['foto'];
			echo "<li style=\"overflow:auto;\" id=\"".$resultado1['dni']."\" class=\"cajajugador\">
			<div class=\"col-sm-3 col-md-3\"><img src=\"".$foto."\" style=\"border-radius:5px\" alt=\"foto del jugador ".$resultado1['alias']." \" title=\" ".$resultado1['alias']."\">
			<span class=\"nombreAliasCajaJugador\">".$resultado1['alias']."</span>&nbsp;&nbsp;<span class=\"DorsalCajaJugador\">".$resultado1['dorsal']."</span>
			</div>
			";
			
			$instruccion="SELECT idcuota,texto FROM cuota";
		$consulta = mysql_query ($instruccion, $conexion)
					or die ("FALLO EN LA CONSULTA $instruccion");
			$nfilas = mysql_num_rows ($consulta);
		if ($nfilas>0) {
			echo "	<div class=\"col-sm-4 col-md-4\">
			 <div class=\"form-group\">
				<label class=\" control-label\">Sanción</label>
					<select name=\"Sancionn\" class=\"form-control input-sm\">
					<option value=\"\">Ninguna</option>";
					for ($j=0; $j<$nfilas; $j++){
					$resultado = mysql_fetch_array ($consulta);
					echo "<option value=\"".$resultado['idcuota']."\">".$resultado['texto']."</option>";
					}
					echo "</select>
					</div>
					</div>
					";
			}
			echo "	<div class=\"col-sm-3 col-md-3\">
			 <div class=\"form-group\">
				<label class=\" control-label\">Gol/es</label>
					<select name=\"Goles\" class=\"form-control input-sm\">
					<option value=\"\">Ningún</option>";
					for ($j=1; $j<=10; $j++){
					
					echo "<option value=\"".$j."\">".$j."</option>";
					}
					echo "</select>
					</div>
					</div>
					";
			echo "	<div class=\"col-sm-1 col-md-1\">
			 <div class=\"form-group\">
				<label class=\" control-label\">Cap.</label>
					<input type=\"checkbox\" name=\"cap\" value=\"".$resultado1['dni']."\" />
					</div>
					</div>
					";
			echo "
			<input name=\"ID\" type=\"hidden\" value=\"".$resultado1['dni']."\" />
			<input type=\"hidden\" name=\"posHab\" value=\"".$resultado1['posicionhab']."\"/>
			</li>";
		
		}
	for($i=0;$i<sizeof($eesPorteroVContent);$i++) {
		mysql_set_charset("utf8");
		$instruccion="SELECT dni,alias,dorsal,foto,posicionhab FROM jugador WHERE dni='".$eesPorteroVContent[$i]."'";
		$consulta = mysql_query ($instruccion, $conexion)
					or die ("FALLO EN LA CONSULTA $instruccion");
			$resultado1 = mysql_fetch_array ($consulta);
			if($resultado1['foto']=='') $foto="../../img/jug/sinfoto.png";
			else $foto="../../img/jug/fotosjug/".$resultado1['foto'];
			echo "<li style=\"overflow:auto;\" id=\"".$resultado1['dni']."\" class=\"cajajugador\">
			<div class=\"col-sm-3 col-md-3\"><img src=\"".$foto."\" style=\"border-radius:5px\" alt=\"foto del jugador ".$resultado1['alias']." \" title=\" ".$resultado1['alias']."\">
			<span class=\"nombreAliasCajaJugador\">".$resultado1['alias']."</span>&nbsp;&nbsp;<span class=\"DorsalCajaJugador\">".$resultado1['dorsal']."</span>
			</div>
			";
			
			$instruccion="SELECT idcuota,texto FROM cuota";
		$consulta = mysql_query ($instruccion, $conexion)
					or die ("FALLO EN LA CONSULTA $instruccion");
			$nfilas = mysql_num_rows ($consulta);
		if ($nfilas>0) {
			echo "	<div class=\"col-sm-4 col-md-4\">
			 <div class=\"form-group\">
				<label class=\" control-label\">Sanción</label>
					<select name=\"Sancionn\" class=\"form-control input-sm\">
					<option value=\"\">Ninguna</option>";
					for ($j=0; $j<$nfilas; $j++){
					$resultado = mysql_fetch_array ($consulta);
					echo "<option value=\"".$resultado['idcuota']."\">".$resultado['texto']."</option>";
					}
					echo "</select>
					</div>
					</div>
					";
			}
			echo "	<div class=\"col-sm-3 col-md-3\">
			 <div class=\"form-group\">
				<label class=\" control-label\">Gol/es</label>
					<select name=\"Goles\" class=\"form-control input-sm\">
					<option value=\"\">Ningún</option>";
					for ($j=1; $j<=10; $j++){
					
					echo "<option value=\"".$j."\">".$j."</option>";
					}
					echo "</select>
					</div>
					</div>
					";
			echo "	<div class=\"col-sm-1 col-md-1\">
			 <div class=\"form-group\">
				<label class=\" control-label\">Cap.</label>
					<input type=\"checkbox\" name=\"cap\" value=\"".$resultado1['dni']."\" />
					</div>
					</div>
					";
			echo "
			<input name=\"ID\" type=\"hidden\" value=\"".$resultado1['dni']."\" />
			<input type=\"hidden\" name=\"posHab\" value=\"".$resultado1['posicionhab']."\"/>
			</li>";
		
		}
 ?>
 </ul>
  </div>
</div>
	<?php
 } /*</ SI HAY ESTRATEGIA DE LOS DOS> */
  else if ($_POST['njugadoreslocalActual']==0) { 
	/*echo " sólo hay estrategia de los locales"; */ ?>
	  <div class="panel panel-default colorNegro">
  <div class="panel-heading local">Local</div>
  <div class="panel-body">
  <ul class="col-sm12 col-md-12" style="list-style-type:none;">
     <?php
	 for($i=0;$i<sizeof($eesDelanteroLContent);$i++) {
		mysql_set_charset("utf8");
		$instruccion="SELECT dni,alias,dorsal,foto,posicionhab FROM jugador WHERE dni='".$eesDelanteroLContent[$i]."'";
		$consulta = mysql_query ($instruccion, $conexion)
					or die ("FALLO EN LA CONSULTA $instruccion");
			$resultado1 = mysql_fetch_array ($consulta);
			if($resultado1['foto']=='') $foto="../../img/jug/sinfoto.png";
			else $foto="../../img/jug/fotosjug/".$resultado1['foto'];
			echo "<li style=\"overflow:auto;\" id=\"".$resultado1['dni']."\" class=\"cajajugador\">
			<div class=\"col-sm-3 col-md-3\"><img src=\"".$foto."\" style=\"border-radius:5px\" alt=\"foto del jugador ".$resultado1['alias']." \" title=\" ".$resultado1['alias']."\">
			<span class=\"nombreAliasCajaJugador\">".$resultado1['alias']."</span>&nbsp;&nbsp;<span class=\"DorsalCajaJugador\">".$resultado1['dorsal']."</span>
			</div>
			";
			
			$instruccion="SELECT idcuota,texto FROM cuota";
		$consulta = mysql_query ($instruccion, $conexion)
					or die ("FALLO EN LA CONSULTA $instruccion");
			$nfilas = mysql_num_rows ($consulta);
		if ($nfilas>0) {
			echo "	<div class=\"col-sm-4 col-md-4\">
			 <div class=\"form-group\">
				<label class=\" control-label\">Sanción</label>
					<select name=\"Sancionn\" class=\"form-control input-sm\">
					<option value=\"\">Ninguna</option>";
					for ($j=0; $j<$nfilas; $j++){
					$resultado = mysql_fetch_array ($consulta);
					echo "<option value=\"".$resultado['idcuota']."\">".$resultado['texto']."</option>";
					}
					echo "</select>
					</div>
					</div>
					";
			}
			echo "	<div class=\"col-sm-3 col-md-3\">
			 <div class=\"form-group\">
				<label class=\" control-label\">Gol/es</label>
					<select name=\"Goles\" class=\"form-control input-sm\">
					<option value=\"\">Ningún</option>";
					for ($j=1; $j<=10; $j++){
					
					echo "<option value=\"".$j."\">".$j."</option>";
					}
					echo "</select>
					</div>
					</div>
					";
			echo "	<div class=\"col-sm-1 col-md-1\">
			 <div class=\"form-group\">
				<label class=\" control-label\">Cap.</label>
					<input type=\"checkbox\" name=\"cap\" value=\"".$resultado1['dni']."\" />
					</div>
					</div>
					";
			echo "
			<input name=\"ID\" type=\"hidden\" value=\"".$resultado1['dni']."\" />
			<input type=\"hidden\" name=\"posHab\" value=\"".$resultado1['posicionhab']."\"/>
			</li>";
		}
	for($i=0;$i<sizeof($eesCentrocampistaLContent);$i++) {
		mysql_set_charset("utf8");
		$instruccion="SELECT dni,alias,dorsal,foto,posicionhab FROM jugador WHERE dni='".$eesCentrocampistaLContent[$i]."'";
		$consulta = mysql_query ($instruccion, $conexion)
					or die ("FALLO EN LA CONSULTA $instruccion");
			$resultado1 = mysql_fetch_array ($consulta);
			if($resultado1['foto']=='') $foto="../../img/jug/sinfoto.png";
			else $foto="../../img/jug/fotosjug/".$resultado1['foto'];
			echo "<li style=\"overflow:auto;\" id=\"".$resultado1['dni']."\" class=\"cajajugador\">
			<div class=\"col-sm-3 col-md-3\"><img src=\"".$foto."\" style=\"border-radius:5px\" alt=\"foto del jugador ".$resultado1['alias']." \" title=\" ".$resultado1['alias']."\">
			<span class=\"nombreAliasCajaJugador\">".$resultado1['alias']."</span>&nbsp;&nbsp;<span class=\"DorsalCajaJugador\">".$resultado1['dorsal']."</span>
			</div>
			";
			
			$instruccion="SELECT idcuota,texto FROM cuota";
		$consulta = mysql_query ($instruccion, $conexion)
					or die ("FALLO EN LA CONSULTA $instruccion");
			$nfilas = mysql_num_rows ($consulta);
		if ($nfilas>0) {
			echo "	<div class=\"col-sm-4 col-md-4\">
			 <div class=\"form-group\">
				<label class=\" control-label\">Sanción</label>
					<select name=\"Sancionn\" class=\"form-control input-sm\">
					<option value=\"\">Ninguna</option>";
					for ($j=0; $j<$nfilas; $j++){
					$resultado = mysql_fetch_array ($consulta);
					echo "<option value=\"".$resultado['idcuota']."\">".$resultado['texto']."</option>";
					}
					echo "</select>
					</div>
					</div>
					";
			}
			echo "	<div class=\"col-sm-3 col-md-3\">
			 <div class=\"form-group\">
				<label class=\" control-label\">Gol/es</label>
					<select name=\"Goles\" class=\"form-control input-sm\">
					<option value=\"\">Ningún</option>";
					for ($j=1; $j<=10; $j++){
					
					echo "<option value=\"".$j."\">".$j."</option>";
					}
					echo "</select>
					</div>
					</div>
					";
			echo "	<div class=\"col-sm-1 col-md-1\">
			 <div class=\"form-group\">
				<label class=\" control-label\">Cap.</label>
					<input type=\"checkbox\" name=\"cap\" value=\"".$resultado1['dni']."\" />
					</div>
					</div>
					";
			echo "
			<input name=\"ID\" type=\"hidden\" value=\"".$resultado1['dni']."\" />
			<input type=\"hidden\" name=\"posHab\" value=\"".$resultado1['posicionhab']."\"/>
			</li>";
		
		}
	for($i=0;$i<sizeof($eesDefensaLContent);$i++) {
		mysql_set_charset("utf8");
		$instruccion="SELECT dni,alias,dorsal,foto,posicionhab FROM jugador WHERE dni='".$eesDefensaLContent[$i]."'";
		$consulta = mysql_query ($instruccion, $conexion)
					or die ("FALLO EN LA CONSULTA $instruccion");
			$resultado1 = mysql_fetch_array ($consulta);
			if($resultado1['foto']=='') $foto="../../img/jug/sinfoto.png";
			else $foto="../../img/jug/fotosjug/".$resultado1['foto'];
			echo "<li style=\"overflow:auto;\" id=\"".$resultado1['dni']."\" class=\"cajajugador\">
			<div class=\"col-sm-3 col-md-3\"><img src=\"".$foto."\" style=\"border-radius:5px\" alt=\"foto del jugador ".$resultado1['alias']." \" title=\" ".$resultado1['alias']."\">
			<span class=\"nombreAliasCajaJugador\">".$resultado1['alias']."</span>&nbsp;&nbsp;<span class=\"DorsalCajaJugador\">".$resultado1['dorsal']."</span>
			</div>
			";
			
			$instruccion="SELECT idcuota,texto FROM cuota";
		$consulta = mysql_query ($instruccion, $conexion)
					or die ("FALLO EN LA CONSULTA $instruccion");
			$nfilas = mysql_num_rows ($consulta);
		if ($nfilas>0) {
			echo "	<div class=\"col-sm-4 col-md-4\">
			 <div class=\"form-group\">
				<label class=\" control-label\">Sanción</label>
					<select name=\"Sancionn\" class=\"form-control input-sm\">
					<option value=\"\">Ninguna</option>";
					for ($j=0; $j<$nfilas; $j++){
					$resultado = mysql_fetch_array ($consulta);
					echo "<option value=\"".$resultado['idcuota']."\">".$resultado['texto']."</option>";
					}
					echo "</select>
					</div>
					</div>
					";
			}
			echo "	<div class=\"col-sm-3 col-md-3\">
			 <div class=\"form-group\">
				<label class=\" control-label\">Gol/es</label>
					<select name=\"Goles\" class=\"form-control input-sm\">
					<option value=\"\">Ningún</option>";
					for ($j=1; $j<=10; $j++){
					
					echo "<option value=\"".$j."\">".$j."</option>";
					}
					echo "</select>
					</div>
					</div>
					";
			echo "	<div class=\"col-sm-1 col-md-1\">
			 <div class=\"form-group\">
				<label class=\" control-label\">Cap.</label>
					<input type=\"checkbox\" name=\"cap\" value=\"".$resultado1['dni']."\" />
					</div>
					</div>
					";
			echo "
			<input name=\"ID\" type=\"hidden\" value=\"".$resultado1['dni']."\" />
			<input type=\"hidden\" name=\"posHab\" value=\"".$resultado1['posicionhab']."\"/>
			</li>";
		
		}
	for($i=0;$i<sizeof($eesPorteroLContent);$i++) {
		mysql_set_charset("utf8");
		$instruccion="SELECT dni,alias,dorsal,foto,posicionhab FROM jugador WHERE dni='".$eesPorteroLContent[$i]."'";
		$consulta = mysql_query ($instruccion, $conexion)
					or die ("FALLO EN LA CONSULTA $instruccion");
			$resultado1 = mysql_fetch_array ($consulta);
			if($resultado1['foto']=='') $foto="../../img/jug/sinfoto.png";
			else $foto="../../img/jug/fotosjug/".$resultado1['foto'];
			echo "<li style=\"overflow:auto;\" id=\"".$resultado1['dni']."\" class=\"cajajugador\">
			<div class=\"col-sm-3 col-md-3\"><img src=\"".$foto."\" style=\"border-radius:5px\" alt=\"foto del jugador ".$resultado1['alias']." \" title=\" ".$resultado1['alias']."\">
			<span class=\"nombreAliasCajaJugador\">".$resultado1['alias']."</span>&nbsp;&nbsp;<span class=\"DorsalCajaJugador\">".$resultado1['dorsal']."</span>
			</div>
			";
			
			$instruccion="SELECT idcuota,texto FROM cuota";
		$consulta = mysql_query ($instruccion, $conexion)
					or die ("FALLO EN LA CONSULTA $instruccion");
			$nfilas = mysql_num_rows ($consulta);
		if ($nfilas>0) {
			echo "	<div class=\"col-sm-4 col-md-4\">
			 <div class=\"form-group\">
				<label class=\" control-label\">Sanción</label>
					<select name=\"Sancionn\" class=\"form-control input-sm\">
					<option value=\"\">Ninguna</option>";
					for ($j=0; $j<$nfilas; $j++){
					$resultado = mysql_fetch_array ($consulta);
					echo "<option value=\"".$resultado['idcuota']."\">".$resultado['texto']."</option>";
					}
					echo "</select>
					</div>
					</div>
					";
			}
			echo "	<div class=\"col-sm-3 col-md-3\">
			 <div class=\"form-group\">
				<label class=\" control-label\">Gol/es</label>
					<select name=\"Goles\" class=\"form-control input-sm\">
					<option value=\"\">Ningún</option>";
					for ($j=1; $j<=10; $j++){
					
					echo "<option value=\"".$j."\">".$j."</option>";
					}
					echo "</select>
					</div>
					</div>
					";
			echo "	<div class=\"col-sm-1 col-md-1\">
			 <div class=\"form-group\">
				<label class=\" control-label\">Cap.</label>
					<input type=\"checkbox\" name=\"cap\" value=\"".$resultado1['dni']."\" />
					</div>
					</div>
					";
			echo "
			<input name=\"ID\" type=\"hidden\" value=\"".$resultado1['dni']."\" />
			<input type=\"hidden\" name=\"posHab\" value=\"".$resultado1['posicionhab']."\"/>
			</li>";
		
		}
 ?>
 </ul>
  </div>
</div>
  <div class="panel panel-default colorNaranja">
  <div class="panel-heading visitante">Visitante</div>
  <div class="panel-body">
  <ul class="col-sm12 col-md-12" style="list-style-type:none;">
     <?php
	 for($i=0;$i<sizeof($evisitante);$i++) {
			
		mysql_set_charset("utf8");
		$instruccion="SELECT dni,alias,dorsal,foto,posicionhab FROM jugador WHERE dni='".$evisitante[$i]."'";
		$consulta = mysql_query ($instruccion, $conexion)
					or die ("FALLO EN LA CONSULTA $instruccion");
			$resultado1 = mysql_fetch_array ($consulta);
			if($resultado1['foto']=='') $foto="../../img/jug/sinfoto.png";
			else $foto="../../img/jug/fotosjug/".$resultado1['foto'];
			echo "<li style=\"overflow:auto;\" id=\"".$resultado1['dni']."\" class=\"cajajugador\">
			<div class=\"col-sm-3 col-md-3\"><img src=\"".$foto."\" style=\"border-radius:5px\" alt=\"foto del jugador ".$resultado1['alias']." \" title=\" ".$resultado1['alias']."\">
			<span class=\"nombreAliasCajaJugador\">".$resultado1['alias']."</span>&nbsp;&nbsp;<span class=\"DorsalCajaJugador\">".$resultado1['dorsal']."</span>
			</div>
			";
			
			$instruccion="SELECT idcuota,texto FROM cuota";
		$consulta = mysql_query ($instruccion, $conexion)
					or die ("FALLO EN LA CONSULTA $instruccion");
			$nfilas = mysql_num_rows ($consulta);
		if ($nfilas>0) {
			echo "	<div class=\"col-sm-4 col-md-4\">
			 <div class=\"form-group\">
				<label class=\" control-label\">Sanción</label>
					<select name=\"Sancionn\" class=\"form-control input-sm\">
					<option value=\"\">Ninguna</option>";
					for ($j=0; $j<$nfilas; $j++){
					$resultado = mysql_fetch_array ($consulta);
					echo "<option value=\"".$resultado['idcuota']."\">".$resultado['texto']."</option>";
					}
					echo "</select>
					</div>
					</div>
					";
			}
			echo "	<div class=\"col-sm-3 col-md-3\">
			 <div class=\"form-group\">
				<label class=\" control-label\">Gol/es</label>
					<select name=\"Goles\" class=\"form-control input-sm\">
					<option value=\"\">Ningún</option>";
					for ($j=1; $j<=10; $j++){
					
					echo "<option value=\"".$j."\">".$j."</option>";
					}
					echo "</select>
					</div>
					</div>
					";
			echo "	<div class=\"col-sm-1 col-md-1\">
			 <div class=\"form-group\">
				<label class=\" control-label\">Cap.</label>
					<input type=\"checkbox\" name=\"cap\" value=\"".$resultado1['dni']."\" />
					</div>
					</div>
					";
			echo "
			<input name=\"ID\" type=\"hidden\" value=\"".$resultado1['dni']."\" />
			<input type=\"hidden\" name=\"posHab\" value=\"".$resultado1['posicionhab']."\"/>
			</li>";

		} ?>
</ul>
</div> <!-- / panel body -->
</div> <!-- / panel -->
 <?php
 }
 else {
  /*echo " sólo hay estrategia de los visitantes";*/
  
  ?>
  	  <div class="panel panel-default colorNegro">
		  <div class="panel-heading local">Local</div>
		  <div class="panel-body">
  <ul class="col-sm12 col-md-12" style="list-style-type:none;">
     <?php
	 for($i=0;$i<sizeof($elocal);$i++) {
			
		mysql_set_charset("utf8");
		$instruccion="SELECT dni,alias,dorsal,foto,posicionhab FROM jugador WHERE dni='".$elocal[$i]."'";
		$consulta = mysql_query ($instruccion, $conexion)
					or die ("FALLO EN LA CONSULTA $instruccion");
			$resultado1 = mysql_fetch_array ($consulta);
			if($resultado1['foto']=='') $foto="../../img/jug/sinfoto.png";
			else $foto="../../img/jug/fotosjug/".$resultado1['foto'];
			echo "<li style=\"overflow:auto;\" id=\"".$resultado1['dni']."\" class=\"cajajugador\">
			<div class=\"col-sm-3 col-md-3\"><img src=\"".$foto."\" style=\"border-radius:5px\" alt=\"foto del jugador ".$resultado1['alias']." \" title=\" ".$resultado1['alias']."\">
			<span class=\"nombreAliasCajaJugador\">".$resultado1['alias']."</span>&nbsp;&nbsp;<span class=\"DorsalCajaJugador\">".$resultado1['dorsal']."</span>
			</div>
			";
			
			$instruccion="SELECT idcuota,texto FROM cuota";
		$consulta = mysql_query ($instruccion, $conexion)
					or die ("FALLO EN LA CONSULTA $instruccion");
			$nfilas = mysql_num_rows ($consulta);
		if ($nfilas>0) {
			echo "	<div class=\"col-sm-4 col-md-4\">
			 <div class=\"form-group\">
				<label class=\" control-label\">Sanción</label>
					<select name=\"Sancionn\" class=\"form-control input-sm\">
					<option value=\"\">Ninguna</option>";
					for ($j=0; $j<$nfilas; $j++){
					$resultado = mysql_fetch_array ($consulta);
					echo "<option value=\"".$resultado['idcuota']."\">".$resultado['texto']."</option>";
					}
					echo "</select>
					</div>
					</div>
					";
			}
			echo "	<div class=\"col-sm-3 col-md-3\">
			 <div class=\"form-group\">
				<label class=\" control-label\">Gol/es</label>
					<select name=\"Goles\" class=\"form-control input-sm\">
					<option value=\"\">Ningún</option>";
					for ($j=1; $j<=10; $j++){
					
					echo "<option value=\"".$j."\">".$j."</option>";
					}
					echo "</select>
					</div>
					</div>
					";
			echo "	<div class=\"col-sm-1 col-md-1\">
			 <div class=\"form-group\">
				<label class=\" control-label\">Cap.</label>
					<input type=\"checkbox\" name=\"cap\" value=\"".$resultado1['dni']."\" />
					</div>
					</div>
					";
			echo "
			<input name=\"ID\" type=\"hidden\" value=\"".$resultado1['dni']."\" />
			<input type=\"hidden\" name=\"posHab\" value=\"".$resultado1['posicionhab']."\"/>
			</li>";

		} ?>
</ul>
		</div> <!-- / panel body -->
	</div> <!-- / panel -->
	  <div class="panel panel-default colorNaranja">
  <div class="panel-heading visitante">Visitante</div>
  <div class="panel-body">
  <ul class="col-sm12 col-md-12" style="list-style-type:none;">
     <?php
	 for($i=0;$i<sizeof($eesDelanteroVContent);$i++) {
		mysql_set_charset("utf8");
		$instruccion="SELECT dni,alias,dorsal,foto,posicionhab FROM jugador WHERE dni='".$eesDelanteroVContent[$i]."'";
		$consulta = mysql_query ($instruccion, $conexion)
					or die ("FALLO EN LA CONSULTA $instruccion");
			$resultado1 = mysql_fetch_array ($consulta);
			if($resultado1['foto']=='') $foto="../../img/jug/sinfoto.png";
			else $foto="../../img/jug/fotosjug/".$resultado1['foto'];
			echo "<li style=\"overflow:auto;\" id=\"".$resultado1['dni']."\" class=\"cajajugador\">
			<div class=\"col-sm-3 col-md-3\"><img src=\"".$foto."\" style=\"border-radius:5px\" alt=\"foto del jugador ".$resultado1['alias']." \" title=\" ".$resultado1['alias']."\">
			<span class=\"nombreAliasCajaJugador\">".$resultado1['alias']."</span>&nbsp;&nbsp;<span class=\"DorsalCajaJugador\">".$resultado1['dorsal']."</span>
			</div>
			";
			
			$instruccion="SELECT idcuota,texto FROM cuota";
		$consulta = mysql_query ($instruccion, $conexion)
					or die ("FALLO EN LA CONSULTA $instruccion");
			$nfilas = mysql_num_rows ($consulta);
		if ($nfilas>0) {
			echo "	<div class=\"col-sm-4 col-md-4\">
			 <div class=\"form-group\">
				<label class=\" control-label\">Sanción</label>
					<select name=\"Sancionn\" class=\"form-control input-sm\">
					<option value=\"\">Ninguna</option>";
					for ($j=0; $j<$nfilas; $j++){
					$resultado = mysql_fetch_array ($consulta);
					echo "<option value=\"".$resultado['idcuota']."\">".$resultado['texto']."</option>";
					}
					echo "</select>
					</div>
					</div>
					";
			}
			echo "	<div class=\"col-sm-3 col-md-3\">
			 <div class=\"form-group\">
				<label class=\" control-label\">Gol/es</label>
					<select name=\"Goles\" class=\"form-control input-sm\">
					<option value=\"\">Ningún</option>";
					for ($j=1; $j<=10; $j++){
					
					echo "<option value=\"".$j."\">".$j."</option>";
					}
					echo "</select>
					</div>
					</div>
					";
			echo "	<div class=\"col-sm-1 col-md-1\">
			 <div class=\"form-group\">
				<label class=\" control-label\">Cap.</label>
					<input type=\"checkbox\" name=\"cap\" value=\"".$resultado1['dni']."\" />
					</div>
					</div>
					";
			echo "
			<input name=\"ID\" type=\"hidden\" value=\"".$resultado1['dni']."\" />
			<input type=\"hidden\" name=\"posHab\" value=\"".$resultado1['posicionhab']."\"/>
			</li>";	
		}
	for($i=0;$i<sizeof($eesCentrocampistaVContent);$i++) {
		mysql_set_charset("utf8");
		$instruccion="SELECT dni,alias,dorsal,foto,posicionhab FROM jugador WHERE dni='".$eesCentrocampistaVContent[$i]."'";
		$consulta = mysql_query ($instruccion, $conexion)
					or die ("FALLO EN LA CONSULTA $instruccion");
			$resultado1 = mysql_fetch_array ($consulta);
			if($resultado1['foto']=='') $foto="../../img/jug/sinfoto.png";
			else $foto="../../img/jug/fotosjug/".$resultado1['foto'];
			echo "<li style=\"overflow:auto;\" id=\"".$resultado1['dni']."\" class=\"cajajugador\">
			<div class=\"col-sm-3 col-md-3\"><img src=\"".$foto."\" style=\"border-radius:5px\" alt=\"foto del jugador ".$resultado1['alias']." \" title=\" ".$resultado1['alias']."\">
			<span class=\"nombreAliasCajaJugador\">".$resultado1['alias']."</span>&nbsp;&nbsp;<span class=\"DorsalCajaJugador\">".$resultado1['dorsal']."</span>
			</div>
			";
			
			$instruccion="SELECT idcuota,texto FROM cuota";
		$consulta = mysql_query ($instruccion, $conexion)
					or die ("FALLO EN LA CONSULTA $instruccion");
			$nfilas = mysql_num_rows ($consulta);
		if ($nfilas>0) {
			echo "	<div class=\"col-sm-4 col-md-4\">
			 <div class=\"form-group\">
				<label class=\" control-label\">Sanción</label>
					<select name=\"Sancionn\" class=\"form-control input-sm\">
					<option value=\"\">Ninguna</option>";
					for ($j=0; $j<$nfilas; $j++){
					$resultado = mysql_fetch_array ($consulta);
					echo "<option value=\"".$resultado['idcuota']."\">".$resultado['texto']."</option>";
					}
					echo "</select>
					</div>
					</div>
					";
			}
			echo "	<div class=\"col-sm-3 col-md-3\">
			 <div class=\"form-group\">
				<label class=\" control-label\">Gol/es</label>
					<select name=\"Goles\" class=\"form-control input-sm\">
					<option value=\"\">Ningún</option>";
					for ($j=1; $j<=10; $j++){
					
					echo "<option value=\"".$j."\">".$j."</option>";
					}
					echo "</select>
					</div>
					</div>
					";
			echo "	<div class=\"col-sm-1 col-md-1\">
			 <div class=\"form-group\">
				<label class=\" control-label\">Cap.</label>
					<input type=\"checkbox\" name=\"cap\" value=\"".$resultado1['dni']."\" />
					</div>
					</div>
					";
			echo "
			<input name=\"ID\" type=\"hidden\" value=\"".$resultado1['dni']."\" />
			<input type=\"hidden\" name=\"posHab\" value=\"".$resultado1['posicionhab']."\"/>
			</li>";
		
		}
	for($i=0;$i<sizeof($eesDefensaVContent);$i++) {
		mysql_set_charset("utf8");
		$instruccion="SELECT dni,alias,dorsal,foto,posicionhab FROM jugador WHERE dni='".$eesDefensaVContent[$i]."'";
		$consulta = mysql_query ($instruccion, $conexion)
					or die ("FALLO EN LA CONSULTA $instruccion");
			$resultado1 = mysql_fetch_array ($consulta);
			if($resultado1['foto']=='') $foto="../../img/jug/sinfoto.png";
			else $foto="../../img/jug/fotosjug/".$resultado1['foto'];
			echo "<li style=\"overflow:auto;\" id=\"".$resultado1['dni']."\" class=\"cajajugador\">
			<div class=\"col-sm-3 col-md-3\"><img src=\"".$foto."\" style=\"border-radius:5px\" alt=\"foto del jugador ".$resultado1['alias']." \" title=\" ".$resultado1['alias']."\">
			<span class=\"nombreAliasCajaJugador\">".$resultado1['alias']."</span>&nbsp;&nbsp;<span class=\"DorsalCajaJugador\">".$resultado1['dorsal']."</span>
			</div>
			";
			
			$instruccion="SELECT idcuota,texto FROM cuota";
		$consulta = mysql_query ($instruccion, $conexion)
					or die ("FALLO EN LA CONSULTA $instruccion");
			$nfilas = mysql_num_rows ($consulta);
		if ($nfilas>0) {
			echo "	<div class=\"col-sm-4 col-md-4\">
			 <div class=\"form-group\">
				<label class=\" control-label\">Sanción</label>
					<select name=\"Sancionn\" class=\"form-control input-sm\">
					<option value=\"\">Ninguna</option>";
					for ($j=0; $j<$nfilas; $j++){
					$resultado = mysql_fetch_array ($consulta);
					echo "<option value=\"".$resultado['idcuota']."\">".$resultado['texto']."</option>";
					}
					echo "</select>
					</div>
					</div>
					";
			}
			echo "	<div class=\"col-sm-3 col-md-3\">
			 <div class=\"form-group\">
				<label class=\" control-label\">Gol/es</label>
					<select name=\"Goles\" class=\"form-control input-sm\">
					<option value=\"\">Ningún</option>";
					for ($j=1; $j<=10; $j++){
					
					echo "<option value=\"".$j."\">".$j."</option>";
					}
					echo "</select>
					</div>
					</div>
					";
			echo "	<div class=\"col-sm-1 col-md-1\">
			 <div class=\"form-group\">
				<label class=\" control-label\">Cap.</label>
					<input type=\"checkbox\" name=\"cap\" value=\"".$resultado1['dni']."\" />
					</div>
					</div>
					";
			echo "
			<input name=\"ID\" type=\"hidden\" value=\"".$resultado1['dni']."\" />
			<input type=\"hidden\" name=\"posHab\" value=\"".$resultado1['posicionhab']."\"/>
			</li>";
		
		}
	for($i=0;$i<sizeof($eesPorteroVContent);$i++) {
		mysql_set_charset("utf8");
		$instruccion="SELECT dni,alias,dorsal,foto,posicionhab FROM jugador WHERE dni='".$eesPorteroVContent[$i]."'";
		$consulta = mysql_query ($instruccion, $conexion)
					or die ("FALLO EN LA CONSULTA $instruccion");
			$resultado1 = mysql_fetch_array ($consulta);
			if($resultado1['foto']=='') $foto="../../img/jug/sinfoto.png";
			else $foto="../../img/jug/fotosjug/".$resultado1['foto'];
			echo "<li style=\"overflow:auto;\" id=\"".$resultado1['dni']."\" class=\"cajajugador\">
			<div class=\"col-sm-3 col-md-3\"><img src=\"".$foto."\" style=\"border-radius:5px\" alt=\"foto del jugador ".$resultado1['alias']." \" title=\" ".$resultado1['alias']."\">
			<span class=\"nombreAliasCajaJugador\">".$resultado1['alias']."</span>&nbsp;&nbsp;<span class=\"DorsalCajaJugador\">".$resultado1['dorsal']."</span>
			</div>
			";
			
			$instruccion="SELECT idcuota,texto FROM cuota";
		$consulta = mysql_query ($instruccion, $conexion)
					or die ("FALLO EN LA CONSULTA $instruccion");
			$nfilas = mysql_num_rows ($consulta);
		if ($nfilas>0) {
			echo "	<div class=\"col-sm-4 col-md-4\">
			 <div class=\"form-group\">
				<label class=\" control-label\">Sanción</label>
					<select name=\"Sancionn\" class=\"form-control input-sm\">
					<option value=\"\">Ninguna</option>";
					for ($j=0; $j<$nfilas; $j++){
					$resultado = mysql_fetch_array ($consulta);
					echo "<option value=\"".$resultado['idcuota']."\">".$resultado['texto']."</option>";
					}
					echo "</select>
					</div>
					</div>
					";
			}
			echo "	<div class=\"col-sm-3 col-md-3\">
			 <div class=\"form-group\">
				<label class=\" control-label\">Gol/es</label>
					<select name=\"Goles\" class=\"form-control input-sm\">
					<option value=\"\">Ningún</option>";
					for ($j=1; $j<=10; $j++){
					
					echo "<option value=\"".$j."\">".$j."</option>";
					}
					echo "</select>
					</div>
					</div>
					";
			echo "	<div class=\"col-sm-1 col-md-1\">
			 <div class=\"form-group\">
				<label class=\" control-label\">Cap.</label>
					<input type=\"checkbox\" name=\"cap\" value=\"".$resultado1['dni']."\" />
					</div>
					</div>
					";
			echo "
			<input name=\"ID\" type=\"hidden\" value=\"".$resultado1['dni']."\" />
			<input type=\"hidden\" name=\"posHab\" value=\"".$resultado1['posicionhab']."\"/>
			</li>";
		
		}
 ?>
 </ul>
  </div>
</div>
</form>
 <?php
 }
 mysql_close ($conexion);
  ?>

  
 