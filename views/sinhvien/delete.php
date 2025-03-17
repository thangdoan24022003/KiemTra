<?php
require_once __DIR__ . '/../../config/db.php';

if (!isset($pdo)) {
    die("Lỗi kết nối CSDL!");
}

if (isset($_GET['masv'])) {
    $masv = $_GET['masv'];

    // Kiểm tra sinh viên có tồn tại không
    $checkStmt = $pdo->prepare("SELECT * FROM SinhVien WHERE MaSV = ?");
    $checkStmt->execute([$masv]);

    if ($checkStmt->rowCount() == 0) {
        die("Không tìm thấy sinh viên với Mã SV: " . htmlspecialchars($masv));
    }

    // Tiến hành xóa
    $stmt = $pdo->prepare("DELETE FROM SinhVien WHERE MaSV = ?");
    if ($stmt->execute([$masv])) {
        // Chuyển hướng sau khi xóa thành công
        header("Location: index.php?page=sinhvien");
        exit(); // 🔥 QUAN TRỌNG: Ngăn mã PHP tiếp tục chạy
    } else {
        die("Xóa thất bại!");
    }
} else {
    die("Thiếu tham số Mã SV.");
}
?>
