<?php

require_once("conexion.php");
include_once("partidos.php");

$partido = new partidos;
?>

<!DOCTYPE html>
<html>
<head>

<style>
table {
    border-collapse: collapse;
    width: 50%;
    
}

table, td, th {
    border: 1px solid black;
    text-align: center;
}
</style>

<body>

<form action="" method="POST">
		<select name="equipo" required="required">
		   		<option disabled selected> -- Seleccione el Equipo a Consultar -- </option>
				<?php $partido->lista_equipos($conexion);?>
		</select>
		&nbsp;
		<input type="submit" value="buscar" name="buscar">

		<br><br>
		<?php
		if(isset($_POST["equipo"])){

			$partido->crear_tabla($conexion, $_POST["equipo"]);

		}

		?>
		<?php echo $partido->mensaje;?>

</form>
</body>
</html>