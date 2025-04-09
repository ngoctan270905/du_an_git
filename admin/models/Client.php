<?php
class Client {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAllClients() {
        $sql = "SELECT * FROM clients ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getClientById($id) {
        $sql = "SELECT * FROM clients WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getClientByUsername($username) {
        $sql = "SELECT * FROM clients WHERE username = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addClient($username, $password, $email, $full_name, $phone, $address) {
        try {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO clients (username, password, email, full_name, phone, address) 
                    VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([$username, $hashed_password, $email, $full_name, $phone, $address]);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function updateClient($id, $username, $password, $email, $full_name, $phone, $address) {
        try {
            if ($password) {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $sql = "UPDATE clients 
                        SET username = ?, password = ?, email = ?, full_name = ?, phone = ?, address = ? 
                        WHERE id = ?";
                $stmt = $this->conn->prepare($sql);
                return $stmt->execute([$username, $hashed_password, $email, $full_name, $phone, $address, $id]);
            } else {
                $sql = "UPDATE clients 
                        SET username = ?, email = ?, full_name = ?, phone = ?, address = ? 
                        WHERE id = ?";
                $stmt = $this->conn->prepare($sql);
                return $stmt->execute([$username, $email, $full_name, $phone, $address, $id]);
            }
        } catch (PDOException $e) {
            return false;
        }
    }

    public function deleteClient($id) {
        try {
            $sql = "DELETE FROM clients WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function login($username, $password) {
        $client = $this->getClientByUsername($username);
        if ($client && password_verify($password, $client['password'])) {
            return $client;
        }
        return false;
    }

    public function getTotalClients() {
        $sql = "SELECT COUNT(*) as total FROM clients";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }
}