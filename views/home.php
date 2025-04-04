<?php
require_once './views/layouts/header.php';
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center mb-4">Danh mục sản phẩm</h1>
        </div>
    </div>

    <div class="row">
        <?php foreach ($categories as $category): ?>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <a href="?act=category&id=<?php echo $category['id']; ?>" class="text-dark text-decoration-none">
                                <?php echo htmlspecialchars($category['name']); ?>
                            </a>
                        </h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text"><?php echo htmlspecialchars($category['description']); ?></p>
                        
                        <?php if (!empty($category['products'])): ?>
                            <div class="row g-2">
                                <?php foreach (array_slice($category['products'], 0, 4) as $product): ?>
                                    <div class="col-6">
                                        <div class="card product-card">
                                            <?php if (!empty($product['image'])): ?>
                                                <img src="<?php echo htmlspecialchars($product['image']); ?>" 
                                                     class="card-img-top" 
                                                     alt="<?php echo htmlspecialchars($product['name']); ?>"
                                                     style="height: 150px; object-fit: cover;">
                                            <?php endif; ?>
                                            <div class="card-body p-2">
                                                <h6 class="card-title mb-1" style="font-size: 0.9rem;">
                                                    <?php echo htmlspecialchars(substr($product['name'], 0, 30)) . (strlen($product['name']) > 30 ? '...' : ''); ?>
                                                </h6>
                                                <p class="card-text mb-0" style="font-size: 0.9rem;">
                                                    <strong><?php echo number_format($product['price'], 0, ',', '.'); ?>đ</strong>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <p class="text-muted">Chưa có sản phẩm trong danh mục này</p>
                        <?php endif; ?>
                    </div>
                    <div class="card-footer">
                        <a href="?act=category&id=<?php echo $category['id']; ?>" class="btn btn-primary btn-sm">
                            Xem tất cả sản phẩm
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php
require_once './views/layouts/footer.php';
?> 