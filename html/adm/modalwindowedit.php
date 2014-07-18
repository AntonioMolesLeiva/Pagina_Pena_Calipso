<?php
include ('../../php/conexion.php');
	$instruccion = "select dni,dorsal,nombre,apellidos,activo,posicionhab,foto,alias from jugador WHERE dni='".$_GET['id']."'" ;
		$consulta = mysql_query ($instruccion, $conexion)
				or die ("Fallo en la consulta");
				$resultado = mysql_fetch_array ($consulta);
				/*if ($resultado['foto']!="")  $foto="Si";
				else $foto="No";
				if ($resultado['activo']=="s")  $activo="<span class=\"glyphicon glyphicon-ok\" style=\"color:green;\"></span>";
				else  $activo="<span class=\"glyphicon glyphicon-remove\" style=\"color:red;\"></span>";*/
				$foto=$resultado['foto'];
			
 ?>
  <form role="form" method="post" enctype="multipart/form-data" action="./menugeneraladm.php" >
  <div class="row col-md-offset-1 col-sm-offset-1">
  <div class="form-group col-md-3  col-sm-3">
    <label for="dni">DNI&nbsp;<span class="obligatorio">*</span>&nbsp;:</label>
    <input type="text" class="form-control" name="dni" id="dni" value="<?php echo $resultado['dni']; ?>"  maxlength="10" required>
  </div>
  
  <div class="form-group col-md-3 col-sm-3">
    <label for="nombre">Nombre&nbsp;<span class="obligatorio">*</span>&nbsp;:</label>
    <input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $resultado['nombre']; ?>" maxlength="20" required>
  </div>
  
  <div class="form-group col-md-3  col-sm-3">
    <label for="apellidos">Apellidos:</label>
    <input type="text" class="form-control" name="apellidos" id="apellidos" value="<?php echo $resultado['apellidos']; ?>" maxlength="20" >
  </div>
 </div> 
 
  <div class="row col-md-offset-1 col-sm-offset-1">
  <div class="form-group col-md-3  col-sm-3">
    <label for="alias">Alias&nbsp;<span class="obligatorio">*</span>&nbsp;:</label>
    <input type="text" class="form-control" name="alias" id="alias" value="<?php echo $resultado['alias']; ?>" maxlength="20" required >
	
  </div>
  
  <div class="form-group col-md-3 col-sm-3">
    <label for="activo">¿Extra?:</label>
    <select class="form-control" name="activo" id="activo">
		<?php $pos=$resultado['activo'];
			if($pos=='s') {
			?>
			<option value="s" selected>No</option>
			<option value="n" >Si</option>
			<?php
			}
			
			else {
			?>
			<option value="s" >No</option>
			<option value="n" selected>Si</option>
			<?php
			}
		?>
	</select>
  </div>
  <div class="form-group col-md-3 col-sm-3">
    <label for="dorsal">Dorsal</label>
    <select class="form-control" name="dorsal" id="dorsal">
		<option value="">Sin dorsal</option>
		<option value="<?php echo $resultado['dorsal']; ?>" selected><?php echo $resultado['dorsal']; ?></option>
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
	<?php $pos=$resultado['posicionhab'];
		switch ($pos) {
    case '':
        ?>
		<option value="" >Elige</option>
		<option value="por" >Portero</option>
		<option value="def" >Defensa</option>
		<option value="cen" >Centrocampista</option>
		<option value="del" >Delantero</option>
		<option value="A" >Árbitro</option>
		<?php
        break;
    case 'por':
        ?>
		<option value="" >Elige</option>
		<option value="por" selected>Portero</option>
		<option value="def" >Defensa</option>
		<option value="cen" >Centrocampista</option>
		<option value="del" >Delantero</option>
		<option value="A" >Árbitro</option>
		<?php
        break;
    case 'def':
        ?>
		<option value="" >Elige</option>
		<option value="por" >Portero</option>
		<option value="def" selected>Defensa</option>
		<option value="cen" >Centrocampista</option>
		<option value="del" >Delantero</option>
		<option value="A" >Árbitro</option>
		<?php
        break;
	case 'cen':
        ?>
		<option value="" >Elige</option>
		<option value="por" >Portero</option>
		<option value="def" >Defensa</option>
		<option value="cen" selected>Centrocampista</option>
		<option value="del" >Delantero</option>
		<option value="A" >Árbitro</option>
		<?php
        break;
	case 'del':
        ?>
		<option value="" >Elige</option>
		<option value="por" >Portero</option>
		<option value="def" >Defensa</option>
		<option value="cen" >Centrocampista</option>
		<option value="del" selected>Delantero</option>
		<option value="A" >Árbitro</option>
		<?php
        break;
	case 'A':
        ?>
		<option value="" >Elige</option>
		<option value="por" >Portero</option>
		<option value="def" >Defensa</option>
		<option value="cen" >Centrocampista</option>
		<option value="del" >Delantero</option>
		<option value="A" selected>Árbitro</option>
		<?php
        break;
		}
	?>
	
	</select>
  </div>
 </div> 
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
$("#generarcontrasena").click(function() {
generarpass();
});
</script>
  <div class="form-group col-md-4  col-sm-3 col-md-offset-1 col-sm-offset-1">
    <label for="contrasena"><a class="btn btn-info btn-xs" id="generarcontrasena">Generar contraseña</a></label>
    <input type="text" class="form-control" name="contrasena" id="contrasena" readonly>
  </div>
  <div class="form-group col-md-4  col-sm-3" id="foto">
    <label for="ejemplo_archivo_1">Adjuntar foto:</label>
	<div class="container" class="fotoedit" style="margin-bottom:10px;">
	<?php
	if ($foto=="") {
	echo "<p>Sin foto</p>";
	}
	
	else {
	 echo "<img class=\"fotoedit\" src=\"../../img/jug/fotosjug/".$foto."\" alt=\"foto del jugador\" title=\"foto del jugador\" />";
	} ?>

	</div>
    <input type="file" name="adjfoto" id="adjfoto">
    <p class="help-block"><span class="obligatorio"> * Campos obligatorios</span></p>
	
  </div>
	<div class="row">
	<div  class="col-sm-12">
	<button class="btn btn-info" type="submit" name="editJug">Guardar cambios</button>	
	</form>
	<?php
mysql_close ($conexion); 
	?>