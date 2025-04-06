<?php require_once './views/header.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Đăng nhập</h3>
                </div>
                <div class="card-body">
                    <?php if (isset($_SESSION['success'])): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['errors'])): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?php 
                            foreach ($_SESSION['errors'] as $error) {
                                echo $error . '<br>';
                            }
                            ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <form action="http://localhost/du_an_git/du_an_git/index.php?act=login" method="POST" class="needs-validation" novalidate>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control <?php echo isset($_SESSION['errors']['email']) ? 'is-invalid' : ''; ?>" 
                                   id="email" name="email" value="<?php echo $_SESSION['old']['email'] ?? ''; ?>" required>
                            <?php if (isset($_SESSION['errors']['email'])): ?>
                                <div class="invalid-feedback"><?php echo $_SESSION['errors']['email']; ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mật khẩu</label>
                            <input type="password" class="form-control <?php echo isset($_SESSION['errors']['password']) ? 'is-invalid' : ''; ?>" 
                                   id="password" name="password" required>
                            <?php if (isset($_SESSION['errors']['password'])): ?>
                                <div class="invalid-feedback"><?php echo $_SESSION['errors']['password']; ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Đăng nhập</button>
                        </div>
                    </form>
                    <div class="text-center mt-3">
                        <p>Chưa có tài khoản? <a href="http://localhost/du_an_git/du_an_git/index.php?act=register">Đăng ký ngay</a></p>
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