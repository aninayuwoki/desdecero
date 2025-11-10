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
    <div class="alert alert-danger" role="alert">
        <?php echo $error; ?>
    </div>
<?php endif; ?>

<form action="create_user.php" method="post">
    <div class="mb-3">
        <label for="us_c_dula" class="form-label">Cédula:</label>
        <input type="text" id="us_c_dula" name="us_c_dula" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="us_apellido" class="form-label">Apellidos:</label>
        <input type="text" id="us_apellido" name="us_apellido" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="us_nombre" class="form-label">Nombres:</label>
        <input type="text" id="us_nombre" name="us_nombre" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="us_celular" class="form-label">Celular:</label>
        <input type="text" id="us_celular" name="us_celular" class="form-control">
    </div>
    <div class="mb-3">
        <label for="us_correo" class="form-label">Email:</label>
        <input type="email" id="us_correo" name="us_correo" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password:</label>
        <input type="password" id="password" name="password" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Create User</button>
    <a href="users.php" class="btn btn-secondary">Cancel</a>
</form>

<?php include '../templates/footer.php'; ?>
