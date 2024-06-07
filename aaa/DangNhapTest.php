<?php
use PHPUnit\Framework\TestCase;

class DangNhapTest extends TestCase
{
    private $conn;

    protected function setUp(): void
    {
        include "connect.php"; // Đảm bảo kết nối đã được thiết lập trước khi chạy testcase
        $this->conn = $conn;
    }

    public function testSuccessfulLogin()
    {
        // Giả lập dữ liệu đầu vào cho tên tài khoản và mật khẩu hợp lệ
        $_POST["taikhoan"] = "huunghia";
        $_POST["matkhau"] = "123456";

        ob_start(); // Bắt đầu bắt kết quả của hàm header()

        // Gọi hàm xử lý đăng nhập
        include "DangNhap.php";

        $output = ob_get_clean(); // Lấy kết quả của hàm header()

        // Kiểm tra xem đã chuyển hướng đến trang chính hay không
        $this->assertStringContainsString("Location: TrangChu.php", $output);

        // Kiểm tra xem session có chứa tên tài khoản đã đăng nhập hay không
        $this->assertEquals("huunghia", $_SESSION['taikhoan']);
    }

    public function testFailedLogin()
    {
        // Giả lập dữ liệu đầu vào cho tên tài khoản và mật khẩu không hợp lệ
        $_POST["taikhoan"] = "khongtontai";
        $_POST["matkhau"] = "wrongpassword";

        ob_start(); // Bắt đầu bắt kết quả của hàm echo

        // Gọi hàm xử lý đăng nhập
        include "DangNhap.php";

        $output = ob_get_clean(); // Lấy kết quả của hàm echo

        // Kiểm tra xem có thông báo lỗi hiển thị hay không
        $this->assertStringContainsString("Tài khoản hoặc mật khẩu sai", $output);
    }
}
?>
