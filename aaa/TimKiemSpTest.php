<?php
use PHPUnit\Framework\TestCase;

class TimKiemSpTest extends TestCase
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

    public function testTimKiemTenSp()
    {
        $searchTerm = "iPhone 15";
        $sql = "SELECT * FROM sanpham WHERE ten_sp LIKE '%$searchTerm%'";
        $result = $this->conn->query($sql);

        $this->assertGreaterThan(0, $result->num_rows, "Không tìm thấy sản phẩm có tên chứa '$searchTerm'");
    }

    public function testTimKiemLoaiSp()
    {
        $searchTerm = "cdc";
        $sql = "SELECT * FROM sanpham WHERE loai_sp LIKE '%$searchTerm%'";
        $result = $this->conn->query($sql);

        $this->assertGreaterThan(0, $result->num_rows, "Không tìm thấy sản phẩm thuộc loại '$searchTerm'");
    }

    public function testTimKiemSpTheoNhaCungCap()
    {
        $searchTerm = "Apple";
        $sql = "SELECT * FROM sanpham WHERE nha_cung_cap_sp LIKE '%$searchTerm%'";
        $result = $this->conn->query($sql);

        $this->assertGreaterThan(0, $result->num_rows, "Không tìm thấy sản phẩm của nhà cung cấp '$searchTerm'");
    }

    public function testTimKiemSpTheoNgay()
    {
        $searchTerm = "2023-10-11";
        $sql = "SELECT * FROM sanpham WHERE ngay_nhap LIKE '%$searchTerm%'";
        $result = $this->conn->query($sql);

        $this->assertGreaterThan(0, $result->num_rows, "Không tìm thấy sản phẩm nhập vào ngày '$searchTerm'");
    }
}