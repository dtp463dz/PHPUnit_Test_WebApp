<?php
use PHPUnit\Framework\TestCase;

class SuaLoaiSanPhamTest extends TestCase
{
    private $conn;
    public function setUp(): void
    {
        // thiết lập ket noi database
        $this->conn = new mysqli('localhost', 'root', '', 'pj09qlhtk');
    }

    public function tearDown(): void
    {
        // close database
        $this->conn->close();
    }
    private function suaLoaiSanPham($id_loai_sp, $ten_loai_sp)
    {
        // mã nguồn 
        include("connect.php");

        $sql = "UPDATE loaisanpham SET ten_loai_sp='$ten_loai_sp' WHERE id_loai_sp=$id_loai_sp";
        $result = mysqli_query($conn, $sql);
        if($result){
            return true;
        }else {
            return false;
        }
    }

    public function testSuaLoaiSanPhamThanhCong()
    {
        // giả lập dữ liệu loại sản phẩm
        $id_loai_sp = 1;
        $ten_loai_sp = 'Coldzy';

        // gọi hàm sửa sản phẩm
        $result = $this->suaLoaiSanPham($id_loai_sp, $ten_loai_sp);

        // kiểm tra kết quả trả về
        $this-> assertTrue($result);

        // Kiểm tra dữ liệu trong database
        $sql = "SELECT * FROM loaisanpham WHERE id_loai_sp = $id_loai_sp";
        $result = $this->conn->query($sql);

        // kiem tra nếu kết quả truy vấn không trống
        if($result && $result->num_rows > 0){
            $row = $result->fetch_assoc();

            $this->assertEquals($ten_loai_sp, $row['ten_loai_sp']);
        }else {
            $this->fail('Không tìm thấy loại sản phẩm với id: '. $id_loai_sp);
        }
    }
}