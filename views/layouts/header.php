<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Nhà sách trực tuyến</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        .top-header {
            background-color: #c92127;
            padding: 10px 0;
        }
        .logo img {
            max-height: 40px;
        }
        .search-box {
            position: relative;
            width: 100%;
        }
        .search-box input {
            width: 100%;
            padding: 8px 15px;
            border: 2px solid #c92127;
            border-radius: 5px;
        }
        .search-box button {
            position: absolute;
            right: 0;
            top: 0;
            height: 100%;
            background: #c92127;
            border: none;
            padding: 0 20px;
            border-top-right-radius: 5px;
            border-bottom-right-radius: 5px;
        }
        .header-icon {
            color: white;
            text-decoration: none;
            text-align: center;
            font-size: 0.9rem;
        }
        .header-icon i {
            font-size: 1.5rem;
            display: block;
            margin-bottom: 5px;
        }
        .category-menu {
            background: #fff;
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
        }
        .language-selector img {
            width: 25px;
            height: auto;
        }
    </style>
</head>
<body>
    <!-- Top Banner -->
    <div class="banner bg-danger text-center">
        <img src="assets/images/top-banner.jpg" alt="Khuyến mãi" class="img-fluid">
    </div>

    <!-- Main Header -->
    <header class="top-header">
        <div class="container">
            <div class="row align-items-center">
                <!-- Logo -->
                <div class="col-lg-2 col-md-2">
                    <a href="index.php" class="logo">
                        <img src="assets/images/logo.png" alt="Fahasa" class="img-fluid">
                    </a>
                </div>

                <!-- Search -->
                <div class="col-lg-7 col-md-7">
                    <form action="index.php?act=search" method="GET" class="search-box">
                        <div class="input-group">
                            <input type="text" name="keyword" class="form-control" placeholder="Tìm kiếm sản phẩm mong muốn..." value="<?php echo isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : ''; ?>">
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Icons -->
                <div class="col-lg-3 col-md-3">
                    <div class="d-flex justify-content-end">
                        <a href="#" class="header-icon mx-3">
                            <i class="far fa-bell"></i>
                            <span>Thông báo</span>
                        </a>
                        <a href="#" class="header-icon mx-3">
                            <i class="fas fa-shopping-cart"></i>
                            <span>Giỏ hàng</span>
                        </a>
                        <a href="#" class="header-icon mx-3">
                            <i class="far fa-user"></i>
                            <span>Tài khoản</span>
                        </a>
                        <div class="language-selector ms-3">
                            <img src="assets/images/vn-flag.png" alt="Tiếng Việt">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Category Menu -->
    <div class="category-menu">
        <div class="container">
            <div class="d-flex align-items-center">
                <div class="dropdown">
                    <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <i class="fas fa-bars me-2"></i> Danh mục sản phẩm
                    </button>
                    <ul class="dropdown-menu">
                        <?php if(isset($categories) && is_array($categories)): ?>
                            <?php foreach($categories as $category): ?>
                                <li>
                                    <a class="dropdown-item" href="index.php?act=category&id=<?php echo $category['id']; ?>">
                                        <?php if(!empty($category['icon'])): ?>
                                            <img src="<?php echo htmlspecialchars($category['icon']); ?>" alt="" class="me-2" style="width: 20px; height: 20px;">
                                        <?php endif; ?>
                                        <?php echo htmlspecialchars($category['name']); ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li><a class="dropdown-item" href="#">Không có danh mục</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Container -->
    <main class="py-4">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 