<script>
$(document).ready(function() {
	$(".local span").click(function(){
	if(confirm("¿Seguro que quieres borrarlo del partido?")==true) {
		$('#EliminadoJugador').modal({
		  keyboard: false,
		  backdrop:'static',
		  show:true
		});
		$.post( "./modificarpartido/eliminarjugador.php", { 'dnijug':$(this).parent().attr("id"),'fecha':$("h4[id]").attr("id")}, function (data) { 
		$("#CuerpoEliminado").html(data); //Se muestra el resultado de la operación en la clase 
		});
		}
	});
	
	$(".visitante span").click(function(){
	if(confirm("¿Seguro que quieres borrarlo del partido?")==true) {
		$('#EliminadoJugador').modal({
		  keyboard: false,
		  backdrop:'static',
		  show:true
		});
		$.post( "./modificarpartido/eliminarjugador.php", { 'dnijug':$(this).parent().attr("id"),'fecha':$("h4[id]").attr("id")}, function (data) { 
		$("#CuerpoEliminado").html(data); //Se muestra el resultado de la operación en la clase 
		});
		}
	});
	
	$("#eliminadojugadorCerrar").click(function(){
		$("#EliminadoJugador").modal('hide');
		$(".modal-backdrop").remove();
		$("body").removeClass("modal-open");
		$.post( "./modificarpartido/infopartido.php", {'fecha':$("h4[id]").attr("id")}, function (data) { 
		$("#infopartido").html(data); //Se muestra el resultado de la operación en la clase 
		});
		
		});
		
	$("h1 + button").click(function(){
		if(confirm("¿Seguro que quieres intercambiar los colores de los quipos?")==true) {
		$('#EliminadoJugador').modal({
		  keyboard: false,
		  backdrop:'static',
		  show:true
		});
		$.post( "./modificarpartido/cambiarcolorequipo.php", {'fecha':$("h4[id]").attr("id")}, function (data) { 
		$("#CuerpoEliminado").html(data); //Se muestra el resultado de la operación en la clase 
		});
		}	
		});
	/* CAMBIAR ESTRATEGIA */	
	$("#selectLocal").change(function() {
		$.post( "./modificarpartido/verestrategia.php", {'fecha':$("h4[id]").attr("id"),'local':'s','idestr':$("#selectLocal option:selected").attr("id")}, function (data) { 
		$("#sitioEstrategia").html(data); //Se muestra el resultado de la operación en la clase 
		});
	});
	$("#selectVisitante").change(function() {
		$.post( "./modificarpartido/verestrategia.php", {'fecha':$("h4[id]").attr("id"),'local':'n','idestr':$("#selectVisitante option:selected").attr("id")}, function (data) { 
		$("#sitioEstrategia").html(data); //Se muestra el resultado de la operación en la clase 
		});
	});
	$("#verEstLocal").click(function() {
		$.post( "./modificarpartido/verestrategia.php", {'fecha':$("h4[id]").attr("id"),'local':'s','idestr':$("#selectLocal option:selected").attr("id")}, function (data) { 
		$("#sitioEstrategia").html(data); //Se muestra el resultado de la operación en la clase 
		});
	});
	$("#verEstVisitante").click(function() {
		$.post( "./modificarpartido/verestrategia.php", {'fecha':$("h4[id]").attr("id"),'local':'n','idestr':$("#selectVisitante option:selected").attr("id")}, function (data) { 
		$("#sitioEstrategia").html(data); //Se muestra el resultado de la operación en la clase 
		});
	});
	/* /CAMBIAR ESTRATEGIA/ */

	/* CAMBIAR CAPITAN */
	
	$("#caplocal span").click(function() {
	$.post( "./modificarpartido/cambiarcapitan.php", {'fecha':$("h4[id]").attr("id"),'local':'s','idjug':$(this).text()}, function (data) { 
		$("#caplocal").html(data); //Se muestra el resultado de la operación en la clase 
		});
	});
	
	$("#capvisitante span").click(function() {
	$.post( "./modificarpartido/cambiarcapitan.php", {'fecha':$("h4[id]").attr("id"),'local':'n','idjug':$(this).text()}, function (data) { 
		$("#capvisitante").html(data); //Se muestra el resultado de la operación en la clase 
		});
	});
	
	/* /CAMBIAR CAPITAN/ */
	/* AÑADIR JUG */
	$("#anadirJugLoc").click(function() {
	$.post( "./modificarpartido/anadirjugador.php", {'fecha':$("h4[id]").attr("id"),'local':'s'}, function (data) { 
		$("#CuerpoEliminado").html(data);
	$("#EliminadoJugador").modal("show");
	});
	});
	$("#anadirJugVis").click(function() {
	$.post( "./modificarpartido/anadirjugador.php", {'fecha':$("h4[id]").attr("id"),'local':'n'}, function (data) { 
		$("#CuerpoEliminado").html(data);
		$("#EliminadoJugador").modal("show");
	});
	});
	/* /AÑADIR JUG/ */
	
	/* MODIFICAR GOLES */
	$(".golloc").click(function() {
	$.post( "./modificarpartido/cambiargoles.php", {'fecha':$("h4[id]").attr("id"),'local':'s','idjug':$(this).parent().attr("id"),'golnuevo':$(this).text()}, function (data) { 
		$("#CuerpoEliminado").html(data);
		$("#EliminadoJugador").modal("show"); //Se muestra el resultado de la operación en la clase 
		});
	});
	
	$(".golvis").click(function() {
	$.post( "./modificarpartido/cambiargoles.php", {'fecha':$("h4[id]").attr("id"),'local':'n','idjug':$(this).parent().attr("id"),'golnuevo':$(this).text()}, function (data) { 
		$("#CuerpoEliminado").html(data);
		$("#EliminadoJugador").modal("show"); //Se muestra el resultado de la operación en la clase 
		});
	});
	/* /MODIFICAR GOLES/ */

	/* MODIFICAR TARJETAS */
	$(".tarloc").click(function() {
	$.post( "./modificarpartido/cambiartarjetas.php", {'fecha':$("h4[id]").attr("id"),'idjug':$(this).parent().attr("id"),'idtarAnt':$(this).attr("id")}, function (data) { 
		$("#CuerpoEliminado").html(data);
		$("#EliminadoJugador").modal("show"); //Se muestra el resultado de la operación en la clase 
		});
	});
	
	$(".tarvis").click(function() {
	$.post( "./modificarpartido/cambiartarjetas.php", {'fecha':$("h4[id]").attr("id"),'idjug':$(this).parent().attr("id"),'idtarAnt':$(this).attr("id")}, function (data) { 
		$("#CuerpoEliminado").html(data);
		$("#EliminadoJugador").modal("show"); //Se muestra el resultado de la operación en la clase 
		});
	});
	/* /MODIFICAR TARJETAS/ */
	
	});
</script>
<?php 
include ('../../../php/conexion.php');
	
	mysql_set_charset("utf8");
	
	$instruccion="SELECT * FROM partido WHERE fecha='".$_POST['fecha']."'";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");			
	$nfilas = mysql_num_rows ($consulta);
	if ($nfilas>0) {
	$partido=mysql_fetch_array ($consulta);
	}
	?>
	<div class="col-sm-8 col-md-8 table-responsive" style="overflow:auto;min-height:480px;">
		
			<table id="modificar" class="table table-hover">
				<thead>
				<tr>
					<td colspan="6"><?php
						$mes=substr($partido['fecha'],5,2);
						$ano=substr($partido['fecha'],0,4);
						$dia=substr($partido['fecha'],8,2);
						echo "<h4 id=\"".$partido['fecha']."\">".$dia." - ".$mes." - ".$ano."</h4>";
					?></td>
				</tr>
				<tr>
				<?php 
				$instruccion="SELECT i.local,i.color FROM incidencia i
						LEFT JOIN jugador j ON i.jugador=j.dni
						where fecha='".$_POST['fecha']."' AND local='s'
						ORDER BY `local` ASC,posicion asc LIMIT 1";
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
				$resultado=mysql_fetch_array ($consulta);
				
				if ($resultado['color']=='na') { ?>
				<td colspan="2"><img src="../../img/adm/cnaranja.png"/></td>
				<td colspan="2"><?php echo "<h1 class=\"marcador\">".$partido['marclocal']." - ".$partido['marcvisitante']."</h1><button type=\"button\" class=\"btn btn-primary btn-xs\"><span class=\"glyphicon glyphicon-refresh\"></span>&nbsp;Cambiar color</button>"; ?></td>
				<td colspan="2"><img src="../../img/adm/cnegra.png"/></td>
				
				<?php }
				else { ?>
				
				
				<td colspan="2"><img src="../../img/adm/cnegra.png"/></td>
				<td colspan="2"><?php echo "<h1 class=\"marcador\">".$partido['marclocal']." - ".$partido['marcvisitante']."</h1><button type=\"button\" class=\"btn btn-primary btn-xs\"><span class=\"glyphicon glyphicon-refresh\"></span>&nbsp;Cambiar color</button>"; ?></td>
				<td colspan="2"><img src="../../img/adm/cnaranja.png"/></td>
				
				<?php }
				
				$instruccion="SELECT j.alias,j.dni,i.jugador,i.idsancion,i.gol,i.local,i.posicion FROM incidencia i
						LEFT JOIN jugador j ON i.jugador=j.dni
						where fecha='".$_POST['fecha']."' AND local='s'
						ORDER BY `local` ASC,posicion asc";
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
					$nfilas = mysql_num_rows ($consulta);
					
					$instruccion="SELECT j.alias,j.dni,i.jugador,i.idsancion,i.gol,i.local,i.posicion FROM incidencia i
						LEFT JOIN jugador j ON i.jugador=j.dni
						where fecha='".$_POST['fecha']."' AND local='n'
						ORDER BY `local` ASC,posicion asc";
					$consulta1 = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
					$nfilas1 = mysql_num_rows ($consulta1);
				
				?>
					
				</tr>
				<tr>
				<td>Estrategia&nbsp;<button id="verEstLocal" class="btn btn-success btn-xs">Ver</button></td>
				<td>
				<select id="selectLocal">
				<option>Ninguna</option>
				<?php
				$estr="SELECT * FROM estrategia WHERE njugadores=".$nfilas;
					$estrcons = mysql_query ($estr, $conexion)
								or die ("FALLO EN LA CONSULTA $estr");
					$estrnfilas = mysql_num_rows ($estrcons);
					if ($estrnfilas>0) {
					for($i=0;$i<$estrnfilas;$i++) {
					$strres=mysql_fetch_array ($estrcons);
					if($strres['idestrategia']==$partido['estlocal']) {
					echo "<option id=\"".$strres['idestrategia']."\" selected>".$strres['def']."-".$strres['cen']."-".$strres['del']."</option>";
					}
					else {
					echo "<option id=\"".$strres['idestrategia']."\">".$strres['def']."-".$strres['cen']."-".$strres['del']."</option>";
					}
					
					
					}
					
					}
				?>
				</select>
				</td>
				<td id="caplocal" style="cursor:pointer;"><span><?php $instruccioncap="SELECT alias FROM jugador WHERE dni='".$partido['caplocal']."'";
					$consultacap = mysql_query ($instruccioncap, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
				$caplocal=mysql_fetch_array ($consultacap);
				if ( $caplocal['alias']=="") echo "Sin Cap."; 
				else echo $caplocal['alias'];
				?>
				</span></td>
				<td id="capvisitante" style="cursor:pointer;"><span><?php $instruccioncap="SELECT alias FROM jugador WHERE dni='".$partido['capvisitante']."'";
					$consultacap = mysql_query ($instruccioncap, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
				$capvisitante=mysql_fetch_array ($consultacap);
				if ( $capvisitante['alias']=="") echo "Sin Cap."; 
				else echo $capvisitante['alias']; ?>
				</span></td>
				<td>
				<select  id="selectVisitante">
				<option>Ninguna</option>
				<?php
				$estr="SELECT * FROM estrategia WHERE njugadores=".$nfilas1;
					$estrcons = mysql_query ($estr, $conexion)
								or die ("FALLO EN LA CONSULTA $estr");
					$estrnfilas = mysql_num_rows ($estrcons);
					if ($estrnfilas>0) {
					for($i=0;$i<$estrnfilas;$i++) {
					$strres=mysql_fetch_array ($estrcons);
					if($strres['idestrategia']==$partido['estvisitante']) {
					echo "<option id=\"".$strres['idestrategia']."\" selected>".$strres['def']."-".$strres['cen']."-".$strres['del']."</option>";
					}
					else {
					echo "<option id=\"".$strres['idestrategia']."\">".$strres['def']."-".$strres['cen']."-".$strres['del']."</option>";
					}
					
					
					}
					
					}
				?>
				</select>
				</td>
				<td><button id="verEstVisitante" class="btn btn-success btn-xs">Ver</button>&nbsp;Estrategia</td>
				</tr>
				<tr>
					<td>Tarjetas</td>
					<td>Gol/es</td>
					<td>
				  <button id="anadirJugLoc" type="button" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-plus"></span></button>
				Jugador</td>
					<td>
				 Jugador
				 <button id="anadirJugVis"  type="button" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-plus"></span></button>
				 </td>
					<td>Gol/es</td>
					<td>Tarjetas</td>
				</tr>
				</thead>
				<tbody>
					<?php 
					
					
					
					if($nfilas>$nfilas1) {
					$nfilasMayor=$nfilas;
					}
					else if ($nfilas<$nfilas1) {
					$nfilasMayor=$nfilas1;
					}
					else {
					$nfilasMayor=$nfilas;
					}
					
					
					
					
					if ($nfilasMayor>0) {
						for ($i=0; $i<$nfilasMayor; $i++){
						$resultado=mysql_fetch_array ($consulta);
						$resultado1=mysql_fetch_array ($consulta1);
						?>
						
						<tr>
							<td id="<?php echo $resultado['dni']; ?>" style="padding:3px;"><?php
							echo "<span id=\"".$resultado['idsancion']."\" class=\"tarloc col-md-12 col-sm-12\" style=\"cursor:pointer;height:18px;\">";
							if ($resultado['idsancion']!='') {
								$instruccion5="SELECT texto FROM cuota WHERE idcuota=".$resultado['idsancion'];
					$consulta5 = mysql_query ($instruccion5, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion5");
								$resultado5=mysql_fetch_array ($consulta5);
								echo $resultado5['texto'];
								}
								echo "</span>";
							?></td><?php

							echo "<td id=\"".$resultado['dni']."\"><span class=\"golloc\" style=\"cursor:pointer;\">".$resultado['gol']."</span></td>";
							echo "<td id=\"".$resultado['dni']."\" class=\"local\">";
							if ($resultado['alias']!="") {
							echo "<span style=\"float:left;visibility:hidden;\">X</span>".$resultado['alias'];
							}
					
							echo "</td>";
							echo "<td id=\"".$resultado1['dni']."\" class=\"visitante\">";
							if ($resultado1['alias']!="") {
							echo "<span style=\"float:right;visibility:hidden;\">X</span>".$resultado1['alias'];
							}
							echo "</td>";
							echo "<td id=\"".$resultado1['dni']."\"><span class=\"golvis\" style=\"cursor:pointer;\">".$resultado1['gol']."</span></td>"
							?>
							<td  id="<?php echo $resultado1['dni']; ?>"><?php
							echo "<span id=\"".$resultado1['idsancion']."\" class=\"tarvis col-md-12 col-sm-12\" style=\"cursor:pointer;height:18px;\">";
							if ($resultado1['idsancion']!='') {
								$instruccion5="SELECT texto FROM cuota WHERE idcuota=".$resultado1['idsancion'];
								$consulta5 = mysql_query ($instruccion5, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion5");
								$resultado5=mysql_fetch_array ($consulta5);
								echo $resultado5['texto'];
								}
								echo "</span>";
							?></td>
						</tr>

					<?php }
					}
					?>
				</tbody>
				<tfoot>
				<tr>
					<td colspan="3">Total Jugadores = <?php echo $nfilas; ?></td>
					<td colspan="3">Total Jugadores = <?php echo $nfilas1; ?></td>
				</tr>
				</tfoot>
			</table>
		
	</div>
	<div id="sitioEstrategia" class="col-sm-4 col-md-4" style="min-height:480px;padding:0px !important;">
	</div>
	<?php
	
		
mysql_close ($conexion);
?>
<div class="modal fade" id="EliminadoJugador" tabindex="-1"  aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">	
        <h4 class="modal-title" id="myModalLabel">Panel Información</h4>
      </div>
      <div id="CuerpoEliminado" class="modal-body">
      </div>
      <div class="modal-footer">
        <button id="eliminadojugadorCerrar" type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>