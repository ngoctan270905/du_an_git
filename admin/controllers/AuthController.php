<?php
require_once 'models/Admin.php';

class AuthController {
    private $db;
    private $adminModel;

    public function __construct($db) {
        $this->db = $db;
        $this->adminModel = new Admin($db);
    }

    public function login() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    
        error_log("Login method called. Session status: " . print_r($_SESSION, true));
        
        // Nếu đã đăng nhập, chuyển hướng về dashboard
        if (!empty($_SESSION['admin'])) {
            error_log("User already logged in, redirecting to dashboard");
            header('Location: index.php?act=dashboard');
            exit();
        }
        
        // Chỉ xử lý form đăng nhập
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
    
            error_log("Login attempt for username: " . $username);
            $admin = $this->adminModel->findByUsername($username);
    
            if ($admin && password_verify($password, $admin['password'])) {
                $_SESSION['admin'] = [
                    'id' => $admin['id'],
                    'username' => $admin['username'],
                    'email' => $admin['email']
                ];
                error_log("Login successful, redirecting to dashboard");
                header('Location: index.php?act=dashboard');
                exit();
            } else {
                $error = 'Username hoặc password không đúng';
                error_log("Login failed: Invalid credentials");
            }
        }
    
        require_once 'views/auth/login.php';
    }
    

    public function logout() {
        session_start(); // Đảm bảo session luôn hoạt động

        // Xóa session
        error_log("Đăng xuất -> Xóa session");
        unset($_SESSION['admin']);
        session_destroy();

        // Chuyển hướng về login
        header('Location: index.php?act=login');
        exit();
    }
}
