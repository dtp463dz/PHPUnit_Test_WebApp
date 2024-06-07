<?php
use PHPUnit\Framework\TestCase;

class NhapKhoTest extends TestCase
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

    public function testThemPhieuNhap()
    {
        // Dữ liệu mẫu để thêm vào bảng phieunhap
        $ngay_nhap = '2023-06-07';
        $so_luong_nhap = 20;
        $this_id = 52; // ID sản phẩm tồn tại trong bảng sanpham
        $nguoi_nhap = 'SSM';

        // Truy vấn thông tin sản phẩm
        $sqlSP = "SELECT ten_sp, mota_sp, loai_sp, gia_nhap_sp, nha_cung_cap_sp, anh_sp FROM sanpham WHERE id_sp = $this_id";
        $resultSP = $this->conn->query($sqlSP);

        if ($resultSP->num_rows > 0) {
            $row_sp = $resultSP->fetch_assoc();
            $ten_sp = $row_sp["ten_sp"];
            $anh_sp = $row_sp["anh_sp"];
            $nha_cung_cap_sp = $row_sp["nha_cung_cap_sp"];
            $mota_sp = $row_sp["mota_sp"];
            $loai_sp = $row_sp["loai_sp"];
            $gia_nhap_sp = $row_sp["gia_nhap_sp"];
            $tong_tien_hang = $so_luong_nhap * $gia_nhap_sp;

            // Thêm phiếu nhập vào cơ sở dữ liệu
            $sql = "INSERT INTO phieunhap (ngay_nhap, so_luong, nguoi_nhap, ten_sp, mota_sp, loai_sp, gia_nhap_sp, tong_tien_hang, nha_cung_cap_sp, anh_sp)
                    VALUES ('$ngay_nhap', '$so_luong_nhap', '$nguoi_nhap', '$ten_sp', '$mota_sp', '$loai_sp', '$gia_nhap_sp', '$tong_tien_hang', '$nha_cung_cap_sp', '$anh_sp')";

            $result = $this->conn->query($sql);

            // Kiểm tra xem phiếu nhập đã được thêm thành công hay chưa
            $this->assertTrue($result);

            // Cập nhật số lượng tồn của sản phẩm
            $sqlUpdate = "UPDATE sanpham SET sl_ton = sl_ton + $so_luong_nhap WHERE id_sp = $this_id";
            $this->conn->query($sqlUpdate);
        } else {
            $this->fail("Không tìm thấy sản phẩm có ID $this_id.");
        }
    }
}