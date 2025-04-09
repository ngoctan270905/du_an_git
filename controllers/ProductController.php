<?php
class ProductController {
    public function detail() {
        $id = $_GET['id'] ?? 0;
        
        // Lấy thông tin sản phẩm từ database
        $db = connectDB();
        $stmt = $db->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$id]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$product) {
            header('Location: index.php');
            exit;
        }

        // Lấy danh mục sản phẩm
        $stmt = $db->prepare("SELECT name FROM categories WHERE id = ?");
        $stmt->execute([$product['category_id']]);
        $category = $stmt->fetch(PDO::FETCH_ASSOC);

        // Lấy sản phẩm liên quan
        $stmt = $db->prepare("SELECT * FROM products WHERE category_id = ? AND id != ? LIMIT 4");
        $stmt->execute([$product['category_id'], $id]);
        $related_products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        require_once './views/product/detail.php';
    }
} 