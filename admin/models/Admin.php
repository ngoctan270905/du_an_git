<?php
class Admin {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllAdmins() {
        $sql = "SELECT * FROM admins ORDER BY id DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAdminById($id) {
        $sql = "SELECT * FROM admins WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAdminByUsername($username) {
        $sql = "SELECT * FROM admins WHERE username = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addAdmin($username, $password, $email) {
        try {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO admins (username, password, email) VALUES (?, ?, ?)";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([$username, $hashed_password, $email]);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function updateAdmin($id, $username, $email, $password = null) {
        try {
            if ($password) {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $sql = "UPDATE admins SET username = ?, email = ?, password = ? WHERE id = ?";
                $stmt = $this->db->prepare($sql);
                $result = $stmt->execute([$username, $email, $hashed_password, $id]);
            } else {
                $sql = "UPDATE admins SET username = ?, email = ? WHERE id = ?";
                $stmt = $this->db->prepare($sql);
                $result = $stmt->execute([$username, $email, $id]);
            }
    
            if ($result) {
                error_log("Cập nhật admin thành công: ID $id, Username: $username, Email: $email");
            } else {
                error_log("Cập nhật admin thất bại: ID $id, Username: $username, Email: $email");
            }
    
            return $result;
        } catch (PDOException $e) {
            error_log("Lỗi SQL khi cập nhật admin: " . $e->getMessage());
            return false;
        }
    }
    

    public function deleteAdmin($id) {
        try {
            $sql = "DELETE FROM admins WHERE id = ?";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function login($username, $password) {
        $admin = $this->getAdminByUsername($username);
        if ($admin && password_verify($password, $admin['password'])) {
            return $admin;
        }
        return false;
    }

    public function getTotalAdmins() {
        $sql = "SELECT COUNT(*) as total FROM admins";
        error_log("Admin SQL: " . $sql);
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        error_log("Admin Result: " . var_export($result, true));
        return $result['total'];
    }

    public function findByUsername($username) {
        $sql = "SELECT * FROM admins WHERE username = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}