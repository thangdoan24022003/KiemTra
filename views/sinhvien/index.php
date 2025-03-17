<?php
$stmt = $pdo->query("
    SELECT sv.*, nh.TenNganh 
    FROM SinhVien sv 
    JOIN NganhHoc nh ON sv.MaNganh = nh.MaNganh
");
$sinhVienList = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Danh sách Sinh Viên</h2>
<table>
    <tr>
        <th>Mã SV</th>
        <th>Họ Tên</th>
        <th>Giới Tính</th>
        <th>Ngày Sinh</th>
        <th>Hình</th>
        <th>Ngành Học</th>
        <th>Thao tác</th>
    </tr>
    <?php foreach ($sinhVienList as $sv): ?>
    <tr>
        <td><?php echo $sv['MaSV']; ?></td>
        <td><?php echo $sv['HoTen']; ?></td>
        <td><?php echo $sv['GioiTinh']; ?></td>
        <td><?php echo date('d/m/Y', strtotime($sv['NgaySinh'])); ?></td>
        <td><img src="../../<?php echo htmlspecialchars($sv['Hinh']); ?>" width="50" height="50" alt="Hình sinh viên"></td>
        <td><?php echo $sv['TenNganh']; ?></td>
        <td>
            <a href="views/sinhvien/detail.php?masv=<?php echo $sv['MaSV']; ?>">Chi tiết</a> |
            <a href="views/sinhvien/edit.php?masv=<?php echo $sv['MaSV']; ?>">Sửa</a> |
            <a href="views/sinhvien/delete.php?masv=<?php echo $sv['MaSV']; ?>" onclick="return confirm('Bạn có chắc?')">Xóa</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<a href="views/sinhvien/create.php">Thêm Sinh Viên</a>