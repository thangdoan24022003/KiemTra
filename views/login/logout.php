<?php
// Bắt đầu session để có thể xóa nó
session_start();

// Xóa tất cả dữ liệu session
session_unset();
session_destroy();

// Chuyển hướng về trang đăng nhập
header("Location: login.php");
exit();
?>