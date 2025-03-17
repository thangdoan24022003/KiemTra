<?php
// Kiểm tra session chỉ khởi tạo nếu chưa có
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Đảm bảo đường dẫn tuyệt đối đúng
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../header.php';

if (!isset($_SESSION['loggedin'])) {
    header("Location: ../login/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['remove'])) {
        $mahp = $_POST['mahp'];
        if (($key = array_search($mahp, $_SESSION['cart'] ?? [])) !== false) {
            unset($_SESSION['cart'][$key]);
            $_SESSION['cart'] = array_values($_SESSION['cart']);
        }
    } elseif (isset($_POST['clear'])) {
        unset($_SESSION['cart']);
    }
    header("Location: index.php?page=cart");
    exit();
}

$cartItems = [];
if (!empty($_SESSION['cart'])) {
    $placeholders = implode(',', array_fill(0, count($_SESSION['cart']), '?'));
    $stmt = $pdo->prepare("SELECT * FROM HocPhan WHERE MaHP IN ($placeholders)");
    $stmt->execute($_SESSION['cart']);
    $cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Giỏ Hàng</title>
</head>
<body>
    <h2>Học Phần Đã Đăng Ký</h2>
    <?php if (empty($cartItems)): ?>
        <p>Giỏ hàng trống!</p>
    <?php else: ?>
        <table>
            <tr>
                <th>Tên Học Phần</th>
                <th>Số Tín Chỉ</th>
                <th>Thao tác</th>
            </tr>
            <?php foreach ($cartItems as $item): ?>
                <tr>
                    <td><?= htmlspecialchars($item['TenHP']) ?></td>
                    <td><?= htmlspecialchars($item['SoTinChi']) ?></td>
                    <td>
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="mahp" value="<?= htmlspecialchars($item['MaHP']) ?>">
                            <button type="submit" name="remove">Xóa</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <form method="POST">
            <button type="submit" name="clear">Xóa tất cả</button>
        </form>
    <?php endif; ?>
    <a href="index.php?page=hocphan">Tiếp tục đăng ký</a> | <a href="index.php?page=save">Lưu đăng ký</a>
</body>
</html>