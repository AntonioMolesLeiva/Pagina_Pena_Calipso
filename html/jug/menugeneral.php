<!DOCTYPE html>
<?php session_start() ?>
<html lang="es">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<title></title>
	<meta charset="utf-8">
	<meta name="keywords" content="peña,fútbol,calipso,zubia">
	<meta name="description" content="Página web de la peña de fútbol Calipso">
	<meta name="author" content="Antonio Moles Leiva">
	<meta name="viewport" content="width=device-width, initial-scale=1 user-scalable=no">
	<link href="../../css/jug/index.css" rel="stylesheet" type="text/css">
	<link href="../../css/adm/index.css" rel="stylesheet" type="text/css">
	 <link href="../../img/favicon.ico" rel="shortcut icon" />
	 <!-- CSS de Bootstrap -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet" media="screen">
 
    <!-- librerías opcionales que activan el soporte de HTML5 para IE8 -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
 
	<!-- PARA JQUERY -->
	 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script src="http://code.highcharts.com/highcharts.js"></script>
  <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
	<script>
	$(document).ready(function() {
	//Para el botoncito cuadrado del menú de la derecha
	$(".navbar-header button").click(function() {
	$("#menuPrincipal").css("overflow","auto");
		//1º cierro el submenu que esté abierto
		$("#menuPrincipal ul li ul").slideUp(100);
		//2º Cierro el menú general
		$("#menuPrincipal").slideToggle(500);
		
	});
	/*	 $("*:not(.a)").click(function() {
	// if($("#menuPrincipal ul li ul").css("display") == "block") {
	//$("#menuPrincipal ul li ul").slideUp(3000);
	
	//}
	});*/
	$("#menuPrincipal ul li #Partidos").click(function() {
		$("#menuPrincipal ul li #ddPartidos").slideToggle(200);
		//añado clase para diferenciar 1 solo
		$("#menuPrincipal ul li #ddPartidos").addClass("a");
		//las listas que no sean .a las subo
		$("#menuPrincipal ul li ul").not(".a").slideUp(100);
		//elimino la clase .a y lo dejo como estaba
		$("#menuPrincipal ul li #ddPartidos").removeClass("a");
				
		});
	$("#menuPrincipal ul li #Goles").click(function() {
			$("#menuPrincipal ul li #ddGoles").slideToggle(300);
			$("#menuPrincipal ul li #ddGoles").addClass("a");
			$("#menuPrincipal ul li ul").not(".a").slideUp(100);
			$("#menuPrincipal ul li #ddGoles").removeClass("a");
		});
	$("#menuPrincipal ul li #Asistencia").click(function() {
			$("#menuPrincipal ul li #ddAsistencia").slideToggle(300);
			$("#menuPrincipal ul li #ddAsistencia").addClass("a");
			$("#menuPrincipal ul li ul").not(".a").slideUp(100);
			$("#menuPrincipal ul li #ddAsistencia").removeClass("a");
		});
	$("#menuPrincipal ul li #Estadisticas").click(function() {
			$("#menuPrincipal ul li #ddEstadisticas").slideToggle(300);
			$("#menuPrincipal ul li #ddEstadisticas").addClass("a");
			$("#menuPrincipal ul li ul").not(".a").slideUp(100);
			$("#menuPrincipal ul li #ddEstadisticas").removeClass("a");
		});
		
	$("#menuPrincipal ul li #Tarjetas").click(function() {
			$("#menuPrincipal ul li #ddTarjetas").slideToggle(300);
			$("#menuPrincipal ul li #ddTarjetas").addClass("a");
			$("#menuPrincipal ul li ul").not(".a").slideUp(100);
			$("#menuPrincipal ul li #ddTarjetas").removeClass("a");
		});
	$("#menuPrincipal ul li #menuUsu").click(function() {
			$("#menuPrincipal ul li #ddmenuUsu").slideToggle(300);
			$("#menuPrincipal ul li #ddmenuUsu").addClass("a");
			$("#menuPrincipal ul li ul").not(".a").slideUp(100);
			$("#menuPrincipal ul li #ddmenuUsu").removeClass("a");
		});
	//animaciones submenús
	$("#menuPrincipal ul li ul li").click(function() {
			$("#menuPrincipal ul li ul").slideUp(100);
			$("#menuPrincipal").slideToggle(100);
		});
	});
	function cargar(div, desde){
		$(div).html("<img class=\"container\" src=\"../../img/adm/loading.gif\" style=\"margin-left:270px;padding-top:200px;\">");
		$(div).load(desde);
	 
	}
	</script>
<?php
	if (isset($_SESSION['usu'])&&isset($_SESSION['pas'])) {
		
		?>
<header>
	<nav id="menuSuperior" class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menuPrincipal">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="./menugeneral.php"><img src="../../img/jug/brand.png" alt="peña calipso logo" style="margin-top:-10px;"><span class="sr-only">peña calipso logo</span></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="menuPrincipal">
      <ul class="nav navbar-nav">    
	   <li>
          <a  onclick="cargar('#contenedor', './votar.php')"><span class="glyphicon glyphicon-download-alt"></span>&nbsp;&nbsp;Votar</b></a>
        </li>
	   <li class="dropdown">
          <a href="#" id="Partidos" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-screenshot"></span>&nbsp;&nbsp;Partidos <b class="caret"></b></a>
          <ul class="dropdown-menu a" id="ddPartidos">
            <!--<li><a href="#"><span class="glyphicon glyphicon-th-list"></span>&nbsp;&nbsp;Último partido</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;Partidos por fecha</a></li>-->
            <li><a onclick="cargar('#contenedor', './vertodospartidos.php')"><span class="glyphicon glyphicon-calendar"></span>&nbsp;&nbsp;ver todos los partidos</a></li>
			<li class="divider"></li>
			<li><a onclick="cargar('#contenedor', './puntos.php')"><span class="glyphicon glyphicon-asterisk"></span>&nbsp;&nbsp;Puntos</a></li>
			<li><a onclick="cargar('#contenedor', './trofeos.php')"><span class="glyphicon glyphicon-tower"></span>&nbsp;&nbsp;Trofeos</a></li>
          </ul>
        </li>
		<li class="dropdown">
          <a href="#" class="dropdown-toggle" id="Goles" data-toggle="dropdown"><span class="glyphicon glyphicon-asterisk"></span>&nbsp;&nbsp;Goles <b class="caret"></b></a>
          <ul class="dropdown-menu" id="ddGoles">
            <li><a onclick="cargar('#contenedor', './misgoles.php')"><span class="glyphicon glyphicon-globe"></span>&nbsp;&nbsp;Mis goles</a></li>
            <li><a onclick="cargar('#contenedor', './golesde.php')"><span class="glyphicon glyphicon-pushpin"></span>&nbsp;&nbsp;Goles de...</a></li>
          </ul>
        </li>
		<li class="dropdown">
          <a href="#" id="Asistencia" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-thumbs-up"></span>&nbsp;&nbsp;Asistencia <b class="caret"></b></a>
          <ul class="dropdown-menu" id="ddAsistencia">
            <li><a onclick="cargar('#contenedor', './miultimopartido.php')"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;&nbsp;Mi último partido</a></li>
            <li><a onclick="cargar('#contenedor', './mispartidosjugados.php')"><span class="glyphicon glyphicon-th-list"></span>&nbsp;&nbsp;Mis partidos jugados</a></li>
          </ul>
        </li>
		<li class="dropdown">
          <a href="#" id="Tarjetas" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-flag"></span>&nbsp;&nbsp;Tarjetas <b class="caret"></b></a>
          <ul class="dropdown-menu" id="ddTarjetas">
            <li><a onclick="cargar('#contenedor', './vermistarjetas.php')"><span class="glyphicon glyphicon-th-large"></span>&nbsp;&nbsp;Mis tarjetas</a></li>
            <li><a onclick="cargar('#contenedor', './vertodastarjetas.php')"><span class="glyphicon glyphicon-th"></span>&nbsp;&nbsp;todas las tarjetas</a></li>
			<li class="divider"></li>
			<li><a onclick="cargar('#contenedor', './pagos.php')"><span class="glyphicon glyphicon-euro"></span>&nbsp;&nbsp;Pagos</a></li>
			
          </ul>
        </li>
		<li class="dropdown">
		  <a href="#" id="Estadisticas" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-stats"></span>&nbsp;&nbsp;Estadísticas <b class="caret"></b></a>
		  <ul class="dropdown-menu" id="ddEstadisticas">
			<li><a onclick="cargar('#contenedor', './estpartidos.php')"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;&nbsp;Partidos</a></li>
			<li><a onclick="cargar('#contenedor', './estjugadores.php')"><span class="glyphicon glyphicon-th-list"></span>&nbsp;&nbsp;Jugadores</a></li>
		  </ul>
		</li>		
      </ul>

      <ul class="nav navbar-nav navbar-right">
		 <li class="dropdown">
          <a href="#" id="menuUsu" class="dropdown-toggle" data-toggle="dropdown" data-no-collapse="true">
		 
		  <?php
			include ('../../php/conexion.php');
			$instruccion = "select foto from jugador WHERE dni='".$_SESSION['usu']."'" ;
			$consulta = mysql_query ($instruccion, $conexion)
				or die ("Fallo en la consulta");
			$resultado = mysql_fetch_array ($consulta);
			if ($resultado['foto']==NULL) { ?>
			 <img src="../../img/jug/sinfoto.png" class="img-rounded" style="width:25px;height:25px;" />
			<?php }
			else { ?>
			<img src="../../img/jug/fotosjug/<?php echo $resultado['foto']; ?>" class="img-rounded" style="width:25px;height:25px;" />
			<?php }
			mysql_close ($conexion);
			
			echo $_SESSION['alias'];
			?><b class="caret"></b></a>
          <ul class="dropdown-menu" id="ddmenuUsu">
            <li><a onclick="cargar('#contenedor', './mificha.php')"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;Mi ficha</a></li>
            <li><a onclick="cargar('#contenedor', './modificarcontrasena.php')"><span class="glyphicon glyphicon-cog"></span>&nbsp;&nbsp;Modificar contraseña</a></li>
            <li class="divider"></li>
            <li><a href="../entrar.php?ds=1"><span class="glyphicon glyphicon-off"></span>&nbsp;&nbsp;Salir</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
</header>	
<div style="margin-top:51px">
<aside id="contenedor">
	<?php
	}
	
	else { ?>
	
	<div class="clearfix col-md-12 hidden-xs hidden-sm" style="height:90px;" >
	</div>
	<div class="container col-md-4 col-sm-4 col-xs-12 col-md-offset-4 col-sm-offset-4" style="margin-top:10px;">
	<div class="panel panel-danger">
	 <div class="panel-heading">
    <h3 class="panel-title">¡Error!</h3>
  </div>
  <div class="panel-body">
    Debes acceder a la página desde el menú principal antes de acceder aquí.
  </div>
  <div class="panel-footer"><a href="../entrar.php" class="btn btn-primary">Acceder</a></div>
</div>
</div>

<?php  }
	
	?>
</aside>
</div>
<footer>
	
</footer>
	 
    <!-- Todos los plugins JavaScript de Bootstrap-->
    <script src="../../js/bootstrap.min.js"></script>
	
</body>
</html>
