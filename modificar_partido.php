<?php

require_once("conexion.php");
include_once("partidos.php");

$partido = new partidos;

//Profe, esta seccion es la parte de buscar el partido, por eso va en GET, en el ejemplo que usted nos puso, usted lo hizo asi.
if(isset($_GET["jornada"], $_GET["equipo_local"], $_GET["equipo_visita"])){

	
	$partido->buscar_partido($conexion, $_GET["jornada"], $_GET["equipo_local"], $_GET["equipo_visita"]);
	

}

//Este si va en POST por que es el que modifica
if(isset($_POST["goles_local"], $_POST["goles_visita"], $_POST["fecha_partido"], $_POST["hora_partido"])){

	$partido->modificar_partido($conexion, $_POST["goles_local"], $_POST["goles_visita"], $_POST["fecha_partido"], $_POST["hora_partido"]);
	
}

?>


<html>
<script>

function buscar_partido(){
var jornada = document.getElementById("jornada").value;
var eq_local = document.getElementById("equipo_local").value;
var eq_visita = document.getElementById("equipo_visita").value;


parent.location = 'modificar_partido.php?jornada='+ jornada + '&equipo_local=' + eq_local + '&equipo_visita=' + eq_visita;
   
} 
function limpiar_pantalla(){
   parent.location='modificar_partido.php';
}

</script>
<body>
<form action="" method="POST">
	<table style="width:10%" align="left">
		 <tr>
		   <td>Jornada:</td>
		   <td>
		   		<select id="jornada" name="jornada" required="required" <?php echo $partido->disabled_buscar;?>>
		   			<option disabled selected><?php echo $partido->drop_jornada;?></option>
					<option value="1"> 1 </option>
					<option value="2"> 2 </option>
					<option value="3"> 3 </option>
					<option value="4"> 4 </option>
					<option value="5"> 5 </option>
					<option value="6"> 6 </option>
					<option value="7"> 7 </option>
					<option value="8"> 8 </option>
					<option value="9"> 9 </option>
					<option value="10"> 10 </option>
					<option value="11"> 11 </option>
				</select>
			</td> 
		    
		 </tr>


		 <tr>
		   <td>Equipo Local:</td>
		   <td>
		   	<select id="equipo_local" name="equipo_local" required="required" <?php echo $partido->disabled_buscar;?>>
		   		<option disabled selected value=<?php echo $partido->codigo_equipo_local;?>><?php echo $partido->drop_local;?></option>
				<?php $partido->lista_equipos($conexion);?>
			</select>
		   </td> 
		 </tr>
		 <tr>
		  <td>Equipo Visita:</td>
		  <td>
		  	<select id="equipo_visita" name="equipo_visita" required="required" <?php echo $partido->disabled_buscar;?>>
		  		<option disabled selected value=<?php echo $partido->codigo_equipo_visita;?>><?php echo $partido->drop_visita;?></option>
				<?php $partido->lista_equipos($conexion);?>
			</select>
		  </td>
		 </tr>
		 <tr>
		  		  <td>Goles Local:</td>
		  <td><input type="number" name="goles_local" min="0" max="30" <?php echo $partido->disabled_campos;?> value=<?php echo $partido->goles_local;?>></td>
		 </tr>

		 <tr>
		  <td>Goles Visita:</td>
		  <td><input type="number" name="goles_visita" min="0" max="30" <?php echo $partido->disabled_campos;?> value=<?php echo $partido->goles_visita;?>></td>
		 </tr>

		 <tr>
		  <td>Fecha Partido:</td>
		  <td><input type="date" name="fecha_partido" <?php echo $partido->disabled_campos;?> value=<?php echo $partido->fecha_partido;?>></td>
		 </tr>


		 <tr>
		  <td>Hora Partido:</td>
		  <td><input type="time" name="hora_partido"  required="required" step="1" min="09:00:00" max="20:00:00"<?php echo $partido->disabled_campos;?> value=<?php echo $partido->hora_partido;?> ></td>
		 </tr>
		 <tr>
		 	<td align="center"><input type="button" value="Buscar" name="Buscar" id="Buscar" onclick="buscar_partido();"></td>
		 	<td align="center"><input type="submit" value="Actualizar" name="Actualizar"></td>
		 	<td align="center"><input type="button" value="Cancelar" name="Cancelar" id="Cancelar" onclick="limpiar_pantalla();" /></td>
		 </tr>

		 
		 <tr>
		 	<td colspan="2" align="center"><?php echo $partido->mensaje;?></td>
		 </tr>



	</table>

</form>

</body>
</html>