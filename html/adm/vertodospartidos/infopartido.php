<script>
	$(document).ready(function(){
		$(".dimCajaJug").click(function() {
		 /*alert($(this).attr("id")+" "+$("h4[id]").attr("id"));*/
		 $.post( "./vertodospartidos/estadisticasjugador.php", { 'idjug':$(this).attr("id"),'fecha':$("h4[id]").attr("id")}, function (data) { 
		$("#EstadisticasJugador").html(data); //Se muestra el resultado de la operación en la clase 
		});
		});
		$("td[id]").click(function() {
		 /*alert($(this).attr("id")+" "+$("h4[id]").attr("id"));*/
		 $.post( "./vertodospartidos/estadisticasjugador.php", { 'idjug':$(this).attr("id"),'fecha':$("h4[id]").attr("id")}, function (data) { 
		$("#EstadisticasJugador").html(data); //Se muestra el resultado de la operación en la clase 
		});
		});
	});
</script>
<?php 
function imgTarjetas($num) {
	switch ($num)
	{
		case 1: ?>
			<img src="../../img/adm/tamarilla20x26.png" style="width:15px;box-shadow:0px 0px 3px #000;margin-right:3px;"/>
			<?php break;
		case 2: ?>
			<img src="../../img/adm/tamarilla20x26.png" style="width:13px;box-shadow:0px 0px 3px #000;"/>
			<img src="../../img/adm/tamarilla20x26.png" style="width:13px;box-shadow:0px 0px 3px #000;"/>
			<?php break;
		case 3: ?>
			<img src="../../img/adm/troja20x26.png" style="width:15px;box-shadow:0px 0px 3px #000;margin-right:3px;"/>
			<?php break;
		case 4: ?>
		<img src="../../img/adm/llegartarde16x22.png" style="width:16px;margin-right:3px;"/>
			<?php break;
	}
}
include ('../../../php/conexion.php');
	
	mysql_set_charset("utf8");
	
	$instruccion="SELECT * FROM partido WHERE fecha='".$_POST['fecha']."'";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");			
	$nfilas = mysql_num_rows ($consulta);
	if ($nfilas>0) {
	$partido=mysql_fetch_array ($consulta);
	}
	
	if ($partido['estlocal']!=NULL&&$partido['estvisitante']!=NULL) {
	/*Hay estrategia de los 2*/
	$instruccion="SELECT def,cen,del FROM estrategia WHERE idestrategia='".$partido['estlocal']."'";
			$consulta = mysql_query ($instruccion, $conexion)
						or die ("FALLO EN LA CONSULTA $instruccion");			
			$estrategia=mysql_fetch_array ($consulta);
			$def=$estrategia['def'];
			$cen=$estrategia['cen'];
			$del=$estrategia['del'];
	?>
<div class="col-sm-4 col-md-4" style="overflow:auto;height:520px;padding:0px !important;">
			<div style="width:323px;height:500px;margin: 0 auto;border:1px solid black;background-size:100% 100%;background-image:url('../../img/adm/campoEstrategiaPlano.jpg');">
			<div id="portero" class="divPosiciones">
				
				<?php
				$instruccion="SELECT j.alias,j.dni,j.dorsal,j.foto,i.gol,i.idsancion FROM incidencia i LEFT JOIN jugador j ON i.jugador=j.dni where
					fecha='".$_POST['fecha']."' AND local='s' AND posicion='por'";	
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
				$resultado=mysql_fetch_array ($consulta);
				
				if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}
				
				
				?>
				
				<div id="<?php echo $resultado['dni']; ?>" class="dimCajaJug margen1">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?><span style="float:right;"><?php echo $resultado['dorsal']; ?></span></div>
				<div><img src="../../img/adm/gol20x20.png" style="width:15px;margin-top:-5px;"/> <?php echo $resultado['gol']; ?> <span style="float:right;margin-top:-5px;"><?php imgTarjetas($resultado['idsancion']); ?></span></div>
				</div>
				
			</div>
			<div id="defensa" class="divPosiciones">
			<?php
				if ($def==5) {
				$instruccion="SELECT j.alias,j.dni,j.dorsal,j.foto,i.gol,i.idsancion FROM incidencia i LEFT JOIN jugador j ON i.jugador=j.dni where
					fecha='".$_POST['fecha']."' AND local='s' AND posicion='def'";	
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
								$nfilas = mysql_num_rows ($consulta);
					
					for($i=0;$i<$nfilas;$i++){
					$resultado=mysql_fetch_array ($consulta);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" id="<?php echo $resultado['dni']; ?>" class="dimCajaJug margen5">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?><span style="float:right;"><?php echo $resultado['dorsal']; ?></span></div>
				<div><img src="../../img/adm/gol20x20.png" style="width:15px;margin-top:-5px;"/> <?php echo $resultado['gol']; ?> <span style="float:right;margin-top:-5px;"><?php imgTarjetas($resultado['idsancion']); ?></span></div>
				</div>
					
					<?php
					
					}
				}
				
				else if ($def==4) {
				$instruccion="SELECT j.alias,j.dni,j.dorsal,j.foto,i.gol,i.idsancion FROM incidencia i LEFT JOIN jugador j ON i.jugador=j.dni where
					fecha='".$_POST['fecha']."' AND local='s' AND posicion='def'";	
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
								$nfilas = mysql_num_rows ($consulta);
					
					for($i=0;$i<$nfilas;$i++){
					$resultado=mysql_fetch_array ($consulta);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" class="dimCajaJug margen4 margen5">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?><span style="float:right;"><?php echo $resultado['dorsal']; ?></span></div>
				<div><img src="../../img/adm/gol20x20.png" style="width:15px;margin-top:-5px;"/> <?php echo $resultado['gol']; ?> <span style="float:right;margin-top:-5px;"><?php imgTarjetas($resultado['idsancion']); ?></span></div>
				</div>
					
					<?php
					
					}
				}
				else if ($def==3) { 

				$instruccion="SELECT j.alias,j.dni,j.dorsal,j.foto,i.gol,i.idsancion FROM incidencia i LEFT JOIN jugador j ON i.jugador=j.dni where
					fecha='".$_POST['fecha']."' AND local='s' AND posicion='def'";	
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
								$nfilas = mysql_num_rows ($consulta);
					
					for($i=0;$i<$nfilas;$i++){
					$resultado=mysql_fetch_array ($consulta);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" class="dimCajaJug margen3 margen5">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?><span style="float:right;"><?php echo $resultado['dorsal']; ?></span></div>
				<div><img src="../../img/adm/gol20x20.png" style="width:15px;margin-top:-5px;"/> <?php echo $resultado['gol']; ?> <span style="float:right;margin-top:-5px;"><?php imgTarjetas($resultado['idsancion']); ?></span></div>
				</div>
					
					<?php
					
					}				
				 
				
				}
				else if ($def==2) {
				$instruccion="SELECT j.alias,j.dni,j.dorsal,j.foto,i.gol,i.idsancion FROM incidencia i LEFT JOIN jugador j ON i.jugador=j.dni where
					fecha='".$_POST['fecha']."' AND local='s' AND posicion='def'";	
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
								$nfilas = mysql_num_rows ($consulta);
					
					for($i=0;$i<$nfilas;$i++){
					$resultado=mysql_fetch_array ($consulta);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" class="dimCajaJug margen2 margen5">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?><span style="float:right;"><?php echo $resultado['dorsal']; ?></span></div>
				<div><img src="../../img/adm/gol20x20.png" style="width:15px;margin-top:-5px;"/> <?php echo $resultado['gol']; ?> <span style="float:right;margin-top:-5px;"><?php imgTarjetas($resultado['idsancion']); ?></span></div>
				</div>
					
					<?php
					
					}
				
				}
				else if ($def==1) {
				$instruccion="SELECT j.alias,j.dni,j.dorsal,j.foto,i.gol,i.idsancion FROM incidencia i LEFT JOIN jugador j ON i.jugador=j.dni where
					fecha='".$_POST['fecha']."' AND local='s' AND posicion='def'";	
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
								$nfilas = mysql_num_rows ($consulta);
					
					for($i=0;$i<$nfilas;$i++){
					$resultado=mysql_fetch_array ($consulta);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" class="dimCajaJug margen1">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?><span style="float:right;"><?php echo $resultado['dorsal']; ?></span></div>
				<div><img src="../../img/adm/gol20x20.png" style="width:15px;margin-top:-5px;"/> <?php echo $resultado['gol']; ?> <span style="float:right;margin-top:-5px;"><?php imgTarjetas($resultado['idsancion']); ?></span></div>
				</div>
					
					<?php
					
					}
				
				}
			?>
			</div>
			<div id="centrocampista" class="divPosiciones">
			<?php
				if ($cen==5) {
				$instruccion="SELECT j.alias,j.dni,j.dorsal,j.foto,i.gol,i.idsancion FROM incidencia i LEFT JOIN jugador j ON i.jugador=j.dni where
					fecha='".$_POST['fecha']."' AND local='s' AND posicion='cen'";	
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
								$nfilas = mysql_num_rows ($consulta);
					
					for($i=0;$i<$nfilas;$i++){
					$resultado=mysql_fetch_array ($consulta);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" class="dimCajaJug margen5">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?><span style="float:right;"><?php echo $resultado['dorsal']; ?></span></div>
				<div><img src="../../img/adm/gol20x20.png" style="width:15px;margin-top:-5px;"/> <?php echo $resultado['gol']; ?> <span style="float:right;margin-top:-5px;"><?php imgTarjetas($resultado['idsancion']); ?></span></div>
				</div>
					
					<?php
					
					}
				}
				
				else if ($cen==4) {
				$instruccion="SELECT j.alias,j.dni,j.dorsal,j.foto,i.gol,i.idsancion FROM incidencia i LEFT JOIN jugador j ON i.jugador=j.dni where
					fecha='".$_POST['fecha']."' AND local='s' AND posicion='cen'";	
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
								$nfilas = mysql_num_rows ($consulta);
					
					for($i=0;$i<$nfilas;$i++){
					$resultado=mysql_fetch_array ($consulta);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" class="dimCajaJug margen4 margen5">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?><span style="float:right;"><?php echo $resultado['dorsal']; ?></span></div>
				<div><img src="../../img/adm/gol20x20.png" style="width:15px;margin-top:-5px;"/> <?php echo $resultado['gol']; ?> <span style="float:right;margin-top:-5px;"><?php imgTarjetas($resultado['idsancion']); ?></span></div>
				</div>
					
					<?php
					
					}
				}
				else if ($cen==3) {
				$instruccion="SELECT j.alias,j.dni,j.dorsal,j.foto,i.gol,i.idsancion FROM incidencia i LEFT JOIN jugador j ON i.jugador=j.dni where
					fecha='".$_POST['fecha']."' AND local='s' AND posicion='cen'";	
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
								$nfilas = mysql_num_rows ($consulta);
					
					for($i=0;$i<$nfilas;$i++){
					$resultado=mysql_fetch_array ($consulta);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" class="dimCajaJug margen3 margen5">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?><span style="float:right;"><?php echo $resultado['dorsal']; ?></span></div>
				<div><img src="../../img/adm/gol20x20.png" style="width:15px;margin-top:-5px;"/> <?php echo $resultado['gol']; ?> <span style="float:right;margin-top:-5px;"><?php imgTarjetas($resultado['idsancion']); ?></span></div>
				</div>
					
					<?php
					
					}
				
				}
				else if ($cen==2) {
				$instruccion="SELECT j.alias,j.dni,j.dorsal,j.foto,i.gol,i.idsancion FROM incidencia i LEFT JOIN jugador j ON i.jugador=j.dni where
					fecha='".$_POST['fecha']."' AND local='s' AND posicion='cen'";	
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
								$nfilas = mysql_num_rows ($consulta);
					
					for($i=0;$i<$nfilas;$i++){
					$resultado=mysql_fetch_array ($consulta);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" class="dimCajaJug margen2 margen5">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?><span style="float:right;"><?php echo $resultado['dorsal']; ?></span></div>
				<div><img src="../../img/adm/gol20x20.png" style="width:15px;margin-top:-5px;"/> <?php echo $resultado['gol']; ?> <span style="float:right;margin-top:-5px;"><?php imgTarjetas($resultado['idsancion']); ?></span></div>
				</div>
					
					<?php
					
					}
				
				}
				else if ($cen==1) {
				$instruccion="SELECT j.alias,j.dni,j.dorsal,j.foto,i.gol,i.idsancion FROM incidencia i LEFT JOIN jugador j ON i.jugador=j.dni where
					fecha='".$_POST['fecha']."' AND local='s' AND posicion='cen'";	
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
								$nfilas = mysql_num_rows ($consulta);
					
					for($i=0;$i<$nfilas;$i++){
					$resultado=mysql_fetch_array ($consulta);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" class="dimCajaJug margen1">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?><span style="float:right;"><?php echo $resultado['dorsal']; ?></span></div>
				<div><img src="../../img/adm/gol20x20.png" style="width:15px;margin-top:-5px;"/> <?php echo $resultado['gol']; ?> <span style="float:right;margin-top:-5px;"><?php imgTarjetas($resultado['idsancion']); ?></span></div>
				</div>
					
					<?php
					
					}
				
				}
			?>
			</div>
			
			<div id="delantero" class="divPosiciones">
			<?php
				if ($del==5) {
				$instruccion="SELECT j.alias,j.dni,j.dorsal,j.foto,i.gol,i.idsancion FROM incidencia i LEFT JOIN jugador j ON i.jugador=j.dni where
					fecha='".$_POST['fecha']."' AND local='s' AND posicion='del'";	
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
								$nfilas = mysql_num_rows ($consulta);
					
					for($i=0;$i<$nfilas;$i++){
					$resultado=mysql_fetch_array ($consulta);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" class="dimCajaJug margen5">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?><span style="float:right;"><?php echo $resultado['dorsal']; ?></span></div>
				<div><img src="../../img/adm/gol20x20.png" style="width:15px;margin-top:-5px;"/> <?php echo $resultado['gol']; ?> <span style="float:right;margin-top:-5px;"><?php imgTarjetas($resultado['idsancion']); ?></span></div>
				</div>
					
					<?php
					
					}
				}
				
				else if ($del==4) {
				$instruccion="SELECT j.alias,j.dni,j.dorsal,j.foto,i.gol,i.idsancion FROM incidencia i LEFT JOIN jugador j ON i.jugador=j.dni where
					fecha='".$_POST['fecha']."' AND local='s' AND posicion='del'";	
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
								$nfilas = mysql_num_rows ($consulta);
					
					for($i=0;$i<$nfilas;$i++){
					$resultado=mysql_fetch_array ($consulta);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" class="dimCajaJug margen4 margen5">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?><span style="float:right;"><?php echo $resultado['dorsal']; ?></span></div>
				<div><img src="../../img/adm/gol20x20.png" style="width:15px;margin-top:-5px;"/> <?php echo $resultado['gol']; ?> <span style="float:right;margin-top:-5px;"><?php imgTarjetas($resultado['idsancion']); ?></span></div>
				</div>
					
					<?php
					
					}
				}
				else if ($del==3) {
				$instruccion="SELECT j.alias,j.dni,j.dorsal,j.foto,i.gol,i.idsancion FROM incidencia i LEFT JOIN jugador j ON i.jugador=j.dni where
					fecha='".$_POST['fecha']."' AND local='s' AND posicion='del'";	
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
								$nfilas = mysql_num_rows ($consulta);
					
					for($i=0;$i<$nfilas;$i++){
					$resultado=mysql_fetch_array ($consulta);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" class="dimCajaJug margen3 margen5">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?><span style="float:right;"><?php echo $resultado['dorsal']; ?></span></div>
				<div><img src="../../img/adm/gol20x20.png" style="width:15px;margin-top:-5px;"/> <?php echo $resultado['gol']; ?> <span style="float:right;margin-top:-5px;"><?php imgTarjetas($resultado['idsancion']); ?></span></div>
				</div>
					
					<?php
					
					}
				
				}
				else if ($del==2) {
				$instruccion="SELECT j.alias,j.dni,j.dorsal,j.foto,i.gol,i.idsancion FROM incidencia i LEFT JOIN jugador j ON i.jugador=j.dni where
					fecha='".$_POST['fecha']."' AND local='s' AND posicion='del'";	
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
								$nfilas = mysql_num_rows ($consulta);
					
					for($i=0;$i<$nfilas;$i++){
					$resultado=mysql_fetch_array ($consulta);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" class="dimCajaJug margen2 margen5">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?><span style="float:right;"><?php echo $resultado['dorsal']; ?></span></div>
				<div><img src="../../img/adm/gol20x20.png" style="width:15px;margin-top:-5px;"/> <?php echo $resultado['gol']; ?> <span style="float:right;margin-top:-5px;"><?php imgTarjetas($resultado['idsancion']); ?></span></div>
				</div>
					
					<?php
					
					}
				
				}
				else if ($del==1) {
				$instruccion="SELECT j.alias,j.dni,j.dorsal,j.foto,i.gol,i.idsancion FROM incidencia i LEFT JOIN jugador j ON i.jugador=j.dni where
					fecha='".$_POST['fecha']."' AND local='s' AND posicion='del'";	
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
								$nfilas = mysql_num_rows ($consulta);
					
					for($i=0;$i<$nfilas;$i++){
					$resultado=mysql_fetch_array ($consulta);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" class="dimCajaJug margen1">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?><span style="float:right;"><?php echo $resultado['dorsal']; ?></span></div>
				<div><img src="../../img/adm/gol20x20.png" style="width:15px;margin-top:-5px;"/> <?php echo $resultado['gol']; ?> <span style="float:right;margin-top:-5px;"><?php imgTarjetas($resultado['idsancion']); ?></span></div>
				</div>
					
					<?php
					
					}
				
				}
			?>
			</div>

			</div>
		</div>
		<?php $instruccion="SELECT def,cen,del FROM estrategia WHERE idestrategia='".$partido['estvisitante']."'";
			$consulta = mysql_query ($instruccion, $conexion)
						or die ("FALLO EN LA CONSULTA $instruccion");			
			$estrategia=mysql_fetch_array ($consulta);
			$def=$estrategia['def'];
			$cen=$estrategia['cen'];
			$del=$estrategia['del'];
	?>
<div class="col-sm-4 col-md-4" style="overflow:auto;height:520px;padding:0px !important;">
			<div style="width:323px;height:500px;margin: 0 auto;border:1px solid black;background-size:100% 100%;background-image:url('../../img/adm/campoEstrategiaPlano.jpg');">
			<div id="portero" class="divPosiciones">
				
				<?php
				$instruccion="SELECT j.alias,j.dni,j.dorsal,j.foto,i.gol,i.idsancion FROM incidencia i LEFT JOIN jugador j ON i.jugador=j.dni where
					fecha='".$_POST['fecha']."' AND local='n' AND posicion='por'";	
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
				$resultado=mysql_fetch_array ($consulta);
				
				if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}
				
				
				?>
				<div id="<?php echo $resultado['dni']; ?>" class="dimCajaJug margen1">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?><span style="float:right;"><?php echo $resultado['dorsal']; ?></span></div>
				<div><img src="../../img/adm/gol20x20.png" style="width:15px;margin-top:-5px;"/> <?php echo $resultado['gol']; ?> <span style="float:right;margin-top:-5px;"><?php imgTarjetas($resultado['idsancion']); ?></span></div>
				</div>
				
			</div>
			<div id="defensa" class="divPosiciones">
			<?php
				if ($def==5) {
				$instruccion="SELECT j.alias,j.dni,j.dorsal,j.foto,i.gol,i.idsancion FROM incidencia i LEFT JOIN jugador j ON i.jugador=j.dni where
					fecha='".$_POST['fecha']."' AND local='n' AND posicion='def'";	
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
								$nfilas = mysql_num_rows ($consulta);
					
					for($i=0;$i<$nfilas;$i++){
					$resultado=mysql_fetch_array ($consulta);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" class="dimCajaJug margen5">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?><span style="float:right;"><?php echo $resultado['dorsal']; ?></span></div>
				<div><img src="../../img/adm/gol20x20.png" style="width:15px;margin-top:-5px;"/> <?php echo $resultado['gol']; ?> <span style="float:right;margin-top:-5px;"><?php imgTarjetas($resultado['idsancion']); ?></span></div>
				</div>
					
					<?php
					
					}
				}
				
				else if ($def==4) {
				$instruccion="SELECT j.alias,j.dni,j.dorsal,j.foto,i.gol,i.idsancion FROM incidencia i LEFT JOIN jugador j ON i.jugador=j.dni where
					fecha='".$_POST['fecha']."' AND local='n' AND posicion='def'";	
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
								$nfilas = mysql_num_rows ($consulta);
					
					for($i=0;$i<$nfilas;$i++){
					$resultado=mysql_fetch_array ($consulta);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" class="dimCajaJug margen4 margen5">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?><span style="float:right;"><?php echo $resultado['dorsal']; ?></span></div>
				<div><img src="../../img/adm/gol20x20.png" style="width:15px;margin-top:-5px;"/> <?php echo $resultado['gol']; ?> <span style="float:right;margin-top:-5px;"><?php imgTarjetas($resultado['idsancion']); ?></span></div>
				</div>
					
					<?php
					
					}
				}
				else if ($def==3) { 

				$instruccion="SELECT j.alias,j.dni,j.dorsal,j.foto,i.gol,i.idsancion FROM incidencia i LEFT JOIN jugador j ON i.jugador=j.dni where
					fecha='".$_POST['fecha']."' AND local='n' AND posicion='def'";	
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
								$nfilas = mysql_num_rows ($consulta);
					
					for($i=0;$i<$nfilas;$i++){
					$resultado=mysql_fetch_array ($consulta);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" class="dimCajaJug margen3 margen5">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?><span style="float:right;"><?php echo $resultado['dorsal']; ?></span></div>
				<div><img src="../../img/adm/gol20x20.png" style="width:15px;margin-top:-5px;"/> <?php echo $resultado['gol']; ?> <span style="float:right;margin-top:-5px;"><?php imgTarjetas($resultado['idsancion']); ?></span></div>
				</div>
					
					<?php
					
					}				
				 
				
				}
				else if ($def==2) {
				$instruccion="SELECT j.alias,j.dni,j.dorsal,j.foto,i.gol,i.idsancion FROM incidencia i LEFT JOIN jugador j ON i.jugador=j.dni where
					fecha='".$_POST['fecha']."' AND local='n' AND posicion='def'";	
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
								$nfilas = mysql_num_rows ($consulta);
					
					for($i=0;$i<$nfilas;$i++){
					$resultado=mysql_fetch_array ($consulta);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" class="dimCajaJug margen2 margen5">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?><span style="float:right;"><?php echo $resultado['dorsal']; ?></span></div>
				<div><img src="../../img/adm/gol20x20.png" style="width:15px;margin-top:-5px;"/> <?php echo $resultado['gol']; ?> <span style="float:right;margin-top:-5px;"><?php imgTarjetas($resultado['idsancion']); ?></span></div>
				</div>
					
					<?php
					
					}
				
				}
				else if ($def==1) {
				$instruccion="SELECT j.alias,j.dni,j.dorsal,j.foto,i.gol,i.idsancion FROM incidencia i LEFT JOIN jugador j ON i.jugador=j.dni where
					fecha='".$_POST['fecha']."' AND local='n' AND posicion='def'";	
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
								$nfilas = mysql_num_rows ($consulta);
					
					for($i=0;$i<$nfilas;$i++){
					$resultado=mysql_fetch_array ($consulta);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" class="dimCajaJug margen1">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?><span style="float:right;"><?php echo $resultado['dorsal']; ?></span></div>
				<div><img src="../../img/adm/gol20x20.png" style="width:15px;margin-top:-5px;"/> <?php echo $resultado['gol']; ?> <span style="float:right;margin-top:-5px;"><?php imgTarjetas($resultado['idsancion']); ?></span></div>
				</div>
					
					<?php
					
					}
				
				}
			?>
			</div>
			<div id="centrocampista" class="divPosiciones">
			<?php
				if ($cen==5) {
				$instruccion="SELECT j.alias,j.dni,j.dorsal,j.foto,i.gol,i.idsancion FROM incidencia i LEFT JOIN jugador j ON i.jugador=j.dni where
					fecha='".$_POST['fecha']."' AND local='n' AND posicion='cen'";	
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
								$nfilas = mysql_num_rows ($consulta);
					
					for($i=0;$i<$nfilas;$i++){
					$resultado=mysql_fetch_array ($consulta);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" class="dimCajaJug margen5">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?><span style="float:right;"><?php echo $resultado['dorsal']; ?></span></div>
				<div><img src="../../img/adm/gol20x20.png" style="width:15px;margin-top:-5px;"/> <?php echo $resultado['gol']; ?> <span style="float:right;margin-top:-5px;"><?php imgTarjetas($resultado['idsancion']); ?></span></div>
				</div>
					
					<?php
					
					}
				}
				
				else if ($cen==4) {
				$instruccion="SELECT j.alias,j.dni,j.dorsal,j.foto,i.gol,i.idsancion FROM incidencia i LEFT JOIN jugador j ON i.jugador=j.dni where
					fecha='".$_POST['fecha']."' AND local='n' AND posicion='cen'";	
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
								$nfilas = mysql_num_rows ($consulta);
					
					for($i=0;$i<$nfilas;$i++){
					$resultado=mysql_fetch_array ($consulta);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" class="dimCajaJug margen4 margen5">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?><span style="float:right;"><?php echo $resultado['dorsal']; ?></span></div>
				<div><img src="../../img/adm/gol20x20.png" style="width:15px;margin-top:-5px;"/> <?php echo $resultado['gol']; ?> <span style="float:right;margin-top:-5px;"><?php imgTarjetas($resultado['idsancion']); ?></span></div>
				</div>
					
					<?php
					
					}
				}
				else if ($cen==3) {
				$instruccion="SELECT j.alias,j.dni,j.dorsal,j.foto,i.gol,i.idsancion FROM incidencia i LEFT JOIN jugador j ON i.jugador=j.dni where
					fecha='".$_POST['fecha']."' AND local='n' AND posicion='cen'";	
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
								$nfilas = mysql_num_rows ($consulta);
					
					for($i=0;$i<$nfilas;$i++){
					$resultado=mysql_fetch_array ($consulta);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" class="dimCajaJug margen3 margen5">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?><span style="float:right;"><?php echo $resultado['dorsal']; ?></span></div>
				<div><img src="../../img/adm/gol20x20.png" style="width:15px;margin-top:-5px;"/> <?php echo $resultado['gol']; ?> <span style="float:right;margin-top:-5px;"><?php imgTarjetas($resultado['idsancion']); ?></span></div>
				</div>
					
					<?php
					
					}
				
				}
				else if ($cen==2) {
				$instruccion="SELECT j.alias,j.dni,j.dorsal,j.foto,i.gol,i.idsancion FROM incidencia i LEFT JOIN jugador j ON i.jugador=j.dni where
					fecha='".$_POST['fecha']."' AND local='n' AND posicion='cen'";	
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
								$nfilas = mysql_num_rows ($consulta);
					
					for($i=0;$i<$nfilas;$i++){
					$resultado=mysql_fetch_array ($consulta);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" class="dimCajaJug margen2 margen5">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?><span style="float:right;"><?php echo $resultado['dorsal']; ?></span></div>
				<div><img src="../../img/adm/gol20x20.png" style="width:15px;margin-top:-5px;"/> <?php echo $resultado['gol']; ?> <span style="float:right;margin-top:-5px;"><?php imgTarjetas($resultado['idsancion']); ?></span></div>
				</div>
					
					<?php
					
					}
				
				}
				else if ($cen==1) {
				$instruccion="SELECT j.alias,j.dni,j.dorsal,j.foto,i.gol,i.idsancion FROM incidencia i LEFT JOIN jugador j ON i.jugador=j.dni where
					fecha='".$_POST['fecha']."' AND local='n' AND posicion='cen'";	
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
								$nfilas = mysql_num_rows ($consulta);
					
					for($i=0;$i<$nfilas;$i++){
					$resultado=mysql_fetch_array ($consulta);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" class="dimCajaJug margen1">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?><span style="float:right;"><?php echo $resultado['dorsal']; ?></span></div>
				<div><img src="../../img/adm/gol20x20.png" style="width:15px;margin-top:-5px;"/> <?php echo $resultado['gol']; ?> <span style="float:right;margin-top:-5px;"><?php imgTarjetas($resultado['idsancion']); ?></span></div>
				</div>
					
					<?php
					
					}
				
				}
			?>
			</div>
			
			<div id="delantero" class="divPosiciones">
			<?php
				if ($del==5) {
				$instruccion="SELECT j.alias,j.dni,j.dorsal,j.foto,i.gol,i.idsancion FROM incidencia i LEFT JOIN jugador j ON i.jugador=j.dni where
					fecha='".$_POST['fecha']."' AND local='n' AND posicion='del'";	
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
								$nfilas = mysql_num_rows ($consulta);
					
					for($i=0;$i<$nfilas;$i++){
					$resultado=mysql_fetch_array ($consulta);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" class="dimCajaJug margen5">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?><span style="float:right;"><?php echo $resultado['dorsal']; ?></span></div>
				<div><img src="../../img/adm/gol20x20.png" style="width:15px;margin-top:-5px;"/> <?php echo $resultado['gol']; ?> <span style="float:right;margin-top:-5px;"><?php imgTarjetas($resultado['idsancion']); ?></span></div>
				</div>
					
					<?php
					
					}
				}
				
				else if ($del==4) {
				$instruccion="SELECT j.alias,j.dni,j.dorsal,j.foto,i.gol,i.idsancion FROM incidencia i LEFT JOIN jugador j ON i.jugador=j.dni where
					fecha='".$_POST['fecha']."' AND local='n' AND posicion='del'";	
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
								$nfilas = mysql_num_rows ($consulta);
					
					for($i=0;$i<$nfilas;$i++){
					$resultado=mysql_fetch_array ($consulta);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" class="dimCajaJug margen4 margen5">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?><span style="float:right;"><?php echo $resultado['dorsal']; ?></span></div>
				<div><img src="../../img/adm/gol20x20.png" style="width:15px;margin-top:-5px;"/> <?php echo $resultado['gol']; ?> <span style="float:right;margin-top:-5px;"><?php imgTarjetas($resultado['idsancion']); ?></span></div>
				</div>
					
					<?php
					
					}
				}
				else if ($del==3) {
				$instruccion="SELECT j.alias,j.dni,j.dni,j.dorsal,j.foto,i.gol,i.idsancion FROM incidencia i LEFT JOIN jugador j ON i.jugador=j.dni where
					fecha='".$_POST['fecha']."' AND local='n' AND posicion='del'";	
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
								$nfilas = mysql_num_rows ($consulta);
					
					for($i=0;$i<$nfilas;$i++){
					$resultado=mysql_fetch_array ($consulta);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" class="dimCajaJug margen3 margen5">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?><span style="float:right;"><?php echo $resultado['dorsal']; ?></span></div>
				<div><img src="../../img/adm/gol20x20.png" style="width:15px;margin-top:-5px;"/> <?php echo $resultado['gol']; ?> <span style="float:right;margin-top:-5px;"><?php imgTarjetas($resultado['idsancion']); ?></span></div>
				</div>
					
					<?php
					
					}
				
				}
				else if ($del==2) {
				$instruccion="SELECT j.alias,j.dni,j.dorsal,j.foto,i.gol,i.idsancion FROM incidencia i LEFT JOIN jugador j ON i.jugador=j.dni where
					fecha='".$_POST['fecha']."' AND local='n' AND posicion='del'";	
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
								$nfilas = mysql_num_rows ($consulta);
					
					for($i=0;$i<$nfilas;$i++){
					$resultado=mysql_fetch_array ($consulta);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" class="dimCajaJug margen2 margen5">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?><span style="float:right;"><?php echo $resultado['dorsal']; ?></span></div>
				<div><img src="../../img/adm/gol20x20.png" style="width:15px;margin-top:-5px;"/> <?php echo $resultado['gol']; ?> <span style="float:right;margin-top:-5px;"><?php imgTarjetas($resultado['idsancion']); ?></span></div>
				</div>
					
					<?php
					
					}
				
				}
				else if ($del==1) {
				$instruccion="SELECT j.alias,j.dni,j.dorsal,j.foto,i.gol,i.idsancion FROM incidencia i LEFT JOIN jugador j ON i.jugador=j.dni where
					fecha='".$_POST['fecha']."' AND local='n' AND posicion='del'";	
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
								$nfilas = mysql_num_rows ($consulta);
					
					for($i=0;$i<$nfilas;$i++){
					$resultado=mysql_fetch_array ($consulta);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" class="dimCajaJug margen1">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?><span style="float:right;"><?php echo $resultado['dorsal']; ?></span></div>
				<div><img src="../../img/adm/gol20x20.png" style="width:15px;margin-top:-5px;"/> <?php echo $resultado['gol']; ?> <span style="float:right;margin-top:-5px;"><?php imgTarjetas($resultado['idsancion']); ?></span></div>
				</div>
					
					<?php
					
					}
				
				}
			?>
			</div>

			</div>
		</div>
	<div class="col-md-4 col-sm-4" style="overflow:auto;min-height:520px;">
	<div class="panel panel-info col-md-12 col-sm-12">
			<div class="panel-heading"><?php
						$mes=substr($partido['fecha'],5,2);
						$ano=substr($partido['fecha'],0,4);
						$dia=substr($partido['fecha'],8,2);
						echo "<h4 id=\"".$partido['fecha']."\"  style=\"text-align:center;\">".$dia." - ".$mes." - ".$ano."</h4>";
					?></div>
			<div class="panel-body">
			<div class="table-responsive">
					<table class="col-md-12 col-sm-12" style="margin:auto;">
						<?php $instruccion="SELECT i.local,i.color FROM incidencia i
						LEFT JOIN jugador j ON i.jugador=j.dni
						where fecha='".$_POST['fecha']."' AND local='s'
						ORDER BY `local` ASC,posicion asc LIMIT 1";
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
				$resultado=mysql_fetch_array ($consulta); 
				if ($resultado['color']=='na') { ?>
				<thead>
				<th><img src="../../img/adm/cnaranja.png"/></th>
				<th><?php echo "<h1 class=\"marcador\">".$partido['marclocal']." - ".$partido['marcvisitante']."</h1>"; ?></th>
				<th><img src="../../img/adm/cnegra.png"/></th>
				</thead>
				<?php }
				else { ?>
				
				<thead>
				<th><img src="../../img/adm/cnegra.png"/></th>
				<th><?php echo "<h1  class=\"marcador\">".$partido['marclocal']." - ".$partido['marcvisitante']."</h1>"; ?></th>
				<th><img src="../../img/adm/cnaranja.png"/></th>
				</thead>
				<?php }
				?>
				</table>
				</div>
			</div>
		</div>
	<div id="EstadisticasJugador" class="col-md-12 col-sm-12">
	</div>
	<?php
					 $instruccion="SELECT j.alias,j.dni,j.dorsal,j.foto FROM incidencia i
					 LEFT JOIN jugador j ON i.jugador=j.dni
					 where fecha='".$_POST['fecha']."' AND posicion='A'";
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
					$nfilas = mysql_num_rows ($consulta);
					if ($nfilas>0) {
					?>
					<div id="Arbitro" class="panel panel-warning col-md-6 col-sm-6" style="min-height:80px;">
					 <div class="panel-heading"><img src="../../img/adm/arbitro.png" style="width:20px;height:20px;"/>Árbitro</div>
						 <div class="panel-body">
						<?php
							for($i=0;$i<$nfilas;$i++){
							$resultado=mysql_fetch_array ($consulta);
							if ($resultado['foto']=='') {
							$foto="../../img/jug/sinfoto.png";
							}
							else {
							$foto="../../img/jug/fotosjug/".$resultado['foto'];
							} ?>
							
							<div id="<?php echo $resultado['dni']; ?>" class="dimCajaJug" style="height:83px !important;">
							<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
							<div><?php echo $resultado['alias']; ?><span style="float:right;"><?php echo $resultado['dorsal']; ?></span></div>	
							</div>
							
							<?php } ?>	
						</div>
					</div>
					<?php }
					
	$instruccion="SELECT j.alias,j.dni,j.dorsal,j.foto FROM incidencia i
					 LEFT JOIN jugador j ON i.jugador=j.dni
					 where fecha='".$_POST['fecha']."' AND posicion IS NULL";
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
					$nfilas = mysql_num_rows ($consulta);
					if ($nfilas>0) {
					?>
					<div id="Espectadores" class="panel panel-success col-md-6 col-sm-6" style="min-height:80px;">
					 <div class="panel-heading">Espectadores</div>
						 <div class="panel-body">
						<?php
							for($i=0;$i<$nfilas;$i++){
							$resultado=mysql_fetch_array ($consulta);
							if ($resultado['foto']=='') {
							$foto="../../img/jug/sinfoto.png";
							}
							else {
							$foto="../../img/jug/fotosjug/".$resultado['foto'];
							} ?>
							
							<div id="<?php echo $resultado['dni']; ?>" class="dimCajaJug" style="height:83px !important;">
							<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
							<div><?php echo $resultado['alias']; ?><span style="float:right;"><?php echo $resultado['dorsal']; ?></span></div>	
							</div>
							
							<?php } ?>	
						</div>
					</div>
					<?php }
					
	?>
	
	</div>
	<?php
/*
/ESTRATEGIA DE LOS 2
*/


	}
	else if($partido['estlocal']!=NULL||$partido['estvisitante']!=NULL) {
	/*Hay estrategia de 1*/
		if($partido['estlocal']!=NULL){
		/*Sólo de los locales*/
		$instruccion="SELECT def,cen,del FROM estrategia WHERE idestrategia='".$partido['estlocal']."'";
			$consulta = mysql_query ($instruccion, $conexion)
						or die ("FALLO EN LA CONSULTA $instruccion");			
			$estrategia=mysql_fetch_array ($consulta);
			$def=$estrategia['def'];
			$cen=$estrategia['cen'];
			$del=$estrategia['del'];
			
		?>
		
		<div class="col-sm-4 col-md-4" style="overflow:auto;height:520px;padding:0px !important;">
			<div style="width:323px;height:500px;margin: 0 auto;border:1px solid black;background-size:100% 100%;background-image:url('../../img/adm/campoEstrategiaPlano.jpg');">
			<div id="portero" class="divPosiciones">
				
				<?php
				$instruccion="SELECT j.alias,j.dni,j.dorsal,j.foto,i.gol,i.idsancion FROM incidencia i LEFT JOIN jugador j ON i.jugador=j.dni where
					fecha='".$_POST['fecha']."' AND local='s' AND posicion='por'";	
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
				$resultado=mysql_fetch_array ($consulta);
				
				if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}
				
				
				?>
				<div id="<?php echo $resultado['dni']; ?>" class="dimCajaJug margen1">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?><span style="float:right;"><?php echo $resultado['dorsal']; ?></span></div>
				<div><img src="../../img/adm/gol20x20.png" style="width:15px;margin-top:-5px;"/> <?php echo $resultado['gol']; ?> <span style="float:right;margin-top:-5px;"><?php imgTarjetas($resultado['idsancion']); ?></span></div>
				</div>
				
			</div>
			<div id="defensa" class="divPosiciones">
			<?php
				if ($def==5) {
				$instruccion="SELECT j.alias,j.dni,j.dorsal,j.foto,i.gol,i.idsancion FROM incidencia i LEFT JOIN jugador j ON i.jugador=j.dni where
					fecha='".$_POST['fecha']."' AND local='s' AND posicion='def'";	
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
								$nfilas = mysql_num_rows ($consulta);
					
					for($i=0;$i<$nfilas;$i++){
					$resultado=mysql_fetch_array ($consulta);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" class="dimCajaJug margen5">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?><span style="float:right;"><?php echo $resultado['dorsal']; ?></span></div>
				<div><img src="../../img/adm/gol20x20.png" style="width:15px;margin-top:-5px;"/> <?php echo $resultado['gol']; ?> <span style="float:right;margin-top:-5px;"><?php imgTarjetas($resultado['idsancion']); ?></span></div>
				</div>
					
					<?php
					
					}
				}
				
				else if ($def==4) {
				$instruccion="SELECT j.alias,j.dni,j.dorsal,j.foto,i.gol,i.idsancion FROM incidencia i LEFT JOIN jugador j ON i.jugador=j.dni where
					fecha='".$_POST['fecha']."' AND local='s' AND posicion='def'";	
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
								$nfilas = mysql_num_rows ($consulta);
					
					for($i=0;$i<$nfilas;$i++){
					$resultado=mysql_fetch_array ($consulta);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" class="dimCajaJug margen4 margen5">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?><span style="float:right;"><?php echo $resultado['dorsal']; ?></span></div>
				<div><img src="../../img/adm/gol20x20.png" style="width:15px;margin-top:-5px;"/> <?php echo $resultado['gol']; ?> <span style="float:right;margin-top:-5px;"><?php imgTarjetas($resultado['idsancion']); ?></span></div>
				</div>
					
					<?php
					
					}
				}
				else if ($def==3) { 

				$instruccion="SELECT j.alias,j.dni,j.dorsal,j.foto,i.gol,i.idsancion FROM incidencia i LEFT JOIN jugador j ON i.jugador=j.dni where
					fecha='".$_POST['fecha']."' AND local='s' AND posicion='def'";	
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
								$nfilas = mysql_num_rows ($consulta);
					
					for($i=0;$i<$nfilas;$i++){
					$resultado=mysql_fetch_array ($consulta);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" class="dimCajaJug margen3 margen5">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?><span style="float:right;"><?php echo $resultado['dorsal']; ?></span></div>
				<div><img src="../../img/adm/gol20x20.png" style="width:15px;margin-top:-5px;"/> <?php echo $resultado['gol']; ?> <span style="float:right;margin-top:-5px;"><?php imgTarjetas($resultado['idsancion']); ?></span></div>
				</div>
					
					<?php
					
					}				
				 
				
				}
				else if ($def==2) {
				$instruccion="SELECT j.alias,j.dni,j.dorsal,j.foto,i.gol,i.idsancion FROM incidencia i LEFT JOIN jugador j ON i.jugador=j.dni where
					fecha='".$_POST['fecha']."' AND local='s' AND posicion='def'";	
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
								$nfilas = mysql_num_rows ($consulta);
					
					for($i=0;$i<$nfilas;$i++){
					$resultado=mysql_fetch_array ($consulta);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" class="dimCajaJug margen2 margen5">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?><span style="float:right;"><?php echo $resultado['dorsal']; ?></span></div>
				<div><img src="../../img/adm/gol20x20.png" style="width:15px;margin-top:-5px;"/> <?php echo $resultado['gol']; ?> <span style="float:right;margin-top:-5px;"><?php imgTarjetas($resultado['idsancion']); ?></span></div>
				</div>
					
					<?php
					
					}
				
				}
				else if ($def==1) {
				$instruccion="SELECT j.alias,j.dni,j.dorsal,j.foto,i.gol,i.idsancion FROM incidencia i LEFT JOIN jugador j ON i.jugador=j.dni where
					fecha='".$_POST['fecha']."' AND local='s' AND posicion='def'";	
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
								$nfilas = mysql_num_rows ($consulta);
					
					for($i=0;$i<$nfilas;$i++){
					$resultado=mysql_fetch_array ($consulta);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" class="dimCajaJug margen1">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?><span style="float:right;"><?php echo $resultado['dorsal']; ?></span></div>
				<div><img src="../../img/adm/gol20x20.png" style="width:15px;margin-top:-5px;"/> <?php echo $resultado['gol']; ?> <span style="float:right;margin-top:-5px;"><?php imgTarjetas($resultado['idsancion']); ?></span></div>
				</div>
					
					<?php
					
					}
				
				}
			?>
			</div>
			<div id="centrocampista" class="divPosiciones">
			<?php
				if ($cen==5) {
				$instruccion="SELECT j.alias,j.dni,j.dorsal,j.foto,i.gol,i.idsancion FROM incidencia i LEFT JOIN jugador j ON i.jugador=j.dni where
					fecha='".$_POST['fecha']."' AND local='s' AND posicion='cen'";	
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
								$nfilas = mysql_num_rows ($consulta);
					
					for($i=0;$i<$nfilas;$i++){
					$resultado=mysql_fetch_array ($consulta);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" class="dimCajaJug margen5">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?><span style="float:right;"><?php echo $resultado['dorsal']; ?></span></div>
				<div><img src="../../img/adm/gol20x20.png" style="width:15px;margin-top:-5px;"/> <?php echo $resultado['gol']; ?> <span style="float:right;margin-top:-5px;"><?php imgTarjetas($resultado['idsancion']); ?></span></div>
				</div>
					
					<?php
					
					}
				}
				
				else if ($cen==4) {
				$instruccion="SELECT j.alias,j.dni,j.dorsal,j.foto,i.gol,i.idsancion FROM incidencia i LEFT JOIN jugador j ON i.jugador=j.dni where
					fecha='".$_POST['fecha']."' AND local='s' AND posicion='cen'";	
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
								$nfilas = mysql_num_rows ($consulta);
					
					for($i=0;$i<$nfilas;$i++){
					$resultado=mysql_fetch_array ($consulta);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" class="dimCajaJug margen4 margen5">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?><span style="float:right;"><?php echo $resultado['dorsal']; ?></span></div>
				<div><img src="../../img/adm/gol20x20.png" style="width:15px;margin-top:-5px;"/> <?php echo $resultado['gol']; ?> <span style="float:right;margin-top:-5px;"><?php imgTarjetas($resultado['idsancion']); ?></span></div>
				</div>
					
					<?php
					
					}
				}
				else if ($cen==3) {
				$instruccion="SELECT j.alias,j.dni,j.dorsal,j.foto,i.gol,i.idsancion FROM incidencia i LEFT JOIN jugador j ON i.jugador=j.dni where
					fecha='".$_POST['fecha']."' AND local='s' AND posicion='cen'";	
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
								$nfilas = mysql_num_rows ($consulta);
					
					for($i=0;$i<$nfilas;$i++){
					$resultado=mysql_fetch_array ($consulta);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" class="dimCajaJug margen3 margen5">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?><span style="float:right;"><?php echo $resultado['dorsal']; ?></span></div>
				<div><img src="../../img/adm/gol20x20.png" style="width:15px;margin-top:-5px;"/> <?php echo $resultado['gol']; ?> <span style="float:right;margin-top:-5px;"><?php imgTarjetas($resultado['idsancion']); ?></span></div>
				</div>
					
					<?php
					
					}
				
				}
				else if ($cen==2) {
				$instruccion="SELECT j.alias,j.dni,j.dorsal,j.foto,i.gol,i.idsancion FROM incidencia i LEFT JOIN jugador j ON i.jugador=j.dni where
					fecha='".$_POST['fecha']."' AND local='s' AND posicion='cen'";	
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
								$nfilas = mysql_num_rows ($consulta);
					
					for($i=0;$i<$nfilas;$i++){
					$resultado=mysql_fetch_array ($consulta);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" class="dimCajaJug margen2 margen5">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?><span style="float:right;"><?php echo $resultado['dorsal']; ?></span></div>
				<div><img src="../../img/adm/gol20x20.png" style="width:15px;margin-top:-5px;"/> <?php echo $resultado['gol']; ?> <span style="float:right;margin-top:-5px;"><?php imgTarjetas($resultado['idsancion']); ?></span></div>
				</div>
					
					<?php
					
					}
				
				}
				else if ($cen==1) {
				$instruccion="SELECT j.alias,j.dni,j.dorsal,j.foto,i.gol,i.idsancion FROM incidencia i LEFT JOIN jugador j ON i.jugador=j.dni where
					fecha='".$_POST['fecha']."' AND local='s' AND posicion='cen'";	
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
								$nfilas = mysql_num_rows ($consulta);
					
					for($i=0;$i<$nfilas;$i++){
					$resultado=mysql_fetch_array ($consulta);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" class="dimCajaJug margen1">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?><span style="float:right;"><?php echo $resultado['dorsal']; ?></span></div>
				<div><img src="../../img/adm/gol20x20.png" style="width:15px;margin-top:-5px;"/> <?php echo $resultado['gol']; ?> <span style="float:right;margin-top:-5px;"><?php imgTarjetas($resultado['idsancion']); ?></span></div>
				</div>
					
					<?php
					
					}
				
				}
			?>
			</div>
			
			<div id="delantero" class="divPosiciones">
			<?php
				if ($del==5) {
				$instruccion="SELECT j.alias,j.dni,j.dorsal,j.foto,i.gol,i.idsancion FROM incidencia i LEFT JOIN jugador j ON i.jugador=j.dni where
					fecha='".$_POST['fecha']."' AND local='s' AND posicion='del'";	
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
								$nfilas = mysql_num_rows ($consulta);
					
					for($i=0;$i<$nfilas;$i++){
					$resultado=mysql_fetch_array ($consulta);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" class="dimCajaJug margen5">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?><span style="float:right;"><?php echo $resultado['dorsal']; ?></span></div>
				<div><img src="../../img/adm/gol20x20.png" style="width:15px;margin-top:-5px;"/> <?php echo $resultado['gol']; ?> <span style="float:right;margin-top:-5px;"><?php imgTarjetas($resultado['idsancion']); ?></span></div>
				</div>
					
					<?php
					
					}
				}
				
				else if ($del==4) {
				$instruccion="SELECT j.alias,j.dni,j.dorsal,j.foto,i.gol,i.idsancion FROM incidencia i LEFT JOIN jugador j ON i.jugador=j.dni where
					fecha='".$_POST['fecha']."' AND local='s' AND posicion='del'";	
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
								$nfilas = mysql_num_rows ($consulta);
					
					for($i=0;$i<$nfilas;$i++){
					$resultado=mysql_fetch_array ($consulta);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" class="dimCajaJug margen4 margen5">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?><span style="float:right;"><?php echo $resultado['dorsal']; ?></span></div>
				<div><img src="../../img/adm/gol20x20.png" style="width:15px;margin-top:-5px;"/> <?php echo $resultado['gol']; ?> <span style="float:right;margin-top:-5px;"><?php imgTarjetas($resultado['idsancion']); ?></span></div>
				</div>
					
					<?php
					
					}
				}
				else if ($del==3) {
				$instruccion="SELECT j.alias,j.dni,j.dorsal,j.foto,i.gol,i.idsancion FROM incidencia i LEFT JOIN jugador j ON i.jugador=j.dni where
					fecha='".$_POST['fecha']."' AND local='s' AND posicion='del'";	
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
								$nfilas = mysql_num_rows ($consulta);
					
					for($i=0;$i<$nfilas;$i++){
					$resultado=mysql_fetch_array ($consulta);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" class="dimCajaJug margen3 margen5">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?><span style="float:right;"><?php echo $resultado['dorsal']; ?></span></div>
				<div><img src="../../img/adm/gol20x20.png" style="width:15px;margin-top:-5px;"/> <?php echo $resultado['gol']; ?> <span style="float:right;margin-top:-5px;"><?php imgTarjetas($resultado['idsancion']); ?></span></div>
				</div>
					
					<?php
					
					}
				
				}
				else if ($del==2) {
				$instruccion="SELECT j.alias,j.dni,j.dorsal,j.foto,i.gol,i.idsancion FROM incidencia i LEFT JOIN jugador j ON i.jugador=j.dni where
					fecha='".$_POST['fecha']."' AND local='s' AND posicion='del'";	
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
								$nfilas = mysql_num_rows ($consulta);
					
					for($i=0;$i<$nfilas;$i++){
					$resultado=mysql_fetch_array ($consulta);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" class="dimCajaJug margen2 margen5">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?><span style="float:right;"><?php echo $resultado['dorsal']; ?></span></div>
				<div><img src="../../img/adm/gol20x20.png" style="width:15px;margin-top:-5px;"/> <?php echo $resultado['gol']; ?> <span style="float:right;margin-top:-5px;"><?php imgTarjetas($resultado['idsancion']); ?></span></div>
				</div>
					
					<?php
					
					}
				
				}
				else if ($del==1) {
				$instruccion="SELECT j.alias,j.dni,j.dorsal,j.foto,i.gol,i.idsancion FROM incidencia i LEFT JOIN jugador j ON i.jugador=j.dni where
					fecha='".$_POST['fecha']."' AND local='s' AND posicion='del'";	
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
								$nfilas = mysql_num_rows ($consulta);
					
					for($i=0;$i<$nfilas;$i++){
					$resultado=mysql_fetch_array ($consulta);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" class="dimCajaJug margen1">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?><span style="float:right;"><?php echo $resultado['dorsal']; ?></span></div>
				<div><img src="../../img/adm/gol20x20.png" style="width:15px;margin-top:-5px;"/> <?php echo $resultado['gol']; ?> <span style="float:right;margin-top:-5px;"><?php imgTarjetas($resultado['idsancion']); ?></span></div>
				</div>
					
					<?php
					
					}
				
				}
			?>
			</div>

			</div>
		</div>
		<div class="col-sm-4 col-md-4" style="min-height:480px;">
		<div class="panel panel-info col-md-12 col-sm-12">
			<div class="panel-heading"><?php
						$mes=substr($partido['fecha'],5,2);
						$ano=substr($partido['fecha'],0,4);
						$dia=substr($partido['fecha'],8,2);
						echo "<h4 id=\"".$partido['fecha']."\"  style=\"text-align:center;\">".$dia." - ".$mes." - ".$ano."</h4>";
					?></div>
			<div class="panel-body">
			<div class="table-responsive">
					<table class="col-md-12 col-sm-12">
						<?php $instruccion="SELECT i.local,i.color FROM incidencia i
						LEFT JOIN jugador j ON i.jugador=j.dni
						where fecha='".$_POST['fecha']."' AND local='s'
						ORDER BY `local` ASC,posicion asc LIMIT 1";
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
				$resultado=mysql_fetch_array ($consulta); 
				if ($resultado['color']=='na') { ?>
				<thead>
				<th><img src="../../img/adm/cnaranja.png"/></th>
				<th><?php echo "<h1 class=\"marcador\">".$partido['marclocal']." - ".$partido['marcvisitante']."</h1>"; ?></th>
				<th><img src="../../img/adm/cnegra.png"/></th>
				</thead>
				<?php }
				else { ?>
				
				<thead>
				<th><img src="../../img/adm/cnegra.png"/></th>
				<th><?php echo "<h1  class=\"marcador\">".$partido['marclocal']." - ".$partido['marcvisitante']."</h1>"; ?></th>
				<th><img src="../../img/adm/cnaranja.png"/></th>
				</thead>
				<?php }
				?>
				</table>
				</div>
			</div>
		</div>
		<div class="table-responsive">
			<table class="table table-hover">
			<thead>
			<tr>
				<th colspan="3">Visitante</th>
			</tr>
			<tr>
				<td>Jugador</td>
				<td>Gol/es</td>
				<td>Tarjetas</td>
			</tr>
			</thead>
			<tbody>
			<?php 
			
			$instruccion="SELECT j.alias,j.dni,i.gol,i.idsancion FROM incidencia i LEFT JOIN jugador j ON i.jugador=j.dni where
			fecha='".$_POST['fecha']."' AND local='n' ORDER BY posicion asc";	
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
					$nfilas = mysql_num_rows ($consulta);
					
					for($i=0;$i<$nfilas;$i++){
					$resultado=mysql_fetch_array ($consulta);
					echo "<tr>
					<td id=\"".$resultado['dni']."\" style=\"cursor:pointer;\">".$resultado['alias']."</td>
					<td>".$resultado['gol']."</td><td>";
					
							if ($resultado['idsancion']!='') {
								$instruccion5="SELECT texto FROM cuota WHERE idcuota=".$resultado['idsancion'];
								$consulta5 = mysql_query ($instruccion5, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion5");
								$resultado5=mysql_fetch_array ($consulta5);
								echo $resultado5['texto'];
								}
							
					echo "</td></tr>";
					}
				
			
			?>
			</tbody>
			<tfoot>
			<tr>
				<td colspan="3">Total Jugadores=<?php echo $nfilas; ?></td>
			</tr>
			</tfoot>
			</table>
		</div>
		</div>
		<div class="col-sm-4 col-md-4" style="min-height:480px;">
		<div id="EstadisticasJugador" class="col-md-12 col-sm-12">
		</div>
		<?php
					 $instruccion="SELECT j.alias,j.dni,j.dorsal,j.foto FROM incidencia i
					 LEFT JOIN jugador j ON i.jugador=j.dni
					 where fecha='".$_POST['fecha']."' AND posicion='A'";
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
					$nfilas = mysql_num_rows ($consulta);
					if ($nfilas>0) {
					?>
					<div id="Arbitro" class="panel panel-warning col-md-6 col-sm-6" style="min-height:80px;">
					 <div class="panel-heading"><img src="../../img/adm/arbitro.png" style="width:20px;height:20px;"/>Árbitro</div>
						 <div class="panel-body">
						<?php
							for($i=0;$i<$nfilas;$i++){
							$resultado=mysql_fetch_array ($consulta);
							if ($resultado['foto']=='') {
							$foto="../../img/jug/sinfoto.png";
							}
							else {
							$foto="../../img/jug/fotosjug/".$resultado['foto'];
							} ?>
							
							<div id="<?php echo $resultado['dni']; ?>" class="dimCajaJug" style="height:83px !important;">
							<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
							<div><?php echo $resultado['alias']; ?><span style="float:right;"><?php echo $resultado['dorsal']; ?></span></div>	
							</div>
							
							<?php } ?>	
						</div>
					</div>
					<?php }
					
					$instruccion="SELECT j.alias,j.dni,j.dorsal,j.foto FROM incidencia i
					 LEFT JOIN jugador j ON i.jugador=j.dni
					 where fecha='".$_POST['fecha']."' AND posicion IS NULL";
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
					$nfilas = mysql_num_rows ($consulta);
					if ($nfilas>0) {
					?>
					<div id="Espectadores" class="panel panel-success col-md-6 col-sm-6" style="min-height:80px;">
					 <div class="panel-heading">Espectadores</div>
						 <div class="panel-body">
						<?php
							for($i=0;$i<$nfilas;$i++){
							$resultado=mysql_fetch_array ($consulta);
							if ($resultado['foto']=='') {
							$foto="../../img/jug/sinfoto.png";
							}
							else {
							$foto="../../img/jug/fotosjug/".$resultado['foto'];
							} ?>
							
							<div id="<?php echo $resultado['dni']; ?>" class="dimCajaJug" style="height:83px !important;">
							<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
							<div><?php echo $resultado['alias']; ?><span style="float:right;"><?php echo $resultado['dorsal']; ?></span></div>	
							</div>
							
							<?php } ?>	
						</div>
					</div>
					<?php }
					
		?>
		</div>
		
		<?php }
		else { 
		/*Sólo tiene estrategia los visitantes*/

		$instruccion="SELECT def,cen,del FROM estrategia WHERE idestrategia='".$partido['estvisitante']."'";
			$consulta = mysql_query ($instruccion, $conexion)
						or die ("FALLO EN LA CONSULTA $instruccion");			
			$estrategia=mysql_fetch_array ($consulta);
			$def=$estrategia['def'];
			$cen=$estrategia['cen'];
			$del=$estrategia['del'];
			
		?>
		
		
		<div class="col-sm-4 col-md-4" style="min-height:480px;">
		<div class="panel panel-info col-md-12 col-sm-12">
			<div class="panel-heading"><?php
						$mes=substr($partido['fecha'],5,2);
						$ano=substr($partido['fecha'],0,4);
						$dia=substr($partido['fecha'],8,2);
						echo "<h4 id=\"".$partido['fecha']."\"  style=\"text-align:center;\">".$dia." - ".$mes." - ".$ano."</h4>";
					?></div>
			<div class="panel-body">
			<div class="table-responsive">
					<table class="col-md-12 col-sm-12">
						<?php $instruccion="SELECT i.local,i.color FROM incidencia i
						LEFT JOIN jugador j ON i.jugador=j.dni
						where fecha='".$_POST['fecha']."' AND local='s'
						ORDER BY `local` ASC,posicion asc LIMIT 1";
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
				$resultado=mysql_fetch_array ($consulta); 
				if ($resultado['color']=='na') { ?>
				<thead>
				<th><img src="../../img/adm/cnaranja.png"/></th>
				<th><?php echo "<h1 class=\"marcador\">".$partido['marclocal']." - ".$partido['marcvisitante']."</h1>"; ?></th>
				<th><img src="../../img/adm/cnegra.png"/></th>
				</thead>
				<?php }
				else { ?>
				
				<thead>
				<th><img src="../../img/adm/cnegra.png"/></th>
				<th><?php echo "<h1  class=\"marcador\">".$partido['marclocal']." - ".$partido['marcvisitante']."</h1>"; ?></th>
				<th><img src="../../img/adm/cnaranja.png"/></th>
				</thead>
				<?php }
				?>
				</table>
				</div>
			</div>
		</div>
		<!--<div class="table-responsive">-->
			<table class="table table-hover">
			<thead>
			<tr>
				<th colspan="3">Local</th>
			</tr>
			<tr>
				<td>Jugador</td>
				<td>Gol/es</td>
				<td>Tarjetas</td>
			</tr>
			</thead>
			<tbody>
			<?php 
			
			$instruccion="SELECT j.alias,j.dni,i.gol,i.idsancion FROM incidencia i LEFT JOIN jugador j ON i.jugador=j.dni where
			fecha='".$_POST['fecha']."' AND local='s' ORDER BY posicion asc";	
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
					$nfilas = mysql_num_rows ($consulta);
					
					for($i=0;$i<$nfilas;$i++){
					$resultado=mysql_fetch_array ($consulta);
					echo "<tr>
					<td id=\"".$resultado['dni']."\" style=\"cursor:pointer;\">".$resultado['alias']."</td>
					<td>".$resultado['gol']."</td><td>";
					
							if ($resultado['idsancion']!='') {
								$instruccion5="SELECT texto FROM cuota WHERE idcuota=".$resultado['idsancion'];
								$consulta5 = mysql_query ($instruccion5, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion5");
								$resultado5=mysql_fetch_array ($consulta5);
								echo $resultado5['texto'];
								}
							
					echo "</td></tr>";
					}
				
			
			?>
			</tbody>
			<tfoot>
			<tr>
				<td colspan="3">Total Jugadores=<?php echo $nfilas; ?></td>
			</tr>
			</tfoot>
			</table>
		<!--</div>-->
		</div>
		<div class="col-sm-4 col-md-4" style="overflow:auto;height:520px;padding:0px !important;">
			<div style="width:323px;height:500px;margin: 0 auto;border:1px solid black;background-size:100% 100%;background-image:url('../../img/adm/campoEstrategiaPlano.jpg');">
			<div id="portero" class="divPosiciones">
				
				<?php
				$instruccion="SELECT j.alias,j.dni,j.dorsal,j.foto,i.gol,i.idsancion FROM incidencia i LEFT JOIN jugador j ON i.jugador=j.dni where
					fecha='".$_POST['fecha']."' AND local='n' AND posicion='por'";	
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
				$resultado=mysql_fetch_array ($consulta);
				
				if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}
				
				
				?>
				<div id="<?php echo $resultado['dni']; ?>" class="dimCajaJug margen1">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?><span style="float:right;"><?php echo $resultado['dorsal']; ?></span></div>
				<div><img src="../../img/adm/gol20x20.png" style="width:15px;margin-top:-5px;"/> <?php echo $resultado['gol']; ?> <span style="float:right;margin-top:-5px;"><?php imgTarjetas($resultado['idsancion']); ?></span></div>
				</div>
				
			</div>
			<div id="defensa" class="divPosiciones">
			<?php
				if ($def==5) {
				$instruccion="SELECT j.alias,j.dni,j.dorsal,j.foto,i.gol,i.idsancion FROM incidencia i LEFT JOIN jugador j ON i.jugador=j.dni where
					fecha='".$_POST['fecha']."' AND local='n' AND posicion='def'";	
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
								$nfilas = mysql_num_rows ($consulta);
					
					for($i=0;$i<$nfilas;$i++){
					$resultado=mysql_fetch_array ($consulta);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" class="dimCajaJug margen5">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?><span style="float:right;"><?php echo $resultado['dorsal']; ?></span></div>
				<div><img src="../../img/adm/gol20x20.png" style="width:15px;margin-top:-5px;"/> <?php echo $resultado['gol']; ?> <span style="float:right;margin-top:-5px;"><?php imgTarjetas($resultado['idsancion']); ?></span></div>
				</div>
					
					<?php
					
					}
				}
				
				else if ($def==4) {
				$instruccion="SELECT j.alias,j.dni,j.dorsal,j.foto,i.gol,i.idsancion FROM incidencia i LEFT JOIN jugador j ON i.jugador=j.dni where
					fecha='".$_POST['fecha']."' AND local='n' AND posicion='def'";	
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
								$nfilas = mysql_num_rows ($consulta);
					
					for($i=0;$i<$nfilas;$i++){
					$resultado=mysql_fetch_array ($consulta);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" class="dimCajaJug margen4 margen5">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?><span style="float:right;"><?php echo $resultado['dorsal']; ?></span></div>
				<div><img src="../../img/adm/gol20x20.png" style="width:15px;margin-top:-5px;"/> <?php echo $resultado['gol']; ?> <span style="float:right;margin-top:-5px;"><?php imgTarjetas($resultado['idsancion']); ?></span></div>
				</div>
					
					<?php
					
					}
				}
				else if ($def==3) { 

				$instruccion="SELECT j.alias,j.dni,j.dorsal,j.foto,i.gol,i.idsancion FROM incidencia i LEFT JOIN jugador j ON i.jugador=j.dni where
					fecha='".$_POST['fecha']."' AND local='n' AND posicion='def'";	
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
								$nfilas = mysql_num_rows ($consulta);
					
					for($i=0;$i<$nfilas;$i++){
					$resultado=mysql_fetch_array ($consulta);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" class="dimCajaJug margen3 margen5">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?><span style="float:right;"><?php echo $resultado['dorsal']; ?></span></div>
				<div><img src="../../img/adm/gol20x20.png" style="width:15px;margin-top:-5px;"/> <?php echo $resultado['gol']; ?> <span style="float:right;margin-top:-5px;"><?php imgTarjetas($resultado['idsancion']); ?></span></div>
				</div>
					
					<?php
					
					}				
				 
				
				}
				else if ($def==2) {
				$instruccion="SELECT j.alias,j.dni,j.dorsal,j.foto,i.gol,i.idsancion FROM incidencia i LEFT JOIN jugador j ON i.jugador=j.dni where
					fecha='".$_POST['fecha']."' AND local='n' AND posicion='def'";	
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
								$nfilas = mysql_num_rows ($consulta);
					
					for($i=0;$i<$nfilas;$i++){
					$resultado=mysql_fetch_array ($consulta);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" class="dimCajaJug margen2 margen5">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?><span style="float:right;"><?php echo $resultado['dorsal']; ?></span></div>
				<div><img src="../../img/adm/gol20x20.png" style="width:15px;margin-top:-5px;"/> <?php echo $resultado['gol']; ?> <span style="float:right;margin-top:-5px;"><?php imgTarjetas($resultado['idsancion']); ?></span></div>
				</div>
					
					<?php
					
					}
				
				}
				else if ($def==1) {
				$instruccion="SELECT j.alias,j.dni,j.dorsal,j.foto,i.gol,i.idsancion FROM incidencia i LEFT JOIN jugador j ON i.jugador=j.dni where
					fecha='".$_POST['fecha']."' AND local='n' AND posicion='def'";	
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
								$nfilas = mysql_num_rows ($consulta);
					
					for($i=0;$i<$nfilas;$i++){
					$resultado=mysql_fetch_array ($consulta);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" class="dimCajaJug margen1">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?><span style="float:right;"><?php echo $resultado['dorsal']; ?></span></div>
				<div><img src="../../img/adm/gol20x20.png" style="width:15px;margin-top:-5px;"/> <?php echo $resultado['gol']; ?> <span style="float:right;margin-top:-5px;"><?php imgTarjetas($resultado['idsancion']); ?></span></div>
				</div>
					
					<?php
					
					}
				
				}
			?>
			</div>
			<div id="centrocampista" class="divPosiciones">
			<?php
				if ($cen==5) {
				$instruccion="SELECT j.alias,j.dni,j.dorsal,j.foto,i.gol,i.idsancion FROM incidencia i LEFT JOIN jugador j ON i.jugador=j.dni where
					fecha='".$_POST['fecha']."' AND local='n' AND posicion='cen'";	
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
								$nfilas = mysql_num_rows ($consulta);
					
					for($i=0;$i<$nfilas;$i++){
					$resultado=mysql_fetch_array ($consulta);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" class="dimCajaJug margen5">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?><span style="float:right;"><?php echo $resultado['dorsal']; ?></span></div>
				<div><img src="../../img/adm/gol20x20.png" style="width:15px;margin-top:-5px;"/> <?php echo $resultado['gol']; ?> <span style="float:right;margin-top:-5px;"><?php imgTarjetas($resultado['idsancion']); ?></span></div>
				</div>
					
					<?php
					
					}
				}
				
				else if ($cen==4) {
				$instruccion="SELECT j.alias,j.dni,j.dorsal,j.foto,i.gol,i.idsancion FROM incidencia i LEFT JOIN jugador j ON i.jugador=j.dni where
					fecha='".$_POST['fecha']."' AND local='n' AND posicion='cen'";	
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
								$nfilas = mysql_num_rows ($consulta);
					
					for($i=0;$i<$nfilas;$i++){
					$resultado=mysql_fetch_array ($consulta);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" class="dimCajaJug margen4 margen5">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?><span style="float:right;"><?php echo $resultado['dorsal']; ?></span></div>
				<div><img src="../../img/adm/gol20x20.png" style="width:15px;margin-top:-5px;"/> <?php echo $resultado['gol']; ?> <span style="float:right;margin-top:-5px;"><?php imgTarjetas($resultado['idsancion']); ?></span></div>
				</div>
					
					<?php
					
					}
				}
				else if ($cen==3) {
				$instruccion="SELECT j.alias,j.dni,j.dorsal,j.foto,i.gol,i.idsancion FROM incidencia i LEFT JOIN jugador j ON i.jugador=j.dni where
					fecha='".$_POST['fecha']."' AND local='n' AND posicion='cen'";	
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
								$nfilas = mysql_num_rows ($consulta);
					
					for($i=0;$i<$nfilas;$i++){
					$resultado=mysql_fetch_array ($consulta);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" class="dimCajaJug margen3 margen5">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?><span style="float:right;"><?php echo $resultado['dorsal']; ?></span></div>
				<div><img src="../../img/adm/gol20x20.png" style="width:15px;margin-top:-5px;"/> <?php echo $resultado['gol']; ?> <span style="float:right;margin-top:-5px;"><?php imgTarjetas($resultado['idsancion']); ?></span></div>
				</div>
					
					<?php
					
					}
				
				}
				else if ($cen==2) {
				$instruccion="SELECT j.alias,j.dni,j.dorsal,j.foto,i.gol,i.idsancion FROM incidencia i LEFT JOIN jugador j ON i.jugador=j.dni where
					fecha='".$_POST['fecha']."' AND local='n' AND posicion='cen'";	
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
								$nfilas = mysql_num_rows ($consulta);
					
					for($i=0;$i<$nfilas;$i++){
					$resultado=mysql_fetch_array ($consulta);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" class="dimCajaJug margen2 margen5">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?><span style="float:right;"><?php echo $resultado['dorsal']; ?></span></div>
				<div><img src="../../img/adm/gol20x20.png" style="width:15px;margin-top:-5px;"/> <?php echo $resultado['gol']; ?> <span style="float:right;margin-top:-5px;"><?php imgTarjetas($resultado['idsancion']); ?></span></div>
				</div>
					
					<?php
					
					}
				
				}
				else if ($cen==1) {
				$instruccion="SELECT j.alias,j.dni,j.dorsal,j.foto,i.gol,i.idsancion FROM incidencia i LEFT JOIN jugador j ON i.jugador=j.dni where
					fecha='".$_POST['fecha']."' AND local='n' AND posicion='cen'";	
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
								$nfilas = mysql_num_rows ($consulta);
					
					for($i=0;$i<$nfilas;$i++){
					$resultado=mysql_fetch_array ($consulta);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" class="dimCajaJug margen1">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?><span style="float:right;"><?php echo $resultado['dorsal']; ?></span></div>
				<div><img src="../../img/adm/gol20x20.png" style="width:15px;margin-top:-5px;"/> <?php echo $resultado['gol']; ?> <span style="float:right;margin-top:-5px;"><?php imgTarjetas($resultado['idsancion']); ?></span></div>
				</div>
					
					<?php
					
					}
				
				}
			?>
			</div>
			
			<div id="delantero" class="divPosiciones">
			<?php
				if ($del==5) {
				$instruccion="SELECT j.alias,j.dni,j.dorsal,j.foto,i.gol,i.idsancion FROM incidencia i LEFT JOIN jugador j ON i.jugador=j.dni where
					fecha='".$_POST['fecha']."' AND local='n' AND posicion='del'";	
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
								$nfilas = mysql_num_rows ($consulta);
					
					for($i=0;$i<$nfilas;$i++){
					$resultado=mysql_fetch_array ($consulta);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" class="dimCajaJug margen5">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?><span style="float:right;"><?php echo $resultado['dorsal']; ?></span></div>
				<div><img src="../../img/adm/gol20x20.png" style="width:15px;margin-top:-5px;"/> <?php echo $resultado['gol']; ?> <span style="float:right;margin-top:-5px;"><?php imgTarjetas($resultado['idsancion']); ?></span></div>
				</div>
					
					<?php
					
					}
				}
				
				else if ($del==4) {
				$instruccion="SELECT j.alias,j.dni,j.dorsal,j.foto,i.gol,i.idsancion FROM incidencia i LEFT JOIN jugador j ON i.jugador=j.dni where
					fecha='".$_POST['fecha']."' AND local='n' AND posicion='del'";	
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
								$nfilas = mysql_num_rows ($consulta);
					
					for($i=0;$i<$nfilas;$i++){
					$resultado=mysql_fetch_array ($consulta);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" class="dimCajaJug margen4 margen5">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?><span style="float:right;"><?php echo $resultado['dorsal']; ?></span></div>
				<div><img src="../../img/adm/gol20x20.png" style="width:15px;margin-top:-5px;"/> <?php echo $resultado['gol']; ?> <span style="float:right;margin-top:-5px;"><?php imgTarjetas($resultado['idsancion']); ?></span></div>
				</div>
					
					<?php
					
					}
				}
				else if ($del==3) {
				$instruccion="SELECT j.alias,j.dni,j.dorsal,j.foto,i.gol,i.idsancion FROM incidencia i LEFT JOIN jugador j ON i.jugador=j.dni where
					fecha='".$_POST['fecha']."' AND local='n' AND posicion='del'";	
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
								$nfilas = mysql_num_rows ($consulta);
					
					for($i=0;$i<$nfilas;$i++){
					$resultado=mysql_fetch_array ($consulta);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" class="dimCajaJug margen3 margen5">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?><span style="float:right;"><?php echo $resultado['dorsal']; ?></span></div>
				<div><img src="../../img/adm/gol20x20.png" style="width:15px;margin-top:-5px;"/> <?php echo $resultado['gol']; ?> <span style="float:right;margin-top:-5px;"><?php imgTarjetas($resultado['idsancion']); ?></span></div>
				</div>
					
					<?php
					
					}
				
				}
				else if ($del==2) {
				$instruccion="SELECT j.alias,j.dni,j.dorsal,j.foto,i.gol,i.idsancion FROM incidencia i LEFT JOIN jugador j ON i.jugador=j.dni where
					fecha='".$_POST['fecha']."' AND local='n' AND posicion='del'";	
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
								$nfilas = mysql_num_rows ($consulta);
					
					for($i=0;$i<$nfilas;$i++){
					$resultado=mysql_fetch_array ($consulta);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" class="dimCajaJug margen2 margen5">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?><span style="float:right;"><?php echo $resultado['dorsal']; ?></span></div>
				<div><img src="../../img/adm/gol20x20.png" style="width:15px;margin-top:-5px;"/> <?php echo $resultado['gol']; ?> <span style="float:right;margin-top:-5px;"><?php imgTarjetas($resultado['idsancion']); ?></span></div>
				</div>
					
					<?php
					
					}
				
				}
				else if ($del==1) {
				$instruccion="SELECT j.alias,j.dni,j.dorsal,j.foto,i.gol,i.idsancion FROM incidencia i LEFT JOIN jugador j ON i.jugador=j.dni where
					fecha='".$_POST['fecha']."' AND local='n' AND posicion='del'";	
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
								$nfilas = mysql_num_rows ($consulta);
					
					for($i=0;$i<$nfilas;$i++){
					$resultado=mysql_fetch_array ($consulta);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" class="dimCajaJug margen1">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?><span style="float:right;"><?php echo $resultado['dorsal']; ?></span></div>
				<div><img src="../../img/adm/gol20x20.png" style="width:15px;margin-top:-5px;"/> <?php echo $resultado['gol']; ?> <span style="float:right;margin-top:-5px;"><?php imgTarjetas($resultado['idsancion']); ?></span></div>
				</div>
					
					<?php
					
					}
				
				}
			?>
			</div>

			</div>
		</div>
		<div class="col-sm-4 col-md-4" style="min-height:480px;">
		<div id="EstadisticasJugador" class="col-md-12 col-sm-12">
		</div>
		<?php
					 $instruccion="SELECT j.alias,j.dni,j.dorsal,j.foto FROM incidencia i
					 LEFT JOIN jugador j ON i.jugador=j.dni
					 where fecha='".$_POST['fecha']."' AND posicion='A'";
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
					$nfilas = mysql_num_rows ($consulta);
					if ($nfilas>0) {
					?>
					<div id="Arbitro" class="panel panel-warning col-md-6 col-sm-6" style="min-height:80px;">
					 <div class="panel-heading"><img src="../../img/adm/arbitro.png" style="width:20px;height:20px;"/>Árbitro</div>
						 <div class="panel-body">
						<?php
							for($i=0;$i<$nfilas;$i++){
							$resultado=mysql_fetch_array ($consulta);
							if ($resultado['foto']=='') {
							$foto="../../img/jug/sinfoto.png";
							}
							else {
							$foto="../../img/jug/fotosjug/".$resultado['foto'];
							} ?>
							
							<div id="<?php echo $resultado['dni']; ?>" class="dimCajaJug" style="height:83px !important;">
							<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
							<div><?php echo $resultado['alias']; ?><span style="float:right;"><?php echo $resultado['dorsal']; ?></span></div>	
							</div>
							
							<?php } ?>	
						</div>
					</div>
					<?php }
					
	$instruccion="SELECT j.alias,j.dni,j.dorsal,j.foto FROM incidencia i
					 LEFT JOIN jugador j ON i.jugador=j.dni
					 where fecha='".$_POST['fecha']."' AND posicion IS NULL";
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
					$nfilas = mysql_num_rows ($consulta);
					if ($nfilas>0) {
					?>
					<div id="Espectadores" class="panel panel-success col-md-6 col-sm-6" style="min-height:80px;">
					 <div class="panel-heading">Espectadores</div>
						 <div class="panel-body">
						<?php
							for($i=0;$i<$nfilas;$i++){
							$resultado=mysql_fetch_array ($consulta);
							if ($resultado['foto']=='') {
							$foto="../../img/jug/sinfoto.png";
							}
							else {
							$foto="../../img/jug/fotosjug/".$resultado['foto'];
							} ?>
							
							<div id="<?php echo $resultado['dni']; ?>" class="dimCajaJug" style="height:83px !important;">
							<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
							<div><?php echo $resultado['alias']; ?><span style="float:right;"><?php echo $resultado['dorsal']; ?></span></div>	
							</div>
							
							<?php } ?>	
						</div>
					</div>
					<?php } ?>
		</div>
		
					
		<?php }
	}
	
	else {
	/*NO HAY estrategia*/
	?>
	
	<div class="col-sm-8 col-md-8" style="min-height:480px;">
		<div class="table-responsive">
			<table class="table table-hover">
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
				<td colspan="2"><?php echo "<h1 class=\"marcador\">".$partido['marclocal']." - ".$partido['marcvisitante']."</h1>"; ?></td>
				<td colspan="2"><img src="../../img/adm/cnegra.png"/></td>
				
				<?php }
				else { ?>
				
				
				<td colspan="2"><img src="../../img/adm/cnegra.png"/></td>
				<td colspan="2"><?php echo "<h1 class=\"marcador\">".$partido['marclocal']." - ".$partido['marcvisitante']."</h1>"; ?></td>
				<td colspan="2"><img src="../../img/adm/cnaranja.png"/></td>
				
				<?php }
				?>
					
				</tr>
				<tr>
					<td>Tarjetas</td>
					<td>Gol/es</td>
					<td>Jugador</td>
					<td>Jugador</td>
					<td>Gol/es</td>
					<td>Tarjetas</td>
				</tr>
				</thead>
				<tbody>
					<?php 
					
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
							<td><?php
							if ($resultado['idsancion']!='') {
								$instruccion5="SELECT texto FROM cuota WHERE idcuota=".$resultado['idsancion'];
					$consulta5 = mysql_query ($instruccion5, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion5");
								$resultado5=mysql_fetch_array ($consulta5);
								echo $resultado5['texto'];
								}
							?></td>
							<td><?php echo $resultado['gol']; ?></td>
							<?php echo "<td id=\"".$resultado['dni']."\" style=\"cursor:pointer;\">".$resultado['alias']."</td>"; ?>
							<?php echo "<td id=\"".$resultado1['dni']."\" style=\"cursor:pointer;\">".$resultado1['alias']."</td>"; ?>
							<td><?php echo $resultado1['gol']; ?></td>
							<td><?php
							if ($resultado1['idsancion']!='') {
								$instruccion5="SELECT texto FROM cuota WHERE idcuota=".$resultado1['idsancion'];
								$consulta5 = mysql_query ($instruccion5, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion5");
								$resultado5=mysql_fetch_array ($consulta5);
								echo $resultado5['texto'];
								}
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
	</div>
	<div class="col-sm-4 col-md-4" style="min-height:480px;">
	<div id="EstadisticasJugador" class="col-md-12 col-sm-12">
		</div>
		<?php
					 $instruccion="SELECT j.alias,j.dni,j.dorsal,j.foto FROM incidencia i
					 LEFT JOIN jugador j ON i.jugador=j.dni
					 where fecha='".$_POST['fecha']."' AND posicion='A'";
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
					$nfilas = mysql_num_rows ($consulta);
					if ($nfilas>0) {
					?>
					<div id="Arbitro" class="panel panel-warning col-md-6 col-sm-6" style="min-height:80px;">
					 <div class="panel-heading"><img src="../../img/adm/arbitro.png" style="width:20px;height:20px;"/>Árbitro</div>
						 <div class="panel-body">
						<?php
							for($i=0;$i<$nfilas;$i++){
							$resultado=mysql_fetch_array ($consulta);
							if ($resultado['foto']=='') {
							$foto="../../img/jug/sinfoto.png";
							}
							else {
							$foto="../../img/jug/fotosjug/".$resultado['foto'];
							} ?>
							
							<div id="<?php echo $resultado['dni']; ?>" class="dimCajaJug" style="height:83px !important;">
							<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
							<div><?php echo $resultado['alias']; ?><span style="float:right;"><?php echo $resultado['dorsal']; ?></span></div>	
							</div>
							
							<?php } ?>	
						</div>
					</div>
					<?php }
					
	$instruccion="SELECT j.alias,j.dni,j.dorsal,j.foto FROM incidencia i
					 LEFT JOIN jugador j ON i.jugador=j.dni
					 where fecha='".$_POST['fecha']."' AND posicion IS NULL";
					$consulta = mysql_query ($instruccion, $conexion)
								or die ("FALLO EN LA CONSULTA $instruccion");
					$nfilas = mysql_num_rows ($consulta);
					if ($nfilas>0) {
					?>
					<div id="Espectadores" class="panel panel-success col-md-6 col-sm-6" style="min-height:80px;">
					 <div class="panel-heading">Espectadores</div>
						 <div class="panel-body">
						<?php
							for($i=0;$i<$nfilas;$i++){
							$resultado=mysql_fetch_array ($consulta);
							if ($resultado['foto']=='') {
							$foto="../../img/jug/sinfoto.png";
							}
							else {
							$foto="../../img/jug/fotosjug/".$resultado['foto'];
							} ?>
							
							<div id="<?php echo $resultado['dni']; ?>" class="dimCajaJug" style="height:83px !important;">
							<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
							<div><?php echo $resultado['alias']; ?><span style="float:right;"><?php echo $resultado['dorsal']; ?></span></div>	
							</div>
							
							<?php } ?>	
						</div>
					</div>
					<?php } ?>
	</div>
	<?php
	}
		
mysql_close ($conexion);
?>
