<?php


require_once("conexion.php");
include_once("partidos.php");

$partido = new partidos;



//Profe, esta seccion es la parte de buscar el partido, por eso va en GET, en el ejemplo que usted nos puso, usted lo hizo asi.
if(isset($_GET["jornada"], $_GET["equipo_local"], $_GET["equipo_visita"])){

	
	$partido->buscar_partido($conexion, $_GET["jornada"], $_GET["equipo_local"], $_GET["equipo_visita"]);
	
}


//Este si va en POST por que es el que borra
if(isset($_POST["hJornada"], $_POST["hLocal"], $_POST["hVisita"])){


		$partido_jugado= $partido->partido_jugado($conexion, $_POST["hJornada"], $_POST["hLocal"], $_POST["hVisita"]);
		


		if($partido_jugado == "N"){

				$partido->eliminar_partido($conexion, $_POST["hJornada"], $_POST["hLocal"], $_POST["hVisita"]);

		}elseif($partido_jugado == "S"){


			$partido->mensaje = "No se puede eliminar un partido que ya se jugo";
		}

}

?>


<html>
<script>
function asignar_variables()
{
   document.getElementById('hJornada').value = document.getElementById('jornada').value;
   document.getElementById('hLocal').value = document.getElementById('equipo_local').value;
   document.getElementById('hVisita').value = document.getElementById('equipo_visita').value;
}
function buscar_partido(){
var jornada = document.getElementById("jornada").value;
var eq_local = document.getElementById("equipo_local").value;
var eq_visita = document.getElementById("equipo_visita").value;


parent.location = 'eliminar_partido.php?jornada='+ jornada + '&equipo_local=' + eq_local + '&equipo_visita=' + eq_visita;
   
} 
function limpiar_pantalla(){
   parent.location='eliminar_partido.php';
}

</script>
<body>
<p id="demo"></p>

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
		  <td><input type="number" name="goles_local" min="0" max="30" disabled value=<?php echo $partido->goles_local;?>></td>
		 </tr>

		 <tr>
		  <td>Goles Visita:</td>
		  <td><input type="number" name="goles_visita" min="0" max="30" disabled value=<?php echo $partido->goles_visita;?>></td>
		 </tr>

		 <tr>
		  <td>Fecha Partido:</td>
		  <td><input type="date" name="fecha_partido" disabled value=<?php echo $partido->fecha_partido;?>></td>
		 </tr>


		 <tr>
		  <td>Hora Partido:</td>
		  <td><input type="time" name="hora_partido"  required="required" step="1" min="09:00:00" max="20:00:00"disabled value=<?php echo $partido->hora_partido;?> ></td>
		 </tr>
		 <tr>
		 	<td align="center"><input type="button" value="Buscar" name="Buscar" id="Buscar" onclick="buscar_partido();"></td>
		 	<td align="center"><input type="submit" value="Eliminar" name="Eliminar" onclick="asignar_variables();"></td>
		 	<td align="center"><input type="button" value="Cancelar" name="Cancelar" id="Cancelar" onclick="limpiar_pantalla();"/></td>
		 	<input type="hidden" name="hJornada" id="hJornada"/>
		 	<input type="hidden" name="hLocal" id="hLocal"/>
		 	<input type="hidden" name="hVisita" id="hVisita"/>
		 </tr>
		 
		 
	
		 
		 <tr>
		 	<td colspan="2" align="center"><?php echo $partido->mensaje;?></td>
		 </tr>



	</table>

</form>

</body>
</html>
