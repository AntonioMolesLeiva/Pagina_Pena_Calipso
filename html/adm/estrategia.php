<script>

	$("#loocal li").draggable({revert:true,helper: 'clone'});
	$("#viisitante li").draggable({revert:true,helper: 'clone'});
	
	if($("#color option:selected").attr("value")=="naranja") {
	
	$(".local").parent().removeClass("colorNegro").addClass("colorNaranja");
	$(".visitante").parent().removeClass("colorNaranja").addClass("colorNegro");
	
	}

</script>
<?php
include ('../../php/conexion.php');
$local=$_POST['local'];
$visitante=$_POST['visitante'];

//Para sacar los números almacenados en un array en otro array (no sé por qué)
$elocal=explode(',', $local[0]);
$evisitante=explode(',', $visitante[0]);
?>
<div class="panel panel-default colorNegro">
<div class="panel-heading local">Local &nbsp;
<!-- SELECT LOCAL -->
	<?php $instruccion="SELECT idestrategia,def,cen,del FROM estrategia WHERE njugadores=".$_POST['njugadoreslocal']." ORDER BY def DESC,cen DESC,del DESC";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");
	$nfilas = mysql_num_rows ($consulta);
	if ($nfilas>0) {
	echo "<select id=\"selectLocal\" ><option value=\"\">Ninguna</option>";
		for ($i=1; $i<=$nfilas; $i++){
		$resultado = mysql_fetch_array ($consulta);
		echo "<option id=".$resultado['idestrategia'].">".$resultado['def']."-".$resultado['cen']."-".$resultado['del']."</option>";
		}
	}
	echo "</select>";?>

<!-- /SELECT LOCAL -->
</div>
<div class="panel-body">
<?php
// <!-- UL LOCAL -->
echo "<ul id=\"loocal\" class=\"lista droptrue\" style=\"opacity:1 !important;\">";
for($i=0;$i<sizeof($elocal);$i++) {
	mysql_set_charset("utf8");
		$instruccion="SELECT dni,alias,dorsal,foto FROM jugador WHERE dni='".$elocal[$i]."'";
		$consulta = mysql_query ($instruccion, $conexion)
					or die ("FALLO EN LA CONSULTA $instruccion");
		$resultado = mysql_fetch_array ($consulta);
		if($resultado['foto']=='') $foto="../../img/jug/sinfoto.png";
		else $foto="../../img/jug/fotosjug/".$resultado['foto'];
		echo "<li id=\"".$resultado['dni']."\" class=\"ui-state-default cajajugador\"><img src=\"".$foto."\" alt=\"foto del jugador ".$resultado['alias']." \" title=\" ".$resultado['alias']."\"> <span class=\"nombreAliasCajaJugador\">".$resultado['alias']."</span>&nbsp;&nbsp;<span class=\"DorsalCajaJugador\">".$resultado['dorsal']."</span></li>";
}
echo "</ul>";
// <!-- UL /LOCAL -->

?>
<script>


$("#selectLocal").change(function() {

var def=$("#selectLocal").val().substr(0,1),
	cen=$("#selectLocal").val().substr(2,1),
	del=$("#selectLocal").val().substr(4,1);
	$("#esDefensaLContent,#esCentrocampistaLContent,#esDelanteroLContent").empty();
	if ($("#selectLocal").val()=="") {$("#estrategialocal").slideUp(200);}
	else {
	$("#estrategialocal").slideDown(200);
	}
	
	var i;
	
	if (def==4) {
		for(i=0;i<def;i++) {
			$("#esDefensaLContent").append("<ul class=\"lista droptrue estrategiaCajaJug\" style=\"margin:0px 20px;\"></ul>");
		}
	}
	 else if(def==3){
		for(i=0;i<def;i++) {
			$("#esDefensaLContent").append("<ul class=\"lista droptrue estrategiaCajaJug\" style=\"margin:0px 35px;\"></ul>");
		}
	 }
	else if(def==2){
		for(i=0;i<def;i++) {
			$("#esDefensaLContent").append("<ul class=\"lista droptrue estrategiaCajaJug\" style=\"margin:0px 70px;\"></ul>");
		}
	 }
	else if (def==1){
		for(i=0;i<def;i++) {
			$("#esDefensaLContent").append("<ul class=\"lista droptrue estrategiaCajaJug\" style=\"margin:0px 170px;\"></ul>");
		}
	 }
	if (cen==5) {
		for(i=0;i<cen;i++) {
			$("#esCentrocampistaLContent").append("<ul class=\"lista droptrue estrategiaCajaJug\" style=\"margin:0px 7px;\"></ul>");
		}
	}
	
	 else if (cen==4) {
		for(i=0;i<cen;i++) {
			$("#esCentrocampistaLContent").append("<ul class=\"lista droptrue estrategiaCajaJug\" style=\"margin:0px 20px;\"></ul>");
		}
	}
	 else if (cen==3){
		for(i=0;i<cen;i++) {
			$("#esCentrocampistaLContent").append("<ul class=\"lista droptrue estrategiaCajaJug\" style=\"margin:0px 35px;\"></ul>");
		}
	 }
	 else if (cen==2){
		for(i=0;i<cen;i++) {
			$("#esCentrocampistaLContent").append("<ul class=\"lista droptrue estrategiaCajaJug\" style=\"margin:0px 70px;\"></ul>");
		}
	 }
	 else if (cen==1){
		for(i=0;i<cen;i++) {
			$("#esCentrocampistaLContent").append("<ul class=\"lista droptrue estrategiaCajaJug\" style=\"margin:0px 170px;\"></ul>");
		}
	 }
	 
	 if (del==5) {
		for(i=0;i<del;i++) {
			$("#esDelanteroLContent").append("<ul class=\"lista droptrue estrategiaCajaJug\" style=\"margin:0px 7px;\"></ul>");
		}
	}
	
	 else if (del==4) {
		for(i=0;i<del;i++) {
			$("#esDelanteroLContent").append("<ul class=\"lista droptrue estrategiaCajaJug\" style=\"margin:0px 20px;\"></ul>");
		}
	}
	 else if (del==3){
		for(i=0;i<del;i++) {
			$("#esDelanteroLContent").append("<ul class=\"lista droptrue estrategiaCajaJug\" style=\"margin:0px 35px\"></ul>");
		}
	 }
	 else if (del==2){
		for(i=0;i<del;i++) {
			$("#esDelanteroLContent").append("<ul class=\"lista droptrue estrategiaCajaJug\" style=\"margin:0px 70px;\"></ul>");
		}
	 }
	 else if (del==1){
		for(i=0;i<del;i++) {
			$("#esDelanteroLContent").append("<ul class=\"lista droptrue estrategiaCajaJug\" style=\"margin:0px 170px;\"></ul>");
		}
	 }
	 
	 $(".lista").droppable({             
                accept: "#loocal li",                
                drop: function(ev, ui) {                                    
                    // Añado el objeto origen a la lista destino                                    
                    
					if($(this).find("li").size()>=1) {
					//alert($(this).find("li").size());
					$(this).droppable("disable");
					}
					else{
					$(this).append($(ui.draggable));
					}
                }
            });
			
});
</script>
<div class="col-md-12 col-sm-12" style="overflow-y:hidden;"> <!-- prueba-->
<div id="estrategialocal" style="display:none;width:405px;margin:10px auto;height:383px;background-image:url('../../img/adm/estrategia.png');background-position:center;border:1px solid black;background-repeat:no-repeat;">
<div id="esDelantero" style="height:80px;">
<div id="esDelanteroLContent" style="width:405px;">
	</div>
</div>

<div id="esCentrocampista"style="height:80px;margin-top:15px;">
<div id="esCentrocampistaLContent" >
	</div>
</div>
<div id="esDefensaL"style="height:80px;margin-top:15px;">
	<div id="esDefensaLContent" >
	</div>
</div>
<div id="esPorteroL"style="height:80px;margin-top:15px;">
<div id="esPorteroLContent">
	<ul class="lista droptrue estrategiaCajaJug" style="margin-left:175px;">
	</ul>
</div>

</div>
</div >
</div> <!-- /prueba -->
</div><!-- /panel body -->
</div><!-- /panel -->
                                   <!-- VISITANTE-->
<div class="panel panel-default colorNaranja">
<div class="panel-heading visitante">Visitante&nbsp;
 <!-- SELECT visitante -->
	<?php $instruccion="SELECT idestrategia,def,cen,del FROM estrategia WHERE njugadores=".$_POST['njugadoresvisitante']." ORDER BY def DESC,cen DESC,del DESC";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");
	$nfilas = mysql_num_rows ($consulta);
	if ($nfilas>0) {
	echo "<select id=\"selectVisitante\" ><option value=\"\">Ninguna</option>";
		for ($i=1; $i<=$nfilas; $i++){
		$resultado = mysql_fetch_array ($consulta);
		echo "<option id=".$resultado['idestrategia'].">".$resultado['def']."-".$resultado['cen']."-".$resultado['del']."</option>";
		}
	}
	echo "</select>"; ?>
<!-- /SELECT visitante -->
</div>
<div class="panel-body">
<?php
// <!-- UL visitante -->
echo "<ul id=\"viisitante\" class=\"lista droptrue \" style=\"opacity:1 !important;\">";
for($i=0;$i<sizeof($evisitante);$i++) {
	mysql_set_charset("utf8");
		$instruccion="SELECT dni,alias,dorsal,foto FROM jugador WHERE dni='".$evisitante[$i]."'";
		$consulta = mysql_query ($instruccion, $conexion)
					or die ("FALLO EN LA CONSULTA $instruccion");
		$resultado = mysql_fetch_array ($consulta);
		if($resultado['foto']=='') $foto="../../img/jug/sinfoto.png";
		else $foto="../../img/jug/fotosjug/".$resultado['foto'];
		echo "<li id=\"".$resultado['dni']."\" class=\"ui-state-default cajajugador\"><img src=\"".$foto."\" alt=\"foto del jugador ".$resultado['alias']." \" title=\" ".$resultado['alias']."\"> <span class=\"nombreAliasCajaJugador\">".$resultado['alias']."</span>&nbsp;&nbsp;<span class=\"DorsalCajaJugador\">".$resultado['dorsal']."</span></li>";
}
echo "</ul>";
// <!-- UL /visitante -->

?>
<script>


$("#selectVisitante").change(function() {

var def=$("#selectVisitante").val().substr(0,1),
	cen=$("#selectVisitante").val().substr(2,1),
	del=$("#selectVisitante").val().substr(4,1);
	$("#esDefensaVContent,#esCentrocampistaVContent,#esDelanteroVContent").empty();
	if ($("#selectVisitante").val()=="") {$("#estrategiavisitante").slideUp(200);}
	else {
	$("#estrategiavisitante").slideDown(200);
	}
	
	var i;
	
	if (def==4) {
		for(i=0;i<def;i++) {
			$("#esDefensaVContent").append("<ul class=\"lista droptrue estrategiaCajaJug\" style=\"margin:0px 20px;\"></ul>");
		}
	}
	 else if(def==3){
		for(i=0;i<def;i++) {
			$("#esDefensaVContent").append("<ul class=\"lista droptrue estrategiaCajaJug\" style=\"margin:0px 35px;\"></ul>");
		}
	 }
	else if(def==2){
		for(i=0;i<def;i++) {
			$("#esDefensaVContent").append("<ul class=\"lista droptrue estrategiaCajaJug\" style=\"margin:0px 70px;\"></ul>");
		}
	 }
	else if (def==1){
		for(i=0;i<def;i++) {
			$("#esDefensaVContent").append("<ul class=\"lista droptrue estrategiaCajaJug\" style=\"margin:0px 170px;\"></ul>");
		}
	 }
	if (cen==5) {
		for(i=0;i<cen;i++) {
			$("#esCentrocampistaVContent").append("<ul class=\"lista droptrue estrategiaCajaJug\" style=\"margin:0px 7px;\"></ul>");
		}
	}
	
	 else if (cen==4) {
		for(i=0;i<cen;i++) {
			$("#esCentrocampistaVContent").append("<ul class=\"lista droptrue estrategiaCajaJug\" style=\"margin:0px 20px;\"></ul>");
		}
	}
	 else if (cen==3){
		for(i=0;i<cen;i++) {
			$("#esCentrocampistaVContent").append("<ul class=\"lista droptrue estrategiaCajaJug\" style=\"margin:0px 35px;\"></ul>");
		}
	 }
	 else if (cen==2){
		for(i=0;i<cen;i++) {
			$("#esCentrocampistaVContent").append("<ul class=\"lista droptrue estrategiaCajaJug\" style=\"margin:0px 70px;\"></ul>");
		}
	 }
	 else if (cen==1){
		for(i=0;i<cen;i++) {
			$("#esCentrocampistaVContent").append("<ul class=\"lista droptrue estrategiaCajaJug\" style=\"margin:0px 170px;\"></ul>");
		}
	 }
	 
	 if (del==5) {
		for(i=0;i<del;i++) {
			$("#esDelanteroVContent").append("<ul class=\"lista droptrue estrategiaCajaJug\" style=\"margin:0px 7px;\"></ul>");
		}
	}
	
	 else if (del==4) {
		for(i=0;i<del;i++) {
			$("#esDelanteroVContent").append("<ul class=\"lista droptrue estrategiaCajaJug\" style=\"margin:0px 20px;\"></ul>");
		}
	}
	 else if (del==3){
		for(i=0;i<del;i++) {
			$("#esDelanteroVContent").append("<ul class=\"lista droptrue estrategiaCajaJug\" style=\"margin:0px 35px\"></ul>");
		}
	 }
	 else if (del==2){
		for(i=0;i<del;i++) {
			$("#esDelanteroVContent").append("<ul class=\"lista droptrue estrategiaCajaJug\" style=\"margin:0px 70px;\"></ul>");
		}
	 }
	 else if (del==1){
		for(i=0;i<del;i++) {
			$("#esDelanteroVContent").append("<ul class=\"lista droptrue estrategiaCajaJug\" style=\"margin:0px 170px;\"></ul>");
		}
	 }
	 
	 $(".lista").droppable({             
                accept: "#viisitante li",                
                drop: function(ev, ui) {                                    
                    // Añado el objeto origen a la lista destino                                    
                    
					if($(this).find("li").size()>=1) {
					//alert($(this).find("li").size());
					$(this).droppable("disable");
					}
					else{
					$(this).append($(ui.draggable));
					}
                }
            });
			
});
</script>
<div class="col-md-12 col-sm-12" style="overflow-y:hidden;"> <!-- prueba-->
<div id="estrategiavisitante" style="display:none;width:405px;margin:10px auto;height:383px;background-image:url('../../img/adm/estrategia.png');background-position:center;border:1px solid black;background-repeat:no-repeat;">
<div id="esDelanteroV" style="height:80px;">
<div id="esDelanteroVContent" style="width:405px;">
	</div>
</div>

<div id="esCentrocampistaV"style="height:80px;margin-top:15px;">
<div id="esCentrocampistaVContent" >
	</div>
</div>
<div id="esDefensaV"style="height:80px;margin-top:15px;">
	<div id="esDefensaVContent" >
	</div>
</div>
<div id="esPorteroV"style="height:80px;margin-top:15px;">
<div id="esPorteroVContent">
	<ul class="lista droptrue estrategiaCajaJug" style="margin-left:175px;">
	</ul>
</div>

</div>
</div >
</div> <!-- /prueba -->
</div><!-- /panel body -->
</div><!-- /panel -->

<?php

 
 mysql_close ($conexion);
 ?>
 