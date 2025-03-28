<?php
$current_page = 'client';
require_once VIEWS_PATH . '/layouts/header.php';
require_once VIEWS_PATH . '/layouts/sidebar.php';
?>

<!-- Main content -->
<main>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Chỉnh sửa khách hàng</h1>
        <a href="index.php?act=client-list" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Quay lại
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>

            <form method="POST" action="index.php?act=client-edit&id=<?php echo $client['id']; ?>">
                <div class="mb-3">
                    <label for="username" class="form-label">Tên đăng nhập</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?php echo $client['username']; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Mật khẩu mới (để trống nếu không muốn thay đổi)</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $client['email']; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="full_name" class="form-label">Họ tên</label>
                    <input type="text" class="form-control" id="full_name" name="full_name" value="<?php echo $client['full_name']; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Số điện thoại</label>
                    <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo $client['phone']; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Địa chỉ</label>
                    <textarea class="form-control" id="address" name="address" rows="3" required><?php echo $client['address']; ?></textarea>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Cập nhật khách hàng
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 