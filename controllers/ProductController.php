<?php
// controllers/ProductController.php
require_once 'commons/env.php';
require_once 'commons/function.php';

class ProductController {
    private $db;

    public function __construct() {
        $this->db = connectDB();
    }

    public function detail() {
        // Lấy ID sản phẩm từ query string
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

        // Truy vấn lấy thông tin sản phẩm
        $query = "SELECT p.*, c.name as category_name 
                  FROM products p 
                  LEFT JOIN categories c ON p.category_id = c.id 
                  WHERE p.id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$product) {
            die("Sản phẩm không tồn tại!");
        }

        // Load view và truyền dữ liệu
        $data['product'] = $product;
        loadView('product_detail', $data);
    }
}
?>