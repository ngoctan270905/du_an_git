<?php
$current_page = 'account';
require_once VIEWS_PATH . '/layouts/header.php';
require_once VIEWS_PATH . '/layouts/sidebar.php';
?>

<!-- Main content -->
<main>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Đăng ký Admin</h1>
    </div>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="index.php?act=account-add-admin">
                <div class="mb-3">
                    <label for="username" class="form-label">Tên đăng nhập</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mật khẩu</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Xác nhận mật khẩu</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="index.php?act=account-list-admins" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Quay lại
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Đăng ký
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>

<script>
document.querySelector('form').addEventListener('submit', function(e) {
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm_password').value;
    
    if (password !== confirmPassword) {
        e.preventDefault();
        alert('Mật khẩu xác nhận không khớp!');
    }
});
</script>

</body>
</html> 