<?php require_once './views/header.php'; ?>

<div class="container mt-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="index.php?act=category&id=<?php echo $product['category_id']; ?>"><?php echo htmlspecialchars($category['name']); ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo htmlspecialchars($product['name']); ?></li>
        </ol>
    </nav>

    <div class="row">
        <!-- Ảnh sản phẩm -->
        <div class="col-md-6">
            <img src="<?php echo htmlspecialchars($product['image']); ?>" class="img-fluid rounded" alt="<?php echo htmlspecialchars($product['name']); ?>">
        </div>

        <!-- Thông tin sản phẩm -->
        <div class="col-md-6">
            <h1 class="mb-4"><?php echo htmlspecialchars($product['name']); ?></h1>
            
            <div class="mb-3">
                <span class="price h3 text-danger"><?php echo number_format($product['price'], 0, ',', '.'); ?>đ</span>
                <?php if ($product['old_price'] > $product['price']): ?>
                    <span class="discount-price ms-2"><?php echo number_format($product['old_price'], 0, ',', '.'); ?>đ</span>
                <?php endif; ?>
            </div>

            <div class="mb-4">
                <?php echo nl2br(htmlspecialchars($product['description'])); ?>
            </div>

            <form action="index.php?act=add_to_cart" method="POST" class="mb-4">
                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                <div class="row g-3 align-items-center mb-3">
                    <div class="col-auto">
                        <label for="quantity" class="col-form-label">Số lượng:</label>
                    </div>
                    <div class="col-auto">
                        <input type="number" id="quantity" name="quantity" class="form-control" value="1" min="1">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-lg">Thêm vào giỏ hàng</button>
            </form>
        </div>
    </div>

    <!-- Sản phẩm liên quan -->
    <?php if (!empty($related_products)): ?>
    <div class="mt-5">
        <h3 class="mb-4">Sản phẩm liên quan</h3>
        <div class="row">
            <?php foreach ($related_products as $related): ?>
            <div class="col-md-3 mb-4">
                <div class="card h-100 product-card">
                    <img src="<?php echo htmlspecialchars($related['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($related['name']); ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($related['name']); ?></h5>
                        <p class="card-text price"><?php echo number_format($related['price'], 0, ',', '.'); ?>đ</p>
                        <a href="index.php?act=product_detail&id=<?php echo $related['id']; ?>" class="btn btn-outline-primary">Xem chi tiết</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>
</div>

<?php require_once './views/footer.php'; ?> 