<?php
$current_page = 'product';
require_once 'views/layouts/header.php';
require_once 'views/layouts/sidebar.php';
?>

<!-- Main content -->
<main>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Chi tiết sản phẩm</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="index.php?act=product-list" class="btn btn-secondary me-2">
                <i class="bi bi-arrow-left"></i> Quay lại
            </a>
            <a href="index.php?act=product-edit&id=<?php echo $product['id']; ?>" class="btn btn-primary">
                <i class="bi bi-pencil"></i> Chỉnh sửa
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Product Image -->
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body text-center">
                    <?php if ($product['image']): ?>
                        <img src="<?php echo BASE_URL . $product['image']; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="img-fluid rounded" style="max-height: 300px; object-fit: contain;">
                    <?php else: ?>
                        <img src="<?php echo BASE_URL; ?>assets/images/no-image.png" alt="No image" class="img-fluid rounded" style="max-height: 300px; object-fit: contain;">
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Product Details -->
        <div class="col-md-8 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Thông tin sản phẩm</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Tên sản phẩm:</strong> <?php echo htmlspecialchars($product['name']); ?></p>
                            <p><strong>Mô tả:</strong> <?php echo nl2br(htmlspecialchars($product['description'])); ?></p>
                            <p><strong>Giá gốc:</strong> <?php echo number_format($product['price'], 0, ',', '.'); ?> đ</p>
                            <p><strong>Giá khuyến mãi:</strong> 
                                <?php if ($product['discount_price']): ?>
                                    <?php echo number_format($product['discount_price'], 0, ',', '.'); ?> đ
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Danh mục:</strong> <?php echo htmlspecialchars($product['category_name']); ?></p>
                            <p><strong>Ngày nhập:</strong> <?php echo $product['import_date'] ? date('d/m/Y', strtotime($product['import_date'])) : '-'; ?></p>
                            <p><strong>Ngày tạo:</strong> <?php echo date('d/m/Y H:i', strtotime($product['created_at'])); ?></p>
                            <p><strong>Ngày cập nhật:</strong> <?php echo date('d/m/Y H:i', strtotime($product['updated_at'])); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main> 