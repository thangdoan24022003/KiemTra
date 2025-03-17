<?php
require_once '../../config/db.php';

if (isset($_GET['masv'])) {
    $masv = $_GET['masv'];
    $stmt = $pdo->prepare("DELETE FROM SinhVien WHERE MaSV = ?");
    $stmt->execute([$masv]);
}
header("Location: index.php");
exit();
?>