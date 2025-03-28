<!-- Sidebar -->
<nav class="col-md-2 d-none d-md-block sidebar">
    <div class="position-sticky">
        <!-- Main Navigation -->
        <div class="nav-section">
            <div class="nav-section-title">Menu chính</div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link <?php echo $current_page === 'dashboard' ? 'active' : ''; ?>" href="index.php?act=dashboard">
                        <i class="bi bi-speedometer2"></i>
                        <span>Dashboard</span>
                        <span class="badge">New</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Content Management -->
        <div class="nav-section">
            <div class="nav-section-title">Quản lý nội dung</div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link <?php echo in_array($current_page, ['category', 'category-list', 'category-add', 'category-edit', 'category-delete']) ? 'active' : ''; ?>" href="index.php?act=category-list">
                        <i class="bi bi-tags"></i>
                        <span>Quản lý danh mục</span>
                        <span class="badge"><?php echo isset($totalCategories) ? $totalCategories : '0'; ?></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo in_array($current_page, ['product', 'product-list', 'product-add', 'product-edit', 'product-delete', 'product-view']) ? 'active' : ''; ?>" href="index.php?act=product-list">
                        <i class="bi bi-box"></i>
                        <span>Quản lý sản phẩm</span>
                        <span class="badge"><?php echo isset($totalProducts) ? $totalProducts : '0'; ?></span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- User Management -->
        <div class="nav-section">
            <div class="nav-section-title">Quản lý người dùng</div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link <?php echo in_array($current_page, ['account', 'account-list-admins', 'account-add-admin', 'account-edit-admin', 'account-delete-admin']) ? 'active' : ''; ?>" href="index.php?act=account-list-admins">
                        <i class="bi bi-person-badge"></i>
                        <span>Quản lý tài khoản</span>
                        <span class="badge"><?php echo isset($totalAccounts) ? $totalAccounts : '0'; ?></span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav> 