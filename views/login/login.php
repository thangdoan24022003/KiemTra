<?php
session_start();
require_once '../../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $masv = $_POST['masv'];
    $stmt = $pdo->prepare("SELECT * FROM SinhVien WHERE MaSV = ?");
    $stmt->execute([$masv]);
    if ($stmt->rowCount() > 0) {
        $_SESSION['loggedin'] = true;
        $_SESSION['masv'] = $masv;
        header("Location: ../../index.php");
        exit();
    } else {
        $error = "Mã sinh viên không đúng!";
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Đăng Nhập</title></head>
<body>
    <h2>Đăng Nhập</h2>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="POST">
        <label>Mã SV: <input type="text" name="masv" required></label><br>
        <button type="submit">Đăng nhập</button>
    </form>
</body>
</html>