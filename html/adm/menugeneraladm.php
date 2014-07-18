<!DOCTYPE html>
<?php session_start() ?>
<html lang="es">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<title>Página administración</title>
	<meta charset="utf-8">
	<meta name="keywords" content="peña,fútbol,calipso,zubia">
	<meta name="description" content="Página web de la peña de fútbol Calipso">
	<meta name="author" content="Antonio Moles Leiva">
	<meta name="viewport" content="width=device-width, initial-scale=1 user-scalable=no">
	<link href="../../css/jug/index.css" rel="stylesheet" type="text/css">
	<link href="../../css/adm/index.css" rel="stylesheet" type="text/css">
	<link href="../../css/adm/datepicker.css" rel="stylesheet" type="text/css">
	 <link href="../../img/favicon.ico" rel="shortcut icon" />
	 <!-- CSS de Bootstrap -->
	 <!--<script src="http://code.jquery.com/jquery-1.10.2.js"></script>-->
	 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script src="http://code.highcharts.com/highcharts.js"></script>
  <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <link href="../../css/bootstrap.min.css" rel="stylesheet" media="screen">
 
    <!-- librerías opcionales que activan el soporte de HTML5 para IE8 -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	</head>
<body>
 <!-- Librería jQuery requerida por los plugins de JavaScript -->
    <!--<script src="http://code.jquery.com/jquery.js"></script>-->
 
    <!-- Todos los plugins JavaScript de Bootstrap-->
    <script src="../../js/bootstrap.min.js"></script>
	
	<!-- PARA JQUERY -->
	<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>-->
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
	$("#menuPrincipal ul li #Jugadores").click(function() {
			$("#menuPrincipal ul li #ddJugadores").slideToggle(300);
			$("#menuPrincipal ul li #ddJugadores").addClass("a");
			$("#menuPrincipal ul li ul").not(".a").slideUp(100);
			$("#menuPrincipal ul li #ddJugadores").removeClass("a");
		});
	$("#menuPrincipal ul li #Pagos").click(function() {
			$("#menuPrincipal ul li #ddPagos").slideToggle(300);
			$("#menuPrincipal ul li #ddPagos").addClass("a");
			$("#menuPrincipal ul li ul").not(".a").slideUp(100);
			$("#menuPrincipal ul li #ddPagos").removeClass("a");
		});
	$("#menuPrincipal ul li #Estadisticas").click(function() {
			$("#menuPrincipal ul li #ddEstadisticas").slideToggle(300);
			$("#menuPrincipal ul li #ddEstadisticas").addClass("a");
			$("#menuPrincipal ul li ul").not(".a").slideUp(100);
			$("#menuPrincipal ul li #ddEstadisticas").removeClass("a");
		});
	//animaciones submenús
	$("#menuPrincipal ul li ul li").click(function() {
			$("#menuPrincipal ul li ul").slideUp(100);
			$("#menuPrincipal").slideToggle(100);
		});
		
	$("#Salir").click(function(){
	window.location = "../entrar.php?ds=1";
	});
	
	$("#modifjug").delay("slow").slideToggle(3000,function() {
	cargar('#contenedor', './verjugador.php');
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
      <a class="navbar-brand" href="./menugeneraladm.php"><img src="../../img/jug/brand.png" alt="peña calipso logo" style="margin-top:-10px;"><span class="sr-only">peña calipso logo</span></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="menuPrincipal">
      <ul class="nav navbar-nav">    
	   <li class="dropdown">
          <a id="Partidos" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-screenshot"></span>&nbsp;&nbsp;Partidos <b class="caret"></b></a>
          <ul class="dropdown-menu a" id="ddPartidos">
            <li><a onclick="cargar('#contenedor', './crearpartido.php')"><span class="glyphicon glyphicon-th-list"></span>&nbsp;&nbsp;Crear Partido</a></li>
            <li><a onclick="cargar('#contenedor', './modificarpartido.php')"><span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;Modificar Partido</a></li>
            <li><a onclick="cargar('#contenedor', './vertodospartidos.php')"><span class="glyphicon glyphicon-calendar"></span>&nbsp;&nbsp;Ver todos los partidos</a></li>
			<li class="divider"></li>
			<li><a onclick="cargar('#contenedor', './puntos.php')"><span class="glyphicon glyphicon-asterisk"></span>&nbsp;&nbsp;Puntos</a></li>
			<li><a onclick="cargar('#contenedor', './trofeos.php')"><span class="glyphicon glyphicon-tower"></span>&nbsp;&nbsp;Trofeos</a></li>
          </ul>
        </li>
		<li class="dropdown">
          <a class="dropdown-toggle" id="Jugadores" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;Jugadores <b class="caret"></b></a>
          <ul class="dropdown-menu" id="ddJugadores">
            <li><a onclick="cargar('#contenedor', './crearjugador.php')"><span class="glyphicon glyphicon-globe"></span>&nbsp;&nbsp;Crear Jugador</a></li>
            <li><a  onclick="cargar('#contenedor', './verjugador.php')"><span class="glyphicon glyphicon-certificate"></span>&nbsp;&nbsp;Ver jugadores</a></li>
          </ul>
        </li>
		<li class="dropdown">
          <a id="Pagos" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-thumbs-up"></span>&nbsp;&nbsp;Pagos <b class="caret"></b></a>
          <ul class="dropdown-menu" id="ddPagos">
            <li><a onclick="cargar('#contenedor', './crearpago.php')"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;&nbsp;Crear cuota</a></li>
            <li><a onclick="cargar('#contenedor', './gestionarpagos.php')"><span class="glyphicon glyphicon-th-list"></span>&nbsp;&nbsp;Gestionar Pagos</a></li>
          </ul>
        </li>
		<li class="dropdown">
          <a id="Estadisticas" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-stats"></span>&nbsp;&nbsp;Estadísticas <b class="caret"></b></a>
          <ul class="dropdown-menu" id="ddEstadisticas">
            <li><a onclick="cargar('#contenedor', './estpartidos.php')"><span class="glyphicon glyphicon-th-large"></span>&nbsp;&nbsp;Partidos</a></li>
            <li><a onclick="cargar('#contenedor', './estjugadores.php')"><span class="glyphicon glyphicon-th"></span>&nbsp;&nbsp;Jugadores</a></li>
			<li><a  onclick="cargar('#contenedor', './estpagos.php')"><span class="glyphicon glyphicon-euro"></span>&nbsp;&nbsp;Pagos</a></li>
          </ul>
        </li>
      </ul>

      <ul class="nav navbar-nav navbar-right" style="margin-left:5px;margin-top:10px;">
		 <li><button class="btn btn-sm btn-primary" id="Salir">Salir</button></li>
      </ul>
    </div>
  </div>
</nav>
</header>	
<aside>
<div style="margin-top:51px">
  <div id="contenedor">
	
	<?php 
	if(isset($_POST['crearJug'])) {
	?>
	<div>
	<ol class="breadcrumb">
	  <li><a>Inicio</a></li>
	  <li><a>Jugadores</a></li>
	  <li class="active">Crear Jugador</li>
	</ol>
	</div>
	<?php

	$dni=$_POST['dni'];
	$nombre=$_POST['nombre'];
	$apellidos=$_POST['apellidos'];
	$alias=$_POST['alias'];
	$activo=$_POST['activo'];
	$poshab=$_POST['poshab'];
	$dorsal=$_POST['dorsal'];
	$contrasena=md5($_POST['contrasena']);
	$nombre_archivo = $_FILES["adjfoto"]['name']; 
	
	move_uploaded_file($_FILES["adjfoto"]['tmp_name'],
          "../../img/jug/fotosjug/".$nombre_archivo);
	
	include ('../../php/conexion.php');
	if (isset($_POST['dni'])&&isset($_POST['nombre'])&&isset($_POST['dni'])&&isset($_POST['alias'])&&isset($_POST['contrasena'])){
						mysql_set_charset("utf8");
						$instruccion="INSERT INTO jugador (dni,alias,nombre,contrasena) VALUES ('".$dni."','".$alias."','".$nombre."','".$contrasena."')";
						$consulta = mysql_query ($instruccion, $conexion)
									or die ("
									<div class=\"container col-md-4 col-sm-4 col-xs-12 col-md-offset-4 col-sm-offset-4\" style=\"margin-top:10px;\">
									<div class=\"panel panel-danger\">
									 <div class=\"panel-heading\">
									<h3 class=\"panel-title\">Error</h3>
								  </div>
								  <div class=\"panel-body\"><span class=\"glyphicon glyphicon-remove\" style=\"color:red;\"></span>&nbsp;No se pudo crear el jugador - DNI existente </div>
								  <div class=\"panel-footer\"><a onclick=\"cargar('#contenedor', './crearjugador.php')\" class=\"btn btn-primary\"><span class=\"glyphicon glyphicon-arrow-left\"></span>&nbsp;&nbsp;Volver</a></div>
								</div>
								</div>
									");
						}
	if (isset($_POST['apellidos']))
			{
			mysql_set_charset("utf8");
						$instruccion="UPDATE jugador SET apellidos='$apellidos' WHERE dni='$dni'";
						$consulta = mysql_query ($instruccion, $conexion)
									or die ("<div class=\"container col-md-4 col-sm-4 col-xs-12 col-md-offset-4 col-sm-offset-4\" style=\"margin-top:10px;\">
									<div class=\"panel panel-danger\">
									 <div class=\"panel-heading\">
									<h3 class=\"panel-title\">Error</h3>
								  </div>
								  <div class=\"panel-body\"><span class=\"glyphicon glyphicon-remove\" style=\"color:red;\"></span>&nbsp;No se pudo introducir apellidos en la base de datos </div>
								  <div class=\"panel-footer\"><a onclick=\"cargar('#contenedor', './crearjugador.php')\" class=\"btn btn-primary\"><span class=\"glyphicon glyphicon-arrow-left\"></span>&nbsp;&nbsp;Volver</a></div>
								</div>
								</div>");
			}
	if (isset($_POST['dorsal']))
			{
				if($dorsal!="") {
				mysql_set_charset("utf8");
							$instruccion="UPDATE jugador SET dorsal='$dorsal' WHERE dni='$dni'";
							$consulta = mysql_query ($instruccion, $conexion)
										or die ("<div class=\"container col-md-4 col-sm-4 col-xs-12 col-md-offset-4 col-sm-offset-4\" style=\"margin-top:10px;\">
									<div class=\"panel panel-danger\">
									 <div class=\"panel-heading\">
									<h3 class=\"panel-title\">Error</h3>
								  </div>
								  <div class=\"panel-body\"><span class=\"glyphicon glyphicon-remove\" style=\"color:red;\"></span>&nbsp;No se pudo introducir el dorsal del jugador en la base de datos </div>
								  <div class=\"panel-footer\"><a onclick=\"cargar('#contenedor', './crearjugador.php')\" class=\"btn btn-primary\"><span class=\"glyphicon glyphicon-arrow-left\"></span>&nbsp;&nbsp;Volver</a></div>
								</div>
								</div>");
								}
			}
	if (isset($_POST['activo']))
			{
			mysql_set_charset("utf8");
				if($_POST['activo']=='s'){$instruccion="UPDATE jugador SET activo='$activo' WHERE dni='$dni'";}
				else{$instruccion="UPDATE jugador SET activo='$activo',dorsal=NULL WHERE dni='$dni'";}
						$consulta = mysql_query ($instruccion, $conexion)
									or die ("<div class=\"container col-md-4 col-sm-4 col-xs-12 col-md-offset-4 col-sm-offset-4\" style=\"margin-top:10px;\">
									<div class=\"panel panel-danger\">
									 <div class=\"panel-heading\">
									<h3 class=\"panel-title\">Error</h3>
								  </div>
								  <div class=\"panel-body\"><span class=\"glyphicon glyphicon-remove\" style=\"color:red;\"></span>&nbsp;No se pudo introducir activo en la base de datos </div>
								  <div class=\"panel-footer\"><a onclick=\"cargar('#contenedor', './crearjugador.php')\" class=\"btn btn-primary\"><span class=\"glyphicon glyphicon-arrow-left\"></span>&nbsp;&nbsp;Volver</a></div>
								</div>
								</div>");
			}
	if (isset($_POST['poshab']))
			{
				if($poshab!="") {
				mysql_set_charset("utf8");
							$instruccion="UPDATE jugador SET posicionhab='$poshab' WHERE dni='$dni'";
							$consulta = mysql_query ($instruccion, $conexion)
										or die ("<div class=\"container col-md-4 col-sm-4 col-xs-12 col-md-offset-4 col-sm-offset-4\" style=\"margin-top:10px;\">
									<div class=\"panel panel-danger\">
									 <div class=\"panel-heading\">
									<h3 class=\"panel-title\">Error</h3>
								  </div>
								  <div class=\"panel-body\"><span class=\"glyphicon glyphicon-remove\" style=\"color:red;\"></span>&nbsp;No se pudo introducir la posición del jugador en la base de datos </div>
								  <div class=\"panel-footer\"><a onclick=\"cargar('#contenedor', './crearjugador.php')\" class=\"btn btn-primary\"><span class=\"glyphicon glyphicon-arrow-left\"></span>&nbsp;&nbsp;Volver</a></div>
								</div>
								</div>");
								}
			}

	if ($nombre_archivo!="")
			{
				
			mysql_set_charset("utf8");
			$instruccion="UPDATE jugador SET foto='$nombre_archivo' WHERE dni='$dni'";
			$consulta = mysql_query ($instruccion, $conexion)
				or die ("<div class=\"container col-md-4 col-sm-4 col-xs-12 col-md-offset-4 col-sm-offset-4\" style=\"margin-top:10px;\">
									<div class=\"panel panel-danger\">
									 <div class=\"panel-heading\">
									<h3 class=\"panel-title\">Error</h3>
								  </div>
								  <div class=\"panel-body\"><span class=\"glyphicon glyphicon-remove\" style=\"color:red;\"></span>&nbsp;No se pudo subir la foto del jugador en la base de datos </div>
								  <div class=\"panel-footer\"><a onclick=\"cargar('#contenedor', './crearjugador.php')\" class=\"btn btn-primary\"><span class=\"glyphicon glyphicon-arrow-left\"></span>&nbsp;&nbsp;Volver</a></div>
								</div>
								</div>");

			}
	?>
	<div class="container col-md-4 col-sm-4 col-xs-12 col-md-offset-4 col-sm-offset-4" style="margin-top:10px;">
	<div class="panel panel-success">
	 <div class="panel-heading">
    <h3 class="panel-title">Información</h3>
  </div>
  <div class="panel-body"><div class="container"><span class="glyphicon glyphicon-ok" style="color:green;"></span>&nbsp;El jugador fue introducido exitosamente </div></div>
  <div class="panel-footer">
	<a onclick="cargar('#contenedor', './crearjugador.php')" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;Añadir otro</a>
	<a onclick="cargar('#contenedor', './verjugador.php')" class="btn btn-primary"><span class="glyphicon glyphicon-th-list"></span>&nbsp;&nbsp;Ver jugadores</a>
  </div>
</div>
</div>
	<?php	
	}
	if(isset($_POST['editJug'])) {
	?>
	<div>
	<ol class="breadcrumb">
	  <li><a>Inicio</a></li>
	  <li><a>Jugadores</a></li>
	  <li class="active">Ver jugadores</li>
	</ol>
	</div>
	<?php
	$dni=$_POST['dni'];
	$nombre=$_POST['nombre'];
	$apellidos=$_POST['apellidos'];
	$alias=$_POST['alias'];
	$activo=$_POST['activo'];
	$poshab=$_POST['poshab'];
	$dorsal=$_POST['dorsal'];
	$contrasena=md5($_POST['contrasena']);
	$nombre_archivo = $_FILES["adjfoto"]['name']; 
	
	move_uploaded_file($_FILES["adjfoto"]['tmp_name'],
          "../../img/jug/fotosjug/".$nombre_archivo);
	
	include ('../../php/conexion.php');
	if (isset($_POST['dni'])&&isset($_POST['nombre'])&&isset($_POST['dni'])&&isset($_POST['alias'])&&isset($_POST['contrasena'])){
						mysql_set_charset("utf8");
						$instruccion="UPDATE jugador SET dni='".$dni."',alias='".$alias."',nombre='".$nombre."',contrasena='".$contrasena."'WHERE dni='".$dni."'";
						$consulta = mysql_query ($instruccion, $conexion)
									or die ("
									<div class=\"container col-md-4 col-sm-4 col-xs-12 col-md-offset-4 col-sm-offset-4\" style=\"margin-top:10px;\">
									<div class=\"panel panel-danger\">
									 <div class=\"panel-heading\">
									<h3 class=\"panel-title\">Error</h3>
								  </div>
								  <div class=\"panel-body\"><span class=\"glyphicon glyphicon-remove\" style=\"color:red;\"></span>&nbsp;No se pudo modificar el jugador. </div>
								  <div class=\"panel-footer\"><a onclick=\"cargar('#contenedor', './crearjugador.php')\" class=\"btn btn-primary\"><span class=\"glyphicon glyphicon-arrow-left\"></span>&nbsp;&nbsp;Volver</a></div>
								</div>
								</div>
									");
						}
	if (isset($_POST['apellidos']))
			{
			mysql_set_charset("utf8");
						$instruccion="UPDATE jugador SET apellidos='$apellidos' WHERE dni='$dni'";
						$consulta = mysql_query ($instruccion, $conexion)
									or die ("<div class=\"container col-md-4 col-sm-4 col-xs-12 col-md-offset-4 col-sm-offset-4\" style=\"margin-top:10px;\">
									<div class=\"panel panel-danger\">
									 <div class=\"panel-heading\">
									<h3 class=\"panel-title\">Error</h3>
								  </div>
								  <div class=\"panel-body\"><span class=\"glyphicon glyphicon-remove\" style=\"color:red;\"></span>&nbsp;No se pudo modificar los apellidos en la base de datos </div>
								  <div class=\"panel-footer\"><a onclick=\"cargar('#contenedor', './crearjugador.php')\" class=\"btn btn-primary\"><span class=\"glyphicon glyphicon-arrow-left\"></span>&nbsp;&nbsp;Volver</a></div>
								</div>
								</div>");
			}
	if (isset($_POST['poshab']))
			{
				if($poshab!="") {
				mysql_set_charset("utf8");
							$instruccion="UPDATE jugador SET posicionhab='$poshab' WHERE dni='$dni'";
							$consulta = mysql_query ($instruccion, $conexion)
										or die ("<div class=\"container col-md-4 col-sm-4 col-xs-12 col-md-offset-4 col-sm-offset-4\" style=\"margin-top:10px;\">
									<div class=\"panel panel-danger\">
									 <div class=\"panel-heading\">
									<h3 class=\"panel-title\">Error</h3>
								  </div>
								  <div class=\"panel-body\"><span class=\"glyphicon glyphicon-remove\" style=\"color:red;\"></span>&nbsp;No se pudo modificar la posición del jugador en la base de datos </div>
								  <div class=\"panel-footer\"><a onclick=\"cargar('#contenedor', './crearjugador.php')\" class=\"btn btn-primary\"><span class=\"glyphicon glyphicon-arrow-left\"></span>&nbsp;&nbsp;Volver</a></div>
								</div>
								</div>");
								}
			}
	if (isset($_POST['dorsal']))
				{
					if($dorsal!="") {
					mysql_set_charset("utf8");
					
								$instruccion="UPDATE jugador SET dorsal='$dorsal' WHERE dni='$dni'";
								$consulta = mysql_query ($instruccion, $conexion)
											or die ("<div class=\"container col-md-4 col-sm-4 col-xs-12 col-md-offset-4 col-sm-offset-4\" style=\"margin-top:10px;\">
										<div class=\"panel panel-danger\">
										 <div class=\"panel-heading\">
										<h3 class=\"panel-title\">Error</h3>
									  </div>
									  <div class=\"panel-body\"><span class=\"glyphicon glyphicon-remove\" style=\"color:red;\"></span>&nbsp;No se pudo modificar el dorsal del jugador en la base de datos </div>
									  <div class=\"panel-footer\"><a onclick=\"cargar('#contenedor', './crearjugador.php')\" class=\"btn btn-primary\"><span class=\"glyphicon glyphicon-arrow-left\"></span>&nbsp;&nbsp;Volver</a></div>
									</div>
									</div>");
									}
					else {
				 mysql_set_charset("utf8");
								$instruccion="UPDATE jugador SET dorsal=NULL WHERE dni='$dni'";
								$consulta = mysql_query ($instruccion, $conexion)
											or die ("<div class=\"container col-md-4 col-sm-4 col-xs-12 col-md-offset-4 col-sm-offset-4\" style=\"margin-top:10px;\">
										<div class=\"panel panel-danger\">
										 <div class=\"panel-heading\">
										<h3 class=\"panel-title\">Error</h3>
									  </div>
									  <div class=\"panel-body\"><span class=\"glyphicon glyphicon-remove\" style=\"color:red;\"></span>&nbsp;No se pudo modificar el dorsal del jugador en la base de datos </div>
									  <div class=\"panel-footer\"><a onclick=\"cargar('#contenedor', './crearjugador.php')\" class=\"btn btn-primary\"><span class=\"glyphicon glyphicon-arrow-left\"></span>&nbsp;&nbsp;Volver</a></div>
									</div>
									</div>");
									}
				}
	if (isset($_POST['activo']))
			{
			mysql_set_charset("utf8");
			if($_POST['activo']=='s'){$instruccion="UPDATE jugador SET activo='$activo' WHERE dni='$dni'";}
				else{$instruccion="UPDATE jugador SET activo='$activo',dorsal=NULL WHERE dni='$dni'";}
						$consulta = mysql_query ($instruccion, $conexion)
									or die ("<div class=\"container col-md-4 col-sm-4 col-xs-12 col-md-offset-4 col-sm-offset-4\" style=\"margin-top:10px;\">
									<div class=\"panel panel-danger\">
									 <div class=\"panel-heading\">
									<h3 class=\"panel-title\">Error</h3>
								  </div>
								  <div class=\"panel-body\"><span class=\"glyphicon glyphicon-remove\" style=\"color:red;\"></span>&nbsp;No se pudo introducir activo en la base de datos </div>
								  <div class=\"panel-footer\"><a onclick=\"cargar('#contenedor', './crearjugador.php')\" class=\"btn btn-primary\"><span class=\"glyphicon glyphicon-arrow-left\"></span>&nbsp;&nbsp;Volver</a></div>
								</div>
								</div>");
			}			
				
	if ($nombre_archivo!="")
			{
				
			mysql_set_charset("utf8");
			$instruccion="UPDATE jugador SET foto='$nombre_archivo' WHERE dni='$dni'";
			$consulta = mysql_query ($instruccion, $conexion)
				or die ("<div class=\"container col-md-4 col-sm-4 col-xs-12 col-md-offset-4 col-sm-offset-4\" style=\"margin-top:10px;\">
									<div class=\"panel panel-danger\">
									 <div class=\"panel-heading\">
									<h3 class=\"panel-title\">Error</h3>
								  </div>
								  <div class=\"panel-body\"><span class=\"glyphicon glyphicon-remove\" style=\"color:red;\"></span>&nbsp;No se pudo subir la foto del jugador en la base de datos </div>
								  <div class=\"panel-footer\"><a onclick=\"cargar('#contenedor', './crearjugador.php')\" class=\"btn btn-primary\"><span class=\"glyphicon glyphicon-arrow-left\"></span>&nbsp;&nbsp;Volver</a></div>
								</div>
								</div>");

			}
	?> 
	<div id="modifjug" class="container col-md-4 col-sm-4 col-xs-12 col-md-offset-4 col-sm-offset-4" style="margin-top:10px;">
		<div class="panel panel-success">
			<div class="panel-heading">
				<h3 class="panel-title">Información</h3>
			</div>
			<div class="panel-body">
				<div class="container">
					<span class="glyphicon glyphicon-ok" style="color:green;"></span>&nbsp;El jugador fue modificado exitosamente 
				</div>
			</div>
		</div>
	</div>
	<?php
	}
	mysql_close ($conexion);
	?>
</div>

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

</div>
</aside>

<footer>
	
</footer>
	

</body>
</html>
