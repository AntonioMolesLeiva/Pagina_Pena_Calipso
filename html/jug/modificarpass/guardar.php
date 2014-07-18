<?php
include ('../../../php/conexion.php');
	mysql_set_charset("utf8");

	$instruccion="update jugador SET contrasena=\"".md5($_POST['pass'])."\" WHERE dni=\"".$_POST['idjug']."\"";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");			

mysql_close ($conexion);
?>
<h1>Tu contraseña nueva es:&nbsp;<?php echo $_POST['pass']; ?></h1>
