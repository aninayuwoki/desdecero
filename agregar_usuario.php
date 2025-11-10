<?php
include 'conexion.php';

$cedula = $_POST['cedula'];
$apellidos = $_POST['apellidos'];
$nombres = $_POST['nombres'];
$celular = $_POST['celular'];
$email = $_POST['email'];

// Inserta en la tabla (ajusta campos según tu estructura real)
$sql = "INSERT INTO usuario (cedula, apellidos, nombres, celular, email) VALUES ('$cedula', '$apellidos', '$nombres', '$celular', '$email')";

if ($con->query($sql) === TRUE) {
    echo "Usuario agregado exitosamente. <a href='index.php'>Volver</a>";
} else {
    echo "Error: " . $sql . "<br>" . $con->error;
}

$con->close();
?>