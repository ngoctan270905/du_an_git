<?php
class Category {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAllCategories() {
        $sql = "SELECT * FROM categories ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCategoryById($id) {
        $sql = "SELECT * FROM categories WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addCategory($name, $description) {
        try {
            $sql = "INSERT INTO categories (name, description) VALUES (?, ?)";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([$name, $description]);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function updateCategory($id, $name, $description) {
        try {
            $sql = "UPDATE categories SET name = ?, description = ? WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([$name, $description, $id]);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function deleteCategory($id) {
        try {
            $sql = "DELETE FROM categories WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getProductsByCategory($category_id) {
        $sql = "SELECT * FROM products WHERE category_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$category_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalCategories() {
        $sql = "SELECT COUNT(*) as total FROM categories";
        error_log("Category SQL: " . $sql);
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        error_log("Category Result: " . var_export($result, true));
        return $result['total'];
    }
}