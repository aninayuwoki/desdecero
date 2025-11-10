<?php
require_once '../src/User.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $us_c_dula = $_POST['us_c_dula'] ?? '';
    $us_apellido = $_POST['us_apellido'] ?? '';
    $us_nombre = $_POST['us_nombre'] ?? '';
    $us_celular = $_POST['us_celular'] ?? '';
    $us_correo = $_POST['us_correo'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($us_c_dula) || empty($us_apellido) || empty($us_nombre) || empty($us_correo) || empty($password)) {
        $error = 'Please fill in all required fields.';
    } else {
        $user = new User();
        if ($user->create($us_c_dula, $us_apellido, $us_nombre, $us_celular, $us_correo, $password)) {
            header('Location: users.php');
            exit;
        } else {
            $error = 'Failed to create user.';
        }
    }
}

include '../templates/header.php';
?>

<h2>Add New User</h2>

<?php if ($error): ?>
    <p style="color:red;"><?php echo $error; ?></p>
<?php endif; ?>

<form action="create_user.php" method="post">
    <div style="margin-bottom: 10px;">
        <label>Cédula:</label><br>
        <input type="text" name="us_c_dula" required>
    </div>
    <div style="margin-bottom: 10px;">
        <label>Apellidos:</label><br>
        <input type="text" name="us_apellido" required>
    </div>
    <div style="margin-bottom: 10px;">
        <label>Nombres:</label><br>
        <input type="text" name="us_nombre" required>
    </div>
    <div style="margin-bottom: 10px;">
        <label>Celular:</label><br>
        <input type="text" name="us_celular">
    </div>
    <div style="margin-bottom: 10px;">
        <label>Email:</label><br>
        <input type="email" name="us_correo" required>
    </div>
    <div style="margin-bottom: 10px;">
        <label>Password:</label><br>
        <input type="password" name="password" required>
    </div>
    <button type="submit">Create User</button>
</form>

<?php include '../templates/footer.php'; ?>
