<?php
include ('../../../php/conexion.php');

//echo "año-> ".$_POST['ano']." dni-> ".$_POST['dnijug']." fechapartido ".$_POST['fechapartido']." collapse->".$_POST['idcollapse']." ideuda-> ".$_POST['ideuda'];
	mysql_set_charset("utf8");
	$instruccion="INSERT INTO deudas(fechapartido,fechadeuda,idcuota,jugador) VALUES (\"".$_POST['fechapartido']."\",\"".$_POST['fechapartido']."\",".$_POST['ideuda'].",\"".$_POST['dnijug']."\")";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA INSERCIÓN,probablemente el partido asociado a ésta deuda no está creado");

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
			$.post("./gestionarpagos/generartabladeudapago.php", { 'ano':'<?php echo $_POST['ano'];?>','dnijug':'<?php echo $_POST['dnijug'];?>','idcollapse':'<?php echo $_POST['idcollapse']; ?>'}, function (data) { 
			$("<?php echo $_POST['idcollapse'];?> div").html(data); //Se muestra el resultado de la operación en la clase 
			});
			});

});

});
</script>

