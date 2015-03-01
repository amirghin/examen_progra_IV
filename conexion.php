<?php
$servername = "localhost";
$username = "root";
$db = "campeonato";

$conexion = mysqli_connect($servername, $username, "", $db);

if (!$conexion) {
    die("Connection failed: " . mysqli_connect_error());
}
/*echo "Connected successfully";*/
?>