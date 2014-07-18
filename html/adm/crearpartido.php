<div>
	<ol class="breadcrumb">
	  <li><a>Inicio</a></li>
	  <li><a>Partidos</a></li>
	  <li class="active">Crear partido</li>
	</ol>
</div>
  <script>            
(function(b){b.support.touch="ontouchend" in document;if(!b.support.touch){return;}var c=b.ui.mouse.prototype,e=c._mouseInit,a;function d(g,h){if(g.originalEvent.touches.length>1){return;}g.preventDefault();var i=g.originalEvent.changedTouches[0],f=document.createEvent("MouseEvents");f.initMouseEvent(h,true,true,window,1,i.screenX,i.screenY,i.clientX,i.clientY,false,false,false,false,0,null);g.target.dispatchEvent(f);}c._touchStart=function(g){var f=this;if(a||!f._mouseCapture(g.originalEvent.changedTouches[0])){return;}a=true;f._touchMoved=false;d(g,"mouseover");d(g,"mousemove");d(g,"mousedown");};c._touchMove=function(f){if(!a){return;}this._touchMoved=true;d(f,"mousemove");};c._touchEnd=function(f){if(!a){return;}d(f,"mouseup");d(f,"mouseout");if(!this._touchMoved){d(f,"click");}a=false;};c._mouseInit=function(){var f=this;f.element.bind("touchstart",b.proxy(f,"_touchStart")).bind("touchmove",b.proxy(f,"_touchMove")).bind("touchend",b.proxy(f,"_touchEnd"));e.call(f);};})(jQuery);            
        </script>
<script>

$(function() {
	$("ul.droptrue" ).sortable({
	  connectWith: "ul",
	});
	$( "#por,#def,#cen,#del,#local,#visitante,#arbitro" ).disableSelection();
  
	/*Para cuando haces click en un jugador*/
	var identi=0;
	$(".cajajugador[id]").mousedown(function() {
		identi=$(this).attr("id");
		$("#"+identi+" div").toggleClass("jugadorSelected");
		});
		
	/*para cuando cambias el valor del equipo local*/	
	 $("#color").change(function() {
	  $("#divlocal").toggleClass("colorNaranja");
	  $("#divisitante").toggleClass("colorNaranja");
	  $("#divisitante").toggleClass("colorNegro");	   
	 });
	 
	 $("#anadirlocal").click(function(){
		//para cada li que esté seleccionada con la clase jugadorSelected
	 $("li div[class='jugadorSelected']").each(function(){
	   //lo muevo a la lista con id=local
		$(this).parent().appendTo("#local");
		//Le quito el "seleccionado" al li
		$("#local li div").removeClass("jugadorSelected");
		
	 });
	 //Hago recuento del número de jugadores que hay en la lista
	 $("#njugadoreslocal").html($("#local li").size());
	 
	 $("#njugadoresvisitante").html($("#visitante li").size());
	});
	 
	 $("#anadirvisitante").click(function(){
	 $("li div[class='jugadorSelected']").each(function(){
		$(this).parent().appendTo("#visitante");
		$("#visitante li div").removeClass("jugadorSelected");
		});
	$("#njugadoresvisitante").html($("#visitante li").size());
	
	$("#njugadoreslocal").html($("#local li").size());
	 });
	 
	 $("#dsplarb").click(function(){
		$(".panelelearb").toggle(300);
	 });
	$("#dsplespec").click(function(){
		$(".panelespec").toggle(300);
	 });
	
	$.fn.panelpor=function(){
	//si no está visible
		if($(".panelpor").css("display")=="none") {
		
		//éste icono pasarlo a out
		$("#btnpor span").removeClass("glyphicon-zoom-in").addClass("glyphicon-zoom-out");
		
		//si hubiera paneles abiertos de los otras categorías, las cierra
		$(".paneldef,.panelcen,.paneldel,.panelarb").slideUp(200);
		
		//desde la ubicación del botón busco el cuerpo del panel y lo subo/bajo
		$("#btnpor").parent().siblings("div .panel-body").toggle(300);
		
		//los demás iconos lupa los restablezco a in (menos en el que me encuentro ahora)
		$(".panelhedef #btndef span,.panelhecen #btncen span,.panelhedel #btndel span,.panelhearb #btnarb span").removeClass("glyphicon-zoom-out").addClass("glyphicon-zoom-in");
		}
		
		//si estaba visible
		else{
		
		//pasar el icono a in
		$("#btnpor span").removeClass("glyphicon-zoom-out").addClass("glyphicon-zoom-in");
		
		//si hubiera paneles abiertos de los otras categorías, las cierra
		$(".paneldef,.panelcen,.paneldel,.panelarb").slideUp(200);
		
		//desde la ubicación del botón busco el cuerpo del panel y lo subo/bajo
		$("#btnpor").parent().siblings("div .panel-body").toggle(300);
		
		//los demás iconos lupa los restablezco a in (menos en el que me encuentro ahora)
		$(".panelhedef #btndef span,.panelhecen #btncen span,.panelhedel #btndel span,.panelhearb #btnarb span").removeClass("glyphicon-zoom-out").addClass("glyphicon-zoom-in");
		}
	}
	$.fn.paneldef=function(){
		if($(".paneldef").css("display")=="none") {
		$("#btndef span").removeClass("glyphicon-zoom-in").addClass("glyphicon-zoom-out");
		$(".panelpor,.panelcen,.paneldel,.panelarb").slideUp(200);
		$("#btndef").parent().siblings("div .panel-body").toggle(300);
		$(".panelhepor #btnpor span,.panelhecen #btncen span,.panelhedel #btndel span,.panelhearb #btnarb span").removeClass("glyphicon-zoom-out").addClass("glyphicon-zoom-in");
		}
		else{
		$("#btndef span").removeClass("glyphicon-zoom-out").addClass("glyphicon-zoom-in");
		$(".panelpor,.panelcen,.paneldel,.panelarb").slideUp(200);
		$("#btndef").parent().siblings("div .panel-body").toggle(300);
		$(".panelhepor #btnpor span,.panelhecen #btncen span,.panelhedel #btndel span,.panelhearb #btnarb span").removeClass("glyphicon-zoom-out").addClass("glyphicon-zoom-in");
		}
	}
	$.fn.panelcen=function(){
		if($(".panelcen").css("display")=="none") {
		$("#btncen span").removeClass("glyphicon-zoom-in").addClass("glyphicon-zoom-out");
		$(".panelpor,.paneldef,.paneldel,.panelarb").slideUp(200);
		$("#btncen").parent().siblings("div .panel-body").toggle(300);
		$(".panelhepor #btnpor span,.panelhedef #btndef span,.panelhedel #btndel span,.panelhearb #btnarb span").removeClass("glyphicon-zoom-out").addClass("glyphicon-zoom-in");
		}
		else{
		$("#btncen span").removeClass("glyphicon-zoom-out").addClass("glyphicon-zoom-in");
		$(".panelpor,.paneldef,.paneldel,.panelarb").slideUp(200);
		$("#btncen").parent().siblings("div .panel-body").toggle(300);
		$(".panelhepor #btnpor span,.panelhedef #btndef span,.panelhedel #btndel span,.panelhearb #btnarb span").removeClass("glyphicon-zoom-out").addClass("glyphicon-zoom-in");
		}
	}
	$.fn.paneldel=function(){
		if($(".paneldel").css("display")=="none") {
		$("#btndel span").removeClass("glyphicon-zoom-in").addClass("glyphicon-zoom-out");
		$(".panelpor,.paneldef,.panelcen,.panelarb").slideUp(200);
		$("#btndel").parent().siblings("div .panel-body").toggle(300);
		$(".panelhepor #btnpor span,.panelhedef #btndef span,.panelhecen #btncen span,.panelhearb #btnarb span").removeClass("glyphicon-zoom-out").addClass("glyphicon-zoom-in");
		}
		else{
		$("#btndel span").removeClass("glyphicon-zoom-out").addClass("glyphicon-zoom-in");
		$(".panelpor,.paneldef,.panelcen,.panelarb").slideUp(200);
		$("#btndel").parent().siblings("div .panel-body").toggle(300);
		$(".panelhepor #btnpor span,.panelhedef #btndef span,.panelhecen #btncen span,.panelhearb #btnarb span").removeClass("glyphicon-zoom-out").addClass("glyphicon-zoom-in");
		}
	}
	$.fn.panelarb=function(){
		if($(".panelarb").css("display")=="none") {
		$("#btnarb span").removeClass("glyphicon-zoom-in").addClass("glyphicon-zoom-out");
		$(".panelpor,.paneldef,.panelcen,.paneldel").slideUp(200);
		$("#btnarb").parent().siblings("div .panel-body").toggle(300);
		$(".panelhepor #btnpor span,.panelhedef #btndef span,.panelhecen #btncen span,.panelhedel #btndel span").removeClass("glyphicon-zoom-out").addClass("glyphicon-zoom-in");
		}
		else{
		$("#btnarb span").removeClass("glyphicon-zoom-out").addClass("glyphicon-zoom-in");
		$(".panelpor,.paneldef,.panelcen,.paneldel").slideUp(200);
		$("#btnarb").parent().siblings("div .panel-body").toggle(300);
		$(".panelhepor #btnpor span,.panelhedef #btndef span,.panelhecen #btncen span,.panelhedel #btndel span").removeClass("glyphicon-zoom-out").addClass("glyphicon-zoom-in");
		}
	}
	$(".panelhepor").click(function(){$(this).panelpor();});
	$(".panelhedef").click(function(){$(this).paneldef();});
	$(".panelhecen").click(function(){$(this).panelcen();});
	$(".panelhedel").click(function(){$(this).paneldel();});
	$(".panelhearb").click(function(){$(this).panelarb();});
	
	/* para contar los elementos de la lista de local y visitante (num de jugadores) */
	 $( "#local" ).sortable({
		update: function() {
			$("#njugadoreslocal").html($("#local li").size());
			//si tiene la unica clase posible que puede tener que se la quite
			if ($("#local li[id="+identi+"] div").attr("class")) $("#local li div").removeClass("jugadorSelected");			
			}	
	});
	$( "#visitante" ).sortable({
		update: function( event, ui ) {
		$("#njugadoresvisitante").html($("#visitante li").size());
			//si tiene la unica clase posible que puede tener que se la quite
			if ($("#visitante li[id="+identi+"] div").attr("class")) $("#visitante li div").removeClass("jugadorSelected");		
		}
	});
	$( "#arbitro" ).sortable({
		update: function( event, ui ) {
			//si tiene la unica clase posible que puede tener que se la quite
			if ($("#arbitro li[id="+identi+"] div").attr("class")) $("#arbitro li div").removeClass("jugadorSelected");		
		}
	});
	
	$( "#espectadores" ).sortable({
		update: function( event, ui ) {
			//si tiene la unica clase posible que puede tener que se la quite
			if ($("#espectadores li[id="+identi+"] div").attr("class")) $("#espectadores li div").removeClass("jugadorSelected");		
		}
	});
	
		$( "#por,#def,#cen,#del,#arb,#arbitro" ).sortable({
		update: function( event, ui ) {
			//si tiene la unica clase posible que puede tener que se la quite
			if ($("#por li[id="+identi+"] div").attr("class")) $("#por li div").removeClass("jugadorSelected");
			if ($("#def li[id="+identi+"] div").attr("class")) $("#def li div").removeClass("jugadorSelected");
			if ($("#cen li[id="+identi+"] div").attr("class")) $("#cen li div").removeClass("jugadorSelected");
			if ($("#del li[id="+identi+"] div").attr("class")) $("#del li div").removeClass("jugadorSelected");	
			if ($("#arb li[id="+identi+"] div").attr("class")) $("#arb li div").removeClass("jugadorSelected");
			if ($("#arbitro li[id="+identi+"] div").attr("class")) $("#arbitro li div").removeClass("jugadorSelected");
		}
	});
	$( "#fechaPartido" ).datepicker({
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
<div  class="col-md-5 col-sm-5">
<div class="col-md-12 col-sm-12">
	<div class="panel panel-primary negroTransparente">
	  <div class="panel-heading panelhepor"><img src="../../img/adm/portero.png" alt="icono portero" title="icono portero"  />Porteros
	  <button id="btnpor" type="button" class="btn btn-default btn-md" style="float:right;" title="Ver todos los porteros">
		<span class="glyphicon glyphicon-zoom-in"></span>
	</button>
	<button type="button" onclick="$('#posicionhabitualform').val('por');" class="btn btn-default btn-md" style="float:right;" title="añadir un portero" data-toggle="modal" data-target="#modalanadirJugador">
		<span class="glyphicon glyphicon-plus"></span>
	 </button>
	 </div>
	  <div class="panel-body panelpor" style="display:none;">
		<ul id="por" class="droptrue"><?php 
		include ('../../php/conexion.php');
		mysql_set_charset("utf8");
						$instruccion="SELECT dni,alias,dorsal,foto FROM jugador WHERE posicionhab='por' ORDER BY activo ASC,dorsal ASC";
						$consulta = mysql_query ($instruccion, $conexion)
									or die ("FALLO EN LA CONSULTA $instruccion");
						$nfilas = mysql_num_rows ($consulta);
						if ($nfilas>0) {
							for ($i=0; $i<$nfilas; $i++){
							$resultado = mysql_fetch_array ($consulta);
							if($resultado['foto']=='') $foto="../../img/jug/sinfoto.png";
							else $foto="../../img/jug/fotosjug/".$resultado['foto'];
							echo "<li id=\"".$resultado['dni']."\" class=\"ui-state-default cajajugador\"><div></div><img src=\"".$foto."\" alt=\"foto del jugador ".$resultado['alias']." \" title=\" ".$resultado['alias']."\"> <span class=\"nombreAliasCajaJugador\">".$resultado['alias']."</span>&nbsp;&nbsp;<span class=\"DorsalCajaJugador\">".$resultado['dorsal']."</span></li>";
							}
						}
				mysql_close ($conexion);
		?>
		</ul>
	  </div>
	</div>
</div>
<div class="col-md-12 col-sm-12">
	<div class="panel panel-info negroTransparente">
		  <div class="panel-heading panelhedef"><img src="../../img/adm/defensa.png"  alt="icono defensa" title="icono defensa" />Defensas<button id="btndef" type="button" class="btn btn-default btn-md" style="float:right;"  title="Ver todos los defensas">
  <span class="glyphicon glyphicon-zoom-in"></span></button>
  <button type="button"  onclick="$('#posicionhabitualform').val('def');" class="btn btn-default btn-md" style="float:right;" title="añadir un defensa"  data-toggle="modal" data-target="#modalanadirJugador">
		<span class="glyphicon glyphicon-plus"></span>
	 </button></div>
		  <div class="panel-body paneldef"   style="display:none;">
			<ul id="def" class="droptrue"><?php 
		include ('../../php/conexion.php');
		mysql_set_charset("utf8");
						$instruccion="SELECT dni,alias,dorsal,foto FROM jugador WHERE posicionhab='def' ORDER BY activo ASC,dorsal ASC";
						$consulta = mysql_query ($instruccion, $conexion)
									or die ("FALLO EN LA CONSULTA $instruccion");
						$nfilas = mysql_num_rows ($consulta);
						if ($nfilas>0) {
							for ($i=0; $i<$nfilas; $i++){
							$resultado = mysql_fetch_array ($consulta);
							if($resultado['foto']=='') $foto="../../img/jug/sinfoto.png";
							else $foto="../../img/jug/fotosjug/".$resultado['foto'];
							echo "<li id=\"".$resultado['dni']."\" class=\"ui-state-default cajajugador\"><div></div><img src=\"".$foto."\" alt=\"foto del jugador ".$resultado['alias']." \" title=\" ".$resultado['alias']."\"> <span class=\"nombreAliasCajaJugador\">".$resultado['alias']."</span>&nbsp;&nbsp;<span class=\"DorsalCajaJugador\">".$resultado['dorsal']."</span></li>";
							}
						}
				mysql_close ($conexion);
		?>
		</ul>
		  </div>
	</div>
</div>
<div class="col-md-12 col-sm-12">
	<div class="panel panel-warning negroTransparente">
		  <div class="panel-heading panelhecen" ><img src="../../img/adm/centrocampista.png"  alt="icono centrocampista" title="icono centrocampista" />Centrocampistas<button id="btncen" type="button" class="btn btn-default btn-md" style="float:right;"  title="Ver todos los centrocampistas">
  <span class="glyphicon glyphicon-zoom-in"></span></button>
  <button type="button" class="btn btn-default btn-md"  onclick="$('#posicionhabitualform').val('cen');" style="float:right;" title="añadir un centrocampista"  data-toggle="modal" data-target="#modalanadirJugador">
		<span class="glyphicon glyphicon-plus"></span>
	 </button>
  </div>
		  <div class="panel-body panelcen" style="display:none;">
			<ul id="cen" class="droptrue"><?php 
		include ('../../php/conexion.php');
		mysql_set_charset("utf8");
						$instruccion="SELECT dni,alias,dorsal,foto FROM jugador WHERE posicionhab='cen' ORDER BY activo ASC,dorsal ASC";
						$consulta = mysql_query ($instruccion, $conexion)
									or die ("FALLO EN LA CONSULTA $instruccion");
						$nfilas = mysql_num_rows ($consulta);
						if ($nfilas>0) {
							for ($i=0; $i<$nfilas; $i++){
							$resultado = mysql_fetch_array ($consulta);
							if($resultado['foto']=='') $foto="../../img/jug/sinfoto.png";
							else $foto="../../img/jug/fotosjug/".$resultado['foto'];
							echo "<li id=\"".$resultado['dni']."\" class=\"ui-state-default cajajugador\"><div></div><img src=\"".$foto."\" alt=\"foto del jugador ".$resultado['alias']." \" title=\" ".$resultado['alias']."\"> <span class=\"nombreAliasCajaJugador\">".$resultado['alias']."</span>&nbsp;&nbsp;<span class=\"DorsalCajaJugador\">".$resultado['dorsal']."</span></li>";
							}
						}
				mysql_close ($conexion);
		?>
		</ul>
		  </div>
		</div>
	</div>
<div class="col-md-12 col-sm-12">
	<div class="panel panel-danger negroTransparente">
		  <div class="panel-heading panelhedel"><img src="../../img/adm/delantero.png" alt="icono delantero" title="icono delantero" />Delanteros<button id="btndel" type="button" class="btn btn-default btn-md" style="float:right;"  title="Ver todos los delanteros">
  <span class="glyphicon glyphicon-zoom-in"></span></button>
  <button type="button" class="btn btn-default btn-md" onclick="$('#posicionhabitualform').val('del');" style="float:right;" title="añadir un delantero"  data-toggle="modal" data-target="#modalanadirJugador">
		<span class="glyphicon glyphicon-plus"></span>
	 </button>
  </div>
		  <div class="panel-body paneldel"  style="display:none;">
			<ul id="del" class="droptrue"><?php 
		include ('../../php/conexion.php');
		mysql_set_charset("utf8");
						$instruccion="SELECT dni,alias,dorsal,foto FROM jugador WHERE posicionhab='del' ORDER BY activo ASC,dorsal ASC";
						$consulta = mysql_query ($instruccion, $conexion)
									or die ("FALLO EN LA CONSULTA $instruccion");
						$nfilas = mysql_num_rows ($consulta);
						if ($nfilas>0) {
							for ($i=0; $i<$nfilas; $i++){
							$resultado = mysql_fetch_array ($consulta);
							if($resultado['foto']=='') $foto="../../img/jug/sinfoto.png";
							else $foto="../../img/jug/fotosjug/".$resultado['foto'];
							echo "<li id=\"".$resultado['dni']."\" class=\"ui-state-default cajajugador\"><div></div><img src=\"".$foto."\" alt=\"foto del jugador ".$resultado['alias']." \" title=\" ".$resultado['alias']."\"> <span class=\"nombreAliasCajaJugador\">".$resultado['alias']."</span>&nbsp;&nbsp;<span class=\"DorsalCajaJugador\">".$resultado['dorsal']."</span></li>";
							}
						}
				mysql_close ($conexion);
		?>
		</ul>
		  </div>
	</div>
</div>

<div class="col-md-12 col-sm-12">
	<div class="panel panel-default negroTransparente">
		  <div class="panel-heading panelhearb"><img src="../../img/adm/arbitro.png" alt="icono arbitro" title="icono delantero" />Árbitros<button id="btnarb" type="button" class="btn btn-default btn-md" style="float:right;"  title="Ver todos los árbitros">
  <span class="glyphicon glyphicon-zoom-in"></span></button>
  <button type="button" class="btn btn-default btn-md" onclick="$('#posicionhabitualform').val('A');" style="float:right;" title="añadir un árbitro"  data-toggle="modal" data-target="#modalanadirJugador">
		<span class="glyphicon glyphicon-plus"></span>
	 </button>
  </div>
		  <div class="panel-body panelarb"  style="display:none;">
			<ul id="arb" class="droptrue"><?php 
		include ('../../php/conexion.php');
		mysql_set_charset("utf8");
						$instruccion="SELECT dni,alias,dorsal,foto FROM jugador WHERE posicionhab='A' ORDER BY activo ASC,dorsal ASC";
						$consulta = mysql_query ($instruccion, $conexion)
									or die ("FALLO EN LA CONSULTA $instruccion");
						$nfilas = mysql_num_rows ($consulta);
						if ($nfilas>0) {
							for ($i=0; $i<$nfilas; $i++){
							$resultado = mysql_fetch_array ($consulta);
							if($resultado['foto']=='') $foto="../../img/jug/sinfoto.png";
							else $foto="../../img/jug/fotosjug/".$resultado['foto'];
							echo "<li id=\"".$resultado['dni']."\" class=\"ui-state-default cajajugador\"><div></div><img src=\"".$foto."\" alt=\"foto del jugador ".$resultado['alias']." \" title=\" ".$resultado['alias']."\"> <span class=\"nombreAliasCajaJugador\">".$resultado['alias']."</span>&nbsp;&nbsp;<span class=\"DorsalCajaJugador\">".$resultado['dorsal']."</span></li>";
							}
						}
				mysql_close ($conexion);
		?>
		</ul>
		  </div>
	</div>
</div>

</div>
<div class="col-md-7 col-sm-7">
<div class="col-md-12 col-sm-12">
<div id="divlocal" class="panel panel-default colorNegro negroTransparente">
		  <div class="panel-heading" style="overflow:auto;"> <button id="anadirlocal" class="btn btn-primary"><span class="glyphicon glyphicon-plus-sign"></span>&nbsp;Añadir</button>&nbsp;Equipo local: <select id="color"><option value="negro">negro</option><option value="naranja">naranja</option></select>
		  
		  <span style="float:right;"><span id="njugadoreslocal">0</span>&nbsp;Jugadores</span>
		  </div>
		  <div class="panel-body">
			<ul id="local" class="droptrue"></ul>
		  </div>
	</div>
</div>

<div  class="col-md-3 col-sm-3">
<div class="panel panel-default negroTransparente">
		  <div class="panel-heading" >Árbitro:
		  <button id="dsplarb" type="button" class="btn btn-default btn-sm" style="float:right;"  title="Desplegar árbitro">
				<span class="glyphicon glyphicon-zoom-in"></span>
			</button>
  </div>
		  <div class="panel-body panelelearb" style="display:none;">
			<ul id="arbitro" class="droptrue" style="overflow:auto;">
		</ul>
		  </div>
	</div>
</div>
<div  class="col-md-3 col-sm-3">
<div class="panel panel-default negroTransparente">
		  <div class="panel-heading" >fecha:
  </div>
		  <div class="panel-body ">
			<div class="col-md-12 col-sm-12"><input id ="fechaPartido" type="text" id="datepicker" class="form-control" readonly required /></div>
		  </div>
	</div>
</div>
<div  class="col-md-3 col-sm-3">
<div class="panel panel-default negroTransparente">
		  <div class="panel-heading" >Espects.
		  <button id="dsplespec" type="button" class="btn btn-default btn-sm" style="float:right;"  title="Desplegar asistentes">
				<span class="glyphicon glyphicon-zoom-in"></span>
			</button>
  </div>
		  <div class="panel-body panelespec" style="display:none;">
			<ul id="espectadores" class="droptrue" style="overflow:auto;">
		</ul>
		  </div>
</div>
</div>
<script>
$("#registrarPartido").click(function(){
	
	var juglocal =$("#local").find("li").map(function(){
  return $(this).attr("id");}).get().join(",");
  
  var jugvisitante =$("#visitante").find("li").map(function(){
  return $(this).attr("id");}).get().join(",");
  var fechPartido=$("#fechaPartido").val();
  
 
  if(fechPartido&&($("#njugadoreslocal").text()>=6)&&($("#njugadoresvisitante").text()>=6)) {
	$.post( "estrategia.php", { 'local': [juglocal],'visitante[]': [jugvisitante],'njugadoreslocal':$("#njugadoreslocal").text(),'njugadoresvisitante':$("#njugadoresvisitante").text() }, function (data) { 
	$("#bodyModalRegistPartido").html(data); //Se muestra el resultado de la operación en la clase 
	});}
	
});
$("#seguirGoles").click(function() {
	$('#ModalRegistPartido').modal('hide');
	var njugadoreslocal=$("#njugadoreslocal").text(),
		njugadoresvisitante=$("#njugadoresvisitante").text(),
	 njugadoreslocalActual=$("#loocal li").size(),
	 njugadoresvisitanteActual=$("#viisitante li").size();
	
	/*Para que local y visitante tengan o no estrategia pero no a medias*/
	if ((njugadoreslocalActual==0||njugadoreslocalActual==njugadoreslocal)&&(njugadoresvisitanteActual==0||njugadoresvisitanteActual==njugadoresvisitante)) {
	//alert("Bien");
	$('#ModalGolesPartido').modal('show');
		
		//lista en la estrategia local
		var juglocal =$("#loocal").find("li").map(function(){
		return $(this).attr("id");}).get().join(","),
		//lista en la estrategia visitante
		jugvisitante =$("#viisitante").find("li").map(function(){
		return $(this).attr("id");}).get().join(",");

	var esPorteroVContent =$("#esPorteroVContent").find("li").map(function(){
		return $(this).attr("id");}).get().join(","),
		esDefensaVContent =$("#esDefensaVContent").find("li").map(function(){
		return $(this).attr("id");}).get().join(","),
		esCentrocampistaVContent =$("#esCentrocampistaVContent").find("li").map(function(){
		return $(this).attr("id");}).get().join(","),
		esDelanteroVContent =$("#esDelanteroVContent").find("li").map(function(){
		return $(this).attr("id");}).get().join(","),
		
		esPorteroLContent =$("#esPorteroLContent").find("li").map(function(){
		return $(this).attr("id");}).get().join(","),
		esDefensaLContent =$("#esDefensaLContent").find("li").map(function(){
		return $(this).attr("id");}).get().join(","),
		esCentrocampistaLContent =$("#esCentrocampistaLContent").find("li").map(function(){
		return $(this).attr("id");}).get().join(","),
		esDelanteroLContent =$("#esDelanteroLContent").find("li").map(function(){
		return $(this).attr("id");}).get().join(",")
		
		
		;
	$.post( "introducirgolysanc.php", {
	'esPorteroLContent':[esPorteroLContent],
	'esDefensaLContent':[esDefensaLContent],
	'esCentrocampistaLContent':[esCentrocampistaLContent],
	'esDelanteroLContent':[esDelanteroLContent],
	'esPorteroVContent':[esPorteroVContent],
	'esDefensaVContent':[esDefensaVContent],
	'esCentrocampistaVContent':[esCentrocampistaVContent],
	'esDelanteroVContent':[esDelanteroVContent],
	'local': [juglocal],
	'njugadoreslocalActual': njugadoreslocalActual,
	'njugadoreslocal':njugadoreslocal,
	'visitante': [jugvisitante],
	'njugadoresvisitanteActual': njugadoresvisitanteActual,
	'njugadoresvisitante':njugadoresvisitante
	}, function (data) { 
	$("#bodyModalRegistGoles").html(data); //Se muestra el resultado de la operación en la clase 
	}); 
	
	}
	else {
	alert("Se te ha olvidado ubicar algún jugador en el campo.");
	$('#ModalRegistPartido').modal('show');
	
	}
});
/* Para el botón de atrás cuando vas a registrar los goles*/
$("#volveraEstrategia").click(function() {
	$('#ModalRegistPartido').modal('show');
	$('#ModalGolesPartido').modal('hide');
});	

$("#GUARDARtodo").click(function() {
	$('#ModalGolesPartido').modal('hide');
	$('#resultadoIntroducirPartido').modal('show');
	var ID =$("#guardarTodo").find("input[name=ID]").map(function(){
		return $(this).attr("value");}).get().join(","),
	SANCION =$("#guardarTodo").find("select[name=Sancionn] option:selected").map(function(){
		return $(this).attr("value");}).get().join(","),
	posHab =$("#guardarTodo").find("input[name=posHab]").map(function(){
		return $(this).attr("value");}).get().join(","),
	GOLES =$("#guardarTodo").find("select[name=Goles] option:selected").map(function(){
		return $(this).attr("value");}).get().join(","),
	cap =$("#guardarTodo").find("input[name=cap]:checked").map(function(){
		return $(this).attr("value");}).get().join(","),
		//lista de jugadores
	idjugadores =$("#guardarTodo ul").find("li").map(function(){
		return $(this).attr("id");}).get().join(","),	
		//lista del árbitro
	arbitro =$("#arbitro").find("li").map(function(){
		return $(this).attr("id");}).get().join(","),
		//jugadores espectador
	espectador =$("#espectadores").find("li").map(function(){
		return $(this).attr("id");}).get().join(","),
		//fecha del partido
	fechPartido=$("#fechaPartido").val(),
		//color del equipo local
	color=$("#color").val(),
	
	estLOCAL=$("#selectLocal option:selected").attr("id"),
	estVISITANTE=$("#selectVisitante option:selected").attr("id");
	
	var Njugadoreslocal=$("#njugadoreslocal").text(),
		Njugadoresvisitante=$("#njugadoresvisitante").text();
	
	/*alert("cap="+cap+"\n idjugadores="+idjugadores+"\n Sancion="+SANCION+"\n poshab="+posHab+"\n GOLES="+GOLES+"\n arbitro="+arbitro+"\n espectador="+espectador+"\n fechPartido="+fechPartido+"\n color="+color+"\n Njugadoreslocal="
	+Njugadoreslocal+"\n Njugadoresvisitante="+Njugadoresvisitante+"\n esLOCAL="+estLOCAL+"\n estVISITANTE="+estVISITANTE);*/
	
	$.post( "guardarpartido.php", {
	'idjugadores':[idjugadores],
	'Sancion':[SANCION],
	'posHab':[posHab],
	'GOLES':[GOLES],
	'arbitro':[arbitro],
	'espectador':[espectador],
	'fechPartido':fechPartido,
	'color':color,	
	'Njugadoreslocal': Njugadoreslocal,
	'Njugadoresvisitante': Njugadoresvisitante,
	'estLOCAL':estLOCAL,
	'estVISITANTE': estVISITANTE,
	'cap':[cap]
	}, function (data) { 
	$("#bodyresultadoIntroducirPartido").html(data); //Se muestra el resultado de la operación en el body de guardar
	});
	
});

$("#volveraGoles").click(function() {
	$('#resultadoIntroducirPartido').modal('hide');
	window.location = "./menugeneraladm.php";
});



</script>

<div class="col-md-3 col-sm-3" style="margin-top:20px;">
<button id="registrarPartido" class="btn btn-lg btn-info" data-toggle="modal" data-target="#ModalRegistPartido">Registrar partido</button>
</div>
<div  class="col-md-12 col-sm-12">
<div id="divisitante" class="panel panel-default colorNaranja negroTransparente">
		  <div class="panel-heading" style="overflow:auto;">
		  <button id="anadirvisitante" class="btn btn-primary"><span class="glyphicon glyphicon-plus-sign"></span>&nbsp;Añadir</button>&nbsp;Equipo visitante:
		  <span style="float:right;"><span id="njugadoresvisitante">0</span>&nbsp;Jugadores</span>
		  </div>
		  <div class="panel-body">
			<ul id="visitante" class="droptrue">
		</ul>
		  </div>
	</div>
</div>
<!-- ESTRATEGIA MODAL-->
<div class="modal fade" id="ModalRegistPartido" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Elegir estrategia</h4>
      </div>
      <div id="bodyModalRegistPartido" class="modal-body">
        Tienes que elegir fecha primero o asignar en cada equipo un mínimo de 6 jugadores
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
        <button id="seguirGoles" type="button" class="btn btn-primary"  data-toggle="modal">Siguiente</button>
      </div>
    </div>
  </div>
</div>
<!-- /ESTRATEGIA MODAL-->

<!-- GOLES MODAL-->
<div class="modal fade" id="ModalGolesPartido" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Elegir estrategia</h4>
      </div>
      <div id="bodyModalRegistGoles" class="modal-body">
      </div>
      <div class="modal-footer">
        <button id="volveraEstrategia" type="button" class="btn btn-default">Atrás</button>
        <button id="GUARDARtodo" type="button" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>
<!-- /GOLES MODAL-->


<!-- RESULTADO de INTRODUCIR MODAL-->
<div class="modal fade" id="resultadoIntroducirPartido" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Partido guardado</h4>
      </div>
      <div id="bodyresultadoIntroducirPartido" class="modal-body">
	  
      </div>
      <div class="modal-footer">
        <button id="volveraGoles" type="button" class="btn btn-default">Salir</button>
      </div>
    </div>
  </div>
</div>
<!-- /RESULTADO de INTRODUCIR MODAL-->


</div>
<script>
$("#anadirJugadorForm").submit(function( event ) {
	  //alert( "El formulario ha sido enviado" );
	  $("#modalanadirJugador").modal("hide");
	
	var poshabitual=$("#posicionhabitualform").val();
	var identi,todos;
	switch (poshabitual) {
	 case "por": identi=".panelpor"; todos=".paneldef,.panelcen,.paneldel,.panelarb";
		break;
	case "def": identi=".paneldef"; todos=".panelpor,.panelcen,.paneldel,.panelarb";
		break;
	case "cen": identi=".panelcen"; todos=".panelpor,.paneldef,.paneldel,.panelarb";
		break;
	case "del": identi=".paneldel"; todos=".panelpor,.paneldef,.panelcen,.panelarb";
		break;
	case "A": identi=".panelarb"; todos=".panelpor,.paneldef,.panelcen,.paneldel";
		break;
	}
	 $(identi).slideDown(200);
	  //si hubiera paneles abiertos de los otras categorías, las cierra
		$(todos).slideUp(200);
			
	var destino = "anadirUnJugador.php"; 
	var datos = $(this).serialize(); 

	$.post(destino, datos, function (data) { 
	$(identi).html(data); //Se muestra el resultado de la operación en la clase 
	});
	  event.preventDefault();
  });
  
  var longdni;
  $("#dni").keyup(function(){
	longdni=$("#dni").val();
	if(longdni.length>=1) {
	$("#repetido").text("a");
	 destino = "comprobardni.php"; 
	 datos = $("#anadirJugadorForm").serialize(); 
	$.post(destino, datos, function (data) { 
		$("#repetido").html(data); //Se muestra el resultado de la operación en la clase 
	});
	}
	else {
	$("#repetido").text("");
	}
  });
</script>
<div class="modal fade" id="modalanadirJugador" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Añadir un Jugador:</h4>
      </div>
      <div id="modalBodyPortero" class="modal-body">
     <form id="anadirJugadorForm" role="form" method="post">
	 <div class="row col-md-offset-1 col-sm-offset-1">
	 <div class="row">
	 
  <div class="form-group col-md-3  col-sm-3">
    <label for="alias">Alias&nbsp;<span class="obligatorio">*</span>&nbsp;:</label>
    <input type="text" class="form-control" name="alias" id="alias" maxlength="20" required >
  </div>
  <div class=" col-md-offset-1 col-sm-offset-1">
  <div class="form-group col-md-3  col-sm-3">
    <label for="dni">DNI&nbsp;<span class="obligatorio">*</span>&nbsp;:</label>
    <input type="text" class="form-control" name="dni" id="dni" maxlength="10" required>
	<p id="repetido" class="help-block"></p>
  </div>
  
  <div class="form-group col-md-3 col-sm-3">
    <label for="nombre">Nombre&nbsp;<span class="obligatorio">*</span>&nbsp;:</label>
    <input type="text" class="form-control" name="nombre" id="nombre" maxlength="20" required>
  </div>
  </div>
	  <div class="form-group col-md-3 col-sm-3">
    <label for="dorsal">Dorsal</label>
    <select class="form-control" name="dorsal" id="dorsal">
		<option value="">Sin dorsal</option>
		<?php
		include ('../../php/conexion.php');
		$instruccion="SELECT dorsal FROM jugador WHERE dorsal is not null ORDER BY dorsal";
						$consulta = mysql_query ($instruccion, $conexion)
									or die ("FALLO EN LA CONSULTA $instruccion");
						$nfilas = mysql_num_rows ($consulta);
						if ($nfilas>0) {
							for ($i=1; $i<=$nfilas; $i++){
							$resultado = mysql_fetch_array ($consulta);
								
								//si ése número no está en mi lista lo imprimo
								if($i!=$resultado['dorsal']) {
								echo "<option value=\"".$i."\">".$i."</option>";
								}
								/*else {
								echo "<option style=\"color:red;\" value=\"".$i."\">".$i."</option>";
								}*/
							}
							//para los restantes números disponibles hasta 50
							for($i; $i<=50; $i++) {
								echo "<option value=\"".$i."\">".$i."</option>";
							}
							}
							
						else{
						for($i=1;$i<=50;$i++) {
							echo "<option value=\"".$i."\">".$i."</option>";
						}
						}
		mysql_close ($conexion);				
		?>
		
	</select>
  </div>
	<input id="posicionhabitualform" type="hidden" class="form-control" name="poshab">

  <div class="form-group col-md-3 col-sm-3">
    <label for="activo">¿Extra?:</label>
    <select class="form-control" name="activo" id="activo">
			<option value="n" selected>Si</option>
			<option value="s" >No</option>
	</select>
  </div>
	  </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button id="gJugador" type="submit" name="crearPartidoGuardarJugador" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>
