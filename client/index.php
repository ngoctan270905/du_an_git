<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- Header -->
    <header class="bg-dark text-white py-3">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-dark">
                <div class="container-fluid">
                    <a class="navbar-brand" href="index.php">
                        <img src="https://via.placeholder.com/150x40" alt="Logo" height="40">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <a class="nav-link active" href="index.php">Trang chủ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="products.php">Sản phẩm</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="about.php">Giới thiệu</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="contact.php">Liên hệ</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container my-5">
        <!-- Hero Section -->
        <section class="hero bg-primary text-white py-5">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h1 class="display-4 fw-bold">Chào mừng đến với TechStore</h1>
                        <p class="lead">Khám phá bộ sưu tập điện thoại và laptop mới nhất với giá tốt nhất</p>
                        <a href="#featured-products" class="btn btn-light btn-lg">Xem sản phẩm</a>
                    </div>
                    <div class="col-md-6">
                        <img src="https://laptop88.vn/media/news/1208_laptopcTPHCM3.jpg" alt="Hero Image" class="img-fluid rounded">
                    </div>
                </div>
            </div>
        </section>

        <section class="featured-products mb-5">
            <h2 class="text-center mb-4">Sản phẩm nổi bật</h2>
            <div class="row">
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        <img src="https://cdn2.cellphones.com.vn/insecure/rs:fill:0:0/q:90/plain/https://cellphones.com.vn/media/wysiwyg/Phone/Apple/iphone-13/iphone-13-9.png" class="card-img-top" alt="iPhone 13">
                        <div class="card-body">
                            <h5 class="card-title">iPhone 13</h5>
                            <p class="card-text">15.990.000 đ</p>
                            <a href="product-detail.php?id=1" class="btn btn-primary">Chi tiết</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        <img src="https://galaxydidong.vn/wp-content/uploads/2022/11/Samsung-Galaxy-S21-5G-–-256GB-–-RAM-8GB.jpg" class="card-img-top" alt="Samsung Galaxy S21">
                        <div class="card-body">
                            <h5 class="card-title">Samsung Galaxy S21</h5>
                            <p class="card-text">19.990.000 đ</p>
                            <a href="product-detail.php?id=2" class="btn btn-primary">Chi tiết</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        <img src="https://muabandienthoai24h.vn/storage/images/dHcuYklV28_1685071295.jpg" class="card-img-top" alt="MacBook Pro M1">
                        <div class="card-body">
                            <h5 class="card-title">MacBook Pro M1</h5>
                            <p class="card-text">39.990.000 đ</p>
                            <a href="product-detail.php?id=3" class="btn btn-primary">Chi tiết</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        <img src="https://laptops.vn/wp-content/uploads/2024/06/thiet-ke-xps-9350.jpg" class="card-img-top" alt="Dell XPS 13">
                        <div class="card-body">
                            <h5 class="card-title">Dell XPS 13</h5>
                            <p class="card-text">29.990.000 đ</p>
                            <a href="product-detail.php?id=4" class="btn btn-primary">Chi tiết</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>Về chúng tôi</h5>
                    <p>Chuyên cung cấp các sản phẩm công nghệ chính hãng</p>
                </div>
                <div class="col-md-4">
                    <h5>Liên kết nhanh</h5>
                    <ul class="list-unstyled">
                        <li><a href="index.php" class="text-white">Trang chủ</a></li>
                        <li><a href="products.php" class="text-white">Sản phẩm</a></li>
                        <li><a href="about.php" class="text-white">Giới thiệu</a></li>
                        <li><a href="contact.php" class="text-white">Liên hệ</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Liên hệ</h5>
                    <p>Email: contact@example.com</p>
                    <p>Điện thoại: 0123456789</p>
                    <p>Địa chỉ: 123 Đường ABC, Quận 1, TP.HCM</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html> 
