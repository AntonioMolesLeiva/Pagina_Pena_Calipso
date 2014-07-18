  <script>            
(function(b){b.support.touch="ontouchend" in document;if(!b.support.touch){return;}var c=b.ui.mouse.prototype,e=c._mouseInit,a;function d(g,h){if(g.originalEvent.touches.length>1){return;}g.preventDefault();var i=g.originalEvent.changedTouches[0],f=document.createEvent("MouseEvents");f.initMouseEvent(h,true,true,window,1,i.screenX,i.screenY,i.clientX,i.clientY,false,false,false,false,0,null);g.target.dispatchEvent(f);}c._touchStart=function(g){var f=this;if(a||!f._mouseCapture(g.originalEvent.changedTouches[0])){return;}a=true;f._touchMoved=false;d(g,"mouseover");d(g,"mousemove");d(g,"mousedown");};c._touchMove=function(f){if(!a){return;}this._touchMoved=true;d(f,"mousemove");};c._touchEnd=function(f){if(!a){return;}d(f,"mouseup");d(f,"mouseout");if(!this._touchMoved){d(f,"click");}a=false;};c._mouseInit=function(){var f=this;f.element.bind("touchstart",b.proxy(f,"_touchStart")).bind("touchmove",b.proxy(f,"_touchMove")).bind("touchend",b.proxy(f,"_touchEnd"));e.call(f);};})(jQuery);            
        </script>
<?php 
include ('../../../php/conexion.php');
mysql_set_charset("utf8");
//echo "<p style=\"color:white;\">".$_POST['fecha']." local=".$_POST['local']." idestrategia=".$_POST['idestr']."</p>";

if ($_POST['idestr']!="") {
 
	$instruccion="SELECT * FROM estrategia WHERE idestrategia=".$_POST['idestr'];
	$consulta = mysql_query ($instruccion, $conexion)
	or die ("FALLO EN LA CONSULTA $instruccion");
	$estrategia=mysql_fetch_array ($consulta);
	
	$instruccion="SELECT j.alias, j.dni, i.posicion, j.dorsal, j.foto, i.gol
					FROM incidencia i
					LEFT JOIN jugador j ON i.jugador = j.dni
					WHERE
					fecha='".$_POST['fecha']."' AND local='".$_POST['local']."' ORDER BY  posicion ASC";				
	$consulta1 = mysql_query ($instruccion, $conexion)
	or die ("FALLO EN LA CONSULTA $instruccion");
	$nfilas = mysql_num_rows ($consulta1);
		$resultado=mysql_fetch_array ($consulta1);
	
 ?>
 <script>
 $(document).ready(function(){
	$( "#portero,#defensa,#centrocampista,#delantero" ).sortable({
      connectWith: ".divPosiciones",
	  revert:true,
	update: function() {/*alert("has actualizado "+$(this).attr("id")+" "+$(this).children().size());*/
	var idPos=$(this).attr("id");
	if($(this).children().size()==1) {
		$("#"+idPos+" >div").removeClass("margen1 margen2 margen3 margen4 margen5");
		$("#"+idPos+" >div").addClass("margen1");
		}
		else if ($(this).children().size()==2) {
		$("#"+idPos+" >div").removeClass("margen1 margen2 margen3 margen4 margen5");
		$("#"+idPos+" >div").addClass("margen2 margen5");
		}
		else if ($(this).children().size()==3) {
		$("#"+idPos+" >div").removeClass("margen1 margen2 margen3 margen4 margen5");
		$("#"+idPos+" >div").addClass("margen3 margen5");
		}
		else if ($(this).children().size()==4) {
		$("#"+idPos+" >div").removeClass("margen1 margen2 margen3 margen4 margen5");
		$("#"+idPos+" >div").addClass("margen4 margen5");
		}
		else if ($(this).children().size()==5) {
		$("#"+idPos+" >div").removeClass("margen1 margen2 margen3 margen4 margen5");
		$("#"+idPos+" >div").addClass("margen5");
		}
	},
	over: function() {
		var idPos=$(this).attr("id");
		//alert("Estás encima de "+idPos+" y hay "+$(this).children().size()+" elementos. margen"+($(this).children().size()-1));
		if($(this).children().size()==1) {
		$("#"+idPos+" >div").removeClass("margen1 margen2 margen3 margen4 margen5");
		$("#"+idPos+" >div").addClass("margen1");
		}
		else if ($(this).children().size()==2) {
		$("#"+idPos+" >div").removeClass("margen1 margen2 margen3 margen4 margen5");
		$("#"+idPos+" >div").addClass("margen2 margen5");
		}
		else if ($(this).children().size()==3) {
		$("#"+idPos+" >div").removeClass("margen1 margen2 margen3 margen4 margen5");
		$("#"+idPos+" >div").addClass("margen3 margen5");
		}
		else if ($(this).children().size()==4) {
		$("#"+idPos+" >div").removeClass("margen1 margen2 margen3 margen4 margen5");
		$("#"+idPos+" >div").addClass("margen4 margen5");
		}
		else if ($(this).children().size()==5) {
		$("#"+idPos+" >div").removeClass("margen1 margen2 margen3 margen4 margen5");
		$("#"+idPos+" >div").addClass("margen5");
		}

		}		
    }).disableSelection();
	$("#guardarEstrategia").click(function() {
	var def=$("#ESTRATEG").val().substr(0,1),
	cen=$("#ESTRATEG").val().substr(2,1),
	del=$("#ESTRATEG").val().substr(4,1);
	if ($("#portero").children().size()==1&&$("#defensa").children().size()==def&&$("#centrocampista").children().size()==cen&&$("#delantero").children().size()==del) {
		$('#GuardarEstrategia').modal('show');
		var portero =$("#portero").find("div").map(function(){
			return $(this).attr("id");}).get().join(","),
			defensa =$("#defensa").find("div").map(function(){
			return $(this).attr("id");}).get().join(","),
			centrocampista =$("#centrocampista").find("div").map(function(){
			return $(this).attr("id");}).get().join(","),
			delantero =$("#delantero").find("div").map(function(){
			return $(this).attr("id");}).get().join(",");
		$.post( "./modificarpartido/guardarestrategia.php", {'fecha':$("h4[id]").attr("id"),'local':$("#local").val(),'localstr':$("#selectLocal option:selected").attr("id"),'visitantestr':$("#selectVisitante option:selected").attr("id"),'portero':[portero],'defensa':[defensa],'centrocampista':[centrocampista],'delantero':[delantero]}, function (data) { 
			$("#CuerpoGuardarEstrategia").html(data);
		});
	$('#GuardarEstrategia').on('hide.bs.modal', function () {
      //alert("./infopartido.php?fecha="+$("h4[id]").attr("id"));
	  $.post( "./modificarpartido/infopartido.php", { 'fecha':$("h4[id]").attr("id")}, function (data) { 
		$("#infopartido").html(data); //Se muestra el resultado de la operación en la clase 
		});
		$(".modal-backdrop").remove();
		$("body").removeClass("modal-open");
	});
	
	}
	
	else {
	alert("no se puede guardar porque no sigue la estrategia elegida "+def+"-"+cen+"-"+del);
	}
	});
 });

 </script>
 <input id="local" type="hidden" value="<?php echo $_POST['local']; ?>"/>
 <div class="col-md-12 col-sm-12 col-md-offset-2">
 <button id="guardarEstrategia" class="btn btn-lg btn-success">Guardar estrategia</button>
 <input id="ESTRATEG" type="hidden" value="<?php echo $estrategia['def']."-".$estrategia['cen']."-".$estrategia['del']; ?>"/>
 </div>
 <div class="col-md-12 col-sm-12" style="height:520px;margin:0px;padding:0px;overflow-x:auto;overflow-y:hidden;">
<div style="width:320px;height:500px;margin: 0 auto;background-size:100% 100%;background-image:url('../../img/adm/campoEstrategiaPlano.jpg');">
<div id="portero" class="divPosiciones">
	<div id="<?php echo $resultado['dni']; ?>" class="dimCajaJugMod margen1">
		<img src="<?php
		if ($resultado['foto']=='') {
					$foto="../../img/jug/sinfoto.png";
					}
					else {
					$foto="../../img/jug/fotosjug/".$resultado['foto'];
					}
		echo $foto;?>" style="width:100%;height:61px;"/>
		<div><?php echo $resultado['alias']; ?></div><div><?php echo $resultado['dorsal']; ?></div>
	</div>
</div>
<div id="defensa" class="divPosiciones">
<?php
if ($estrategia['def']==5) {
					for($i=0;$i<5;$i++){
					$resultado=mysql_fetch_array ($consulta1);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" id="<?php echo $resultado['dni']; ?>" class="dimCajaJugMod margen5">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?></div><div><?php echo $resultado['dorsal']; ?></div>
				</div>
					
					<?php
					
					}
}
else if ($estrategia['def']==4) {
					for($i=0;$i<4;$i++){
					$resultado=mysql_fetch_array ($consulta1);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" id="<?php echo $resultado['dni']; ?>" class="dimCajaJugMod margen4 margen5">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?></div><div><?php echo $resultado['dorsal']; ?></div>
				</div>
					
					<?php
					
					}
}
else if ($estrategia['def']==3) {
					for($i=0;$i<3;$i++){
					$resultado=mysql_fetch_array ($consulta1);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" id="<?php echo $resultado['dni']; ?>" class="dimCajaJugMod margen3 margen5">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?></div><div><?php echo $resultado['dorsal']; ?></div>
				</div>
					
					<?php
					
					}
}
else if ($estrategia['def']==2) {
					for($i=0;$i<2;$i++){
					$resultado=mysql_fetch_array ($consulta1);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" id="<?php echo $resultado['dni']; ?>" class="dimCajaJugMod margen2 margen5">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?></div><div><?php echo $resultado['dorsal']; ?></div>
				</div>
					
					<?php
					
					}
}
else if ($estrategia['def']==1) {
					$resultado=mysql_fetch_array ($consulta1);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" id="<?php echo $resultado['dni']; ?>" class="dimCajaJugMod margen1">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?></div><div><?php echo $resultado['dorsal']; ?></div>
				</div>
					
					<?php
}
 ?>
</div>
<div id="centrocampista" class="divPosiciones">
<?php
if ($estrategia['cen']==5) {
					for($i=0;$i<5;$i++){
					$resultado=mysql_fetch_array ($consulta1);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" id="<?php echo $resultado['dni']; ?>" class="dimCajaJugMod margen5">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?></div><div><?php echo $resultado['dorsal']; ?></div>
				</div>
					
					<?php
					
					}
}
else if ($estrategia['cen']==4) {
					for($i=0;$i<4;$i++){
					$resultado=mysql_fetch_array ($consulta1);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" id="<?php echo $resultado['dni']; ?>" class="dimCajaJugMod margen4 margen5">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?></div><div><?php echo $resultado['dorsal']; ?></div>
				</div>
					
					<?php
					
					}
}
else if ($estrategia['cen']==3) {
					for($i=0;$i<3;$i++){
					$resultado=mysql_fetch_array ($consulta1);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" id="<?php echo $resultado['dni']; ?>" class="dimCajaJugMod margen3 margen5">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?></div><div><?php echo $resultado['dorsal']; ?></div>
				</div>
					
					<?php
					
					}
}
else if ($estrategia['cen']==2) {
					for($i=0;$i<2;$i++){
					$resultado=mysql_fetch_array ($consulta1);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" id="<?php echo $resultado['dni']; ?>" class="dimCajaJugMod margen2 margen5">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?></div><div><?php echo $resultado['dorsal']; ?></div>
				</div>
					
					<?php
					
					}
}
else if ($estrategia['cen']==1) {
					$resultado=mysql_fetch_array ($consulta1);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" id="<?php echo $resultado['dni']; ?>" class="dimCajaJugMod margen1">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?></div><div><?php echo $resultado['dorsal']; ?></div>
				</div>
					
					<?php
}
 ?>
</div>
<div id="delantero" class="divPosiciones">
<?php
if ($estrategia['del']==5) {
					for($i=0;$i<5;$i++){
					$resultado=mysql_fetch_array ($consulta1);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" id="<?php echo $resultado['dni']; ?>" class="dimCajaJugMod margen5">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?></div><div><?php echo $resultado['dorsal']; ?></div>
				</div>
					
					<?php
					
					}
}
else if ($estrategia['del']==4) {
					for($i=0;$i<4;$i++){
					$resultado=mysql_fetch_array ($consulta1);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" id="<?php echo $resultado['dni']; ?>" class="dimCajaJugMod margen4 margen5">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?></div><div><?php echo $resultado['dorsal']; ?></div>
				</div>
					
					<?php
					
					}
}
else if ($estrategia['del']==3) {
					for($i=0;$i<3;$i++){
					$resultado=mysql_fetch_array ($consulta1);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" id="<?php echo $resultado['dni']; ?>" class="dimCajaJugMod margen3 margen5">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?></div><div><?php echo $resultado['dorsal']; ?></div>
				</div>
					
					<?php
					
					}
}
else if ($estrategia['del']==2) {
					for($i=0;$i<2;$i++){
					$resultado=mysql_fetch_array ($consulta1);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" id="<?php echo $resultado['dni']; ?>" class="dimCajaJugMod margen2 margen5">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?></div><div><?php echo $resultado['dorsal']; ?></div>
				</div>
					
					<?php
					
					}
}
else if ($estrategia['del']==1) {
					$resultado=mysql_fetch_array ($consulta1);					
					if ($resultado['foto']=='') {
				$foto="../../img/jug/sinfoto.png";
				}
				else {
				$foto="../../img/jug/fotosjug/".$resultado['foto'];
				}

				?>
				<div id="<?php echo $resultado['dni']; ?>" id="<?php echo $resultado['dni']; ?>" class="dimCajaJugMod margen1">
				<img src="<?php echo $foto;?>" style="width:100%;height:61px;"/>
				<div><?php echo $resultado['alias']; ?></div><div><?php echo $resultado['dorsal']; ?></div>
				</div>
					
					<?php
}
 ?>
</div>
</div>
</div>
 
<?php }
mysql_close ($conexion);
?>
<!-- Modal Guardar estrategia -->
<div class="modal fade" id="GuardarEstrategia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Guardar estrategia</h4>
      </div>
      <div id="CuerpoGuardarEstrategia" class="modal-body">
	  ...
      </div>
    </div>
  </div>
</div>