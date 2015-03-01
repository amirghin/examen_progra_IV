	<table style="width:10%" align="left">
		 <tr>
		   <td>Jornada:</td>
		   <td>
		   		<select name="jornada" required="required" <?php echo $partido->disabled_buscar;?>>
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
		   	<select name="equipo_local" required="required" <?php echo $partido->disabled_buscar;?>>
		   		<option disabled selected> -- Seleccione el Equipo Local -- </option>
				<?php $partido->lista_equipos($conexion);?>
			</select>
		   </td> 
		 </tr>
		 <tr>
		  <td>Equipo Visita:</td>
		  <td>
		  	<select name="equipo_visita" required="required" <?php echo $partido->disabled_buscar;?>>
		  		<option disabled selected> -- Seleccione el Equipo Visita -- </option>
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
		  <td><input type="time" name="hora_partido"  required="required" step="1" value="" min="09:00:00" max="20:00:00"<?php echo $partido->disabled_campos;?> value=<?php echo "\"$partido->hora_partido\"";?> ></td>
		 </tr>
		 <tr>
		 	<td align="center"><input type="submit" value="Buscar" name="Buscar"></td>
		 	<td align="center"><input type="submit" value="Actualizar" name="Actualizar"></td>
		 	<td align="center"><input type="submit" value="Cancelar" name="Cancelar"></td>
		 </tr>

		 
		 <tr>
		 	<td colspan="2" align="center"><?php echo $partido->mensaje;?></td>
		 </tr>



	</table>