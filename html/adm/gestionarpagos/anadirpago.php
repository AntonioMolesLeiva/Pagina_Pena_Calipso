<script>
$(document).ready(function(){
	$("#guardar").click(function(){
	var hola=$("#Precio option:selected").html();
	//busco el &
	var n = hola.indexOf("&");
	//corto desde 0 hasta que haya encontrado &
	var ah=hola.slice(0,n);
	
		//alert("Valor: "+ah+" deuda: "+$("#ideuda option:selected").attr("id"));
		$.post("./gestionarpagos/guardarpago.php", { 'ano':"<?php echo $_POST['ano']; ?>",'ideuda':$("#ideuda option:selected").attr("id"),'valor':ah,'idcollapse':'<?php echo $_POST['idcollapse']; ?>'}, function (data) { 
		$("#cambiardeudaPago").find(".modal-body").html(data); //Se muestra el resultado de la operación en la clase 
		});
	});
 });
</script>
	<?php
	include ('../../../php/conexion.php');
	//echo "año-> ".$_POST['ano']." | dnijug-> ".$_POST['dnijug']."<br />";
	mysql_set_charset("utf8");
	$instruccion="SELECT * FROM deudas d LEFT JOIN cuota c ON d.idcuota=c.idcuota WHERE d.fechadeuda>=\"".($_POST['ano']-1)."-09-01\" AND d.fechadeuda<=\"".$_POST['ano']."-06-30\" AND d.jugador=\"".$_POST['dnijug']."\" AND pagado=\"n\" ORDER BY d.fechadeuda ASC";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");
	$nfilas = mysql_num_rows ($consulta);
	if ($nfilas>0) {
		echo "<label>Elige: <select id=\"ideuda\" class=\"form-control\">";
		for ($i=0; $i<$nfilas; $i++){
			$resultado = mysql_fetch_array ($consulta);
			echo "<option id=\"".$resultado['ideuda']."\">(".substr($resultado['fechadeuda'],8,2)."-".substr($resultado['fechadeuda'],5,2)."-".substr($resultado['fechadeuda'],0,4).") ".$resultado['texto']."</option>";
			}
		echo "</select></label>";
	}
	?>

  <label>
	Entrega:
    <select id="Precio"  class="form-control">
	<?php
	for($i=1;$i<=50;$i++)	echo "<option>".$i."&nbsp;€</option>";
	?>
	</select>
  </label>
	<?php
mysql_close ($conexion);
?>
<hr />
<div>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar sin guardar</button>
        <button id="guardar" type="button" class="btn btn-primary">Guardar</button>
</div>
