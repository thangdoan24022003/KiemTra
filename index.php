<?php
require_once 'header.php';

// Xác định trang con dựa trên tham số 'page'
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

?>

<div class="container">
    <?php
    // Include nội dung trang con dựa trên tham số 'page'
    switch ($page) {
        case 'home':
            echo "<h3>Chào mừng đến với trang chủ!</h3>";
            echo "<p>Đây là trang chính của hệ thống đăng ký học phần. Vui lòng chọn các chức năng ở menu trên để tiếp tục.</p>";
            break;
        case 'sinhvien':
            include 'views/sinhvien/index.php';
            break;
        case 'create':
            include 'views/sinhvien/create.php';
            break;
        case 'edit':
            include 'views/sinhvien/edit.php';
            break;
        case 'hocphan':
            include 'views/hocphan/register.php';
            break;

        case 'cart':
            include 'views/cart/cart.php';
            break;
        case 'save':
            include 'views/save.php';
            break;

        default:
            echo "<h3>Trang không tồn tại!</h3>";
            break;
    }
    ?>
</div>

</body>
</html>