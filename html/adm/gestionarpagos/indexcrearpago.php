<?php 
include ('../../php/conexion.php');
include ('../../../php/conexion.php');
?>
<div id="infopartido" class="col-md-12 col-sm-12" style="min-height:536px;background-color:rgba(12,12,12,0.3);">
<div class="col-md-5 col-md-offset-3 col-sm-5 col-sm-offset-3" style="height:600px;background-color:white;border-radius:12px;box-shadow: 0px 0px 22px yellowgreen;border:5px solid #777;" >
<h2 style="text-align:center;">Crear-modificar cuota</h2>
<div class="table-responsive">
	<table class="table table-striped">
		<thead>
		<tr>
			<th>Concepto</th>
			<th>Precio</th>
			<th></th>
		</tr>
		</thead>
		<tfoot>
		<tr>
		<td><button id="agCuota" class="btn btn-info">Agregar cuota</button></td>
		<td><button id="boCuota" class="btn btn-warning">Borrar cuota</button></td>
		<td></td>
		</tr>
		</tfoot>
		<tbody>
		<?php
		mysql_set_charset("utf8");
		$instruccion="SELECT * FROM cuota ORDER BY idcuota ASC";
		$consulta = mysql_query ($instruccion, $conexion)
					or die ("FALLO EN LA CONSULTA $instruccion");
		$nfilas = mysql_num_rows ($consulta);
		if ($nfilas>0) {
			for ($i=0; $i<$nfilas; $i++){
				$resultado = mysql_fetch_array ($consulta);
				if ($i>=5) {
				echo "<tr>
					<td>".$resultado['texto']."</td>
					<td><span id=\"".$resultado['idcuota']."\" style=\"cursor:pointer;\">".$resultado['precio']."<span>&nbsp; €</td>
					<td><input type=\"checkbox\" name=\"we\" value=\"".$resultado['idcuota']."\"/></td>
				</tr>";
				}
				else {
				echo "<tr>
					<td>".$resultado['texto']."</td>
					<td><span id=\"".$resultado['idcuota']."\" style=\"cursor:pointer;\">".$resultado['precio']."<span>&nbsp; €</td>
					<td></td>
				</tr>";
				}
				
			}
		}
		?>
		</tbody>
		
	</table>
</div>
</div>
</div>
<script>
$(document).ready(function(){
	$("span").click(function(){
		//alert("Quieres modificar: "+$(this).attr("id"));
		var val=$(this).attr("id");
		$.post( "./gestionarpagos/cargarprecio.php", { 'precio':$(this).text(),'idcuota':$(this).attr("id")}, function (data) { 
		$("#"+val).html(data); //Se muestra el resultado de la operación en la clase 
		});
	});
	
	$("#agCuota").click(function(){
	$("#AnadirCuota").modal('show');
	});
	
	$("#boCuota").click(function(){
	var checkboxValues = "";
	var we=$("input[name='we']:checked").each(function() {
	checkboxValues += $(this).val() + ",";
	});
	//alert("wa ");
	if(checkboxValues.length==0){
	alert("No has selecionado ninguna cuota para borrar");
	}
	else {
	//alert("Has seleccionado al menos 1");
	
	if (confirm("Si hay deudas-pagos asociados a ésta cuota SE BORRARÁN, ¿Está seguro?")) {
	$.post( "./gestionarpagos/borrarcuota.php", {'idcuota':checkboxValues}, function (data) { 
		$("table").after(data); //Se muestra el resultado de la operación en la clase 
		});
	}
	}
	
	});
	
	$("#gCuota").click(function(){
	if ($("#texto").val()=="") {
	alert("Tienes que poner un concepto a la cuota obligatoriamente");
	}
	else {
	var hola=$("#precioCuota option:selected").html();
	//busco el &
	var n = hola.indexOf("&");
	//corto desde 0 hasta que haya encontrado &
	var ah=hola.slice(0,n);
	$.post( "./gestionarpagos/agregarcuota.php", {'texto':$("#texto").val(),'precio':ah}, function (data) { 
		$("table").after(data); //Se muestra el resultado de la operación en la clase 
		});
	}
	});
});

</script>
<?php 
mysql_close ($conexion);
?>
<div class="modal fade" id="AnadirCuota" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Añadir una cuota</h4>
      </div>
      <div class="modal-body">
			<label>
			Concepto:
			<input id="texto" class="form-control" type="text" value="" placeholder="introduce el texto de cuota"/>
			</label>
			<label>
			Precio:
			<select id="precioCuota" class="form-control">
			<?php
			for($i=1;$i<=50;$i++){
			echo "<option>".$i."&nbsp;€</option>";
			}
			?>
			</select>
			</label>
			
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" id="gCuota" class="btn btn-primary">Guardar cuota</button>
      </div>
    </div>
  </div>
</div>