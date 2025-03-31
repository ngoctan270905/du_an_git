<?php
class Product {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAllProducts() {
        $sql = "SELECT p.*, c.name as category_name 
                FROM products p 
                LEFT JOIN categories c ON p.category_id = c.id 
                ORDER BY p.id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductById($id) {
        $sql = "SELECT p.*, c.name as category_name 
                FROM products p 
                LEFT JOIN categories c ON p.category_id = c.id 
                WHERE p.id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addProduct($name, $description, $price, $discount_price, $image, $category_id, $import_date, $stock_quantity) {
        try {
            $sql = "INSERT INTO products (name, description, price, discount_price, image, category_id, import_date, stock_quantity) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([$name, $description, $price, $discount_price, $image, $category_id, $import_date, $stock_quantity]);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function updateProduct($id, $name, $description, $price, $discount_price, $image, $category_id, $import_date, $stock_quantity) {
        try {
            $sql = "UPDATE products 
                    SET name = ?, description = ?, price = ?, discount_price = ?, 
                        image = ?, category_id = ?, import_date = ?, stock_quantity = ? 
                    WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([$name, $description, $price, $discount_price, 
                                 $image, $category_id, $import_date, $stock_quantity, $id]);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function deleteProduct($id) {
        try {
            $sql = "DELETE FROM products WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getTotalProducts() {
        $sql = "SELECT COUNT(*) as total FROM products";
        error_log("Product SQL: " . $sql);
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        error_log("Product Result: " . var_export($result, true));
        return $result['total'];
    }

    public function getProductsByCategory($categoryId) {
        $sql = "SELECT * FROM products WHERE category_id = ? ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$categoryId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}