<?php 

include ('../../php/conexion.php');
				$instruccion="SELECT dni FROM jugador WHERE dni='".$_POST['dni']."'";
						$consulta = mysql_query ($instruccion, $conexion)
									or die ("FALLO EN LA CONSULTA $instruccion");
						$nfilas = mysql_num_rows ($consulta);
						if ($nfilas>0) { ?>
							<span style="color:red;">Existe</span>
							<script>
								$("#gJugador").prop('disabled',true);
							</script>
							<?php }
						else{?>
							<span style="color:green;">no Existe</span>
							<script>
								$("#gJugador").prop('disabled',false);
							</script>
							<?php }
mysql_close ($conexion);

?>
