-- Tạo database
CREATE DATABASE IF NOT EXISTS shop_db;
USE shop_db;

-- Tạo bảng categories
CREATE TABLE IF NOT EXISTS categories (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tạo bảng products
CREATE TABLE IF NOT EXISTS products (
    id INT PRIMARY KEY AUTO_INCREMENT,
    category_id INT,
    name VARCHAR(200) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    image VARCHAR(255),
    specifications JSON,
    featured BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id)
);

-- Thêm dữ liệu mẫu cho categories
INSERT INTO categories (name, description) VALUES
('Điện thoại', 'Các sản phẩm điện thoại di động'),
('Laptop', 'Các sản phẩm máy tính xách tay'),
('Phụ kiện', 'Các phụ kiện điện tử');

-- Thêm dữ liệu mẫu cho products
INSERT INTO products (category_id, name, description, price, image, specifications, featured) VALUES
(1, 'iPhone 13', 'iPhone 13 128GB chính hãng VN/A', 15990000, 'images/products/iphone13.jpg', '{"Màu sắc": "Đen", "Bộ nhớ": "128GB", "Màn hình": "6.1 inch"}', 1),
(1, 'Samsung Galaxy S21', 'Samsung Galaxy S21 Ultra 5G', 19990000, 'images/products/samsung-s21.jpg', '{"Màu sắc": "Đen", "Bộ nhớ": "256GB", "Màn hình": "6.8 inch"}', 1),
(2, 'MacBook Pro M1', 'MacBook Pro 14 inch M1 Pro', 39990000, 'images/products/macbook-pro.jpg', '{"Chip": "M1 Pro", "RAM": "16GB", "SSD": "512GB"}', 1),
(2, 'Dell XPS 13', 'Dell XPS 13 9310', 29990000, 'images/products/dell-xps.jpg', '{"CPU": "Intel i7", "RAM": "16GB", "SSD": "1TB"}', 1); 