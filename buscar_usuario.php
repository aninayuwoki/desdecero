<?php
include 'conexion.php';

$cedula = $_GET['cedula'];

$sql = "SELECT * FROM usuario WHERE cedula = '$cedula'";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "ID: " . $row["id"] . "<br>";
        echo "Cédula: " . $row["cedula"] . "<br>";
        echo "Apellidos: " . $row["apellidos"] . "<br>";
        echo "Nombres: " . $row["nombres"] . "<br>";
        echo "Celular: " . $row["celular"] . "<br>";
        echo "Email: " . $row["email"] . "<br>";
    }
} else {
    echo "No se encontró el usuario.";
}

echo "<a href='index.php'>Volver</a>";
$con->close();
?>