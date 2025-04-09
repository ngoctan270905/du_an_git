<?php
$current_page = 'category';
require_once 'views/layouts/header.php';
require_once 'views/layouts/sidebar.php';
?>

<!-- Main content -->
<main>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Chi tiết danh mục</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="index.php?act=category-list" class="btn btn-secondary me-2">
                <i class="bi bi-arrow-left"></i> Quay lại
            </a>
            <a href="index.php?act=category-edit&id=<?php echo $category['id']; ?>" class="btn btn-primary">
                <i class="bi bi-pencil"></i> Chỉnh sửa
            </a>
        </div>
    </div>

    <!-- Category Details -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="card-title mb-0">Thông tin danh mục</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Tên danh mục:</strong> <?php echo htmlspecialchars($category['name']); ?></p>
                    <p><strong>Mô tả:</strong> <?php echo htmlspecialchars($category['description']); ?></p>
                    <p><strong>Ngày tạo:</strong> <?php echo date('d/m/Y H:i', strtotime($category['created_at'])); ?></p>
                    <p><strong>Ngày cập nhật:</strong> <?php echo date('d/m/Y H:i', strtotime($category['updated_at'])); ?></p>
                </div>
                <div class="col-md-6">
                    <p><strong>Tổng số sản phẩm:</strong> <?php echo count($products); ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Products List -->
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Danh sách sản phẩm</h5>
        </div>
        <div class="card-body">
            <?php if (empty($products)): ?>
                <div class="text-center py-4">
                    <i class="bi bi-info-circle text-muted"></i> Chưa có sản phẩm nào trong danh mục này
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên sản phẩm</th>
                                <th>Giá</th>
                                <th>Mô tả</th>
                                <th>Ngày tạo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($products as $product): ?>
                                <tr>
                                    <td><?php echo $product['id']; ?></td>
                                    <td><?php echo htmlspecialchars($product['name']); ?></td>
                                    <td><?php echo number_format($product['price'], 0, ',', '.'); ?>đ</td>
                                    <td><?php echo htmlspecialchars($product['description']); ?></td>
                                    <td><?php echo date('d/m/Y H:i', strtotime($product['created_at'])); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>
