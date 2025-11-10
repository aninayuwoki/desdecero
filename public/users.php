<?php
require_once '../src/User.php';
include '../templates/header.php';

$user = new User();
$users = $user->readAll();
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">User Management</h2>
    <a href="create_user.php" class="btn btn-primary">Add New User</a>
</div>

<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Cédula</th>
                <th>Apellidos</th>
                <th>Nombres</th>
                <th>Celular</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $u): ?>
                <tr>
                    <td><?php echo htmlspecialchars($u['us_id']); ?></td>
                    <td><?php echo htmlspecialchars($u['us_c_dula']); ?></td>
                    <td><?php echo htmlspecialchars($u['us_apellido']); ?></td>
                    <td><?php echo htmlspecialchars($u['us_nombre']); ?></td>
                    <td><?php echo htmlspecialchars($u['us_celular']); ?></td>
                    <td><?php echo htmlspecialchars($u['us_correo']); ?></td>
                    <td>
                        <a href="edit_user.php?id=<?php echo $u['us_id']; ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                        <a href="delete_user.php?id=<?php echo $u['us_id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include '../templates/footer.php'; ?>
