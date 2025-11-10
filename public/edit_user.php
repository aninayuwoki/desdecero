<?php
require_once '../src/User.php';

$id = $_GET['id'] ?? null;
if ($id === null) {
    header('Location: users.php');
    exit;
}

$user = new User();
$userData = $user->findById($id);

if ($userData === false) {
    header('Location: users.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $us_c_dula = $_POST['us_c_dula'] ?? '';
    $us_apellido = $_POST['us_apellido'] ?? '';
    $us_nombre = $_POST['us_nombre'] ?? '';
    $us_celular = $_POST['us_celular'] ?? '';
    $us_correo = $_POST['us_correo'] ?? '';

    if ($user->update($id, $us_c_dula, $us_apellido, $us_nombre, $us_celular, $us_correo)) {
        header('Location: users.php');
        exit;
    } else {
        $error = 'Failed to update user.';
    }
}

include '../templates/header.php';
?>

<h2>Edit User</h2>

<?php if (isset($error)): ?>
    <div class="alert alert-danger" role="alert">
        <?php echo $error; ?>
    </div>
<?php endif; ?>

<form action="edit_user.php?id=<?php echo $id; ?>" method="post">
    <div class="mb-3">
        <label for="us_c_dula" class="form-label">Cédula:</label>
        <input type="text" id="us_c_dula" name="us_c_dula" class="form-control" value="<?php echo htmlspecialchars($userData['us_c_dula']); ?>" required>
    </div>
    <div class="mb-3">
        <label for="us_apellido" class="form-label">Apellidos:</label>
        <input type="text" id="us_apellido" name="us_apellido" class="form-control" value="<?php echo htmlspecialchars($userData['us_apellido']); ?>" required>
    </div>
    <div class="mb-3">
        <label for="us_nombre" class="form-label">Nombres:</label>
        <input type="text" id="us_nombre" name="us_nombre" class="form-control" value="<?php echo htmlspecialchars($userData['us_nombre']); ?>" required>
    </div>
    <div class="mb-3">
        <label for="us_celular" class="form-label">Celular:</label>
        <input type="text" id="us_celular" name="us_celular" class="form-control" value="<?php echo htmlspecialchars($userData['us_celular']); ?>">
    </div>
    <div class="mb-3">
        <label for="us_correo" class="form-label">Email:</label>
        <input type="email" id="us_correo" name="us_correo" class="form-control" value="<?php echo htmlspecialchars($userData['us_correo']); ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Update User</button>
    <a href="users.php" class="btn btn-secondary">Cancel</a>
</form>

<?php include '../templates/footer.php'; ?>
