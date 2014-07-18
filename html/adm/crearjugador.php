<?php
	/*if (isset($_SESSION['usu'])&&isset($_SESSION['pas'])) {*/
		
		 ?>
<script>
function generarpass() {
	var cadena=["n","d","s",7,"g","h","k","a",2,"ñ","p","u",0,"c",3,"w","e",5,"f","m","y","v",9,"o","b",6,"l","j","q",8,"r","i",1,"t","x",4],contienenum = new Array(8),contienepass = new Array(8),fin="" ;
	//cojo 8 num aleatorios y los meto en contienenum (otro array)
	for (i=0;i<8;i++) {
		aleat = Math.random() * cadena.length;
		num=Math.round(aleat);
		contienenum[i]=num;
	}
	for (i=0;i<8;i++) {
		contienepass[i]=cadena[contienenum[i]];
		fin=fin+contienepass[i];
	}
	$("#contrasena").val(fin);
}
$("#crearJugador").ready(function() {
generarpass();
});
</script>
<div>
	<ol class="breadcrumb">
	  <li><a>Inicio</a></li>
	  <li><a>Jugadores</a></li>
	  <li class="active">Crear jugador</li>
	</ol>
</div>
<div class="col-sm-7 col-md-7 col-sm-offset-3 col-md-offset-3">
<div class="panel panel-info" id="crearJugador">
  <div class="panel-heading">Crear jugador</div>
  <div class="panel-body">
  <form role="form" method="post" enctype="multipart/form-data" action="./menugeneraladm.php" >
  <div class="row col-md-offset-1 col-sm-offset-1">
  <div class="form-group col-md-3  col-sm-3">
    <label for="dni">DNI&nbsp;<span class="obligatorio">*</span>&nbsp;:</label>
    <input type="text" class="form-control" name="dni" id="dni"  maxlength="10" required>
	<span class="help-block" >Ejemplo DNI: 12345678E</span>
  </div>
  
  <div class="form-group col-md-3 col-sm-3">
    <label for="nombre">Nombre&nbsp;<span class="obligatorio">*</span>&nbsp;:</label>
    <input type="text" class="form-control" name="nombre" id="nombre"  maxlength="20" required>
  </div>
  
  <div class="form-group col-md-3  col-sm-3">
    <label for="apellidos">Apellidos:</label>
    <input type="text" class="form-control" name="apellidos" id="apellidos" maxlength="20" >
  </div>
 </div> 
 
  <div class="row col-md-offset-1 col-sm-offset-1">
  <div class="form-group col-md-3  col-sm-3">
    <label for="alias">Alias&nbsp;<span class="obligatorio">*</span>&nbsp;:</label>
    <input type="text" class="form-control" name="alias" id="alias"  maxlength="20" required >
	
  </div>
  
  <div class="form-group col-md-3 col-sm-3">
    <label for="activo">¿Extra?:</label>
    <select class="form-control" name="activo" id="activo">
		<option value="s" selected>No</option>
		<option value="n">Si</option>
	</select>
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
  
  <div class="form-group col-md-4  col-sm-4">
    <label for="poshab">Posición habitual:</label>
	<select class="form-control" class="form-control" name="poshab" id="poshab">
		<option value="" >Elige</option>
		<option value="por" >Portero</option>
		<option value="def" >Defensa</option>
		<option value="cen" >Centrocampista</option>
		<option value="del" >Delantero</option>
		<option value="A" >Árbitro</option>
	</select>
  </div>
 </div> 
 
  <div class="form-group col-md-4  col-sm-3 col-md-offset-1 col-sm-offset-1">
    <label for="contrasena">Contraseña:</label>
    <input type="text" class="form-control" name="contrasena" id="contrasena" readonly>
  </div>
  <div class="form-group col-md-4  col-sm-3" id="foto">
    <label for="ejemplo_archivo_1">Adjuntar foto:</label>
    <input type="file" name="adjfoto" id="adjfoto">
    <p class="help-block"><span class="obligatorio"> * Campos obligatorios</span></p>
	
  </div>
	<div class="row">
	<div  class="col-sm-12">
	<button class="btn btn-info" type="submit" name="crearJug">Guardar</button>	
	</form>
	</div>
  </div>
   </div>

</div>
	<?php
	/*}
	
	else {*/ ?>
	
	<!-- <div class="clearfix col-md-12 hidden-xs hidden-sm" style="height:90px;" >
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
</div> -->

<?php /* }*/
	
	?>