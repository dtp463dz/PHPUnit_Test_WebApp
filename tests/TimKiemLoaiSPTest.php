<?php
use PHPUnit\Framework\TestCase;

class TimKiemLoaiSPTest extends TestCase
{
    private $conn;

    public function setUp(): void
    {
        // Thiết lập kết nối tới database
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "pj09qlhtk";

        $this->conn = new mysqli($servername, $username, $password, $dbname);
        if ($this->conn->connect_error) {
            die("Kết nối tới database thất bại: " . $this->conn->connect_error);
        }
    }

    public function tearDown(): void
    {
        // Đóng kết nối tới database
        $this->conn->close();
    }

    public function testTimKiemLoaiSPTest()
    {
        $searchTerm = "Laptop";
        $sql = "SELECT * FROM loaisanpham WHERE ten_loai_sp LIKE '%$searchTerm%'";
        $result = $this->conn->query($sql);

        $this->assertGreaterThan(0, $result->num_rows, "Không tìm thấy loại sp có tên chứa '$searchTerm'");
    }

}