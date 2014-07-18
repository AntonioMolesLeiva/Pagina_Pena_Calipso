
<?php session_start(); ?>

<script>
$(document).ready(function(){
	$(".btn").click(function() {
		//alert($("input[type='text']").val());
		$.post( "./modificarpass/guardar.php", { 'idjug':'<?php echo $_SESSION['usu']; ?>','pass':$("input[type='password']").val()}, function (data) { 
		$(".jumbotron").html(data); //Se muestra el resultado de la operación en la clase 
		});
	});
});
</script>
<?php
include ('../../php/conexion.php');
	
	mysql_set_charset("utf8");

	
	/*$instruccion="SELECT p.fecha
				FROM partido p
				LEFT JOIN incidencia i ON p.fecha = i.fecha
				WHERE jugador =  \"".$_SESSION['usu']."\"
				ORDER BY p.fecha DESC 
				LIMIT 0 , 1";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");			
	$nfilas = mysql_num_rows ($consulta);
	if ($nfilas>0) {
	$fechapart=mysql_fetch_array ($consulta);
	$fechapartido=$fechapart['fecha'];
	}*/
	
	/*$contrasena=md5($_POST['contrasena']);*/
	?>
	<div class="jumbotron col-md-6 col-sm-6 col-md-offset-3 col-sm-offset-3" style="border-radius:20px;">
  <h1>Cambia tu contraseña</h1>
  <label>
  Contraseña:
  <input class="form-control" type="password" />
  </label>
  <p><a class="btn btn-primary btn-lg" role="button">Guardar</a></p>
</div>
<?php 
mysql_close ($conexion);
?>
