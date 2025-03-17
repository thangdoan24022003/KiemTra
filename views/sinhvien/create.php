<?php
require_once '../../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $masv = $_POST['masv'];
    $hoten = $_POST['hoten'];
    $gioitinh = $_POST['gioitinh'];
    $ngaysinh = $_POST['ngaysinh'];
    $hinh = $_POST['hinh'];
    $manganh = $_POST['manganh'];

    $stmt = $pdo->prepare("INSERT INTO SinhVien (MaSV, HoTen, GioiTinh, NgaySinh, Hinh, MaNganh) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$masv, $hoten, $gioitinh, $ngaysinh, $hinh, $manganh]);
    header("Location: index.php");
    exit();
}

$stmt = $pdo->query("SELECT MaNganh, TenNganh FROM NganhHoc");
$nganhHocList = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head><title>Thêm Sinh Viên</title></head>
<body>
    <h2>Thêm Sinh Viên</h2>
    <form method="POST">
        <label>Mã SV: <input type="text" name="masv" required></label><br>
        <label>Họ Tên: <input type="text" name="hoten" required></label><br>
        <label>Giới Tính: <input type="text" name="gioitinh" required></label><br>
        <label>Ngày Sinh: <input type="date" name="ngaysinh" required></label><br>
        <label>Hình: <input type="text" name="hinh" value="/Content/images/default.jpg"></label><br>
        <label>Ngành Học: 
            <select name="manganh" required>
                <?php foreach ($nganhHocList as $nh): ?>
                    <option value="<?php echo $nh['MaNganh']; ?>"><?php echo $nh['TenNganh']; ?></option>
                <?php endforeach; ?>
            </select>
        </label><br>
        <button type="submit">Thêm</button>
    </form>
    <a href="index.php">Quay lại</a>
</body>
</html>