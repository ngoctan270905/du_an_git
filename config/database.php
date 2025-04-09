<?php
class Database {
    private $host = "localhost";
    private $db_name = "agile";
    private $username = "root";
    private $password = "";

    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Lỗi kết nối: " . $exception->getMessage();
        }
        return $this->conn;
    }
}

$db = (new Database())->getConnection();
if (!$db) {
    die("Không thể kết nối đến cơ sở dữ liệu.");
}

// $query = $db->query("SHOW TABLES");
// $tables = $query->fetchAll(PDO::FETCH_COLUMN);
// foreach ($tables as $table) {
//     echo $table . "<br>";
// }

// $db->exec("
// CREATE TABLE users (
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     username VARCHAR(50) NOT NULL UNIQUE,
//     password VARCHAR(255) NOT NULL,
//     fullname VARCHAR(100) NOT NULL,
//     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
// );
// ");
?>