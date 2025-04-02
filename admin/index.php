<?php
session_start();

// Define base paths
define('BASE_PATH', dirname(__DIR__));
define('ADMIN_PATH', __DIR__);
define('VIEWS_PATH', ADMIN_PATH . '/views');
define('CONTROLLERS_PATH', ADMIN_PATH . '/controllers');
define('MODELS_PATH', ADMIN_PATH . '/models');
define('COMMONS_PATH', BASE_PATH . '/commons');

// Require common files
require_once COMMONS_PATH . '/env.php';
require_once COMMONS_PATH . '/function.php';

// Debug: Kiểm tra session
error_log("Session tại index.php: " . print_r($_SESSION, true));

// Kết nối database
$db = connectDB();

// Include các file controller
require_once CONTROLLERS_PATH . '/AuthController.php';
require_once CONTROLLERS_PATH . '/DashboardController.php';
require_once CONTROLLERS_PATH . '/CategoryController.php';
require_once CONTROLLERS_PATH . '/ProductController.php';
require_once CONTROLLERS_PATH . '/AccountController.php';
require_once CONTROLLERS_PATH . '/ClientController.php';

// Lấy action từ URL
$act = $_GET['act'] ?? 'login';

// Danh sách các action không cần đăng nhập
$public_actions = ['login', '/'];

// Kiểm tra nếu đã đăng nhập
$is_logged_in = isset($_SESSION['admin']);

// Xử lý chuyển hướng dựa trên trạng thái đăng nhập
if ($is_logged_in) {
    // Nếu đã đăng nhập và truy cập login => chuyển về dashboard
    if ($act === 'login' || $act === '/') {
        error_log("Đã đăng nhập -> Chuyển hướng dashboard");
        header('Location: index.php?act=dashboard');
        exit();
    }
} else {
    // Nếu chưa đăng nhập và không phải trang login => chuyển về login
    if (!in_array($act, $public_actions)) {
        error_log("Chưa đăng nhập -> Chuyển hướng login");
        header('Location: index.php?act=login');
        exit();
    }
}

// Điều hướng bằng match
match ($act) {
    '/' => (new AuthController($db))->login(),
    'login' => (new AuthController($db))->login(),
    'logout' => (new AuthController($db))->logout(),
    'dashboard' => (new DashboardController($db))->index(),

    // Categories
    'category-list' => (new CategoryController($db))->list(),
    'category-add' => (new CategoryController($db))->add(),
    'category-edit' => (new CategoryController($db))->edit(),
    'category-delete' => (new CategoryController($db))->delete(),
    'category-view' => (new CategoryController($db))->view(),

    // Products
    'product-list' => (new ProductController($db))->list(),
    'product-add' => (new ProductController($db))->add(),
    'product-edit' => (new ProductController($db))->edit(),
    'product-delete' => (new ProductController($db))->delete(),
    'product-view' => (new ProductController($db))->view(),

    // Accounts
    
    'account-list-admins' => (new AccountController($db))->listAdmins(),
    'account-list-clients' => (new AccountController($db))->listClients(),
    'account-add-admin' => (new AccountController($db))->addAdmin(),
    'account-add-client' => (new AccountController($db))->addClient(),
    'account-edit-admin' => (new AccountController($db))->editAdmin(),
    'account-delete-admin' => (new AccountController($db))->deleteAdmin(),
    'account-edit-client' => (new AccountController($db))->editClient(),
    'account-delete-client' => (new AccountController($db))->deleteClient(),

    // Clients
    'client-list' => (new ClientController($db))->list(),
    'client-add' => (new ClientController($db))->add(),
    'client-edit' => (new ClientController($db))->edit(),
    'client-delete' => (new ClientController($db))->delete(),

    // Default: Nếu không có action nào phù hợp, quay về login
    default => (new AuthController($db))->login(),
};
