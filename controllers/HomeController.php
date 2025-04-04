<?php
// controllers/HomeController.php
require_once 'commons/env.php';
require_once 'commons/function.php';

class HomeController {
    private $db;

    public function __construct() {
        $this->db = connectDB();
    }

    public function index() {
        // Truy vấn lấy danh sách sản phẩm cùng với tên danh mục
        $query = "SELECT p.*, c.name as category_name 
                  FROM products p 
                  LEFT JOIN categories c ON p.category_id = c.id";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Load view và truyền dữ liệu
        $data['products'] = $products;
        loadView('home', $data);
    }
}
?>