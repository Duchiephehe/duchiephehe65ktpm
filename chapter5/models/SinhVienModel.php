<?php

class SinhVienModel 
{
    // Hàm Đọc (Read - R) - Lấy tất cả
    public function getAllSinhVien($pdo)
    {
        $sql = "SELECT * FROM sinhvien";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Hàm Thêm (Create - C)
    public function addSinhVien($pdo, $maSV, $ten, $lop, $diemTB) 
    {
        $sql = "INSERT INTO sinhvien (MaSV, TenSV, Lop, DiemTB) VALUES (?, ?, ?, ?)";
        try {
            $stmt = $pdo->prepare($sql);
            return $stmt->execute([$maSV, $ten, $lop, $diemTB]);
        } catch (\PDOException $e) {
            return false;
        }
    }

    // Hàm Xóa (Delete - D)
    public function deleteSinhVien($pdo, $maSV)
    {
        $sql = "DELETE FROM sinhvien WHERE MaSV = ?";
        try {
            $stmt = $pdo->prepare($sql);
            return $stmt->execute([$maSV]);
        } catch (\PDOException $e) {
            return false;
        }
    }
    
    // Hàm Phụ trợ cho Sửa (Update - U): Lấy dữ liệu theo ID
    public function getSinhVienById($pdo, $maSV)
    {
        $sql = "SELECT * FROM sinhvien WHERE MaSV = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$maSV]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Hàm Cập nhật (Update - U)
    public function updateSinhVien($pdo, $maSV, $ten, $lop, $diemTB)
    {
        // Cập nhật 3 trường TenSV, Lop, DiemTB dựa trên MaSV
        $sql = "UPDATE sinhvien SET TenSV = ?, Lop = ?, DiemTB = ? WHERE MaSV = ?";
        try {
            $stmt = $pdo->prepare($sql);
            return $stmt->execute([$ten, $lop, $diemTB, $maSV]);
        } catch (\PDOException $e) {
            return false;
        }
    }
}

?>