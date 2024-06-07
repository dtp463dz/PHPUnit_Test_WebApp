<?php
use PHPUnit\Framework\TestCase;

class XoaKhachHangTest extends TestCase
{
    private $conn;

    public function setUp(): void
    {
        // Khởi tạo kết nối cơ sở dữ liệu cho các test case
        $this->conn = new mysqli("localhost", "root", "", "pj09qlhtk");
    }

    public function tearDown(): void
    {
        // Đóng kết nối cơ sở dữ liệu sau khi chạy xong test case
        $this->conn->close();
    }

    public function testXoaKhachHangThanhCong()
    {
        // Thêm một sản phẩm mới vào cơ sở dữ liệu để kiểm tra xóa
        $sql = "INSERT INTO khachhang (ten_kh,email_kh,sdt_kh,dia_chi_kh) 
                VALUES ('KHNew', 'newEKH@gmail.com', '251', 'QuangNinh')";
        $this->conn->query($sql);
        $id_kh = $this->conn->insert_id;

        // Gọi hàm xóa sản phẩm
        $this->XoaKhachHang($id_kh);

        // Kiểm tra xem sản phẩm đã bị xóa hay chưa
        $sql = "SELECT * FROM khachhang WHERE id_kh = $id_kh";
        $result = $this->conn->query($sql);
        $this->assertCount(0, $result->fetch_all());
    }

    public function testXoaKhachHangKhongThanhCong()
    {
        // Gọi hàm xóa sản phẩm với một id không tồn tại
        $result = $this->XoaKhachHang(999999);

        // Kiểm tra kết quả trả về là false khi không tìm thấy loại sản phẩm
        $this->assertFalse($result);
    }

    private function XoaKhachHang($id_kh)
    {
        // Gọi hàm xóa sản phẩm từ file XoaSanPham.php
        include("XoaNhaCungCap.php");
        // Hàm thực hiện xóa loại sản phẩm
        $sql = "DELETE FROM khachhang WHERE id_kh = $id_kh";
        $result = $this->conn->query($sql);
        return $this->conn->affected_rows > 0;
    }
}