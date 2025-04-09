-- Tạo bảng categories
CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tạo bảng products
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    discount_price DECIMAL(10,2),
    image VARCHAR(255),
    category_id INT,
    import_date DATE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Thêm dữ liệu mẫu cho bảng categories
INSERT INTO categories (name, description) VALUES
('Điện thoại', 'Các sản phẩm điện thoại di động'),
('Laptop', 'Các sản phẩm máy tính xách tay'),
('Máy tính bảng', 'Các sản phẩm máy tính bảng'),
('Phụ kiện', 'Các phụ kiện điện tử');

-- Thêm dữ liệu mẫu cho bảng products
INSERT INTO products (name, description, price, discount_price, category_id, import_date) VALUES
('iPhone 13', 'iPhone 13 128GB', 19990000, 18990000, 1, '2023-01-01'),
('Samsung Galaxy S21', 'Samsung Galaxy S21 Ultra 5G', 24990000, 22990000, 1, '2023-01-02'),
('MacBook Pro M1', 'MacBook Pro 14 inch M1 Pro', 39990000, 37990000, 2, '2023-01-03'),
('iPad Pro 12.9', 'iPad Pro 12.9 inch M1', 29990000, 27990000, 3, '2023-01-04'),
('Tai nghe AirPods Pro', 'Tai nghe không dây Apple AirPods Pro', 4990000, 4590000, 4, '2023-01-05'); 