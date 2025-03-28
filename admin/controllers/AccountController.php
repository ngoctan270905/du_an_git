<?php
class AccountController {
    private $conn;
    private $adminModel;
    private $clientModel;

    public function __construct() {
        $this->conn = connectDB();
        $this->adminModel = new Admin($this->conn);
        $this->clientModel = new Client($this->conn);
    }

    public function listAdmins() {
        if (!isset($_SESSION['admin'])) {
            header('Location: index.php?act=login');
            exit;
        }
        $admins = $this->adminModel->getAllAdmins();
        $clients = $this->clientModel->getAllClients();
        require_once VIEWS_PATH . '/account/index.php';
    }

    public function listClients() {
        if (!isset($_SESSION['admin'])) {
            header('Location: index.php?act=login');
            exit;
        }
        $admins = $this->adminModel->getAllAdmins();
        $clients = $this->clientModel->getAllClients();
        require_once VIEWS_PATH . '/account/index.php';
    }

    public function addAdmin() {
        if (!isset($_SESSION['admin'])) {
            header('Location: index.php?act=login');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $email = $_POST['email'];
            if ($this->adminModel->addAdmin($username, $password, $email)) {
                header('Location: index.php?act=account-list-admins');
                exit;
            } else {
                $error = "Thêm admin thất bại!";
            }
        }
        require_once VIEWS_PATH . '/account/add_admin.php';
    }

    public function editAdmin() {
        if (!isset($_SESSION['admin'])) {
            header('Location: index.php?act=login');
            exit;
        }
        $id = $_GET['id'] ?? 0;
        $admin = $this->adminModel->getAdminById($id);
        if (!$admin) {
            header('Location: index.php?act=account-list-admins');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = !empty($_POST['password']) ? $_POST['password'] : null;
            if ($this->adminModel->updateAdmin($id, $username, $email, $password)) {
                header('Location: index.php?act=account-list-admins');
                exit;
            } else {
                $error = "Cập nhật admin thất bại!";
            }
        }
        require_once VIEWS_PATH . '/account/account-edit-admin.php';
    }

    public function deleteAdmin() {
        if (!isset($_SESSION['admin'])) {
            header('Location: index.php?act=login');
            exit;
        }
        $id = $_GET['id'] ?? 0;
        if ($this->adminModel->deleteAdmin($id)) {
            header('Location: index.php?act=account-list-admins');
            exit;
        }
    }

    public function editClient() {
        if (!isset($_SESSION['admin'])) {
            header('Location: index.php?act=login');
            exit;
        }
        $id = $_GET['id'] ?? 0;
        $client = $this->clientModel->getClientById($id);
        if (!$client) {
            header('Location: index.php?act=account-list-clients');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $full_name = $_POST['full_name'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $password = !empty($_POST['password']) ? $_POST['password'] : null;
            if ($this->clientModel->updateClient($id, $username, $email, $full_name, $phone, $address, $password)) {
                header('Location: index.php?act=account-list-clients');
                exit;
            } else {
                $error = "Cập nhật khách hàng thất bại!";
            }
        }
        require_once VIEWS_PATH . '/account/edit_client.php';
    }

    public function deleteClient() {
        if (!isset($_SESSION['admin'])) {
            header('Location: index.php?act=login');
            exit;
        }
        $id = $_GET['id'] ?? 0;
        if ($this->clientModel->deleteClient($id)) {
            header('Location: index.php?act=account-list-clients');
            exit;
        }
    }

    public function addClient() {
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
                header('Location: index.php?act=account-list-clients');
                exit;
            } else {
                if ($this->isAjaxRequest()) {
                    echo json_encode(['success' => false, 'message' => 'Thêm khách hàng thất bại!']);
                    exit;
                }
                $error = "Thêm khách hàng thất bại!";
            }
        }
        require_once VIEWS_PATH . '/account/add_client.php';
    }

    private function isAjaxRequest() {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
               strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
    }
}