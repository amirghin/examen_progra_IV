<?php

require_once("conexion.php");
include_once("partidos.php");

$partido = new partidos;

if(isset($_POST["equipo"])){


}

?>


<html>
<head>
<body>

<form action="" method="POST">
		<select name="equipo" required="required">
		   		<option disabled selected> -- Seleccione el Equipo a Consultar -- </option>
				<?php $partido->lista_equipos($conexion);?>
		</select>
		&nbsp;
		<input type="submit" value="buscar" name="buscar">

		<br><br>
		<?php $partido->crear_tabla($conexion, $_POST["equipo"]);
		echo $partido->mensaje;
		?>

</form>
</body>
</html>