<?php

require_once("conexion.php");
include_once("partidos.php");

$partido = new partidos;

if(isset($_GET["equipo"])){


}

?>


<html>
<body>
<form action="">
		<select name="equipo" required="required">
		   		<option disabled selected> -- Seleccione el Equipo a Consultar -- </option>
				<?php $partido->lista_equipos($conexion);?>
		</select>
		&nbsp;
		<input type="submit" value="buscar" name="buscar">

		<br><br>
		<?php $partido->crear_tabla($conexion, $_GET["equipo"]);
				echo $partido->mensaje;
		?>

</form>
</body>
</html>