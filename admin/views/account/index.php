<?php
$current_page = 'account';
require_once VIEWS_PATH . '/layouts/header.php';
require_once VIEWS_PATH . '/layouts/sidebar.php';
?>

<!-- Main content -->
<main>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Quản lý Tài khoản</h1>
    </div>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>

    <?php if (isset($success)): ?>
        <div class="alert alert-success"><?php echo $success; ?></div>
    <?php endif; ?>

    <!-- Tabs -->
    <ul class="nav nav-tabs mb-4" id="accountTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="admin-tab" data-bs-toggle="tab" data-bs-target="#admin" type="button" role="tab">
                <i class="bi bi-person-badge"></i> Quản lý Admin
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="client-tab" data-bs-toggle="tab" data-bs-target="#client" type="button" role="tab">
                <i class="bi bi-people"></i> Quản lý Khách hàng
            </button>
        </li>
    </ul>

    <!-- Tab content -->
    <div class="tab-content" id="accountTabsContent">
        <!-- Admin Tab -->
        <div class="tab-pane fade show active" id="admin" role="tabpanel">
            <div class="d-flex justify-content-end mb-3">
                <a href="index.php?act=account-add-admin" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Thêm Admin mới
                </a>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên đăng nhập</th>
                                    <th>Email</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($admins)): ?>
                                    <tr>
                                        <td colspan="4" class="text-center">Chưa có tài khoản admin nào</td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($admins as $admin): ?>
                                        <tr>
                                            <td><?php echo $admin['id']; ?></td>
                                            <td><?php echo htmlspecialchars($admin['username']); ?></td>
                                            <td><?php echo htmlspecialchars($admin['email']); ?></td>
                                            <td>
                                                <a href="index.php?act=account-edit-admin&id=<?php echo $admin['id']; ?>" 
                                                   class="btn btn-sm btn-warning">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <a href="index.php?act=account-delete-admin&id=<?php echo $admin['id']; ?>" 
                                                   class="btn btn-sm btn-danger"
                                                   onclick="return confirm('Bạn có chắc chắn muốn xóa tài khoản admin này?')">
                                                    <i class="bi bi-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Client Tab -->
        <div class="tab-pane fade" id="client" role="tabpanel">
            <div class="d-flex justify-content-end mb-3">
                <a href="index.php?act=account-add-client" class="btn btn-success">
                    <i class="bi bi-plus-circle"></i> Thêm Khách hàng mới
                </a>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên đăng nhập</th>
                                    <th>Họ tên</th>
                                    <th>Email</th>
                                    <th>Số điện thoại</th>
                                    <th>Địa chỉ</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($clients)): ?>
                                    <tr>
                                        <td colspan="7" class="text-center">Chưa có tài khoản khách hàng nào</td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($clients as $client): ?>
                                        <tr>
                                            <td><?php echo $client['id']; ?></td>
                                            <td><?php echo htmlspecialchars($client['username']); ?></td>
                                            <td><?php echo htmlspecialchars($client['full_name']); ?></td>
                                            <td><?php echo htmlspecialchars($client['email']); ?></td>
                                            <td><?php echo htmlspecialchars($client['phone']); ?></td>
                                            <td><?php echo htmlspecialchars($client['address']); ?></td>
                                            <td>
                                                <a href="index.php?act=account-edit-client&id=<?php echo $client['id']; ?>" 
                                                   class="btn btn-sm btn-warning">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <a href="index.php?act=account-delete-client&id=<?php echo $client['id']; ?>" 
                                                   class="btn btn-sm btn-danger"
                                                   onclick="return confirm('Bạn có chắc chắn muốn xóa tài khoản khách hàng này?')">
                                                    <i class="bi bi-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 