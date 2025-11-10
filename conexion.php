<?php
$host = "localhost";
$port = 3306;
$user = "root";
$password = "147258";  // Vacío, como indicas
$dbname = "pruebas";

$con = new mysqli($host, $user, $password, $dbname, $port);

if ($con->connect_error) {
    die("Error de conexión: " . $con->connect_error);
}
?>