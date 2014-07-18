<?php
include ('../../../php/conexion.php');

//echo "ideuda-> ".$_POST['ideuda']." valor->".$_POST['valor']." ano-> ".$_POST['ano']." collapse-> ".$_POST['idcollapse']."<br />";

	mysql_set_charset("utf8");
	$instruccion="SELECT d.jugador, SUM( p.acuenta ) AS totpagos FROM deudas d
				INNER JOIN pagos p ON d.ideuda = p.ideuda
				AND d.jugador = (SELECT jugador FROM deudas WHERE ideuda=".$_POST['ideuda'].")
				AND d.fechadeuda >=  \"".($_POST['ano']-1)."-09-01\"
				AND d.fechadeuda <=  \"".$_POST['ano']."-06-30\"
				GROUP BY d.jugador";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");
	$totpagos = mysql_fetch_array ($consulta);
	if ($totpagos['totpagos']=="") $parcial=0;
	else $parcial=$totpagos['totpagos'];
	$total=$parcial+$_POST['valor'];
	
	
	$instruccion="SELECT d.ideuda, c.precio,d.pagado FROM deudas d
				LEFT JOIN cuota c ON d.idcuota = c.idcuota
				WHERE d.fechadeuda >=  \"".($_POST['ano']-1)."-09-01\"
				AND d.fechadeuda <=  \"".$_POST['ano']."-06-30\"
				AND d.jugador = (SELECT jugador FROM deudas WHERE ideuda=".$_POST['ideuda'].")
				ORDER BY d.pagado ASC ";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");
	$nfilas = mysql_num_rows ($consulta);
	
	$instruccion="INSERT INTO pagos (ideuda,acuenta)VALUES(".$_POST['ideuda'].",".$_POST['valor'].")";
					$consulta1 = mysql_query ($instruccion, $conexion)
					or die ("FALLO EN LA CONSULTA $instruccion");
	
	if ($nfilas>0) {
		for ($i=0; $i<$nfilas; $i++){
				$resultado = mysql_fetch_array ($consulta);
				$total=$total-$resultado['precio'];
				
				if($total>=0&&$resultado['pagado']=='n'){
					$instruccion="UPDATE deudas SET pagado='s' WHERE ideuda=".$resultado['ideuda'];
					
					$consulta1 = mysql_query ($instruccion, $conexion)
					or die ("FALLO EN LA CONSULTA $instruccion");
				}
				
				
			}
	}

	echo "<h4 style=\"color:green;\"><span class=\"glyphicon glyphicon-ok\"></span></h4>
		<p>Se han introducido correctamente el pago al jugador</p>";	
mysql_close ($conexion);
?>
<script>
$(document).ready(function() {
$('#cambiardeudaPago').on('hidden.bs.modal', function (e) {
	$.post( "./gestionarpagos/pagos.php", { 'anomax':'<?php echo $_POST['ano']; ?>'}, function (data) { 
			$("#infopartido").html(data); //Se muestra el resultado de la operación en la clase 
			}).done(function(){
			$("<?php echo $_POST['idcollapse'];?>").addClass("in");
			$.post("./gestionarpagos/generartabladeudapago.php", { 'ano':'<?php echo $_POST['ano'];?>','dnijug':'<?php echo $totpagos['jugador'];?>','idcollapse':'<?php echo $_POST['idcollapse']; ?>'}, function (data) { 
			$("<?php echo $_POST['idcollapse'];?> div").html(data); //Se muestra el resultado de la operación en la clase 
			});
			});
			

	
});

});
</script>

