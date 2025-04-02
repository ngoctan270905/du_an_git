<?php
class ClientController {
    private $conn;
    private $clientModel;

    public function __construct() {
        $this->conn = connectDB();
        $this->clientModel = new Client($this->conn);
    }

    public function list() {
        if (!isset($_SESSION['admin'])) {
            header('Location: index.php?act=login');
            exit;
        }
        $clients = $this->clientModel->getAllClients();
        require_once 'views/client/list.php';
    }

    public function add() {
        if (!isset($_SESSION['admin'])) {
            if ($this->isAjaxRequest()) {
                echo json_encode(['success' => false, 'message' => 'Phiên đăng nhập đã hết hạn!']);
                exit;
            }
            header('Location: index.php?act=login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $email = $_POST['email'];
            $full_name = $_POST['full_name'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];

            if ($this->clientModel->addClient($username, $password, $email, $full_name, $phone, $address)) {
                if ($this->isAjaxRequest()) {
                    echo json_encode(['success' => true]);
                    exit;
                }
                header('Location: index.php?act=client-list');
                exit;
            } else {
                if ($this->isAjaxRequest()) {
                    echo json_encode(['success' => false, 'message' => 'Thêm khách hàng thất bại!']);
                    exit;
                }
                $error = "Thêm khách hàng thất bại!";
            }
        }
        require_once 'views/client/add.php';
    }

    private function isAjaxRequest() {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
               strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
    }

    public function edit() {
        if (!isset($_SESSION['admin'])) {
            header('Location: index.php?act=login');
            exit;
        }
        $id = $_GET['id'] ?? 0;
        $client = $this->clientModel->getClientById($id);
        if (!$client) {
            header('Location: index.php?act=client-list');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $full_name = $_POST['full_name'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $password = !empty($_POST['password']) ? $_POST['password'] : null;

            if ($this->clientModel->updateClient($id, $username, $password, $email, $full_name, $phone, $address)) {
                header('Location: index.php?act=client-list');
                exit;
            } else {
                $error = "Cập nhật khách hàng thất bại!";
            }
        }
        require_once 'views/client/edit.php';
    }

    public function delete() {
        if (!isset($_SESSION['admin'])) {
            header('Location: index.php?act=login');
            exit;
        }
        $id = $_GET['id'] ?? 0;
        if ($this->clientModel->deleteClient($id)) {
            header('Location: index.php?act=client-list');
            exit;
        }
    }
} 