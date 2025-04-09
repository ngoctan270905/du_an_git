<?php
class ProductController {
    private $conn;
    private $productModel;
    private $categoryModel;

    public function __construct() {
        $this->conn = connectDB();
        $this->productModel = new Product($this->conn);
        $this->categoryModel = new Category($this->conn);
    }

    public function list() {
        if (!isset($_SESSION['admin'])) {
            header('Location: index.php?act=login');
            exit;
        }
        $products = $this->productModel->getAllProducts();
        require_once 'views/product/list.php';
    }

    public function add() {
        if (!isset($_SESSION['admin'])) {
            header('Location: index.php?act=login');
            exit;
        }
        $categories = $this->categoryModel->getAllCategories();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $discount_price = !empty($_POST['discount_price']) ? $_POST['discount_price'] : null;
            $category_id = $_POST['category_id'];
            $import_date = $_POST['import_date'];
            $stock_quantity = $_POST['stock_quantity'];

            // Xử lý upload ảnh
            $image = null;
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                // Tạo thư mục uploads nếu chưa tồn tại
                $uploadDir = __DIR__ . '/../../uploads/';
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                // Tạo tên file duy nhất
                $fileName = time() . '_' . basename($_FILES['image']['name']);
                $targetPath = $uploadDir . $fileName;

                // Kiểm tra loại file
                $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
                if (!in_array($_FILES['image']['type'], $allowedTypes)) {
                    $error = "Chỉ cho phép upload file ảnh (JPG, PNG, GIF, WEBP)";
                } else {
                    // Kiểm tra kích thước file (tối đa 5MB)
                    if ($_FILES['image']['size'] > 5 * 1024 * 1024) {
                        $error = "Kích thước file không được vượt quá 5MB";
                    } else {
                        // Upload file
                        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                            $image = 'uploads/' . $fileName;
                        } else {
                            $error = "Không thể upload file. Vui lòng thử lại.";
                        }
                    }
                }
            }

            if (!isset($error) && $this->productModel->addProduct($name, $description, $price, $discount_price, $image, $category_id, $import_date, $stock_quantity)) {
                header('Location: index.php?act=product-list');
                exit;
            } else {
                $error = $error ?? "Thêm sản phẩm thất bại!";
            }
        }
        require_once 'views/product/add.php';
    }

    public function edit() {
        if (!isset($_SESSION['admin'])) {
            header('Location: index.php?act=login');
            exit;
        }
        $id = $_GET['id'] ?? 0;
        $product = $this->productModel->getProductById($id);
        $categories = $this->categoryModel->getAllCategories();
        if (!$product) {
            header('Location: index.php?act=product-list');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $discount_price = !empty($_POST['discount_price']) ? $_POST['discount_price'] : null;
            $category_id = $_POST['category_id'];
            $import_date = $_POST['import_date'];
            $stock_quantity = $_POST['stock_quantity'];

            $image = $product['image'];
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                // Tạo thư mục uploads nếu chưa tồn tại
                $uploadDir = __DIR__ . '/../../uploads/';
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                // Xóa ảnh cũ nếu có
                if ($image) {
                    $oldImagePath = __DIR__ . '/../../' . $image;
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }

                // Tạo tên file duy nhất
                $fileName = time() . '_' . basename($_FILES['image']['name']);
                $targetPath = $uploadDir . $fileName;

                // Kiểm tra loại file
                $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
                if (!in_array($_FILES['image']['type'], $allowedTypes)) {
                    $error = "Chỉ cho phép upload file ảnh (JPG, PNG, GIF, WEBP)";
                } else {
                    // Kiểm tra kích thước file (tối đa 5MB)
                    if ($_FILES['image']['size'] > 5 * 1024 * 1024) {
                        $error = "Kích thước file không được vượt quá 5MB";
                    } else {
                        // Upload file
                        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                            $image = 'uploads/' . $fileName;
                        } else {
                            $error = "Không thể upload file. Vui lòng thử lại.";
                        }
                    }
                }
            }

            if ($this->productModel->updateProduct($id, $name, $description, $price, $discount_price, $image, $category_id, $import_date, $stock_quantity)) {
                header('Location: index.php?act=product-list');
                exit;
            } else {
                $error = $error ?? "Cập nhật sản phẩm thất bại!";
            }
        }
        require_once 'views/product/edit.php';
    }

    public function delete() {
        if (!isset($_SESSION['admin'])) {
            header('Location: index.php?act=login');
            exit;
        }
        $id = $_GET['id'] ?? 0;
        $product = $this->productModel->getProductById($id);
        if ($product && $product['image']) {
            deleteFile($product['image']); // Xóa hình ảnh
        }
        if ($this->productModel->deleteProduct($id)) {
            header('Location: index.php?act=product-list');
            exit;
        }
    }

    public function view() {
        if (!isset($_SESSION['admin'])) {
            header('Location: index.php?act=login');
            exit;
        }
        $id = $_GET['id'] ?? 0;
        $product = $this->productModel->getProductById($id);
        if (!$product) {
            header('Location: index.php?act=product-list');
            exit;
        }
        require_once 'views/product/view.php';
    }
}