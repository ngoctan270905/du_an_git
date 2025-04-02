<?php
require_once '../commons/db.php';

// Lấy ID sản phẩm từ URL
$product_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Lấy thông tin sản phẩm
$sql = "SELECT * FROM products WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header("Location: index.php");
    exit();
}

$product = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết sản phẩm</title>
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
                        <img src="https://placeholder.pics/svg/150x50/DEDEDE/555555/LOGO" alt="Logo" height="40">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="index.php">Trang chủ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="products.php">Sản phẩm</a>
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
        <div class="row">
            <!-- Product Images -->
            <div class="col-md-6">
                <div class="product-images">
                    <?php
                    $image_url = '';
                    switch($product_id) {
                        case 1:
                            $image_url = 'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:0/q:90/plain/https://cellphones.com.vn/media/wysiwyg/Phone/Apple/iphone-13/iphone-13-9.png';
                            break;
                        case 2:
                            $image_url = 'https://galaxydidong.vn/wp-content/uploads/2022/11/Samsung-Galaxy-S21-5G-–-256GB-–-RAM-8GB.jpg';
                            break;
                        case 3:
                            $image_url = 'https://muabandienthoai24h.vn/storage/images/dHcuYklV28_1685071295.jpg';
                            break;
                        case 4:
                            $image_url = 'https://laptops.vn/wp-content/uploads/2024/06/thiet-ke-xps-9350.jpg';
                            break;
                        default:
                            $image_url = 'https://placeholder.pics/svg/600x600/DEDEDE/555555/Product%20Image';
                    }
                    ?>
                    <img src="<?php echo $image_url; ?>" alt="<?php echo $product['name']; ?>" class="img-fluid rounded main-image mb-3">
                    <div class="row">
                        <div class="col-3">
                            <img src="<?php echo $image_url; ?>" alt="Thumbnail 1" class="img-fluid rounded thumbnail">
                        </div>
                        <div class="col-3">
                            <img src="<?php echo $image_url; ?>" alt="Thumbnail 2" class="img-fluid rounded thumbnail">
                        </div>
                        <div class="col-3">
                            <img src="<?php echo $image_url; ?>" alt="Thumbnail 3" class="img-fluid rounded thumbnail">
                        </div>
                        <div class="col-3">
                            <img src="<?php echo $image_url; ?>" alt="Thumbnail 4" class="img-fluid rounded thumbnail">
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Product Info -->
            <div class="col-md-6">
                <h1 class="mb-4">iPhone 13 Pro Max</h1>
                <div class="mb-4">
                    <span class="h3 text-primary">29.990.000 đ</span>
                    <span class="text-muted text-decoration-line-through ms-2">32.990.000 đ</span>
                </div>
                
                <div class="mb-4">
                    <h5>Mô tả sản phẩm:</h5>
                    <p>iPhone 13 Pro Max. Một nâng cấp hệ thống camera chuyên nghiệp hoành tráng chưa từng có. Màn hình Super Retina XDR với ProMotion cho cảm giác nhanh nhạy hơn. Chip A15 Bionic thần tốc. Mạng 5G siêu nhanh. Thiết kế bền bỉ và thời lượng pin dài nhất từng có trên iPhone.</p>
                </div>

                <div class="mb-4">
                    <h5>Thông số kỹ thuật:</h5>
                    <ul class="list-unstyled">
                        <li><strong>Màn hình:</strong> 6.7 inch Super Retina XDR OLED</li>
                        <li><strong>CPU:</strong> Apple A15 Bionic</li>
                        <li><strong>RAM:</strong> 6GB</li>
                        <li><strong>Bộ nhớ trong:</strong> 128GB</li>
                        <li><strong>Camera sau:</strong> 3 camera 12MP</li>
                        <li><strong>Camera trước:</strong> 12MP</li>
                        <li><strong>Pin:</strong> 4352 mAh</li>
                    </ul>
                </div>

                <div class="mb-4">
                    <h5>Màu sắc:</h5>
                    <div class="color-options">
                        <button class="btn btn-outline-dark me-2 active">Xám</button>
                        <button class="btn btn-outline-dark me-2">Bạc</button>
                        <button class="btn btn-outline-dark me-2">Vàng</button>
                        <button class="btn btn-outline-dark">Xanh</button>
                    </div>
                </div>

                <div class="mb-4">
                    <h5>Số lượng:</h5>
                    <div class="input-group" style="width: 150px;">
                        <button class="btn btn-outline-secondary" type="button" id="decreaseQuantity">-</button>
                        <input type="text" class="form-control text-center" value="1" id="quantity">
                        <button class="btn btn-outline-secondary" type="button" id="increaseQuantity">+</button>
                    </div>
                </div>

                <div class="d-grid gap-2">
                    <button class="btn btn-primary btn-lg" onclick="addToCart(1)">
                        <i class="bi bi-cart-plus"></i> Thêm vào giỏ hàng
                    </button>
                    <button class="btn btn-success btn-lg" onclick="buyNow(1)">
                        Mua ngay
                    </button>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        <section class="related-products mt-5">
            <h2 class="mb-4">Sản phẩm liên quan</h2>
            <div class="row">
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        <img src="https://placeholder.pics/svg/300x300/DEDEDE/555555/iPhone%2012" class="card-img-top" alt="iPhone 12">
                        <div class="card-body">
                            <h5 class="card-title">iPhone 12</h5>
                            <p class="card-text">19.990.000 đ</p>
                            <a href="product-detail.php?id=2" class="btn btn-primary">Chi tiết</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        <img src="https://placeholder.pics/svg/300x300/DEDEDE/555555/iPhone%2013" class="card-img-top" alt="iPhone 13">
                        <div class="card-body">
                            <h5 class="card-title">iPhone 13</h5>
                            <p class="card-text">24.990.000 đ</p>
                            <a href="product-detail.php?id=3" class="btn btn-primary">Chi tiết</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        <img src="https://placeholder.pics/svg/300x300/DEDEDE/555555/iPhone%2013%20Pro" class="card-img-top" alt="iPhone 13 Pro">
                        <div class="card-body">
                            <h5 class="card-title">iPhone 13 Pro</h5>
                            <p class="card-text">27.990.000 đ</p>
                            <a href="product-detail.php?id=4" class="btn btn-primary">Chi tiết</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        <img src="https://placeholder.pics/svg/300x300/DEDEDE/555555/iPhone%2014" class="card-img-top" alt="iPhone 14">
                        <div class="card-body">
                            <h5 class="card-title">iPhone 14</h5>
                            <p class="card-text">32.990.000 đ</p>
                            <a href="product-detail.php?id=5" class="btn btn-primary">Chi tiết</a>
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