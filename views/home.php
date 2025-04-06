<?php require_once './views/header.php'; ?>

<div class="container mt-4">
    <!-- Slider hoặc banner -->
    <div id="carouselExampleIndicators" class="carousel slide mb-4" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://via.placeholder.com/1200x400" class="d-block w-100" alt="Banner 1">
            </div>
            <div class="carousel-item">
                <img src="https://via.placeholder.com/1200x400" class="d-block w-100" alt="Banner 2">
            </div>
            <div class="carousel-item">
                <img src="https://via.placeholder.com/1200x400" class="d-block w-100" alt="Banner 3">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    <!-- Danh mục sản phẩm -->
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="text-center mb-4">Danh mục sản phẩm</h2>
        </div>
        <?php
        $db = connectDB();
        $query = "SELECT * FROM categories";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($categories as $category): ?>
            <div class="col-md-3 mb-3">
                <div class="card h-100">
                    <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="<?php echo htmlspecialchars($category['name']); ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($category['name']); ?></h5>
                        <a href="http://localhost/du_an_git/du_an_git/index.php?act=category&id=<?php echo $category['id']; ?>" class="btn btn-primary">Xem sản phẩm</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Sản phẩm nổi bật -->
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="text-center mb-4">Sản phẩm nổi bật</h2>
        </div>
        <?php
        $query = "SELECT p.*, c.name as category_name 
                 FROM products p 
                 JOIN categories c ON p.category_id = c.id 
                 ORDER BY p.created_at DESC 
                 LIMIT 8";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($products as $product): ?>
            <div class="col-md-3 mb-4">
                <div class="card h-100 product-card">
                    <img src="<?php echo htmlspecialchars($product['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($product['name']); ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($product['name']); ?></h5>
                        <p class="card-text"><?php echo htmlspecialchars($product['category_name']); ?></p>
                        <div class="price">
                            <?php if ($product['discount'] > 0): ?>
                                <span class="discount-price"><?php echo number_format($product['price']); ?>đ</span>
                                <span><?php echo number_format($product['price'] * (1 - $product['discount']/100)); ?>đ</span>
                            <?php else: ?>
                                <span><?php echo number_format($product['price']); ?>đ</span>
                            <?php endif; ?>
                        </div>
                        <a href="http://localhost/du_an_git/du_an_git/index.php?act=product_detail&id=<?php echo $product['id']; ?>" class="btn btn-primary mt-2">Xem chi tiết</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require_once './views/footer.php'; ?> 