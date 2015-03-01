<?php


require_once("conexion.php");
include_once("partidos.php");

$partido = new partidos;

if(isset($_POST["jornada"], $_POST["equipo_local"], $_POST["equipo_visita"])){

		$partido_jugado= $partido->partido_jugado($conexion, $_POST["jornada"], $_POST["equipo_local"], $_POST["equipo_visita"]);


		if($partido_jugado == "N"){

				$partido->eliminar_partido($conexion, $_POST["jornada"], $_POST["equipo_local"], $_POST["equipo_visita"]);

		}else{


			$partido->mensaje = "No se puede eliminar un partido que ya se jugo";
		}

}

?>


<html>

<script>


function limpiar_pantalla(){
   parent.location='eliminar_partido.php';
}

</script>


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
		 	<td align="center"><input type="submit" value="Eliminar" name="Eliminar"></td>
		 	<td align="center"><input type="button" value="Cancelar" name="Cancelar" id="Cancelar" onclick="limpiar_pantalla();" /></td>
		 </tr>
		 <tr>
		 	<td colspan="2" align="center"><?php echo $partido->mensaje;?></td>
		 </tr>


	</table>


</form>

</body>
</html>
