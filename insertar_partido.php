<?php


require_once("conexion.php");
include_once("partidos.php");

$partido = new partidos;

if(isset($_POST["jornada"], $_POST["equipo_local"], $_POST["equipo_visita"], $_POST["fecha_partido"], $_POST["hora_partido"])){

	if($_POST["equipo_local"] != $_POST["equipo_visita"]){

			$hora_permitida = $partido->hora_permitida($_POST["hora_partido"]);
			$tiempo_entre_partidos = $partido->tiempo_entre_partidos($conexion, $_POST["fecha_partido"], $_POST["hora_partido"]);
			$cantidad_partidos = $partido->cantidad_partidos($conexion, $_POST["fecha_partido"]);
			
			if($hora_permitida == "S" AND $tiempo_entre_partidos == "S" AND $cantidad_partidos){
				
				$partido->insertar_partido($conexion, $_POST["jornada"], $_POST["equipo_local"], $_POST["equipo_visita"], $_POST["goles_local"], $_POST["goles_visita"], $_POST["fecha_partido"], $_POST["hora_partido"]);
			
			}elseif ($hora_permitida ==	"N"){
				$partido->mensaje =  "El horario del partido no esta en el rango horario permitido";
			}elseif ($tiempo_entre_partidos == "N"){

				$partido->mensaje = "Necesita existir por lo menos dos horas entre partidos";
			}


	}else{

		$partido->mensaje = "No se puede seleccionar el mismo equipo como local y visita";
	}
	
}


?>



<html>
<body>
<form action="" method="POST">
	<table style="width:10%" align="left">
		 <tr>
		   <td>Jornada:</td>
		   <td>
		   		<select name="jornada" required="required">
		   			<option disabled selected> -- Seleccione una Jornada -- </option>
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
		   	<select name="equipo_local" required="required">
		   		<option disabled selected> -- Seleccione el Equipo Local -- </option>
				<?php $partido->lista_equipos($conexion);?>
			</select>
		   </td> 
		 </tr>
		 <tr>
		  <td>Equipo Visita:</td>
		  <td>
		  	<select name="equipo_visita" required="required">
		  		<option disabled selected> -- Seleccione el Equipo Visita -- </option>
				<?php $partido->lista_equipos($conexion);?>
			</select>
		  </td>
		 </tr>

		 <tr>
		  <td>Goles Local:</td>
		  <td><input type="number" name="goles_local" min="0" max="30"></td>
		 </tr>

		 <tr>
		  <td>Goles Visita:</td>
		  <td><input type="number" name="goles_visita" min="0" max="30"></td>
		 </tr>

		 <tr>
		  <td>Fecha Partido:</td>
		  <td><input type="date" required="required" name="fecha_partido" value="<?php echo date("Y-m-d");?>"></td>
		 </tr>


		 <tr>
		  <td>Hora Partido:</td>
		  <td><input type="time" name="hora_partido"  required="required" step="1" value="09:00:00" min="09:00:00" max="20:00:00"></td>


		 </tr>

		 <tr>
		 	<td colspan="2" align="center"><input type="submit" value="insertar" name="insertar"></td>
		 </tr>

		 <tr>
		 	<td colspan="2" align="center"><?php echo $partido->mensaje;?></td>
		 </tr>



	</table>


</form>

</body>
</html>
