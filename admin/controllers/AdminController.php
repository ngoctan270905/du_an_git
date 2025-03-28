<?php
class AdminController {
    private $conn;
    private $adminModel;

    public function __construct() {
        $this->conn = connectDB();
        $this->adminModel = new Admin($this->conn);
    }

    public function list() {
        if (!isset($_SESSION['admin'])) {
            header('Location: index.php?act=login');
            exit;
        }
        $admins = $this->adminModel->getAllAdmins();
        require_once 'views/admin/list.php';
    }

    public function add() {
        if (!isset($_SESSION['admin'])) {
            header('Location: index.php?act=login');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $email = $_POST['email'];

            if ($this->adminModel->addAdmin($username, $password, $email)) {
                header('Location: index.php?act=admin-list');
                exit;
            } else {
                $error = "Thêm admin thất bại!";
            }
        }
        require_once 'views/admin/add.php';
    }

    public function edit() {
        if (!isset($_SESSION['admin'])) {
            header('Location: index.php?act=login');
            exit;
        }
        $id = $_GET['id'] ?? 0;
        $admin = $this->adminModel->getAdminById($id);
        if (!$admin) {
            header('Location: index.php?act=admin-list');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = !empty($_POST['password']) ? $_POST['password'] : null;

            if ($this->adminModel->updateAdmin($id, $username, $password, $email)) {
                header('Location: index.php?act=admin-list');
                exit;
            } else {
                $error = "Cập nhật admin thất bại!";
            }
        }
        require_once 'views/admin/edit.php';
    }

    public function delete() {
        if (!isset($_SESSION['admin'])) {
            header('Location: index.php?act=login');
            exit;
        }
        $id = $_GET['id'] ?? 0;
        if ($this->adminModel->deleteAdmin($id)) {
            header('Location: index.php?act=admin-list');
            exit;
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $admin = $this->adminModel->login($username, $password);
            if ($admin) {
                $_SESSION['admin'] = $admin;
                header('Location: index.php?act=dashboard');
                exit;
            } else {
                $error = "Tên đăng nhập hoặc mật khẩu không đúng!";
            }
        }
        require_once 'views/auth/login.php';
    }

    public function logout() {
        session_destroy();
        header('Location: index.php?act=login');
        exit;
    }
} 