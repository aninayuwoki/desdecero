<?php
require_once '../src/User.php';
include '../templates/header.php';

$user = new User();
$users = $user->readAll();
?>

<h2>User Management</h2>

<a href="create_user.php">Add New User</a>

<table border="1" style="width:100%; margin-top: 20px;">
    <thead>
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
                <td><?php echo htmlspecialchars($u['us_cedula']); ?></td>
                <td><?php echo htmlspecialchars($u['us_apellidos']); ?></td>
                <td><?php echo htmlspecialchars($u['us_nombres']); ?></td>
                <td><?php echo htmlspecialchars($u['us_celular']); ?></td>
                <td><?php echo htmlspecialchars($u['us_correo']); ?></td>
                <td>
                    <a href="edit_user.php?id=<?php echo $u['us_id']; ?>">Edit</a>
                    <a href="delete_user.php?id=<?php echo $u['us_id']; ?>" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include '../templates/footer.php'; ?>
