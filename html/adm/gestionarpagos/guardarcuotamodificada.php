
<?php
//$_POST['precionuevo'] $_POST['idcuota'];
include ('../../../php/conexion.php');

mysql_set_charset("utf8");
		$instruccion="UPDATE cuota SET precio=".$_POST['precionuevo']." WHERE idcuota=".$_POST['idcuota'];
		$consulta = mysql_query ($instruccion, $conexion)
					or die ("FALLO EN LA CONSULTA $instruccion");
					
mysql_close ($conexion);
?>
Modificaciones guardadas.
