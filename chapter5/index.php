<?php 

// Tệp Controller là "não" của ứng dụng 

// TODO 6: (Quan trọng) Import (require_once) tệp Model vào 
require_once 'models/SinhVienModel.php'; 

// === THIẾT LẬP KẾT NỐI PDO === 

// TODO 7: Copy code PDO từ PHT Chương 4 vào đây 
$host = '127.0.0.1'; 
$dbname = 'cse485_web'; 
$username = 'root'; 
$password = ''; 
$charset = 'utf8mb4'; // Thêm charset cho đầy đủ

$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset"; 
try { 
    $pdo = new PDO($dsn, $username, $password); 
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
} catch (PDOException $e) {    
    die("Kết nối thất bại: " . $e->getMessage()); 
} 
// === KẾT THÚC KẾT NỐI PDO === 

// Khởi tạo Model và biến thông báo
$model = new SinhVienModel();
$message = ''; 

// === LOGIC CỦA CONTROLLER === 

// TODO 8: Kiểm tra xem có hành động POST (thêm sinh viên) không 
// Kiểm tra method POST và action là 'create' (từ form View)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'create') { 
    
    // TODO 9: Nếu có, lấy dữ liệu MaSV, TenSV, Lop, DiemTB từ $_POST 
    $maSV = $_POST['maSV'] ?? '';
    $tenSV = $_POST['tenSV'] ?? '';
    $lop = $_POST['lop'] ?? '';
    $diemTB = $_POST['diemTB'] ?? '';

    if (!empty($maSV) && !empty($tenSV) && !empty($lop) && !empty($diemTB)) {
        
        // TODO 10: Gọi hàm addSinhVien() từ Model    
        // (Truyền $pdo, $maSV, $tenSV, $lop, $diemTB vào hàm) 
        if ($model->addSinhVien($pdo, $maSV, $tenSV, $lop, $diemTB)) {
             $message = "Thêm sinh viên thành công!";
        } else {
             $message = "Lỗi: Không thể thêm sinh viên. (Kiểm tra trùng Mã SV)";
        }

        // TODO 11: Chuyển hướng về index.php để "làm mới" trang 
        header('Location: index.php?message=' . urlencode($message));   
        exit; 
    } else {
        $message = "Lỗi: Vui lòng điền đầy đủ thông tin.";
    }
} 

// Xử lý thông báo sau khi redirect (từ thao tác thêm)
if (isset($_GET['message'])) {
    $message = urldecode($_GET['message']);
}


// TODO 12: (Luôn luôn) Gọi hàm getAllSinhVien() từ Model 
// Lưu kết quả trả về vào một biến, ví dụ: $danh_sach_sv 
$danh_sach_sv = $model->getAllSinhVien($pdo); 

// Đặt biến $students để tương thích với code View đã hoàn thiện
$students = $danh_sach_sv;

// TODO 13: (Rất quan trọng) Import (include) tệp View ở cuối cùng 
include 'views/sinhvien_view.php'; 

?>