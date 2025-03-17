<?php
session_start();
require_once 'config/db.php';

// Kiểm tra trạng thái đăng nhập
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: views/login/login.php");
    exit();
}

// Lấy thông tin sinh viên đã đăng nhập
$masv = $_SESSION['masv'];
$stmt = $pdo->prepare("SELECT sv.HoTen, nh.TenNganh 
                       FROM SinhVien sv 
                       JOIN NganhHoc nh ON sv.MaNganh = nh.MaNganh 
                       WHERE sv.MaSV = ?");
$stmt->execute([$masv]);
$sinhVien = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Website Đăng Ký Học Phần</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .header {
            background-color: #fff;
            padding: 15px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .header h2 {
            margin: 0;
            display: inline-block;
            color: #333;
        }
        .welcome {
            display: inline-block;
            margin-left: 20px;
            color: #555;
        }
        .nav-links {
            margin-top: 10px;
        }
        .nav-links a {
            display: inline-block;
            margin-right: 10px;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 3px;
        }
        .nav-links a:hover {
            background-color: #0056b3;
        }
        .logout {
            display: inline-block;
            margin-left: 20px;
        }
        .logout a {
            color: #dc3545;
            text-decoration: none;
        }
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Website Đăng Ký Học Phần</h2>
        <div class="welcome">
            Xin chào, <strong><?php echo htmlspecialchars($sinhVien['HoTen']); ?></strong>! 
            (Ngành: <?php echo htmlspecialchars($sinhVien['TenNganh']); ?>)
        </div>
        <div class="nav-links">
            <a href="index.php?page=home">Trang Chủ</a>
            <a href="index.php?page=sinhvien">Quản lý Sinh Viên</a>
            <a href="index.php?page=hocphan">Đăng Ký Học Phần</a>
            <a href="index.php?page=cart">Xem Giỏ Hàng</a>
        </div>
        <div class="logout">
            <a href="views/login/logout.php" onclick="return confirm('Bạn có chắc muốn đăng xuất?')">Đăng Xuất</a>
        </div>
    </div>