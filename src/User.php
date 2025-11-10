<?php

require_once 'Database.php';

class User {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    // Create a new user
    public function create($us_c_dula, $us_apellidos, $us_nombres, $us_celular, $us_correo, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuario (us_c_dula, us_apellidos, us_nombres, us_celular, us_correo, password) VALUES (:us_c_dula, :us_apellidos, :us_nombres, :us_celular, :us_correo, :password)";

        try {
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':us_c_dula', $us_c_dula);
            $stmt->bindParam(':us_apellidos', $us_apellidos);
            $stmt->bindParam(':us_nombres', $us_nombres);
            $stmt->bindParam(':us_celular', $us_celular);
            $stmt->bindParam(':us_correo', $us_correo);
            $stmt->bindParam(':password', $hashedPassword);
            return $stmt->execute();
        } catch (PDOException $e) {
            // In a real app, log this error
            return false;
        }
    }

    // Read all users
    public function readAll() {
        $sql = "SELECT us_id, us_c_dula, us_apellidos, us_nombres, us_celular, us_correo FROM usuario";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    // Find a user by ID
    public function findById($id) {
        $sql = "SELECT us_id, us_c_dula, us_apellidos, us_nombres, us_celular, us_correo FROM usuario WHERE us_id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    // Update a user
    public function update($id, $us_c_dula, $us_apellidos, $us_nombres, $us_celular, $us_correo) {
        $sql = "UPDATE usuario SET us_c_dula = :us_c_dula, us_apellidos = :us_apellidos, us_nombres = :us_nombres, us_celular = :us_celular, us_correo = :us_correo WHERE us_id = :id";

        try {
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':us_c_dula', $us_c_dula);
            $stmt->bindParam(':us_apellidos', $us_apellidos);
            $stmt->bindParam(':us_nombres', $us_nombres);
            $stmt->bindParam(':us_celular', $us_celular);
            $stmt->bindParam(':us_correo', $us_correo);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    // Delete a user
    public function delete($id) {
        $sql = "DELETE FROM usuario WHERE us_id = :id";
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    // User login
    public function login($us_correo, $password) {
        $sql = "SELECT * FROM usuario WHERE us_correo = :us_correo";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':us_correo', $us_correo);
        $stmt->execute();

        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            // Password is correct
            unset($user['password']); // Don't expose password hash
            return $user;
        } else {
            // Wrong email or password
            return false;
        }
    }
}
