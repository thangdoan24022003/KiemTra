<?php
require_once '../../config/db.php';

if (!isset($_GET['masv'])) header("Location: index.php");

$masv = $_GET['masv'];
$stmt = $pdo->prepare("SELECT sv.*, nh.TenNganh FROM SinhVien sv JOIN NganhHoc nh ON sv.MaNganh = nh.MaNganh WHERE sv.MaSV = ?");
$stmt->execute([$masv]);
$sinhVien = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head><title>Chi Tiết Sinh Viên</title></head>
<body>
    <h2>Thông Tin Chi Tiết</h2>
    <p>Mã SV: <?php echo $sinhVien['MaSV']; ?></p>
    <p>Họ Tên: <?php echo $sinhVien['HoTen']; ?></p>
    <p>Giới Tính: <?php echo $sinhVien['GioiTinh']; ?></p>
    <p>Ngày Sinh: <?php echo date('d/m/Y', strtotime($sinhVien['NgaySinh'])); ?></p>
    <p>Hình: <img src="../../<?php echo $sinhVien['Hinh']; ?>" width="50" height="50"></p>
    <p>Ngành Học: <?php echo $sinhVien['TenNganh']; ?></p>
    <a href="index.php">Quay lại</a>
</body>
</html>