<?php
require_once 'models/Category.php';
require_once 'models/Product.php';
require_once 'models/Admin.php';
require_once 'models/Client.php';

class DashboardController {
    private $conn;
    private $categoryModel;
    private $productModel;
    private $adminModel;
    private $clientModel;

    public function __construct($db) {
        $this->conn = $db;
        $this->categoryModel = new Category($db);
        $this->productModel = new Product($db);
        $this->adminModel = new Admin($db);
        $this->clientModel = new Client($db);
    }

    public function index() {
        // Check admin session
        if (!isset($_SESSION['admin'])) {
            header('Location: index.php?act=login');
            exit();
        }

        // Get statistics
        $totalCategories = $this->categoryModel->getTotalCategories();
        $totalProducts = $this->productModel->getTotalProducts();
        $totalAdmins = $this->adminModel->getTotalAdmins();
        $totalClients = $this->clientModel->getTotalClients();
        $totalAccounts = $totalAdmins + $totalClients;

        // Debug statistics
        error_log("Debug Statistics:");
        error_log("Total Categories: " . var_export($totalCategories, true));
        error_log("Total Products: " . var_export($totalProducts, true));
        error_log("Total Admins: " . var_export($totalAdmins, true));
        error_log("Total Clients: " . var_export($totalClients, true));
        error_log("Total Accounts: " . var_export($totalAccounts, true));

        // Get recent activities
        $recentActivities = $this->getRecentActivities();

        // Load dashboard view
        require_once 'views/dashboard.php';
    }

    private function getRecentActivities() {
        // This is a placeholder for recent activities
        // In a real application, you would fetch this from a database
        return [
            [
                'created_at' => date('Y-m-d H:i:s'),
                'action' => 'Đăng nhập',
                'details' => 'Admin đã đăng nhập vào hệ thống'
            ],
            [
                'created_at' => date('Y-m-d H:i:s', strtotime('-1 hour')),
                'action' => 'Thêm sản phẩm',
                'details' => 'Thêm sản phẩm mới: iPhone 13'
            ],
            [
                'created_at' => date('Y-m-d H:i:s', strtotime('-2 hours')),
                'action' => 'Cập nhật danh mục',
                'details' => 'Cập nhật thông tin danh mục: Điện thoại'
            ]
        ];
    }
}