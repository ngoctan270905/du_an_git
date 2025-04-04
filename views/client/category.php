<?php
require_once './views/layouts/header.php';
?>

<div class="container mt-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo htmlspecialchars($category['name']); ?></li>
        </ol>
    </nav>

    <!-- Category Header -->
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="mb-2"><?php echo htmlspecialchars($category['name']); ?></h1>
            <p class="lead"><?php echo htmlspecialchars($category['description']); ?></p>
        </div>
    </div>

    <!-- Products Grid -->
    <?php if (!empty($category['products'])): ?>
        <div class="row g-4">
            <?php foreach ($category['products'] as $product): ?>
                <div class="col-md-3">
                    <div class="card h-100">
                        <?php if (!empty($product['image'])): ?>
                            <img src="<?php echo htmlspecialchars($product['image']); ?>" 
                                 class="card-img-top" 
                                 alt="<?php echo htmlspecialchars($product['name']); ?>"
                                 style="height: 200px; object-fit: cover;">
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($product['name']); ?></h5>
                            <p class="card-text">
                                <?php echo htmlspecialchars(substr($product['description'] ?? '', 0, 100)) . (strlen($product['description'] ?? '') > 100 ? '...' : ''); ?>
                            </p>
                            <p class="card-text">
                                <strong class="text-primary">
                                    <?php echo number_format($product['price'], 0, ',', '.'); ?>đ
                                </strong>
                                <?php if (!empty($product['discount_price'])): ?>
                                    <del class="text-muted ms-2">
                                        <?php echo number_format($product['discount_price'], 0, ',', '.'); ?>đ
                                    </del>
                                <?php endif; ?>
                            </p>
                        </div>
                        <div class="card-footer">
                            <a href="?act=product&id=<?php echo $product['id']; ?>" class="btn btn-primary w-100">
                                Xem chi tiết
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="row">
            <div class="col-12">
                <div class="alert alert-info">
                    Chưa có sản phẩm nào trong danh mục này.
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php
require_once './views/layouts/footer.php';
?> 