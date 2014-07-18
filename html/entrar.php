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
	<link href="../css/jug/index.css" rel="stylesheet" type="text/css">
	 <link href="../img/favicon.ico" rel="shortcut icon" />
	 <!-- CSS de Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
 
    <!-- librerías opcionales que activan el soporte de HTML5 para IE8 -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
 <!-- Librería jQuery requerida por los plugins de JavaScript -->
    <script src="http://code.jquery.com/jquery.js"></script>
 
    <!-- Todos los plugins JavaScript de Bootstrap-->
    <script src="../../js/bootstrap.min.js"></script>
	
	<!-- PARA JQUERY -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<header>

</header>	
<aside>
<?php if(isset($_GET['ds']))
		{
		session_destroy();
		}
		?>	 

<div class="col-md-12 hidden-xs hidden-sm" style="height:90px;">
</div>
<div class="col-md-12 col-sm-12">
<?php 

if (isset($_POST['us'])&&isset($_POST['pas'])) /*para la primera vez que se manda el usuario y la contraseña*/
		{
		include ('../php/conexion.php');
		$jugador=$_POST['us']; 
		$contrasena=md5($_POST['pas']);
		
		$instruccion = "select * from administrador WHERE dni='".$jugador."' AND pass='".$contrasena."'" ;
		$consulta = mysql_query ($instruccion, $conexion)
				or die ("Fallo en la consulta");
				$nfilas = mysql_num_rows ($consulta);
				$resultado = mysql_fetch_array ($consulta);
		if ($nfilas==1) {
			$_SESSION['usu']=$jugador;
			$_SESSION['alias']=$resultado['alias'];
			$_SESSION['pas']=$contrasena;
			header('Location:./adm/menugeneraladm.php');

		}
		
		else {
		$instruccion = "select * from jugador WHERE dni='".$jugador."'" ;
		
		$consulta = mysql_query ($instruccion, $conexion)
				or die ("Fallo en la consulta");
				$nfilas = mysql_num_rows ($consulta);
				$resultado = mysql_fetch_array ($consulta);
		if ($nfilas==1) {
				$instruccion = "select * from jugador WHERE dni='".$jugador."' AND contrasena='".$contrasena."'" ;
		
				$consulta = mysql_query ($instruccion, $conexion)
						or die ("Fallo en la consulta");
						$nfilas = mysql_num_rows ($consulta);
						
				if ($nfilas==1) {
				
						$_SESSION['usu']=$jugador;
						$_SESSION['alias']=$resultado['alias'];
						$_SESSION['pas']=$contrasena;
						//echo "eres jugador";
						header('Location:./jug/menugeneral.php');

						}
						else {
							
							?>
							<div class="alert alert-warning alert-dismissable col-sm-5 col-md-5 col-xs-12 col-md-offset-3 col-sm-offset-3">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <strong>¡Advertencia!</strong> el jugador <?php echo $resultado['alias']; ?> sí está registrado, pero la contraseña introducida es inválida</div>
							<script>
							$(document).ready(function() {
							$("#pas").addClass("has-error");
							$("button.close").click(function() {
								$("div.alert").slideToggle();
							});							
							});
							</script>
							<?php
							}
		}
		else {
		?>
		<div class="alert alert-danger alert-dismissable col-sm-5 col-md-5 col-xs-12 col-md-offset-3 col-sm-offset-3">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <strong>¡Error!</strong> el jugador no está registrado en la base de datos.</div>
  
							<script>
							$(document).ready(function() {
							$("button.close").click(function() {
								$("div.alert").slideToggle();
							});
							$("#pas").addClass("has-error");
							$("#us").addClass("has-error");
							});
							</script>		
		<?php
		}
}
}
?>
</div>
<div id="entrar" class="container col-md-3 col-sm-3 col-xs-12 col-md-offset-4 col-sm-offset-4">

      <form action="./entrar.php" method="post" class="form-signin" role="form">
        <h2 class="form-signin-heading" style="color:#c9c9c9;">Ingresa:</h2>
        <div id="us">
		<input type="text" class="form-control" name="us" id="us" placeholder="DNI con letra" required autofocus>
		</div>
		<span class="help-block" >Ejemplo DNI: 12345678E</span>
		
		<div id="pas">
        <input type="password" class="form-control" name="pas" placeholder="Contraseña" required>
		</div>
        <label class="checkbox">
          <input type="checkbox"value="recuerdame"><span  style="color:#c9c9c9;">Recuérdame</span>
        </label>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Entra!</button>
      </form>

    </div>		
</aside>
<footer>
	
</footer>
<?php
	mysql_close ($conexion);	
	?>
</body>
</html>
