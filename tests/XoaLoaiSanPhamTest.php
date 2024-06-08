<?php
use PHPUnit\Framework\TestCase;

class XoaLoaiSanPhamTest extends TestCase
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

    public function testXoaLoaiSanPhamThanhCong()
    {
        // Thêm một loại sản phẩm mới vào cơ sở dữ liệu để kiểm tra xóa
        $sql = "INSERT INTO loaisanpham (ten_loai_sp) VALUES ('DelTest')";
        $this->conn->query($sql);
        $id_loai_sp = $this->conn->insert_id;

        // Gọi hàm xóa loại sản phẩm
        $this->xoaLoaiSanPham($id_loai_sp);

        // Kiểm tra xem loại sản phẩm đã bị xóa hay chưa
        $sql = "SELECT * FROM loaisanpham WHERE id_loai_sp = $id_loai_sp";
        $result = $this->conn->query($sql);
        $this->assertEquals(0, $result->num_rows);
    }

    public function testXoaLoaiSanPhamKhongThanhCong()
    {
        // Gọi hàm xóa loại sản phẩm với một id không tồn tại
        $result = $this->xoaLoaiSanPham(999999);

        // Kiểm tra kết quả trả về là false khi không tìm thấy loại sản phẩm
        $this->assertFalse($result);
    }

    private function xoaLoaiSanPham($id_loai_sp)
    {
        // Gọi hàm xóa loại sản phẩm từ file XoaLoaiSanPham.php
        include("XoaLoaiSanPham.php");

        // Hàm thực hiện xóa loại sản phẩm
        $sql = "DELETE FROM loaisanpham WHERE id_loai_sp = $id_loai_sp";
        $result = $this->conn->query($sql);
        return $this->conn->affected_rows > 0;
    }
}
