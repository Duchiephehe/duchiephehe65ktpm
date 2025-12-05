<?php 
// Tệp View CHỈ chứa HTML và logic hiển thị (echo, foreach) 
// Tệp View KHÔNG chứa câu lệnh SQL 
?> 

<!DOCTYPE html> 
<html lang="vi"> 
<head> 
    <meta charset="UTF-8"> 
    <title>PHT Chương 5 - MVC</title> 
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .form-container { border: 1px solid #ccc; padding: 15px; margin-bottom: 20px; }
        .action-link { margin-right: 10px; }
    </style> 
</head> 
<body> 

    <div class="form-container">
        <h2>Thêm Sinh Viên Mới (Kiến trúc MVC)</h2> 
        <form action="index.php" method="POST">
            <input type="hidden" name="action" value="create"> 
            
            <label for="maSV">Mã SV:</label>
            <input type="text" id="maSV" name="maSV" required><br><br>

            <label for="tenSV">Tên SV:</label>
            <input type="text" id="tenSV" name="tenSV" required><br><br>
            
            <label for="lop">Lớp:</label>
            <input type="text" id="lop" name="lop" required><br><br>

            <label for="diemTB">Điểm TB:</label>
            <input type="number" id="diemTB" name="diemTB" step="0.01" required><br><br>

            <button type="submit">Thêm Sinh Viên</button>
        </form>
    </div>
    
    <?php 
    if (!empty($message)) {
        $class = strpos($message, 'thành công') !== false ? 'success' : 'error';
        echo "<p class='{$class}'>{$message}</p>";
    }
    ?>

    <h2>Danh Sách Sinh Viên (Kiến trúc MVC)</h2> 
    
    <?php 
    // Giả định Controller đã truyền dữ liệu vào biến $students 
    $danh_sach_sv = $students ?? []; 
    
    if (empty($danh_sach_sv)) {
        echo "<p>Hiện không có sinh viên nào trong danh sách.</p>";
    } else {
        echo "<table>";
        echo "<thead><tr>";
        echo "<th>Mã SV</th>";
        echo "<th>Tên Sinh Viên</th>";
        echo "<th>Lớp</th>";
        echo "<th>Điểm TB</th>";
        echo "<th>Thao tác</th>";
        echo "</tr></thead>";
        echo "<tbody>";

        // TODO 4 & 5: Dùng vòng lặp foreach để duyệt qua biến $danh_sach_sv
        foreach ($danh_sach_sv as $sv) {
            
            echo "<tr>";
            // Cột Mã SV
            echo "<td>" . htmlspecialchars($sv['MaSV']) . "</td>";
            // Cột Tên Sinh Viên
            echo "<td>" . htmlspecialchars($sv['TenSV']) . "</td>";
            // Cột Lớp
            echo "<td>" . htmlspecialchars($sv['Lop']) . "</td>";
            // Cột Điểm TB
            echo "<td>" . htmlspecialchars($sv['DiemTB']) . "</td>";

            // Cột Thao tác (Sửa/Xóa)
            echo "<td>";
            // Nút Sửa
            echo "<a class='action-link' href='index.php?action=edit&maSV=" . urlencode($sv['MaSV']) . "'>Sửa</a>";
            // Nút Xóa
            echo "<a href='index.php?action=delete&maSV=" . urlencode($sv['MaSV']) . "' onclick=\"return confirm('Bạn có chắc chắn muốn xóa sinh viên " . htmlspecialchars($sv['TenSV']) . "?');\">Xóa</a>";
            echo "</td>";
            echo "</tr>";
            
        } // Đóng vòng lặp 
        
        echo "</tbody>";
        echo "</table>"; 
    }
    ?> 
    
</body> 
</html>