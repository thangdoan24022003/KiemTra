<?php
require_once __DIR__ . '/../../config/db.php';

if (!isset($_GET['masv'])) header("Location: index.php");

$masv = $_GET['masv'];
$stmt = $pdo->prepare("SELECT * FROM SinhVien WHERE MaSV = ?");
$stmt->execute([$masv]);
$sinhVien = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $hoten = $_POST['hoten'];
    $gioitinh = $_POST['gioitinh'];
    $ngaysinh = $_POST['ngaysinh'];
    $hinh = $_POST['hinh'];
    $manganh = $_POST['manganh'];

    $stmt = $pdo->prepare("UPDATE SinhVien SET HoTen = ?, GioiTinh = ?, NgaySinh = ?, Hinh = ?, MaNganh = ? WHERE MaSV = ?");
    $stmt->execute([$hoten, $gioitinh, $ngaysinh, $hinh, $manganh, $masv]);
    header("Location: index.php");
    exit();
}

$stmt = $pdo->query("SELECT MaNganh, TenNganh FROM NganhHoc");
$nganhHocList = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head><title>Sửa Sinh Viên</title></head>
<body>
    <h2>Sửa Thông Tin Sinh Viên</h2>
    <form method="POST">
        <label>Họ Tên: <input type="text" name="hoten" value="<?php echo $sinhVien['HoTen']; ?>" required></label><br>
        <label>Giới Tính: <input type="text" name="gioitinh" value="<?php echo $sinhVien['GioiTinh']; ?>" required></label><br>
        <label>Ngày Sinh: <input type="date" name="ngaysinh" value="<?php echo $sinhVien['NgaySinh']; ?>" required></label><br>
        <label>Hình: <input type="text" name="hinh" value="<?php echo $sinhVien['Hinh']; ?>"></label><br>
        <label>Ngành Học: 
            <select name="manganh" required>
                <?php foreach ($nganhHocList as $nh): ?>
                    <option value="<?php echo $nh['MaNganh']; ?>" <?php echo $sinhVien['MaNganh'] == $nh['MaNganh'] ? 'selected' : ''; ?>><?php echo $nh['TenNganh']; ?></option>
                <?php endforeach; ?>
            </select>
        </label><br>
        <button type="submit">Cập nhật</button>
    </form>
    <a href="index.php">Quay lại</a>
</body>
</html>