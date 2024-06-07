<?php
use PHPUnit\Framework\TestCase;

class XuatKhoTest extends TestCase
{
    private $conn;

    public function setUp(): void
    {
        // Khởi tạo kết nối cơ sở dữ liệu
        $server = 'localhost';
        $user = 'root';
        $pass = '';
        $database = 'pj09qlhtk';

        $this->conn = new mysqli($server, $user, $pass, $database);
    }

    public function tearDown(): void
    {
        // Đóng kết nối cơ sở dữ liệu
        $this->conn->close();
    }

    public function testThemPhieuXuat()
    {
        // Dữ liệu mẫu để thêm vào bảng phieuxuat
        $ngay_xuat = '2023-06-07';
        $nha_cung_cap = 'Apple';
        $ten_sp = 'iPhone 15';
        $anh_sp = 'iphone15.jpg';
        $mota_sp = '512GB';
        $loai_sp = 'Điện thoại';
        $so_luong = 10;
        $nguoi_xuat = 'John Doe';
        $so_luong_xuat = '5';
        $id_sp = 52; // ID sản phẩm tồn tại trong bảng sanpham

        // Lấy thông tin sản phẩm từ cơ sở dữ liệu
        $sql_sp = "SELECT ten_sp, mota_sp, loai_sp, gia_ban_sp, nha_cung_cap_sp, anh_sp FROM sanpham WHERE id_sp = $id_sp";
        $result_sp = $this->conn->query($sql_sp);

        if ($result_sp->num_rows > 0) {
            $row_sp = $result_sp->fetch_assoc();
            $ten_sp = $row_sp["nha_cung_cap_sp"];
            $anh_sp = $row_sp["anh_sp"];
            $nha_cung_cap_sp = $row_sp["nha_cung_cap_sp"];
            $mota_sp = $row_sp["mota_sp"];
            $loai_sp = $row_sp["loai_sp"];
            $gia_ban_sp = $row_sp["gia_ban_sp"];
            $tong_tien_hang = $so_luong_xuat * $gia_ban_sp;

            // Tạo phiếu xuất kho
            $sql = "INSERT INTO phieuxuat (ngay_xuat, so_luong, nguoi_xuat, ten_sp, mota_sp, loai_sp, gia_ban_sp, tong_tien_hang, nha_cung_cap_sp, anh_sp)
                    VALUES ('$ngay_xuat', '$so_luong', '$nguoi_xuat', '$ten_sp', '$mota_sp', '$loai_sp', '$gia_ban_sp', '$tong_tien_hang', '$nha_cung_cap_sp', '$anh_sp')";

            $result = $this->conn->query($sql);

            // Kiểm tra xem phiếu xuất đã được thêm thành công hay chưa
            $this->assertFalse($result);
        } else {
            $this->fail("Không tìm thấy sản phẩm có ID $id_sp.");
        }
    }
}