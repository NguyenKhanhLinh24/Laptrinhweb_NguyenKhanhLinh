CREATE DATABASE quan_ly_thu_vien
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE quan_ly_thu_vien;

CREATE TABLE books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ma_sach VARCHAR(20) NOT NULL UNIQUE,
    ten_sach VARCHAR(100) NOT NULL,
    ma_tac_gia VARCHAR(20) NOT NULL,
    tac_gia VARCHAR(100) NOT NULL,
    danh_muc VARCHAR(50) NOT NULL,
    nha_xuat_ban VARCHAR(100) NOT NULL,
    nam_xuat_ban INT NOT NULL,
    isbn VARCHAR(13) NOT NULL UNIQUE,
    gia_sach DECIMAL(12,2) NOT NULL,
    mo_ta VARCHAR(500),
    trang_thai ENUM('Hoạt động', 'Đã khóa') DEFAULT 'Hoạt động'
);