	<?php
	include ('../../../php/conexion.php');
	switch($_POST['pos']) {
		case 'por':
				$instruccion="SELECT dni,alias,posicionhab FROM jugador WHERE posicionhab='por' ORDER BY alias ASC";
				break;
		case 'def':
				$instruccion="SELECT dni,alias,posicionhab FROM jugador WHERE posicionhab='def' ORDER BY alias ASC";
				break;
		case 'cen':
				$instruccion="SELECT dni,alias,posicionhab FROM jugador WHERE posicionhab='cen' ORDER BY alias ASC";
				break;
		case 'del':
				$instruccion="SELECT dni,alias,posicionhab FROM jugador WHERE posicionhab='del' ORDER BY alias ASC";
				break;
		case 'arb':
				$instruccion="SELECT dni,alias,posicionhab FROM jugador WHERE posicionhab='A' ORDER BY alias ASC";
				break;
		case 'extran':
				$instruccion="SELECT dni,alias,posicionhab FROM jugador WHERE activo='n' ORDER BY alias ASC";
				break;
		case 'extras':
				$instruccion="SELECT dni,alias,posicionhab FROM jugador WHERE activo='s' ORDER BY alias ASC";
				break;
	}
	
	
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
	
mysql_close ($conexion);
?>