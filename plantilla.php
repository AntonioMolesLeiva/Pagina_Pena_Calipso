<!DOCTYPE html>
<?php session_start() ?>
<html lang="es">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<meta name="keywords" content="peña,fútbol,calipso,zubia">
	<meta name="description" content="Página web de la peña de fútbol Calipso">
	<meta name="author" content="Antonio Moles Leiva">
	<meta name="viewport" content="width=device-width, initial-scale=1 user-scalable=no">
	<link href="./css/index.css" rel="stylesheet" type="text/css">
	 <link href="./img/favicon.ico" rel="shortcut icon" />
	 <!-- CSS de Bootstrap -->
    <link href="./css/bootstrap.min.css" rel="stylesheet" media="screen">
	<!-- CSS NIVO SLIDER -->
	<link href="./css/nivo-slider.css" rel="stylesheet" media="screen">
	<link href="./css/themes/default/default.css" rel="stylesheet" media="screen">
	<link href="./css/themes/light/light.css" rel="stylesheet" media="screen">
	<link href="./css/themes/dark/dark.css" rel="stylesheet" media="screen">
	<link href="./css/themes/bar/bar.css" rel="stylesheet" media="screen">
	<title>Plantilla - Peña Calipso</title>
 </head>
<body>
 <!-- Librería jQuery requerida por los plugins de JavaScript -->
    <script src="http://code.jquery.com/jquery.js"></script>
 
    <!-- Todos los plugins JavaScript de Bootstrap-->
    <script src="./js/bootstrap.min.js"></script>
	
	<!-- PARA JQUERY -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<header class="col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2" style="margin-bottom:12px;">
	<div class="col-md-10 col-sm-10" style="height:87px;padding-left:0px !important;margin-bottom:5px;">
		<div class="col-sm-offset-0 col-md-offset-0 col-xs-offset-3" style="max-width:242px;height:87px;">
			<img class="img-responsive" src="./img/index/logo.png" alt="Logo Peña Calipso" title="Logo Peña Calipso"/>
		</div>
	</div>
	<a href="./html/entrar.php"><div class="col-md-2 col-sm-2 col-sm-offset-0 col-md-offset-0 col-xs-6 col-xs-offset-2">
		<img class="img-responsive" style="float:left;margin-right:5px;height:48px;" src="./img/index/entrar.png"/>
		<p style="padding-top:12px;">¡Entra!</p>
	</div></a>
</header>	
<aside  class="col-md-8 col-sm-8 col-xs-12 col-md-offset-2 col-sm-offset-2">
	<nav class="col-md-12 col-sm-12 navbar navbar-default" style="min-height:70px;margin-bottom:3px;padding:0px;" role="navigation">
	  <div class="container-fluid" style="/*padding:0px;*/">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
		  <button type="button" style="margin-top:19px;margin-right:30px;" class="navbar-toggle" data-toggle="collapse" data-target="#mimenu">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </button>
		  <a class="navbar-brand hidden-sm hidden-md visible-xs" style="margin-top:15px;margin-left:15px;">Menú</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="mimenu">
		  <ul class="nav navbar-nav" style="width:100%;min-height:70px;">
			<li><a href="./index.html">Inicio</a></li>
			<li class="dropdown active">
			  <a class="dropdown-toggle" data-toggle="dropdown">Quienes somos<span class="caret"></span></a>
			  <ul class="dropdown-menu" role="menu">
				<li><a href="./plantilla.php">Plantilla</a></li>
				
			  </ul>
			</li>
			<li><a href="#">Estatutos</a></li>
			<li class="dropdown">
			  <a id="aa" href="#" class="dropdown-toggle" data-toggle="dropdown">Galerías<span class="caret"></span></a>
			  <ul class="dropdown-menu" role="menu">
				<li class="dropdown-submenu"><a>Temp. 13/14</a>
				<ul class="dropdown-menu">
				  <li><a href="#">Partido 17/06/2014</a></li>
				  <li><a href="#">Partido 24/06/2014</a></li>
				  <li><a href="#">Fiesta final temp.</a>
				  </li>
                </ul>
				</li>
			  </ul>
			</li>
		  </ul>
		</div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
</nav>
	<div class="col-md-12 col-sm-12" style="margin-top:5px;min-height:900px;background-color:rgba(0,0,0,0.8);border-radius:10px;padding-top:5px;margin-bottom:5px;">
	
	<?php
	include ('./php/conexion.php');
	
	mysql_set_charset("utf8");
	$instruccion="SELECT * FROM jugador WHERE activo =  \"s\" ORDER BY posicionhab ASC ";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");
	$nfilas = mysql_num_rows ($consulta);
	if ($nfilas>0) {
	$a=0;
		for ($i=0; $i<$nfilas; $i++){
			$resultado = mysql_fetch_array ($consulta);
			if ($a==0) echo "<div class=\"row\">";
			?>		
	<div class="col-md-3 col-sm-3" style="/*border:1px solid red;*/min-height:300px;">
		<div class="col-md-12 col-sm-12" style="padding-top:3px;height:200px;/*border:1px solid blue;*/">
			<?php
				if ($resultado['foto']=="") echo "<img class=\"img-responsive\" style=\"margin:auto;max-height:197px;border-radius:3px;\" src=\"./img/jug/sinfoto.png\">";
				else  echo "<img class=\"img-responsive\" style=\"margin:auto;max-height:197px;border-radius:3px;\" src=\"./img/jug/fotosjug/".$resultado['foto']."\">";
			?>
		</div>
		<div class="col-md-12 col-sm-12" style="min-height:100px;/*border:1px solid yellow;*/">
			<p style="color:white;margin:auto;text-align:center;">
			<?php echo $resultado['nombre']; ?><br/>
			<?php echo $resultado['apellidos']; ?>
			</p>
			<p style="color:white;text-align:center;">Posición:
			<?php
			switch($resultado['posicionhab']) {
				case "por":	echo "Portero";
							break;
				case "def":	echo "Defensa";
							break;
				case "cen":	echo "Centrocampista";
							break;
				case "del":	echo "Delantero";
							break;
				case "A":	echo "Árbitro";
							break;
			}
			?><br />
			
			<?php
			/*
			SELECT SUM(gol) as gol FROM incidencia WHERE jugador=\"".$resultado['dni']."\" GROUP BY jugador
			
			SELECT idsancion, COUNT( idsancion ) AS nsancion
			FROM incidencia
			WHERE jugador =  \"".$resultado['dni']."\"
			AND idsancion =1
			OR idsancion =3
			GROUP BY idsancion
			*/
			$instruccion="SELECT SUM(gol) as gol FROM incidencia WHERE jugador=\"".$resultado['dni']."\" GROUP BY jugador";
			$consulta1 = mysql_query ($instruccion, $conexion)
						or die ("FALLO EN LA CONSULTA $instruccion");
			$nfilas1 = mysql_num_rows ($consulta1);
			if ($nfilas1>0) {
				$resultado1 = mysql_fetch_array ($consulta1);
				echo "<img src=\"./img/adm/gol20x20.png\"/> ".$resultado1['gol']."&nbsp;&nbsp;&nbsp;&nbsp;";
			}
			else echo "<img src=\"./img/adm/gol20x20.png\"/> 0&nbsp;&nbsp;&nbsp;&nbsp;";
			
			$instruccion="SELECT idsancion, COUNT( idsancion ) AS nsancion
							FROM incidencia
							WHERE jugador =  \"".$resultado['dni']."\"
							AND idsancion =1
							OR idsancion =3
							GROUP BY idsancion";
			$consulta1 = mysql_query ($instruccion, $conexion)
						or die ("FALLO EN LA CONSULTA $instruccion");
			$nfilas1 = mysql_num_rows ($consulta1);
			if ($nfilas1>0) {
				for ($ii=0; $ii<$nfilas; $ii++){
					$resultado1 = mysql_fetch_array ($consulta1);
					if ($resultado1['nsancion']==1&&$nfilas1==1) {
						echo "<img src=\"./img/adm/tamarilla20x26.png\"/> ".$resultado1['nsancion']."&nbsp;&nbsp;&nbsp;&nbsp;<img src=\"./img/adm/troja20x26.png\"/> 0";
					}
					else if ($resultado1['nsancion']==1) {
						echo "<img src=\"./img/adm/tamarilla20x26.png\"/> ".$resultado1['nsancion']."&nbsp;&nbsp;&nbsp;&nbsp;";
					}
					else if ($resultado1['nsancion']==3) {
						echo "<img src=\"./img/adm/tamarilla20x26.png\"/> 0&nbsp;&nbsp;&nbsp;&nbsp;<img src=\"./img/adm/troja20x26.png\"/> ".$resultado1['nsancion'];
					}
				
				}
				
			}
			else {
				echo "<img src=\"./img/adm/tamarilla20x26.png\"/> 0&nbsp;&nbsp;&nbsp;&nbsp;<img src=\"./img/adm/troja20x26.png\"/> 0";
			}
			
			?>
			</p>
		</div>
	</div>		
			<?php
			
			if ($a==3) {
			echo "</div>";
			$a=0;
			}
			else $a++;
			
			}
	}
	else {
	echo "<h1 style=\"text-align:center;color:white;\">Aún no hay jugadores en la plantilla</h1>";
	}
	
	mysql_close ($conexion);
	?>
	

	</div>
</aside>
<footer class="col-md-8 col-sm-8 col-xs-12 col-md-offset-2 col-sm-offset-2"  style="border-top:1px solid gray;margin-top:5px;height:70px;padding:10px;">
<p class="col-md-5 col-sm-5 col-xs-6" style="color:white;">Peña calipso 2014 &copy; <small>Todos los derechos reservados</small></p>	
<p class="col-md-7 col-sm-7 col-xs-6" style="color:#c0c0c0;border-left:3px solid #f26721;"><small>Creado por:</small> <a href="http://es.linkedin.com/pub/antonio-moles-leiva/3a/70/970" style="cursor:pointer;"><strong>Antonio Moles</strong></a></p>
</footer>
<script>
$(document).ready(function(){
	$(".dropdown-submenu").click(function (){
	e.stopPropagation();
	$(this).find(".dropdown-menu").toggle();
	});
	$(".dropdown-submenu .dropdown-menu").click(function (e){
	$(this).parent().parent().toggle();
	});
	
	$("#aa").click(function(){
		$(this).siblings().toggle();

	});
	$("#aa").next().click(function(){
	$("#aa").siblings().css("display","none");
	});
	
	$("#ScrollUp").click(function(){
		$('html, body').animate({
				scrollTop: 0
			}, 800);
		$( "#ScrollUp" ).fadeOut(1000);
		$("#ScrollUp").css("display","none");
	});
	$.fn.scrollStopped = function(callback) {           
        $(this).scroll(function(){
            var self = this, $this = $(self);
            if ($this.data('scrollTimeout')) {
              clearTimeout($this.data('scrollTimeout'));
            }
            $this.data('scrollTimeout', setTimeout(callback,250,self));
        });
    };
$(window).scrollStopped(function(){
    var window_y = $(window).scrollTop();
		if (window_y>=300) {
		$( "#ScrollUp" ).fadeIn(1000);
		$( "#ScrollUp" ).css("display","block");
		
		}
		else {
		$( "#ScrollUp" ).fadeOut(1000);
		$( "#ScrollUp" ).css("display","none");
		}
});

});
</script>
<div id="ScrollUp" class="hidden-xs">
<p>Subir</p>
</div>
<script src="./js/jquery.nivo.slider.js" type="text/javascript"></script>
<script type="text/javascript">
$(window).load(function() {
$("#slider").nivoSlider();
});
</script>
</body>
</html>
