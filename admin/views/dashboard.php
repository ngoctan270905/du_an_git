<?php
require_once VIEWS_PATH . '/layouts/header.php';
require_once VIEWS_PATH . '/layouts/sidebar.php';
?>

<!-- Main content -->
<main>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary">Chia sẻ</button>
                <button type="button" class="btn btn-sm btn-outline-secondary">Xuất báo cáo</button>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Categories Card -->
        <div class="col-md-4 mb-4">
            <div class="card stat-card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-0 text-white">Tổng số danh mục</h6>
                            <h2 class="mt-2 mb-0 text-white"><?php echo $totalCategories; ?></h2>
                            <small class="text-white-50">Danh mục hiện có</small>
                        </div>
                        <i class="bi bi-tags fs-1 text-white"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Products Card -->
        <div class="col-md-4 mb-4">
            <div class="card stat-card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-0 text-white">Tổng số sản phẩm</h6>
                            <h2 class="mt-2 mb-0 text-white"><?php echo $totalProducts; ?></h2>
                            <small class="text-white-50">Sản phẩm trong kho</small>
                        </div>
                        <i class="bi bi-box fs-1 text-white"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Accounts Card -->
        <div class="col-md-4 mb-4">
            <div class="card stat-card bg-info text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-0 text-white">Tổng số tài khoản</h6>
                            <h2 class="mt-2 mb-0 text-white"><?php echo $totalAccounts; ?></h2>
                            <small class="text-white-50">Tài khoản đã đăng ký</small>
                        </div>
                        <i class="bi bi-person-badge fs-1 text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activities -->
    <div class="card">
        <div class="card-header bg-white">
            <h5 class="card-title mb-0">
                <i class="bi bi-activity"></i> Hoạt động gần đây
            </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Thời gian</th>
                            <th>Hoạt động</th>
                            <th>Chi tiết</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($recentActivities)): ?>
                            <tr>
                                <td colspan="3" class="text-center py-4">
                                    <i class="bi bi-info-circle text-muted"></i> Chưa có hoạt động nào
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($recentActivities as $activity): ?>
                                <tr>
                                    <td>
                                        <i class="bi bi-clock text-muted"></i>
                                        <?php echo date('d/m/Y H:i', strtotime($activity['created_at'])); ?>
                                    </td>
                                    <td><?php echo htmlspecialchars($activity['action']); ?></td>
                                    <td><?php echo htmlspecialchars($activity['details']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
