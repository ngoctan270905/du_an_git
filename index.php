<?php
// Require file Common
require_once './commons/env.php'; // Khai báo biến môi trường
require_once './commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/HomeController.php';
require_once './controllers/ProductController.php';

// Require toàn bộ file Models

$act = $_GET['act'] ?? '/';

// Để bảo bớt điều kiện chạy cho từng chức chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match
match ($act) {
    '/' => (new HomeController())->index(),
    'product_detail' => (new ProductController())->detail(),
    default => (new HomeController())->index(), // Mặc định là trang chủ
};
?>