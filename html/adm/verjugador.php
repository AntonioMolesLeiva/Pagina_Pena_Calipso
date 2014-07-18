<script>

$(document).ready(function() {
	
	$("span[id]").click(function(){
		var identi=$(this).attr("id");
  /* $.get("./modalwindowedit.php?id="+identi,function(data){
       $("#ventanamodal").html(data);
    });*/
    $.ajax({
	url:"./modalwindowedit.php",
	data: {id:identi},
	type:'get',
	success:function(result){
      $(".modal-body").html(result);
    }
	});

	
	});

});
</script>
<div>
	<ol class="breadcrumb">
	  <li><a>Inicio</a></li>
	  <li><a>Jugadores</a></li>
	  <li class="active">Ver jugadores</li>
	</ol>
	<div class="col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2" style="background-color:white;">
	<div class="table-responsive">
	<table class="table table-striped">
	<thead>
	<tr>
		<th>Modif.</th>
		<th>dni</th>
		<th>dorsal</th>
		<th>Nombre</th>
		<th>Alias</th>
		<th>Apellidos</th>
		<th>Activo</th>
		<th>Posición Hab.</th>
		<th>foto</th>
		
	</tr>
	</thead>
	<tbody>
	<?php

	include ('../../php/conexion.php');
	$instruccion = "select dni,dorsal,nombre,apellidos,activo,posicionhab,foto,alias from jugador order by activo ASC,dorsal ASC" ;
		$consulta = mysql_query ($instruccion, $conexion)
				or die ("Fallo en la consulta");
				$nfilas = mysql_num_rows ($consulta);
				
		if ($nfilas>0) {
			for ($i=0; $i<$nfilas; $i++){
				$resultado = mysql_fetch_array ($consulta);
				echo "<tr>";
				if ($resultado['foto']!="")  $foto="Si";
				else $foto="No";
				if ($resultado['activo']=="s")  $activo="<span class=\"glyphicon glyphicon-ok\" style=\"color:green;\"></span>";
				else  $activo="<span class=\"glyphicon glyphicon-remove\" style=\"color:red;\"></span>";
				if ($resultado['dorsal']=="")$resultado['dorsal']="No";
				echo "
				<td><span id=\"".$resultado['dni']."\" class=\"glyphicon glyphicon-cog\" style=\"color:#009;cursor:pointer;\" data-toggle=\"modal\" data-target=\"#myModal\"></span></td>
				<td>".$resultado['dni']."</td>
				<td>".$resultado['dorsal']."</td>
				<td>".$resultado['nombre']."</td>
				<td>".$resultado['alias']."</td>
				<td>".$resultado['apellidos']."</td>
				<td>".$activo."</td>
				<td>".$resultado['posicionhab']."</td>
				<td>".$foto."</td>
				";
				echo "</tr>";
			}
		}		
		
	mysql_close ($conexion); 
	?>
	</tbody>
	</table>
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title" id="myModalLabel">Editar jugador</h4>
		  </div>
		  <div class="modal-body">
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
		  </div>
		</div>
	  </div>
	</div>
	</div>
	</div>
<div>