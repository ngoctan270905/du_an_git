<?php
require_once 'models/User.php';

class AuthController {
    private $user;

    public function __construct($db) {
        $this->user = new User($db);
    }

    public function login() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->user->email = $_POST['email'];
            $this->user->password = $_POST['password'];

            if ($this->user->login()) {
                $_SESSION['user'] = [
                    'id' => $this->user->id,
                    'username' => $this->user->username,
                    'fullname' => $this->user->fullname,
                    'email' => $this->user->email
                ];
                $_SESSION['success'] = "Đăng nhập thành công!";
                header("Location: index.php");
                exit();
            } else {
                $_SESSION['errors'] = "Tên đăng nhập hoặc mật khẩu không chính xác!";
            }
        }
        require_once 'views/auth/login.php';
    }

    public function register() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->user->username = $_POST['username'];
            $this->user->password = $_POST['password'];
            $this->user->fullname = $_POST['fullname'];
            $this->user->email = $_POST['email'];

            if (strlen($this->user->password) < 6) {
                $_SESSION['errors'] = "Mật khẩu phải có ít nhất 6 ký tự!";
            }

            else if ($this->user->checkUsernameExists()) {
                $_SESSION['errors'] = "Tên đăng nhập đã tồn tại!";
            }

            else if ($this->user->checkEmailExists()) {
                $_SESSION['errors'] = "Email đã được sử dụng!";
            }
            
            else {
                if ($this->user->register()) {
                    $_SESSION['success'] = "Đăng ký thành công! Vui lòng đăng nhập.";
                    header("Location: index.php?act=login");
                    exit();
                } else {
                    $_SESSION['errors'] = "Đã xảy ra lỗi. Vui lòng thử lại!";
                }
            }
        }
        require_once 'views/auth/register.php';
    }

    public function logout() {
        $username = $_SESSION['user']['fullname'];
        unset($_SESSION['user']);
        $_SESSION['success'] = "Tạm biệt " . $username . "! Đăng xuất thành công.";
        header("Location: index.php");
        exit();
    }
} 