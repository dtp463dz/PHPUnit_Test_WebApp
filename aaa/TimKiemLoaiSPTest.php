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

    public function testTimKiemTenKH()
    {
        $searchTerm = "Nam";
        $sql = "SELECT * FROM khachhang WHERE ten_kh LIKE '%$searchTerm%'";
        $result = $this->conn->query($sql);

        $this->assertGreaterThan(0, $result->num_rows, "Không tìm thấy tên khách hàng có tên chứa '$searchTerm'");
    }

    public function testTimKiemSdtKH()
    {
        $searchTerm = "68669";
        $sql = "SELECT * FROM khachhang WHERE sdt_kh LIKE '%$searchTerm%'";
        $result = $this->conn->query($sql);

        $this->assertGreaterThan(0, $result->num_rows, "Không tìm thấy sdt Khách hàng '$searchTerm'");
    }

    public function testTimKiemDiaChiKH()
    {
        $searchTerm = "HN";
        $sql = "SELECT * FROM khachhang WHERE dia_chi_kh LIKE '%$searchTerm%'";
        $result = $this->conn->query($sql);

        $this->assertGreaterThan(0, $result->num_rows, "Không tìm thấy địa chỉ của khách hàng '$searchTerm'");
    }

    public function testTimKiemEmailKH()
    {
        $searchTerm = "nam@gmail.com";
        $sql = "SELECT * FROM khachhang WHERE email_kh LIKE '%$searchTerm%'";
        $result = $this->conn->query($sql);

        $this->assertGreaterThan(0, $result->num_rows, "Không tìm thấy email khách hàng '$searchTerm'");
    }
}