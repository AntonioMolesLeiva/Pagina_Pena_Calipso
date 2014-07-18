<?php
include ('../../../php/conexion.php');
$mes=array(1=>"Enero",2=>"Febrero",3=>"Marzo",4=>"Abril",5=>"Mayo",6=>"Junio",9=>"Septiembre",10=>"Octubre",11=>"Noviembre",12=>"Diciembre");
//echo "año-> ".$_POST['ano']." jugador->".$_POST['dnijug']."<br />";
/*	mysql_set_charset("utf8");
	$instruccion="";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");
	$nfilas = mysql_num_rows ($consulta);
	if ($nfilas>0) {
		for ($i=0; $i<$nfilas; $i++){
				$resultado = mysql_fetch_array ($consulta);
			}
	}*/
?>
<script>
$(document).ready(function() {
	$("#masdeuda").click(function(){
	$('#cambiardeudaPago').modal('show');
		$.post("./gestionarpagos/anadirdeuda.php", { 'ano':"<?php echo $_POST['ano']; ?>",'dnijug':"<?php echo $_POST['dnijug']; ?>",'idcollapse':'<?php echo $_POST['idcollapse']; ?>'}, function (data) { 
			$("#cambiardeudaPago").find(".modal-body").html(data); //Se muestra el resultado de la operación en la clase 
			});
	});
	$("#menosdeuda").click(function(){
		$('#cambiardeudaPago').modal('show');
		$.post("./gestionarpagos/anadirpago.php", { 'ano':"<?php echo $_POST['ano']; ?>",'dnijug':"<?php echo $_POST['dnijug']; ?>",'idcollapse':'<?php echo $_POST['idcollapse']; ?>'}, function (data) { 
			$("#cambiardeudaPago").find(".modal-body").html(data); //Se muestra el resultado de la operación en la clase 
			});
	});
});
</script>

<div class="table-resposive">
	<table class="table table-striped">
		<thead>
		<tr>
		<th colspan="4">
			<button id="masdeuda" class="btn btn-danger"><span class="glyphicon glyphicon-thumbs-down"></span>&nbsp;&nbsp;Agregar deuda</button>
			<button id="menosdeuda" class="btn btn-info"><span class="glyphicon glyphicon-thumbs-up"></span>&nbsp;&nbsp;Agregar Pago </button>
		</th>
		</tr>
		</thead>
		<tbody>
		<?php
			$instruccion="SELECT * FROM deudas d LEFT JOIN cuota c ON d.idcuota=c.idcuota WHERE d.fechadeuda>=\"".($_POST['ano']-1)."-09-01\" AND d.fechadeuda<=\"".$_POST['ano']."-06-30\" AND d.jugador=\"".$_POST['dnijug']."\" ORDER BY d.fechadeuda ASC";
			$consulta = mysql_query ($instruccion, $conexion)
						or die ("FALLO EN LA CONSULTA $instruccion");
			$nfilas = mysql_num_rows ($consulta);
			if ($nfilas>0) {
			$ano=0;
				for ($i=0; $i<$nfilas; $i++){
				$j=0;
						$resultado = mysql_fetch_array ($consulta);
						
						/* PARA SABER CUANTOS PAGOS EN ÉSE MES */
						$instruccion="SELECT * 
									FROM deudas d
									LEFT JOIN pagos p ON d.ideuda = p.ideuda
									WHERE d.ideuda=".$resultado['ideuda']."
									AND d.jugador =  \"".$resultado['jugador']."\"
									ORDER BY d.fechadeuda ASC";
						$consulta1 = mysql_query ($instruccion, $conexion)
									or die ("FALLO EN LA CONSULTA $instruccion");
						$nfilas1 = mysql_num_rows ($consulta1);
						if($nfilas1==0) {
							if ($ano==substr($resultado['fechadeuda'],0,7)) {
							
								echo "<tr>
									<td>".$resultado['fechadeuda']."</td>
									<td>".$resultado['texto']."</td>
									<td>".$resultado['precio']." €</td>
									</tr>";
									
							}
							else {
							$mees=(int)substr($resultado['fechadeuda'],5,2);
							echo "<tr>
								<td colspan=\"4\"  class=\"warning\">".$mes[$mees]."</td>
							</tr>";
							echo "<tr>
							<td>Fecha</td>
							<td>Concepto</td>
							<td>Precio</td>
							<td>Recibí</td>
							</tr>";
							echo "<tr>
									<td>".$resultado['fechadeuda']."</td>
									<td>".$resultado['texto']."</td>
									<td>".$resultado['precio']." €</td>
									</tr>";
							}
						}
						else {
							if ($ano==substr($resultado['fechadeuda'],0,7)) {
							$resultado1 = mysql_fetch_array ($consulta1);
							$j++;
								echo "<tr>
									<td rowspan=\"".$nfilas1."\" style=\"vertical-align:middle;\">".substr($resultado['fechadeuda'],8,2)."-".substr($resultado['fechadeuda'],5,2)."-".substr($resultado['fechadeuda'],0,4)."</td>
									<td rowspan=\"".$nfilas1."\" style=\"vertical-align:middle;\">".$resultado['texto']."</td>
									<td rowspan=\"".$nfilas1."\" style=\"vertical-align:middle;\">".$resultado['precio']." €";
									if ($resultado['pagado']=='s') echo "&nbsp;&nbsp;<span class=\"glyphicon glyphicon-ok\" style=\"color:green;\"></span>";
									else echo "&nbsp;&nbsp;<span class=\"glyphicon glyphicon-remove\"  style=\"color:red;\"></span>";
									"</td>";
									
									if ($resultado1['acuenta']=="") echo"<td></td>";
									else echo"<td>".$resultado1['acuenta']." €</td>";
									
									echo "</tr>";
							}
							else {
							$resultado1 = mysql_fetch_array ($consulta1);
							$j++;
							$mees=(int)substr($resultado['fechadeuda'],5,2);
							echo "<tr>
								<td colspan=\"4\" class=\"warning\">".$mes[$mees]."</td>
							</tr>";
							echo "<tr>
							<td>Fecha</td>
							<td>Concepto</td>
							<td>Precio</td>
							<td>Recibí</td>
							</tr>";
							echo "<tr>
									<td rowspan=\"".$nfilas1."\" style=\"vertical-align:middle;\">".substr($resultado['fechadeuda'],8,2)."-".substr($resultado['fechadeuda'],5,2)."-".substr($resultado['fechadeuda'],0,4)."</td>
									<td rowspan=\"".$nfilas1."\" style=\"vertical-align:middle;\">".$resultado['texto']."</td>
									<td rowspan=\"".$nfilas1."\" style=\"vertical-align:middle;\">".$resultado['precio']." €";
									if ($resultado['pagado']=='s') echo "&nbsp;&nbsp;<span class=\"glyphicon glyphicon-ok\" style=\"color:green;\"></span>";
									else echo "&nbsp;&nbsp;<span class=\"glyphicon glyphicon-remove\"  style=\"color:red;\"></span>";
									"</td>";
									
									if ($resultado1['acuenta']=="") echo"<td></td>";
									else echo"<td>".$resultado1['acuenta']." €</td>";
									
									echo "</tr>";
							}
						}
						
						
						for ($j; $j<$nfilas1; $j++){
						$resultado1 = mysql_fetch_array ($consulta1);
						echo "<tr><td>".$resultado1['acuenta']." €</td></tr>";
						}

						
						
						
						
					$ano=substr($resultado['fechadeuda'],0,7);	
						
					}
			}
		?>
		</tbody>
	</table>
</div>
<?php
mysql_close ($conexion);
?>
