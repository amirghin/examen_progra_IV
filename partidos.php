<?php
class partidos{



public $mensaje = "";


function cantidad_partidos($con, $fecha){
	try{
		$query = "SELECT * FROM partidos WHERE fecha_partido='{$fecha}'";
		$resultado = mysqli_query($con, $query);
		$cant_juegos =  mysqli_num_rows($resultado);
		
		if ($cant_juegos <= 5){
				return $cant_juegos;
		}else{

			throw new Exception("No se pueden ingresar mas de 5 juegos por dia");
		}


	}catch (Exception $e){
			 $this->$mensaje = $e->GetMessage();
	}

}

function hora_permitida($hora){


	if ($hora >= "09:00:00" AND $hora <= "20:00:00"){

			return "S";

		}else{
			return "N";

		}
}


function tiempo_entre_partidos($con, $fecha, $hora){

	

	try{

		$query = "SELECT * FROM partidos WHERE fecha_partido='{$fecha}' AND hora_partido BETWEEN SUBTIME('{$hora}', '01:59:00') AND ADDTIME('{$hora}', '01:59:00')";
		$resultado = mysqli_query($con, $query);
		$cant_juegos =  mysqli_num_rows($resultado);

		if($cant_juegos	> 0){

				return "N";

		}else{

			return "S";
		}


	}catch (Exception $e){
			 $this->$mensaje = $e->GetMessage();
	}

		

}


function partido_jugado($con, $jornada, $local, $visita){


try{

	$query = "SELECT * FROM partidos WHERE jornada='{$jornada}' AND codigo_equipo_local={$local} AND codigo_equipo_visita={$visita} AND goles_local IS NULL AND goles_visita IS NULL";
	$resultado = mysqli_query($con, $query);

	if($cant_juegos	> 0){

		return "N";

	}else{

		return "S";
	}



}catch(Exception $e){
			 $this->$mensaje = $e->GetMessage();



}

}


function lista_equipos($con){

try{
	$query = "SELECT * FROM equipos";
	$equipos = mysqli_query($con, $query);
	while($row = mysqli_fetch_assoc($equipos)){
	
		echo "<option value=\"{$row["codigo_equipo"]}\">{$row["nombre"]}</option>";
	}
}catch(Exception $e){
			$this->$mensaje = $e->GetMessage();



}
}

function insertar_partido($con, $jornada, $local, $visita, $goles_local, $goles_visita, $fecha, $hora){

	if(trim($goles_local)==""){
		$goles_local = 'NULL';	
	}

	if(trim($goles_visita)==""){
		$goles_visita = 'NULL';	
	}


	try{
		$insert = "INSERT INTO partidos (jornada, codigo_equipo_local, codigo_equipo_visita, goles_local, goles_visita, fecha_partido, hora_partido, usuario_creacion, fecha_creacion)
		           VALUES ({$jornada}, '{$local}', '{$visita}', {$goles_local}, {$goles_visita}, '{$fecha}', '{$hora}', 'system', CURDATE())";	

		$resultado = mysqli_query($con, $insert);

		if(!$resultado){

			throw new Exception("Error al insertar juego");
		}else{

			$this->mensaje = "Se inserto con exito el juego";
		}
			
	}catch(Exception $e){
		$this->$mensaje = $e->GetMessage();

	}
}
		
function crear_tabla($con, $equipo){

	try{

			$query = "SELECT pt.codigo_equipo_local AS 'Codigo_Equipo', eq.nombre AS 'Nombre_Equipo', pt.jornada AS 'Numero de jornada', fecha_partido AS 'Fecha del partido',
						pt.codigo_equipo_visita AS 'Codigo_Equipo_Rival',(SELECT nombre FROM equipos WHERE codigo_equipo=pt.codigo_equipo_visita) AS 'Nombre_Equipo_Rival',
						CONCAT_WS(':', goles_local, goles_visita) AS Marcador
						FROM equipos eq, partidos pt
						WHERE pt.codigo_equipo_local={$equipo} AND eq.codigo_equipo=pt.codigo_equipo_local
						UNION
					SELECT pt.codigo_equipo_visita AS 'Codigo_Equipo', eq.nombre AS 'Nombre_Equipo', pt.jornada AS 'Numero de jornada', fecha_partido AS 'Fecha del partido',
					pt.codigo_equipo_local AS 'Codigo_Equipo_Rival', (SELECT nombre FROM equipos WHERE codigo_equipo=pt.codigo_equipo_local) AS 'Nombre_Equipo_Rival',
					CONCAT_WS(':', goles_visita, goles_local) AS Marcador
					FROM equipos eq, partidos pt
					WHERE pt.codigo_equipo_visita={$equipo} AND eq.codigo_equipo=pt.codigo_equipo_visita";
			$resultado = mysqli_query($con, $query);

			if(!$resultado){
				throw new Exception("Error de conexion");

			}else{
				if(mysqli_num_rows($resultado) > 0){	
					echo "<table>";
					echo "<tr>
							<th>Codigo_Equipo</th>
							<th>Nombre_Equipo</th>
							<th>Numero de jornada</th>
							<th>Fecha del partido</th>
							<th>Codigo_Equipo_Rival</th>
							<th>Nombre_Equipo_Rival</th>
							<th>Marcador</th>
						  </tr>";
					while($row = mysqli_fetch_assoc($resultado)){
					
					echo "<tr>";
					echo "<td>{$row["Codigo_Equipo"]}</td>";
					echo "<td>{$row["Nombre_Equipo"]}</td>";
					echo "<td>{$row["Numero de jornada"]}</td>";
					echo "<td>{$row["Fecha del partido"]}</td>";
					echo "<td>{$row["Codigo_Equipo_Rival"]}</td>";
					echo "<td>{$row["Nombre_Equipo_Rival"]}</td>";
					echo "<td>{$row["Marcador"]}</td>";
					echo "</tr>";
					}
					echo "</table>";
				}else{

					$this->mensaje = "No se encontraron registros para el equipo seleccionado";
				}

			}

	}catch(Exception $e){

		$this->$mensaje = $e->GetMessage();

	}




}


}



?>