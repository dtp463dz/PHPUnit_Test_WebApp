<?php
require_once 'dangkylogic.php';

use PHPUnit\Framework\TestCase;

class DangKyTest extends TestCase
{
    private $conn;

    public function setUp(): void
    {
        // Khởi tạo kết nối cơ sở dữ liệu cho mỗi test case
        $this->conn = new mysqli('localhost', 'root', '', 'pj09qlhtk');
    }

    public function tearDown(): void
    {
        // Đóng kết nối cơ sở dữ liệu sau mỗi test case
        $this->conn->close();
    }

    public function testRegisterUserWithValidData()
    {
        $taikhoan = 'testuser';
        $matkhau = 'password123';
        $level = 1;
        $anh = 'AnhoLe_PC.png';
        $anh_tmp_name = './images/AnhoLe_PC.png';
        $hoten = 'Test User';
        $namsinh = 1990;
        $sdt = '0123456789';
        $diachi = 'Test Address';

        $result = registerUser($taikhoan, $matkhau, $level, $anh, $hoten, $namsinh, $sdt, $diachi, $this->conn);
        $this->assertTrue($result);

        // Xóa dữ liệu test khỏi cơ sở dữ liệu sau khi test
        // $this->conn->query("DELETE FROM thanhvien WHERE taikhoan = '$taikhoan'");
    }

    public function testRegisterUserWithInvalidData()
    {
        $taikhoan = '';
        $matkhau = 'password123';
        $level = 1;
        $anh = 'test.jpg';
        $anh_tmp_name = '/path/to/test.jpg';
        $hoten = 'Test User';
        $namsinh = 1990;
        $sdt = '0123456789';
        $diachi = 'Test Address';

        $result = registerUser($taikhoan, $matkhau, $level, $anh, $hoten, $namsinh, $sdt, $diachi, $this->conn);
        $this->assertEquals('Vui lòng điền đầy đủ thông tin vào tất cả các trường.', $result);
    }
}