<?php
require_once '../src/User.php';

$id = $_GET['id'] ?? null;

if ($id !== null) {
    $user = new User();
    $user->delete($id);
}

header('Location: users.php');
exit;
