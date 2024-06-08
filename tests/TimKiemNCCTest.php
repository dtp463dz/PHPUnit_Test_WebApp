<?php
use PHPUnit\Framework\TestCase;

class TimKiemNCCTest extends TestCase
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

    public function testTimKiemTenNCC()
    {
        $searchTerm = "Coldzy";
        $sql = "SELECT * FROM nhacungcap WHERE ten_nha_cc LIKE '%$searchTerm%'";
        $result = $this->conn->query($sql);

        $this->assertGreaterThan(0, $result->num_rows, "Không tìm thấy tên nhà cung cấp có tên chứa '$searchTerm'");
    }

    public function testTimKiemSdtNCC()
    {
        $searchTerm = "88886";
        $sql = "SELECT * FROM nhacungcap WHERE sdt_nha_cc LIKE '%$searchTerm%'";
        $result = $this->conn->query($sql);

        $this->assertGreaterThan(0, $result->num_rows, "Không tìm thấy sdt nhà cung cấp '$searchTerm'");
    }

    public function testTimKiemDiaChiNCC()
    {
        $searchTerm = "HN";
        $sql = "SELECT * FROM nhacungcap WHERE dia_chi_nha_cc LIKE '%$searchTerm%'";
        $result = $this->conn->query($sql);

        $this->assertGreaterThan(0, $result->num_rows, "Không tìm thấy địa chỉ của nhà cung cấp '$searchTerm'");
    }

    public function testTimKiemEmailNCC()
    {
        $searchTerm = "xiaomi@gmail.com";
        $sql = "SELECT * FROM nhacungcap WHERE email_nha_cc LIKE '%$searchTerm%'";
        $result = $this->conn->query($sql);

        $this->assertGreaterThan(0, $result->num_rows, "Không tìm thấy email nhà cung cấp '$searchTerm'");
    }
}