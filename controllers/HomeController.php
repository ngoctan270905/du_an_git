<?php
require_once './models/Category.php';
require_once './models/Product.php';

class HomeController {
    private $conn;
    private $categoryModel;
    private $productModel;

    public function __construct() {
        $this->conn = connectDB();
        $this->categoryModel = new Category($this->conn);
        $this->productModel = new Product($this->conn);
    }

    public function index() {
        // Get all categories
        $categories = $this->categoryModel->getAllCategories();
        
        // Check if there's a search query
        $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
        
        if (!empty($keyword)) {
            // Get search results
            $featured_products = $this->productModel->searchProducts($keyword);
            $total_results = $this->productModel->getTotalSearchResults($keyword);
        } else {
            // Get featured products (first 6 products)
            $featured_products = $this->productModel->getFeaturedProducts(6);
            $total_results = 0;
        }
        
        // Load the home view
        require_once './views/client/home.php';
    }

    public function viewCategory($id) {
        // Get category ID from URL
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        
        // Get category details
        $category = $this->categoryModel->getCategoryById($id);
        
        if (!$category) {
            // If category not found, redirect to home
            header('Location: index.php');
            exit;
        }
        
        // Get all categories for the sidebar
        $categories = $this->categoryModel->getAllCategories();
        
        // Get 6 products from this category
        $category_products = $this->productModel->getProductsByCategory($id, 6);
        
        // Load the home view with the selected category
        require_once './views/client/home.php';
    }
    
    public function search() {
        // Get search parameters
        $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $per_page = 12; // Số sản phẩm trên mỗi trang
        
        // Get search results
        $search_results = $this->productModel->searchProductsByName($keyword, $page, $per_page);
        $total_products = $this->productModel->getTotalSearchResultsByName($keyword);
        $total_pages = ceil($total_products / $per_page);
        
        // Get all categories for the sidebar
        $categories = $this->categoryModel->getAllCategories();
        
        // Load the search view
        require_once './views/search.php';
    }
}