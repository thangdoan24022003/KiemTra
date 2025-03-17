<?php
// Lấy tất cả học phần từ bảng HocPhan (không cần điều kiện SoLuongDuKien)
$stmt = $pdo->query("SELECT * FROM HocPhan");
$hocPhanList = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['selected_hocphan'])) {
    session_start();
    $selected = $_POST['selected_hocphan'];
    if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
    $_SESSION['cart'] = array_unique(array_merge($_SESSION['cart'], $selected));
    header("Location: index.php?page=cart");
    exit();
}
?>

<h2>Đăng Ký Học Phần</h2>
<?php if (empty($hocPhanList)): ?>
    <p>Không có học phần nào khả dụng để đăng ký!</p>
<?php else: ?>
    <form method="POST">
        <?php foreach ($hocPhanList as $hp): ?>
            <input type="checkbox" name="selected_hocphan[]" value="<?php echo $hp['MaHP']; ?>">
            <?php echo $hp['TenHP'] . ' (' . $hp['SoTinChi'] . ' tín chỉ)'; ?><br>
        <?php endforeach; ?>
        <button type="submit">Thêm vào giỏ</button>
    </form>
<?php endif; ?>
<a href="index.php?page=cart">Xem giỏ hàng</a>