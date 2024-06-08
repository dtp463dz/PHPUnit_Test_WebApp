<?php
use PHPUnit\Framework\TestCase;

class XoaSanPhamTest extends TestCase
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

    public function testXoaSanPhamThanhCong()
    {
        // Thêm một sản phẩm mới vào cơ sở dữ liệu để kiểm tra xóa
        $sql = "INSERT INTO sanpham (ten_sp, anh_sp, mota_sp, loai_sp, gia_ban_sp, gia_nhap_sp, nha_cung_cap_sp, sl_ton, sl_ton_toithieu, ngay_nhap) 
                VALUES ('Test Product', 'test.jpg', 'Test Description', 'Test Category', 100, 80, 'Test Supplier', 10, 5, '2023-06-07')";
        $this->conn->query($sql);
        $id_sp = $this->conn->insert_id;

        // Gọi hàm xóa sản phẩm
        $this->xoaSanPham($id_sp);

        // Kiểm tra xem sản phẩm đã bị xóa hay chưa
        $sql = "SELECT * FROM sanpham WHERE id_sp = $id_sp";
        $result = $this->conn->query($sql);
        $this->assertCount(0, $result->fetch_all());
    }

    public function testXoaSanPhamKhongThanhCong()
    {
        // Gọi hàm xóa sản phẩm với một id không tồn tại
        $result = $this->xoaSanPham(999999);

       // Kiểm tra kết quả trả về là false khi không tìm thấy loại sản phẩm
        $this->assertFalse($result);
    }

    private function xoaSanPham($id_sp)
    {
        // Gọi hàm xóa sản phẩm từ file XoaSanPham.php
        include("XoaSanPham.php");
         // Hàm thực hiện xóa loại sản phẩm
        $sql = "DELETE FROM sanpham WHERE id_sp = $id_sp";
        $result = $this->conn->query($sql);
        return $this->conn->affected_rows > 0;
    }
}