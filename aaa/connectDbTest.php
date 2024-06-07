<?php
use PHPUnit\Framework\TestCase;

class DatabaseConnectionTest extends TestCase
{
    private $conn;

    protected function setUp(): void
    {
        include "connect.php"; // Đảm bảo kết nối được thiết lập trước khi chạy testcase
        $this->conn = $conn;
    }

    public function testConnectionEstablished()
    {
        // Kiểm tra xem kết nối đã được thiết lập chưa
        $this->assertInstanceOf(mysqli::class, $this->conn);
    }

    public function testCharacterSet()
    {
        // Kiểm tra xem ký tự được sử dụng có phải là utf8 hay không
        $charset = mysqli_character_set_name($this->conn);
        $this->assertEquals('latin1', $charset);
    }

    public function testDatabaseSelection()
    {
        // Kiểm tra xem đã chọn cơ sở dữ liệu cụ thể hay chưa
        $selected_database = mysqli_select_db($this->conn, 'pj09qlhtk');
        $this->assertTrue($selected_database);
    }
}
?>
