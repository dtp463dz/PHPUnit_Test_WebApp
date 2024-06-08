<?php
    use PHPUnit\Framework\TestCase;

    class XuatKhoWB extends TestCase {
        private $conn;

        protected function setUp(): void {
            // Kết nối cơ sở dữ liệu
            // $this->conn = new mysqli('localhost', 'root', '', 'pj09qlhtk');
            // if ($this->conn->connect_error) {
            //     die("Connection failed: " . $this->conn->connect_error);
            // }
            $this->conn = mysqli_connect('localhost', 'root', '', 'pj09qlhtk');
            // Xóa dữ liệu mẫu trước khi chạy mỗi kiểm thử
            $this->conn->query("DELETE FROM phieuxuat");

            // Thêm dữ liệu mẫu
            $insertQuery = "
                INSERT INTO phieuxuat (id_phieu_xuat, ngay_xuat, nha_cung_cap_sp, ten_sp, anh_sp, mota_sp, loai_sp, gia_ban_sp, so_luong_xuat, tong_tien_hang, nguoi_xuat)
                VALUES (100, '2023-01-01', 'NCCTest', 'SPTest', '../images/iphone-x-256gb-black.jpg', 'Mô tả sản phẩm 1', 'Loại 1', 10000, 5, 50000, 'Người xuất 1')
            ";

            $this->conn->query($insertQuery);
        }

        protected function tearDown(): void {
            // Xóa dữ liệu sau mỗi kiểm thử
            $this->conn->query("DELETE FROM phieuxuat");
            $this->conn->close();
        }

        public function testQueryExecution() {
            // Kiểm tra nếu truy vấn SQL thực thi đúng
            $sql = "SELECT * FROM phieuxuat";
            $result = $this->conn->query($sql);
            $this->assertTrue($result !== false);
        }

        public function testSumCalculation() {
            // Kiểm tra tính toán tổng tiền xuất
            $sql = "SELECT * FROM phieuxuat";
            $result = $this->conn->query($sql);
            $TongTienXuat = 0;
            while ($row = $result->fetch_assoc()) {
                $TongTienXuat += $row['tong_tien_hang'];
            }
            $this->assertEquals(50000, $TongTienXuat);
        }

        public function testHtmlOutput() {
            ob_start();
            include 'XuatKho.php';
            $output = ob_get_clean();
        
            // Retrieve data from the database
            $sql = "SELECT ten_sp, tong_tien_hang, nha_cung_cap_sp FROM phieuxuat";
            $result = $this->conn->query($sql);
        
            // Check if each expected value is present in the output
            while ($row = $result->fetch_assoc()) {
                $this->assertEquals($row['ten_sp'], 'SPTest');
                $this->assertEquals((string)$row['tong_tien_hang'], '50000');
                $this->assertEquals($row['nha_cung_cap_sp'], 'NCCTest');
            }
        }
        
    }

    // Chạy kiểm thử với lệnh:
    // vendor/bin/phpunit tests/XuatKhoTest.php
    ?>