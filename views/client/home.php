<?php
require_once './views/layouts/header.php';
?>

<div class="container mt-4">
    <div class="row">
        <!-- Categories Sidebar -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Danh mục sản phẩm</h5>
                </div>
                <div class="list-group list-group-flush">
                    <?php foreach ($categories as $cat): ?>
                        <a href="index.php?act=category&id=<?php echo $cat['id']; ?>" 
                           class="list-group-item list-group-item-action <?php echo (isset($_GET['id']) && $_GET['id'] == $cat['id']) ? 'active' : ''; ?>">
                            <?php echo htmlspecialchars($cat['name']); ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Products Display -->
        <div class="col-md-9">
            <?php if (isset($_GET['id']) && isset($category_products)): ?>
                <!-- Category Products -->
                <h2 class="mb-4"><?php echo htmlspecialchars($category['name']); ?></h2>
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <?php foreach ($category_products as $product): ?>
                        <div class="col">
                            <div class="card h-100">
                                <img src="<?php echo htmlspecialchars($product['image']); ?>" 
                                     class="card-img-top" 
                                     alt="<?php echo htmlspecialchars($product['name']); ?>">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <a href="index.php?act=product&id=<?php echo $product['id']; ?>" 
                                           class="text-decoration-none">
                                            <?php echo htmlspecialchars($product['name']); ?>
                                        </a>
                                    </h5>
                                    <p class="card-text text-danger fw-bold">
                                        <?php echo number_format($product['price'], 0, ',', '.'); ?>đ
                                    </p>
                                    <div class="d-flex justify-content-between">
                                        <a href="index.php?act=product&id=<?php echo $product['id']; ?>" 
                                           class="btn btn-primary">Xem chi tiết</a>
                                        <button class="btn btn-success add-to-cart" 
                                                data-product-id="<?php echo $product['id']; ?>">
                                            <i class="fas fa-shopping-cart"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <!-- Search Results or Featured Products -->
                <?php if (isset($_GET['keyword']) && !empty($_GET['keyword'])): ?>
                    <h2 class="mb-4">Kết quả tìm kiếm cho "<?php echo htmlspecialchars($_GET['keyword']); ?>"</h2>
                    <?php if ($total_results > 0): ?>
                        <p class="text-muted mb-4">Tìm thấy <?php echo $total_results; ?> sản phẩm</p>
                    <?php endif; ?>
                <?php else: ?>
                    <h2 class="mb-4">Sản phẩm nổi bật</h2>
                <?php endif; ?>
                
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <?php if (!empty($featured_products)): ?>
                        <?php foreach ($featured_products as $product): ?>
                            <div class="col">
                                <div class="card h-100">
                                    <img src="<?php echo htmlspecialchars($product['image']); ?>" 
                                         class="card-img-top" 
                                         alt="<?php echo htmlspecialchars($product['name']); ?>">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <a href="index.php?act=product&id=<?php echo $product['id']; ?>" 
                                               class="text-decoration-none">
                                                <?php echo htmlspecialchars($product['name']); ?>
                                            </a>
                                        </h5>
                                        <p class="card-text text-danger fw-bold">
                                            <?php echo number_format($product['price'], 0, ',', '.'); ?>đ
                                        </p>
                                        <div class="d-flex justify-content-between">
                                            <a href="index.php?act=product&id=<?php echo $product['id']; ?>" 
                                               class="btn btn-primary">Xem chi tiết</a>
                                            <button class="btn btn-success add-to-cart" 
                                                    data-product-id="<?php echo $product['id']; ?>">
                                                <i class="fas fa-shopping-cart"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="col-12">
                            <div class="alert alert-info">
                                <?php if (isset($_GET['keyword'])): ?>
                                    Không tìm thấy sản phẩm nào phù hợp với từ khóa "<?php echo htmlspecialchars($_GET['keyword']); ?>"
                                <?php else: ?>
                                    Không có sản phẩm nổi bật.
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
require_once './views/layouts/footer.php';
?>
