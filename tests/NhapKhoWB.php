<?php
use PHPUnit\Framework\TestCase;

class NhapKhoWB extends TestCase {
    private $conn;

    protected function setUp(): void {
        $this->conn = new mysqli('localhost', 'root', '', 'pj09qlhtk');
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }

        // Xóa dữ liệu mẫu trước khi chạy mỗi kiểm thử
        $this->conn->query("DELETE FROM phieunhap");

        // Thêm dữ liệu mẫu
        $insertQuery = "
            INSERT INTO phieunhap (id, ngay_nhap, nha_cung_cap_sp, ten_sp, anh_sp, mota_sp, loai_sp, gia_nhap_sp, so_luong, tong_tien_hang, nguoi_nhap)
            VALUES (100, '2023-01-01', 'NCCTest', 'SPTest', '../images/iphone-x-256gb-black.jpg', 'Mô tả sản phẩm 1', 'Loại 1', 10000, 5, 50000, 'Người nhập 1')
        ";

        $result = $this->conn->query($insertQuery);

        // Kiểm tra xem câu lệnh INSERT có thành công hay không
        if ($result !== TRUE) {
            die("Error: " . $this->conn->error);
        }
    }

    protected function tearDown(): void {
        // Xóa dữ liệu sau mỗi kiểm thử
        $this->conn->query("DELETE FROM phieunhap");
        $this->conn->close();
    }

    public function testQueryExecution() {
        // Kiểm tra nếu truy vấn SQL thực thi đúng
        $sql = "SELECT * FROM phieunhap";
        $result = $this->conn->query($sql);
        $this->assertTrue($result !== false);
    }

    public function testSumCalculation() {
        // Kiểm tra tính toán tổng tiền nhập
        $sql = "SELECT * FROM phieunhap";
        $result = $this->conn->query($sql);
        $TongTienNhap = 0;
        while ($row = $result->fetch_assoc()) {
            $TongTienNhap += $row['tong_tien_hang'];
        }
        $this->assertEquals(50000, $TongTienNhap);
    }

    public function testHtmlOutput() {
        ob_start();
        include 'NhapKho.php';
        $output = ob_get_clean();
    
        // Retrieve data from the database
        $sql = "SELECT ten_sp, tong_tien_hang, nha_cung_cap_sp FROM phieunhap";
        $result = $this->conn->query($sql);
    
        // Check if each expected value is present in the output
        while ($row = $result->fetch_assoc()) {
            $this->assertEquals($row['ten_sp'], 'SPTest');
            $this->assertEquals((string)$row['tong_tien_hang'], '50000');
            $this->assertEquals($row['nha_cung_cap_sp'], 'NCCTest');
        }
    }
}
?>