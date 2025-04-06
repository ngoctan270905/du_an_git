<?php require_once './views/header.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Đăng ký tài khoản</h3>
                </div>
                <div class="card-body">
                    <?php if (isset($_SESSION['errors']['register'])): ?>
                        <div class="alert alert-danger"><?php echo $_SESSION['errors']['register']; unset($_SESSION['errors']['register']); ?></div>
                    <?php endif; ?>

                    <form action="http://localhost/du_an_git/du_an_git/index.php?act=register" method="POST" class="needs-validation" novalidate>
                        <div class="mb-3">
                            <label for="name" class="form-label">Họ và tên</label>
                            <input type="text" class="form-control <?php echo isset($_SESSION['errors']['name']) ? 'is-invalid' : ''; ?>" 
                                   id="name" name="name" value="<?php echo $_SESSION['old']['name'] ?? ''; ?>" required>
                            <?php if (isset($_SESSION['errors']['name'])): ?>
                                <div class="invalid-feedback"><?php echo $_SESSION['errors']['name']; unset($_SESSION['errors']['name']); ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control <?php echo isset($_SESSION['errors']['email']) ? 'is-invalid' : ''; ?>" 
                                   id="email" name="email" value="<?php echo $_SESSION['old']['email'] ?? ''; ?>" required>
                            <?php if (isset($_SESSION['errors']['email'])): ?>
                                <div class="invalid-feedback"><?php echo $_SESSION['errors']['email']; unset($_SESSION['errors']['email']); ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mật khẩu</label>
                            <input type="password" class="form-control <?php echo isset($_SESSION['errors']['password']) ? 'is-invalid' : ''; ?>" 
                                   id="password" name="password" required>
                            <?php if (isset($_SESSION['errors']['password'])): ?>
                                <div class="invalid-feedback"><?php echo $_SESSION['errors']['password']; unset($_SESSION['errors']['password']); ?></div>
                            <?php endif; ?>
                            <div class="form-text">
                                Mật khẩu phải có ít nhất 6 ký tự, bao gồm chữ hoa, chữ thường và số
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Xác nhận mật khẩu</label>
                            <input type="password" class="form-control <?php echo isset($_SESSION['errors']['confirm_password']) ? 'is-invalid' : ''; ?>" 
                                   id="confirm_password" name="confirm_password" required>
                            <?php if (isset($_SESSION['errors']['confirm_password'])): ?>
                                <div class="invalid-feedback"><?php echo $_SESSION['errors']['confirm_password']; unset($_SESSION['errors']['confirm_password']); ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Đăng ký</button>
                        </div>
                    </form>
                    <div class="text-center mt-3">
                        <p>Đã có tài khoản? <a href="index.php?act=login">Đăng nhập</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
unset($_SESSION['errors']);
unset($_SESSION['old']);
require_once './views/footer.php'; 
?> 