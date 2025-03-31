<?php

// Kết nối CSDL qua PDO
function connectDB() {
    // Kết nối CSDL
    $host = DB_HOST;
    $port = DB_PORT;
    $dbname = DB_NAME;

    try {
        $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname", DB_USERNAME, DB_PASSWORD);

        // cài đặt chế độ báo lỗi là xử lý ngoại lệ
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // cài đặt chế độ trả dữ liệu
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
        return $conn;
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
}

function uploadFile($file, $folderUpdate){
    // Tạo thư mục uploads nếu chưa tồn tại
    $uploadDir = PATH_ROOT . $folderUpdate;
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Tạo tên file duy nhất
    $fileName = time() . '_' . basename($file['name']);
    $pathStorage = $folderUpdate . $fileName;
    $from = $file['tmp_name'];
    $to = PATH_ROOT . $pathStorage;

    // Kiểm tra loại file
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    if (!in_array($file['type'], $allowedTypes)) {
        error_log("Invalid file type: " . $file['type']);
        return null;
    }

    // Kiểm tra kích thước file (tối đa 5MB)
    if ($file['size'] > 5 * 1024 * 1024) {
        error_log("File too large: " . $file['size']);
        return null;
    }

    if(move_uploaded_file($from, $to)){
        return $pathStorage;
    }
    error_log("Failed to move uploaded file from $from to $to");
    return null;
}

function deleteFile($file){
    $pathDelete = PATH_ROOT . $file;
    if(file_exists($pathDelete)){
        unlink($pathDelete);
    }
}

// Hàm kiểm tra đăng nhập admin
function isAdminLoggedIn() {
    return isset($_SESSION['admin']) && !empty($_SESSION['admin']) && isset($_SESSION['admin']['id']);
}

// Hàm lấy thông tin admin đang đăng nhập
function getAdminInfo() {
    return isAdminLoggedIn() ? $_SESSION['admin'] : null;
}

// Hàm lấy ID của admin đang đăng nhập
function getAdminId() {
    return isAdminLoggedIn() ? $_SESSION['admin']['id'] : null;
}

// Hàm lấy username của admin đang đăng nhập
function getAdminUsername() {
    return isAdminLoggedIn() ? $_SESSION['admin']['username'] : null;
}

// Hàm lấy email của admin đang đăng nhập
function getAdminEmail() {
    return isAdminLoggedIn() ? $_SESSION['admin']['email'] : null;
}

// Hàm kiểm tra quyền admin
function requireAdminLogin() {
    if (!isAdminLoggedIn()) {
        // Xóa session nếu không hợp lệ
        session_unset();
        session_destroy();
        header('Location: index.php?act=login');
        exit();
    }
}

// Hàm chuyển hướng nếu đã đăng nhập
function redirectIfLoggedIn() {
    if (isAdminLoggedIn()) {
        header('Location: index.php?act=dashboard');
        exit();
    }
}

// Hàm xóa session
function clearAdminSession() {
    // Xóa tất cả các biến session
    $_SESSION = array();
    
    // Hủy cookie session nếu có
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time()-3600, '/');
    }
    
    // Hủy session
    session_destroy();
    
    // Khởi tạo session mới
    session_start();
}

// Các hàm hỗ trợ
function redirect($url) {
    header("Location: $url");
    exit();
}

function base_url($path = '') {
    return BASE_URL . '/' . $path;
}