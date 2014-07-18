
<?php
//$_POST['idcuota'];
include ('../../../php/conexion.php');
$instruccion="SELECT * FROM cuota";
		$consulta = mysql_query ($instruccion, $conexion)
					or die ("FALLO EN LA CONSULTA $instruccion");
		$nfilas = mysql_num_rows ($consulta);
		
		//
		$instruccion="INSERT INTO cuota VALUES(".($nfilas++).",\"".$_POST['texto']."\",".$_POST['precio'].") ";
		$consulta = mysql_query ($instruccion, $conexion)
					or die ("FALLO EN LA CONSULTA $instruccion");

mysql_close ($conexion);
?>
<script>

$.post("./gestionarpagos/indexcrearpago.php", function (data) { 
			$("#infopartido").html(data); //Se muestra el resultado de la operación en la clase 
			});
$("#AnadirCuota").modal('hide');
$("body").removeClass("modal-open");
$(".modal-backdrop").remove();
</script>