<?php
use PHPUnit\Framework\TestCase;

class ThemKhachHangTest extends TestCase
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

    public function testThemKhachHangThanhCong()
    {
        // Dữ liệu sản phẩm mới
        $ten = 'HzP';
        $email = 'hzp134@gmail.com';
        $sdt = '09703';
        $diachi = 'NamDinh';

        // Thêm sản phẩm mới vào cơ sở dữ liệu
        $sql = "INSERT INTO khachhang (ten_kh,email_kh,sdt_kh,dia_chi_kh) VALUES ('$ten','$email','$sdt','$diachi')";
        mysqli_query($this->conn, $sql);

        // Kiểm tra xem sản phẩm đã được thêm thành công hay chưa
        $sql = "SELECT * FROM khachhang WHERE ten_kh = '$ten'";
        $result = mysqli_query($this->conn, $sql);
        $this->assertGreaterThan(0, mysqli_num_rows($result), 'Thêm khách hàng thất bại');

        // Xóa sản phẩm mới khỏi cơ sở dữ liệu
        $sql = "DELETE FROM khachhang WHERE ten_kh = '$ten'";
        mysqli_query($this->conn, $sql);
    }
}