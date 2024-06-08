<?php
use PHPUnit\Framework\TestCase;

class ThemNhaCungCapTest extends TestCase
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

    public function testThemNhaCungCapThanhCong()
    {
        // Dữ liệu sản phẩm mới
        $ten = 'HP';
        $email = 'hp134@gmail.com';
        $sdt = '0903';
        $diachi = 'VPhuc';

        // Thêm sản phẩm mới vào cơ sở dữ liệu
        $sql = "INSERT INTO nhacungcap (ten_nha_cc,email_nha_cc,sdt_nha_cc,dia_chi_nha_cc) VALUES ('$ten','$email','$sdt','$diachi')";
        mysqli_query($this->conn, $sql);

        // Kiểm tra xem sản phẩm đã được thêm thành công hay chưa
        $sql = "SELECT * FROM nhacungcap WHERE ten_nha_cc = '$ten'";
        $result = mysqli_query($this->conn, $sql);
        $this->assertGreaterThan(0, mysqli_num_rows($result), 'Thêm nhà cung cấp thất bại');

        // Xóa sản phẩm mới khỏi cơ sở dữ liệu
        $sql = "DELETE FROM nhacungcap WHERE ten_nha_cc = '$ten'";
        mysqli_query($this->conn, $sql);
    }
}