<?php
session_start();

require_once '../src/User.php';

// If the user is already logged in, redirect to the dashboard
if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit;
}

$error = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $us_correo = $_POST['us_correo'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($us_correo) || empty($password)) {
        $error = 'Please fill in all fields.';
    } else {
        $user = new User();
        $loggedInUser = $user->login($us_correo, $password);

        if ($loggedInUser) {
            // Store user data in session
            $_SESSION['user_id'] = $loggedInUser['us_id'];
            $_SESSION['user_name'] = $loggedInUser['us_nombres'];

            // Redirect to a protected page
            header('Location: dashboard.php');
            exit;
        } else {
            $error = 'Invalid credentials. Please try again.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Add basic styling -->
    <style>
        body { font-family: sans-serif; }
        .container { max-width: 400px; margin: 50px auto; padding: 20px; border: 1px solid #ccc; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; }
        .form-group input { width: 100%; padding: 8px; }
        .error { color: red; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <?php if ($error): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <form action="login.php" method="post">
            <div class="form-group">
                <label for="us_correo">Email:</label>
                <input type="email" id="us_correo" name="us_correo" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
