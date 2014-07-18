<script>
//Para que no se propague el evento click del padre: SPAN
	$("select").click(function(e){
	  e.stopPropagation();
	});
	$("select").blur(function(){
	var hola=$("select option:selected").html();
	//busco el &
	var n = hola.indexOf("&");
	//corto desde 0 hasta que haya encontrado &
	var ah=hola.slice(0,n);
	 // alert("(guardar) "+ah);
	  if (confirm("Cambiará el precio de la cuota de TODAS las temporadas, ¿Éstas seguro?")){
	  $.post( "./gestionarpagos/guardarcuotamodificada.php", { 'precionuevo':ah,'idcuota':'<?php echo $_POST['idcuota']; ?>'}, function (data) { 
		alert(data); //Se muestra el resultado de la operación en la clase 
		});
		$("#"+ <?php echo $_POST['idcuota']; ?>).html(ah+"&nbsp;€");
	  }
	  else   $("#"+ <?php echo $_POST['idcuota']; ?>).html(ah+"&nbsp;€");
	  
	  
	});
</script>
<select>
<?php
//$_POST['precio'] $_POST['idcuota'];
for($i=1;$i<=50;$i++){
if($i==$_POST['precio']) echo "<option selected>".$i."&nbsp;€</option>";
 else echo "<option>".$i."&nbsp;€</option>";

}
?>
</select>