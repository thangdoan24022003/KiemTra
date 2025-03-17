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
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f2f5;
        }
        .header {
            background-color: #fff;
            padding: 15px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .header h2 {
            margin: 0;
            color: #007bff;
            font-weight: bold;
        }
        .welcome {
            font-size: 16px;
            color: #333;
        }
        .nav-links {
            display: flex;
            gap: 15px;
        }
        .nav-links a {
            padding: 8px 15px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: 0.3s;
            font-size: 14px;
        }
        .nav-links a:hover {
            background-color: #0056b3;
        }
        .logout a {
            color: #dc3545;
            text-decoration: none;
            font-weight: bold;
            transition: 0.3s;
        }
        .logout a:hover {
            color: #b02a37;
        }
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
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
</body>
</html>