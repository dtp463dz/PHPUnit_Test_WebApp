<?php
use PHPUnit\Framework\TestCase;

class ThemSanPhamTest extends TestCase
{
    private $conn;

    public function setUp(): void
    {
        // Kết nối đến cơ sở dữ liệu
        $this->conn = mysqli_connect('localhost', 'root', '', 'pj09qlhtk');
    }

    public function tearDown(): void
    {
        // Đóng kết nối cơ sở dữ liệu
        mysqli_close($this->conn);
    }

    public function testThemSanPhamThanhCong()
    {
        // Dữ liệu sản phẩm mới
        $tenSP = 'Sản phẩm mới';
        $anhSP = 'sanpham_moi.jpg';
        $motaSP = 'Mô tả sản phẩm mới';
        $loaiSP = 'Điện thoại';
        $giaBanSP = 1000000;
        $giaNhapSP = 800000;
        $nhaCungCapSP = 'Apple';
        $slTonToiThieu = 10;
        $ngayNhap = '2023-06-07';

        // Thêm sản phẩm mới vào cơ sở dữ liệu
        $sql = "INSERT INTO sanpham (ten_sp, anh_sp, mota_sp, loai_sp, gia_ban_sp, gia_nhap_sp, nha_cung_cap_sp, sl_ton_toithieu, ngay_nhap)
                VALUES ('$tenSP', '$anhSP', '$motaSP', '$loaiSP', '$giaBanSP', '$giaNhapSP', '$nhaCungCapSP', '$slTonToiThieu', '$ngayNhap')";
        mysqli_query($this->conn, $sql);

        // Kiểm tra xem sản phẩm đã được thêm thành công hay chưa
        $sql = "SELECT * FROM sanpham WHERE ten_sp = '$tenSP'";
        $result = mysqli_query($this->conn, $sql);
        $this->assertGreaterThan(0, mysqli_num_rows($result), 'Thêm sản phẩm thất bại');

        // Xóa sản phẩm mới khỏi cơ sở dữ liệu
        $sql = "DELETE FROM sanpham WHERE ten_sp = '$tenSP'";
        mysqli_query($this->conn, $sql);
    }
}