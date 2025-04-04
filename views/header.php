<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? htmlspecialchars($page_title) : 'Cửa hàng công nghệ'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .navbar {
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }
        .product-card {
            margin-bottom: 20px;
            transition: transform 0.2s;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        .product-card img {
            max-height: 200px;
            object-fit: cover;
        }
        .product-image {
            max-height: 400px;
            object-fit: cover;
        }
        .price {
            color: red;
            font-weight: bold;
            font-size: 1.2rem;
        }
        .discount-price {
            text-decoration: line-through;
            color: gray;
            font-size: 0.9rem;
        }
        .banner img {
            width: 100%;
            border-radius: 10px;
        }
        footer {
            background-color: #343a40;
            color: white;
            padding: 40px 0;
        }
        footer a {
            color: #adb5bd;
            text-decoration: none;
        }
        footer a:hover {
            color: white;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="index.php">Cửa hàng công nghệ</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Trang chủ</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Danh mục
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php
                            require_once 'commons/env.php';
                            require_once 'commons/function.php';
                            $db = connectDB();
                            $query = "SELECT * FROM categories";
                            $stmt = $db->prepare($query);
                            $stmt->execute();
                            $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($categories as $category): ?>
                                <li><a class="dropdown-item" href="index.php?act=category&id=<?php echo $category['id']; ?>"><?php echo htmlspecialchars($category['name']); ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Liên hệ</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Tìm kiếm sản phẩm" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Tìm</button>
                </form>
            </div>
        </div>
    </nav>