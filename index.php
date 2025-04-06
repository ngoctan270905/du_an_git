<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Require file Common
require_once './commons/env.php'; // Khai báo biến môi trường
require_once './commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/HomeController.php';
require_once './controllers/ProductController.php';
require_once './controllers/UserController.php';

// Require toàn bộ file Models

// Route
$act = $_GET['act'] ?? '/';

// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match

match ($act) {
    // Trang chủ
    '/' => (new HomeController())->index(),
    // Sản phẩm
    'product_detail' => (new ProductController())->detail(),
    // Authentication
    'login' => (new UserController())->login(),
    'register' => (new UserController())->register(),
    'logout' => (new UserController())->logout(),
    // Mặc định là trang chủ
    default => (new HomeController())->index(),
};