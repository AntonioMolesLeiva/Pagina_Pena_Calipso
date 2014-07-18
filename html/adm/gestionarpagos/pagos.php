<?php
include ('../../../php/conexion.php');
?>
<input id="ano" type="hidden" value="<?php echo $_POST['anomax']; ?>" />
<div class="well col-sm-12 col-md-12">En la temporada <?php echo ($_POST['anomax']-1)." - ".$_POST['anomax']; ?> se debe:<span id="monto" style="color:red;font-size:1.4em;">&nbsp;&nbsp;- <?php
	$instruccion="SELECT SUM(precio) AS deuda FROM deudas d 
	LEFT JOIN cuota c ON d.idcuota=c.idcuota  
	WHERE d.fechadeuda>=\"".($_POST['anomax']-1)."-09-01\"
	AND d.fechadeuda<=\"".$_POST['anomax']."-06-30\" 
	GROUP BY fechadeuda>=\"".($_POST['anomax']-1)."-09-01\" AND d.fechadeuda<=\"".$_POST['anomax']."-06-30\" ";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");
	$resultado = mysql_fetch_array ($consulta);
	$deuda=$resultado['deuda'];
	$instruccion="SELECT SUM( acuenta ) AS pagar
FROM deudas d
LEFT JOIN pagos p ON d.ideuda = p.ideuda
WHERE d.fechadeuda >=  \"".($_POST['anomax']-1)."-09-01\"
AND d.fechadeuda <=  \"".$_POST['anomax']."-06-30\"
GROUP BY fechadeuda >=  \"".($_POST['anomax']-1)."-09-01\"
AND d.fechadeuda <=  \"".$_POST['anomax']."-06-30\"";

	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");
	$resultado = mysql_fetch_array ($consulta);
	$deuda-=$resultado['pagar'];
	
	echo $deuda;
 ?> €</span></div>
 
 <script>
 $(document).ready(function(){
	$(".panel-title a").click(function(){
	$(".panel-collapse .panel-body").empty();
	var val=$(this).attr("id");
	if ($("#collapse"+val).hasClass("in")) {
	$("#collapse"+val+" div").empty();
	}
	else {
	$.post("./gestionarpagos/generartabladeudapago.php", { 'ano':$("#ano").val(),'dnijug':$(this).attr("id"),'idcollapse':'#collapse'+val}, function (data) { 
		$("#collapse"+val+" div").html(data); //Se muestra el resultado de la operación en la clase 
		});
	}
	

		//alert("Has click jugador "+$(this).attr("id")+"\n"+"#collapse"+$(this).attr("id")+" div");
	});
 });
 </script>
<div class="panel-group" id="accordion">
<?php
/*

//DEFINITIVA DEL PAGO Y LA DEUDA JUNTAS
SELECT d.jugador,j.alias, (
IFNULL( SUM( acuenta ) , 0 ) - SUM( c.precio )
) AS monto
FROM deudas d
LEFT JOIN cuota c ON d.idcuota = c.idcuota
LEFT JOIN pagos p ON d.ideuda = p.ideuda
LEFT JOIN jugador j ON d.jugador=j.dni
WHERE d.fechadeuda>="2013-09-01" AND d.fechadeuda<="2014-06-30"
GROUP BY d.jugador
ORDER BY monto ASC 
*/
mysql_set_charset("utf8");
	$instruccion="SELECT d.jugador,j.alias, (
IFNULL( SUM( acuenta ) , 0 ) - SUM( c.precio )
) AS monto
FROM deudas d
LEFT JOIN cuota c ON d.idcuota = c.idcuota
LEFT JOIN pagos p ON d.ideuda = p.ideuda
LEFT JOIN jugador j ON d.jugador=j.dni
WHERE d.fechadeuda>=\"".($_POST['anomax']-1)."-09-01\" AND d.fechadeuda<=\"".$_POST['anomax']."-06-30\"
GROUP BY d.jugador
ORDER BY monto ASC";
	$consulta = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");
	$nfilas = mysql_num_rows ($consulta);
	if ($nfilas>0) {
		for ($i=0; $i<$nfilas; $i++){
			$resultado = mysql_fetch_array ($consulta);
		 ?>
		   <div class="panel panel-info">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a id="<?php  echo $resultado['jugador']; ?>" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $resultado['jugador']; ?>" >
          <?php echo $resultado['alias']; ?>
        </a>
		<span style="float:right;">Saldo: <?php 
			$instruccion="SELECT SUM( precio ) AS deuda
			FROM deudas d
			LEFT JOIN cuota c ON d.idcuota = c.idcuota
			WHERE d.fechadeuda >=  \"".($_POST['anomax']-1)."-09-01\"
			AND d.fechadeuda <=  \"".$_POST['anomax']."-06-30\"
			AND d.jugador =  \"".$resultado['jugador']."\"
			GROUP BY d.jugador";
			$consulta1 = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");
			$resultado1 = mysql_fetch_array ($consulta1);
			
			if ($resultado1['deuda']=="") $deuda=0;
			else $deuda=$resultado1['deuda'];
			
			$instruccion="SELECT SUM( acuenta ) AS pagar
			FROM pagos p
			LEFT JOIN deudas d ON p.ideuda = d.ideuda
			WHERE d.fechadeuda >=  \"".($_POST['anomax']-1)."-09-01\"
			AND d.fechadeuda <=  \"".$_POST['anomax']."-06-30\"
			AND d.jugador =  \"".$resultado['jugador']."\"
			GROUP BY d.jugador";
			$consulta1 = mysql_query ($instruccion, $conexion)
				or die ("FALLO EN LA CONSULTA $instruccion");
			$resultado1 = mysql_fetch_array ($consulta1);
			if ($resultado1['pagar']=="") $pagar=0;
			else $pagar=$resultado1['pagar'];
			$total=$pagar-$deuda;
			
		if ($total<0) echo "<span style=\"color:red\">".$total." €</span>"; 
		else echo "<span style=\"color:green\">".$total." €</span>"; 
		?></span>
      </h4>
    </div>
    <div id="collapse<?php echo $resultado['jugador']; ?>" class="panel-collapse collapse">
      <div class="panel-body">
      </div>
    </div>
  </div>
		 <?php
		}
	}
 ?>

  
 </div>
<div class="modal fade" id="cambiardeudaPago" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Información</h4>
      </div>
      <div class="modal-body">
      </div>
    </div>
  </div>
</div>
<?php
mysql_close ($conexion);
?>
