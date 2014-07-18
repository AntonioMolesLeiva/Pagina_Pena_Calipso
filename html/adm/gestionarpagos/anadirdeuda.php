<script>
$(document).ready(function(){
	$("#guardar").click(function(){	
	if ($("#fechaPartido").val()!=""){ 
	var fecha=$("#fechaPartido").val().substr(6,4)+"-"+$("#fechaPartido").val().substr(3,2)+"-"+$("#fechaPartido").val().substr(0,2);
		//alert(" deuda: "+$("#ideuda option:selected").attr("id")+" fecha-> "+fecha+" collapse <?php echo $_POST['idcollapse']; ?>");
		$.post("./gestionarpagos/guardardeuda.php", { 'ano':"<?php echo $_POST['ano']; ?>",'ideuda':$("#ideuda option:selected").attr("id"),'dnijug':"<?php echo $_POST['dnijug']; ?>",'fechapartido':fecha,'idcollapse':'<?php echo $_POST['idcollapse']; ?>'}, function (data) { 
		$("#cambiardeudaPago").find(".modal-body").html(data); //Se muestra el resultado de la operación en la clase 
		});
		}
		else alert("Tienes que escoger una fecha.");
	});
 
 $( "#fechaPartido").datepicker({
		dateFormat: "dd-mm-yy",
		dayNames: [ "Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado" ],
		dayNamesMin:[ "D", "L", "M", "X", "J", "V", "S" ],
		duration:"slow",
		firstDay: 1,
		monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ],
		monthNamesShort: [ "Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic" ],
		nextText: "Sig.",
		prevText: "Ant.",
		showAnim: "slide",
		appendText: "(dd-mm-aaaa)",
		beforeShowDay: function(date) {
				var a = new Array();
				a[0] = date.getDay() == 2;
				a[1] = '';
				a[2] = '';
				return a;
			}
  });
 });
</script>
	<?php
	include ('../../../php/conexion.php');
	//echo "año-> ".$_POST['ano']." | dnijug-> ".$_POST['dnijug']."<br />";
	mysql_set_charset("utf8");
	$instruccion="SELECT * FROM cuota ORDER BY idcuota DESC";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");
	$nfilas = mysql_num_rows ($consulta);
	if ($nfilas>0) {
		echo "<label  style=\"float:left;\">Elige: <select id=\"ideuda\" class=\"form-control\">";
		for ($i=0; $i<$nfilas; $i++){
			$resultado = mysql_fetch_array ($consulta);
			echo "<option id=\"".$resultado['idcuota']."\">".$resultado['texto']." (".$resultado['precio']."&nbsp; €)</option>";
			}
		echo "</select>
		<p id=\"helpdeuda\" class=\"help-block\">SI-No -Error</p>
		</label>";
	}
	?>

  <label>
	Fecha:
    <input id ="fechaPartido" type="text" class="form-control" readonly required />
  </label>
	<?php
mysql_close ($conexion);
?>
<hr />
<div>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar sin guardar</button>
        <button id="guardar" type="button" class="btn btn-primary">Guardar</button>
</div>
