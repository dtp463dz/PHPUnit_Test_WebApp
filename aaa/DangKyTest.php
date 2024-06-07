<?php
use PHPUnit\Framework\TestCase;

class DangKyTest extends TestCase
{
    public function testEmptyFields()
    {
        // Chuẩn bị dữ liệu giả định cho biến POST (tất cả các trường đều trống)
        $_POST["taikhoan"] = "";
        $_POST["matkhau"] = "";
        $_POST["level"] = "";
        $_FILES["HinhAnh"] = array('name' => "", 'tmp_name' => "");
        $_POST["hoten"] = "";
        $_POST["namsinh"] = "";
        $_POST["sdt"] = "";
        $_POST["diachi"] = "";

        // Chuẩn bị sử dụng output buffering để bắt kết quả của echo
        ob_start();

        // Bao gồm file DangKy.php để thực thi
        include "DangKy.php";

        // Lấy kết quả của echo
        $output = ob_get_clean();

        // Kiểm tra xem có thông báo lỗi hiển thị hay không
        $this->assertStringContainsString("Vui lòng điền đầy đủ thông tin vào tất cả các trường.", $output);
    }

    public function testSuccessfulRegistration()
    {
        // Chuẩn bị dữ liệu giả định cho biến POST (đầy đủ thông tin)
        $_POST["taikhoan"] = "testuser";
        $_POST["matkhau"] = "password";
        $_POST["level"] = 1;
        $_FILES["HinhAnh"] = array('name' => "testimage.jpg", 'tmp_name' => "testimage_tmp.jpg");
        $_POST["hoten"] = "Test User";
        $_POST["namsinh"] = 1990;
        $_POST["sdt"] = "0123456789";
        $_POST["diachi"] = "123 Test Street";

        // Chuẩn bị sử dụng output buffering để bắt kết quả của lệnh header()
        ob_start();

        // Bao gồm file DangKy.php để thực thi
        include "DangKy.php";

        // Lấy kết quả của lệnh header()
        $output = ob_get_clean();

        // Kiểm tra xem đã chuyển hướng đến trang đăng nhập hay không
        $this->assertStringContainsString("Location: DangNhap.php", $output);
    }
}
?>
