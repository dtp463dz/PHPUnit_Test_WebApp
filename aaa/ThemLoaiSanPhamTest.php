<?php
use PHPUnit\Framework\TestCase;

class ThemLoaiSanPhamTest extends TestCase
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

    public function testThemLoaiSanPhamThanhCong()
    {
        // Dữ liệu sản phẩm mới
        $ten = 'LoaiSpNew';
        

        // Thêm sản phẩm mới vào cơ sở dữ liệu
        $sql = "INSERT INTO loaisanpham (ten_loai_sp) VALUES ('$ten')";
        mysqli_query($this->conn, $sql);

        // Kiểm tra xem sản phẩm đã được thêm thành công hay chưa
        $sql = "SELECT * FROM loaisanpham WHERE ten_loai_sp = '$ten'";
        $result = mysqli_query($this->conn, $sql);
        $this->assertGreaterThan(0, mysqli_num_rows($result), 'Thêm loại sản phẩm thất bại');

        // Xóa sản phẩm mới khỏi cơ sở dữ liệu
        $sql = "DELETE FROM loaisanpham WHERE ten_loai_sp = '$ten'";
        mysqli_query($this->conn, $sql);
    }
}