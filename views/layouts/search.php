<?php
// Kiểm tra và lấy tham số tìm kiếm
$keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
$category_id = isset($_GET['category_id']) ? (int)$_GET['category_id'] : 0;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$per_page = 12; // Số sản phẩm trên mỗi trang

// Lấy danh sách sản phẩm từ model
$productModel = new Product($conn);
$search_results = $productModel->searchProducts($keyword, $category_id, $page, $per_page);
$total_products = $productModel->getTotalSearchResults($keyword, $category_id);
$total_pages = ceil($total_products / $per_page);

// Lấy danh mục đã chọn
$selected_category = null;
if ($category_id > 0) {
    $categoryModel = new Category($conn);
    $selected_category = $categoryModel->getCategoryById($category_id);
}
?>

<div class="container py-4">
    <div class="row">
        <!-- Breadcrumb -->
        <div class="col-12 mb-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Kết quả tìm kiếm</li>
                </ol>
            </nav>
        </div>

        <!-- Search Results Header -->
        <div class="col-12 mb-4">
            <h2 class="mb-3">
                <?php if ($keyword): ?>
                    Kết quả tìm kiếm cho "<?php echo htmlspecialchars($keyword); ?>"
                <?php else: ?>
                    Tất cả sản phẩm
                <?php endif; ?>
                <?php if ($selected_category): ?>
                    trong danh mục "<?php echo htmlspecialchars($selected_category['name']); ?>"
                <?php endif; ?>
            </h2>
            <p class="text-muted">Tìm thấy <?php echo $total_products; ?> sản phẩm</p>
        </div>

        <!-- Products Grid -->
        <div class="col-12">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                <?php if (!empty($search_results)): ?>
                    <?php foreach ($search_results as $product): ?>
                        <div class="col">
                            <div class="card h-100">
                                <img src="<?php echo htmlspecialchars($product['image']); ?>" 
                                     class="card-img-top" 
                                     alt="<?php echo htmlspecialchars($product['name']); ?>">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <a href="index.php?act=product&id=<?php echo $product['id']; ?>" 
                                           class="text-decoration-none text-dark">
                                            <?php echo htmlspecialchars($product['name']); ?>
                                        </a>
                                    </h5>
                                    <p class="card-text text-danger fw-bold">
                                        <?php echo number_format($product['price'], 0, ',', '.'); ?>đ
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <a href="index.php?act=product&id=<?php echo $product['id']; ?>" 
                                               class="btn btn-sm btn-outline-primary">Xem chi tiết</a>
                                            <button type="button" 
                                                    class="btn btn-sm btn-outline-danger add-to-cart" 
                                                    data-product-id="<?php echo $product['id']; ?>">
                                                <i class="fas fa-shopping-cart"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12">
                        <div class="alert alert-info">
                            Không tìm thấy sản phẩm phù hợp với tiêu chí tìm kiếm.
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Pagination -->
            <?php if ($total_pages > 1): ?>
                <nav class="mt-4">
                    <ul class="pagination justify-content-center">
                        <?php if ($page > 1): ?>
                            <li class="page-item">
                                <a class="page-link" href="?act=search&keyword=<?php echo urlencode($keyword); ?>&category_id=<?php echo $category_id; ?>&page=<?php echo $page - 1; ?>">
                                    Trước
                                </a>
                            </li>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                            <li class="page-item <?php echo $i === $page ? 'active' : ''; ?>">
                                <a class="page-link" href="?act=search&keyword=<?php echo urlencode($keyword); ?>&category_id=<?php echo $category_id; ?>&page=<?php echo $i; ?>">
                                    <?php echo $i; ?>
                                </a>
                            </li>
                        <?php endfor; ?>

                        <?php if ($page < $total_pages): ?>
                            <li class="page-item">
                                <a class="page-link" href="?act=search&keyword=<?php echo urlencode($keyword); ?>&category_id=<?php echo $category_id; ?>&page=<?php echo $page + 1; ?>">
                                    Sau
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>
.card {
    transition: transform 0.2s;
}
.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}
.card-img-top {
    height: 200px;
    object-fit: cover;
}
.pagination .page-link {
    color: #c92127;
}
.pagination .page-item.active .page-link {
    background-color: #c92127;
    border-color: #c92127;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Xử lý thêm vào giỏ hàng
    const addToCartButtons = document.querySelectorAll('.add-to-cart');
    addToCartButtons.forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.dataset.productId;
            // Gọi API thêm vào giỏ hàng
            fetch('index.php?act=add-to-cart', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: 1
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Đã thêm sản phẩm vào giỏ hàng!');
                } else {
                    alert('Có lỗi xảy ra: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Có lỗi xảy ra khi thêm vào giỏ hàng!');
            });
        });
    });
});
</script> 