<?php
require_once './commons/validate.php';

class UserController {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $errors = validateLogin($email, $password);
            
            if (empty($errors)) {
                try {
                    $db = connectDB();
                    $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
                    $stmt->execute([$email]);
                    $user = $stmt->fetch(PDO::FETCH_ASSOC);

                    if ($user && password_verify($password, $user['password'])) {
                        unset($user['password']);
                        $_SESSION['user'] = $user;
                        $_SESSION['success'] = 'Đăng nhập thành công!';
                        header('Location: http://localhost/du_an_git/du_an_git/index.php');
                        exit;
                    } else {
                        $errors['login'] = 'Email hoặc mật khẩu không đúng';
                    }
                } catch (PDOException $e) {
                    $errors['login'] = 'Có lỗi xảy ra, vui lòng thử lại sau';
                }
            }

            $_SESSION['errors'] = $errors;
            $_SESSION['old'] = ['email' => $email];
            header('Location: http://localhost/du_an_git/du_an_git/index.php?act=login');
            exit;
        }

        require_once './views/auth/login.php';
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirm_password = $_POST['confirm_password'] ?? '';

            $errors = validateRegister($name, $email, $password, $confirm_password);
            
            if (empty($errors)) {
                $db = connectDB();
                
                $stmt = $db->prepare("SELECT id FROM users WHERE email = ?");
                $stmt->execute([$email]);
                if ($stmt->fetch()) {
                    $errors['email'] = 'Email đã tồn tại';
                } else {
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                    $stmt = $db->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
                    if ($stmt->execute([$name, $email, $hashed_password])) {
                        $_SESSION['success'] = 'Đăng ký thành công! Vui lòng đăng nhập';
                        header('Location: http://localhost/du_an_git/du_an_git/index.php?act=login');
                        exit;
                    } else {
                        $errors['register'] = 'Có lỗi xảy ra, vui lòng thử lại';
                    }
                }
            }

            $_SESSION['errors'] = $errors;
            $_SESSION['old'] = [
                'name' => $name,
                'email' => $email
            ];
            header('Location: http://localhost/du_an_git/du_an_git/index.php?act=register');
            exit;
        }

        require_once './views/auth/register.php';
    }

    public function logout() {
        session_destroy();
        $_SESSION['success'] = 'Đăng xuất thành công!';
        header('Location: http://localhost/du_an_git/du_an_git/index.php');
        exit;
    }
} 