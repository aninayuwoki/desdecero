<?php
require_once 'src/Database.php';

try {
    $db = Database::getInstance()->getConnection();
    $sql = "ALTER TABLE usuario ADD COLUMN password VARCHAR(255) NOT NULL AFTER email";
    $db->exec($sql);
    echo "Table 'usuario' altered successfully. Added 'password' column.\n";
} catch (PDOException $e) {
    echo "Error altering table: " . $e->getMessage() . "\n";
}
