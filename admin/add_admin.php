<?php
require_once '../commons/env.php';
require_once '../commons/function.php';

$conn = connectDB();

// Tạo tài khoản admin mới
$username = 'admin5';
$password = password_hash('12345', PASSWORD_DEFAULT); // Mật khẩu: 123456
$email = 'admin5@example.com';

$stmt = $conn->prepare("INSERT INTO admins (username, password, email) VALUES (?, ?, ?)");
$stmt->execute([$username, $password, $email]);

echo "Tài khoản admin đã được tạo: Username: admin5, Password: 12345";