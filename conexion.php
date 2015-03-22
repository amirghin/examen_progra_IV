<?php
$servername = "127.0.0.1";
$username = "root";
$db = "campeonato";

$conexion = mysqli_connect($servername, $username, "", $db);

if (!$conexion) {
    die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully";
?>