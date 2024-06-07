<?php
use PHPUnit\Framework\TestCase;

class SuaKhachHangTest extends TestCase
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
    private function suaKhachHang($id_kh, $ten_kh, $email_kh, $sdt_kh, $dia_chi_kh)
    {
        // mã nguồn 
        include("connect.php");

        $sql = "UPDATE khachhang SET ten_kh='$ten_kh', email_kh='$email_kh', sdt_kh='$sdt_kh', dia_chi_kh='$dia_chi_kh' WHERE id_kh=$id_kh";
        $result = mysqli_query($conn, $sql);
        if($result){
            return true;
        }else {
            return false;
        }
    }

    public function testSuaKhachHangThanhCong()
    {
        // giả lập dữ liệu loại sản phẩm
        $id_kh = 1;
        $ten_kh = 'abcd';
        $email_kh = 'miniumy@gmail.com';
        $sdt_kh = '152';
        $dia_chi_kh= 'HN';

        // gọi hàm sửa sản phẩm
        $result = $this->suaKhachHang($id_kh, $ten_kh, $email_kh, $sdt_kh, $dia_chi_kh);

        // kiểm tra kết quả trả về
        $this-> assertTrue($result);

        // Kiểm tra dữ liệu trong database
        $sql = "SELECT * FROM khachhang WHERE id_kh = $id_kh";
        $result = $this->conn->query($sql);

        // kiem tra nếu kết quả truy vấn không trống
        if($result && $result->num_rows > 0){
            $row = $result->fetch_assoc();

            $this->assertEquals($ten_kh, $row['ten_kh']);
            $this->assertEquals($email_kh, $row['email_kh']);
            $this->assertEquals($sdt_kh, $row['sdt_kh']);
            $this->assertEquals($dia_chi_kh, $row['dia_chi_kh']);
        }else {
            $this->fail('Không tìm thấy khach hang với id: '. $id_loai_sp);
        }
    }
    

}