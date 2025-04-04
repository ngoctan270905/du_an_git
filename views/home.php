<?php
$page_title = "Trang chủ - Cửa hàng công nghệ";
require_once 'header.php';
?>

<img src="uploads/1739711394banner1.jpg" style="width: 1690px">

<div class="container-fluid p-0">
   
    <!-- Danh sách sản phẩm -->
    <div class="container mt-4">
        <h1 class="text-center mb-4">Danh sách sản phẩm</h1>
        <?php if (empty($products)): ?>
            <p class="text-center">Không có sản phẩm nào để hiển thị.</p>
        <?php else: ?>
            <div class="row">
                <?php foreach ($products as $product): ?>
                    <div class="col-md-2 col-6 product-card mb-4">
                        <div class="card h-100 shadow-sm">
                            <img src="<?php echo file_exists($product['image']) ? htmlspecialchars($product['image']) : 'https://via.placeholder.com/300x300?text=No+Image'; ?>" class="card-img-top" alt="<?php echo htmlspecialchars($product['name']); ?>">
                            <div class="card-body text-center">
                                <h5 class="card-title"><?php echo htmlspecialchars($product['name']); ?></h5>
                                <p class="card-text text-muted">Danh mục: <?php echo htmlspecialchars($product['category_name'] ?? 'Không có danh mục'); ?></p>
                                <p class="card-text">
                                    <span class="price"><?php echo number_format($product['discount_price'] ?? $product['price'], 0, ',', '.'); ?> VNĐ</span>
                                    <?php if ($product['discount_price']): ?>
                                        <br><span class="discount-price"><?php echo number_format($product['price'], 0, ',', '.'); ?> VNĐ</span>
                                    <?php endif; ?>
                                </p>
                                <a href="index.php?act=product_detail&id=<?php echo $product['id']; ?>" class="btn btn-primary btn-sm">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php require_once 'footer.php'; ?>