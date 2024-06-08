<?php
use PHPUnit\Framework\TestCase;

class XoaNhaCungCapTest extends TestCase
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

    public function testXoaNhaCungCapThanhCong()
    {
        // Thêm một sản phẩm mới vào cơ sở dữ liệu để kiểm tra xóa
        $sql = "INSERT INTO nhacungcap (ten_nha_cc,email_nha_cc,sdt_nha_cc,dia_chi_nha_cc) 
                VALUES ('TestNCC', 'newEmail@gmail.com', '251', 'HaLong')";
        $this->conn->query($sql);
        $id_nha_cc = $this->conn->insert_id;

        // Gọi hàm xóa sản phẩm
        $this->XoaNhaCungCap($id_nha_cc);

        // Kiểm tra xem sản phẩm đã bị xóa hay chưa
        $sql = "SELECT * FROM nhacungcap WHERE id_nha_cc = $id_nha_cc";
        $result = $this->conn->query($sql);
        $this->assertCount(0, $result->fetch_all());
    }

    public function testXoaNhaCungCapKhongThanhCong()
    {
        // Gọi hàm xóa sản phẩm với một id không tồn tại
        $result = $this->XoaNhaCungCap(999999);

        // Kiểm tra kết quả trả về là false khi không tìm thấy loại sản phẩm
        $this->assertFalse($result);
    }

    private function XoaNhaCungCap($id_nha_cc)
    {
        // Gọi hàm xóa sản phẩm từ file XoaSanPham.php
        include("XoaNhaCungCap.php");
        // Hàm thực hiện xóa loại sản phẩm
        $sql = "DELETE FROM nhacungcap WHERE id_nha_cc = $id_nha_cc";
        $result = $this->conn->query($sql);
        return $this->conn->affected_rows > 0;
    }
}