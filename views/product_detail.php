<?php
$page_title = "Chi tiết sản phẩm - " . htmlspecialchars($product['name']);
require_once 'header.php';
?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Chi tiết sản phẩm</h1>
    <div class="row">
        <div class="col-md-6">
            <img src="<?php echo htmlspecialchars($product['image']); ?>" class="img-fluid product-image" alt="<?php echo htmlspecialchars($product['name']); ?>">
        </div>
        <div class="col-md-6">
            <h2><?php echo htmlspecialchars($product['name']); ?></h2>
            <p><strong>Danh mục:</strong> <?php echo htmlspecialchars($product['category_name'] ?? 'Không có danh mục'); ?></p>
            <p><strong>Mô tả:</strong> <?php echo htmlspecialchars($product['description'] ?? 'Không có mô tả'); ?></p>
            <p>
                <strong>Giá:</strong> 
                <span class="price"><?php echo number_format($product['discount_price'] ?? $product['price'], 0, ',', '.'); ?> VNĐ</span>
                <?php if ($product['discount_price']): ?>
                    <br><span class="discount-price"><?php echo number_format($product['price'], 0, ',', '.'); ?> VNĐ</span>
                <?php endif; ?>
            </p>
            <p><strong>Số lượng tồn kho:</strong> <?php echo $product['stock_quantity']; ?></p>
            <a href="index.php" class="btn btn-secondary">Quay lại</a>
        </div>
    </div>
</div>

<?php require_once 'footer.php'; ?>