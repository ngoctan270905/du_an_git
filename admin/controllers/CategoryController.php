<?php
class CategoryController {
    private $conn;
    private $categoryModel;
    private $productModel;

    public function __construct() {
        $this->conn = connectDB();
        $this->categoryModel = new Category($this->conn);
        $this->productModel = new Product($this->conn);
    }

    public function list() {
        if (!isset($_SESSION['admin'])) {
            header('Location: index.php?act=login');
            exit;
        }
        $categories = $this->categoryModel->getAllCategories();
        require_once 'views/category/list.php';
    }

    public function add() {
        if (!isset($_SESSION['admin'])) {
            header('Location: index.php?act=login');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];

            if ($this->categoryModel->addCategory($name, $description)) {
                header('Location: index.php?act=category-list');
                exit;
            } else {
                $error = "Thêm danh mục thất bại!";
            }
        }
        require_once 'views/category/add.php';
    }

    public function edit() {
        if (!isset($_SESSION['admin'])) {
            header('Location: index.php?act=login');
            exit;
        }
        $id = $_GET['id'] ?? 0;
        $category = $this->categoryModel->getCategoryById($id);
        if (!$category) {
            header('Location: index.php?act=category-list');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];

            if ($this->categoryModel->updateCategory($id, $name, $description)) {
                header('Location: index.php?act=category-list');
                exit;
            } else {
                $error = "Cập nhật danh mục thất bại!";
            }
        }
        require_once 'views/category/edit.php';
    }

    public function delete() {
        if (!isset($_SESSION['admin'])) {
            header('Location: index.php?act=login');
            exit;
        }
        $id = $_GET['id'] ?? 0;
        if ($this->categoryModel->deleteCategory($id)) {
            header('Location: index.php?act=category-list');
            exit;
        }
    }

    public function view() {
        if (!isset($_SESSION['admin'])) {
            header('Location: index.php?act=login');
            exit;
        }
        $id = $_GET['id'] ?? 0;
        $category = $this->categoryModel->getCategoryById($id);
        if (!$category) {
            header('Location: index.php?act=category-list');
            exit;
        }
        $products = $this->productModel->getProductsByCategory($id);
        require_once 'views/category/view.php';
    }
}