<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../header.php';

if (!isset($_SESSION['loggedin']) || !isset($_SESSION['cart'])) {
    header("Location: /KiemTra/index.php?page=login");
    exit();
}

$masv = $_SESSION['masv'];
$ngaydk = date('Y-m-d');

try {
    $pdo->beginTransaction();

    // Thêm bản ghi vào bảng DangKy
    $stmt = $pdo->prepare("INSERT INTO DangKy (NgayDK, MaSV) VALUES (?, ?)");
    $stmt->execute([$ngaydk, $masv]);
    $madk = $pdo->lastInsertId();

    // Thêm chi tiết đăng ký
    foreach ($_SESSION['cart'] as $mahp) {
        $stmt = $pdo->prepare("INSERT INTO ChiTietDangKy (MaDK, MaHP) VALUES (?, ?)");
        $stmt->execute([$madk, $mahp]);
    }

    $pdo->commit();
    unset($_SESSION['cart']);
    echo "Đăng ký thành công!<br>";
    echo "<a href='/KiemTra/index.php?page=home'>Quay về trang chủ</a>";
    exit();
} catch (Exception $e) {
    $pdo->rollBack();
    echo "Đăng ký thất bại: " . $e->getMessage();
    echo "<br><a href='/KiemTra/index.php?page=hocphan'>Tiếp tục đăng ký</a>";
}
?>
