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
    $us_apellidos = $_POST['us_apellidos'] ?? '';
    $us_nombres = $_POST['us_nombres'] ?? '';
    $us_celular = $_POST['us_celular'] ?? '';
    $us_correo = $_POST['us_correo'] ?? '';

    if ($user->update($id, $us_c_dula, $us_apellidos, $us_nombres, $us_celular, $us_correo)) {
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
    <p style="color:red;"><?php echo $error; ?></p>
<?php endif; ?>

<form action="edit_user.php?id=<?php echo $id; ?>" method="post">
    <div style="margin-bottom: 10px;">
        <label>Cédula:</label><br>
        <input type="text" name="us_c_dula" value="<?php echo htmlspecialchars($userData['us_c_dula']); ?>" required>
    </div>
    <div style="margin-bottom: 10px;">
        <label>Apellidos:</label><br>
        <input type="text" name="us_apellidos" value="<?php echo htmlspecialchars($userData['us_apellidos']); ?>" required>
    </div>
    <div style="margin-bottom: 10px;">
        <label>Nombres:</label><br>
        <input type="text" name="us_nombres" value="<?php echo htmlspecialchars($userData['us_nombres']); ?>" required>
    </div>
    <div style="margin-bottom: 10px;">
        <label>Celular:</label><br>
        <input type="text" name="us_celular" value="<?php echo htmlspecialchars($userData['us_celular']); ?>">
    </div>
    <div style="margin-bottom: 10px;">
        <label>Email:</label><br>
        <input type="email" name="us_correo" value="<?php echo htmlspecialchars($userData['us_correo']); ?>" required>
    </div>
    <button type="submit">Update User</button>
</form>

<?php include '../templates/footer.php'; ?>
