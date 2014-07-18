
<?php
//$_POST['idcuota'];
include ('../../../php/conexion.php');

$cuotas = explode(",",$_POST['idcuota']);
$cont=count($cuotas);
for($i=0;$i<$cont;$i++) {

	if ($cuotas[$i]!="") {
		//BORRO PAGOS
		$instruccion="SELECT p.idpago
						FROM deudas d
						RIGHT JOIN pagos p ON d.ideuda = p.ideuda
						WHERE d.idcuota =".$cuotas[$i]."
						ORDER BY p.idpago ASC ";
		$consulta = mysql_query ($instruccion, $conexion)
					or die ("FALLO EN LA CONSULTA $instruccion");
		$nfilas = mysql_num_rows ($consulta);
		if ($nfilas>0) {
			for ($j=0; $j<$nfilas; $j++){
				$resultado = mysql_fetch_array ($consulta);
				$instruccion="DELETE FROM pagos WHERE idpago=".$resultado['idpago'];
				$consulta1 = mysql_query ($instruccion, $conexion)
					or die ("FALLO EN LA CONSULTA $instruccion");
				
				}
				
		}
		//BORRO DEUDAS
		$instruccion="SELECT ideuda FROM deudas WHERE idcuota =".$cuotas[$i];
		$consulta = mysql_query ($instruccion, $conexion)
					or die ("FALLO EN LA CONSULTA $instruccion");
		$nfilas = mysql_num_rows ($consulta);
		if ($nfilas>0) {
			for ($j=0; $j<$nfilas; $j++){
				$resultado = mysql_fetch_array ($consulta);
				$instruccion="DELETE FROM deudas WHERE ideuda=".$resultado['ideuda'];
				$consulta1 = mysql_query ($instruccion, $conexion)
					or die ("FALLO EN LA CONSULTA $instruccion");
				
				}
			}
	//BORRO CUOTA
	$instruccion="DELETE FROM cuota WHERE idcuota=".$cuotas[$i];
	$consulta1 = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");
	}
}




mysql_close ($conexion);
?>
<script>
$.post("./gestionarpagos/indexcrearpago.php", function (data) { 
			$("#infopartido").html(data); //Se muestra el resultado de la operación en la clase 
			});
</script>