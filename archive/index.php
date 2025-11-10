<?php include 'conexion.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Plataforma Pruebas</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Bienvenido a la Plataforma Pruebas</h1>
    
    <h2>Lista de Cantones</h2>
    <?php
    $sql_cantones = "SELECT id, can_nombre, pr_id FROM canton LIMIT 10";  // Limitado para ejemplo
    $result_cantones = $con->query($sql_cantones);
    if ($result_cantones->num_rows > 0) {
        echo "<table><tr><th>ID</th><th>Nombre</th><th>Provincia ID</th></tr>";
        while($row = $result_cantones->fetch_assoc()) {
            echo "<tr><td>".$row["id"]."</td><td>".$row["can_nombre"]."</td><td>".$row["pr_id"]."</td></tr>";
        }
        echo "</table>";
    } else {
        echo "No hay cantones.";
    }
    ?>
    
    <h2>Lista de Usuarios</h2>
    <?php
    $sql_usuarios = "SELECT id, cedula, apellidos, nombres, celular FROM usuario LIMIT 10";  // Limitado
    $result_usuarios = $con->query($sql_usuarios);
    if ($result_usuarios->num_rows > 0) {
        echo "<table><tr><th>ID</th><th>Cédula</th><th>Apellidos</th><th>Nombres</th><th>Celular</th></tr>";
        while($row = $result_usuarios->fetch_assoc()) {
            echo "<tr><td>".$row["id"]."</td><td>".$row["cedula"]."</td><td>".$row["apellidos"]."</td><td>".$row["nombres"]."</td><td>".$row["celular"]."</td></tr>";
        }
        echo "</table>";
    } else {
        echo "No hay usuarios.";
    }
    ?>
    
    <h2>Agregar Nuevo Usuario</h2>
    <form action="agregar_usuario.php" method="POST">
        <label>Cédula:</label> <input type="text" name="cedula" required><br>
        <label>Apellidos:</label> <input type="text" name="apellidos" required><br>
        <label>Nombres:</label> <input type="text" name="nombres" required><br>
        <label>Celular:</label> <input type="text" name="celular"><br>
        <label>Email:</label> <input type="email" name="email"><br>
        <input type="submit" value="Agregar">
    </form>
    
    <h2>Buscar Usuario por Cédula</h2>
    <form action="buscar_usuario.php" method="GET">
        <label>Cédula:</label> <input type="text" name="cedula" required><br>
        <input type="submit" value="Buscar">
    </form>
</body>
</html>
<?php $con->close(); ?>