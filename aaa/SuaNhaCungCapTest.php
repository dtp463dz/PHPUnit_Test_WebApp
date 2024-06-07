<?php
use PHPUnit\Framework\TestCase;

class SuaNhaCungCapTest extends TestCase
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
    private function suaNhaCungCap($id_nha_cc, $ten_nha_cc, $email_nha_cc, $sdt_nha_cc, $dia_chi_nha_cc)
    {
        // mã nguồn 
        include("connect.php");

        $sql = "UPDATE nhacungcap SET ten_nha_cc='$ten_nha_cc', email_nha_cc='$email_nha_cc', sdt_nha_cc='$sdt_nha_cc', dia_chi_nha_cc='$dia_chi_nha_cc' WHERE id_nha_cc=$id_nha_cc";
        $result = mysqli_query($conn, $sql);
        if($result){
            return true;
        }else {
            return false;
        }
    }

    public function testSuaNhaCungCapThanhCong()
    {
        // giả lập dữ liệu loại sản phẩm
        $id_nha_cc = 1;
        $ten_nha_cc = 'Coldzy';
        $email_nha_cc = 'coldzy@gmail.com';
        $sdt_nha_cc = '152';
        $dia_chi_nha_cc= 'VietNamese';

        // gọi hàm sửa sản phẩm
        $result = $this->suaNhaCungCap($id_nha_cc, $ten_nha_cc, $email_nha_cc, $sdt_nha_cc, $dia_chi_nha_cc);

        // kiểm tra kết quả trả về
        $this-> assertTrue($result);

        // Kiểm tra dữ liệu trong database
        $sql = "SELECT * FROM nhacungcap WHERE id_nha_cc = $id_nha_cc";
        $result = $this->conn->query($sql);

        // kiem tra nếu kết quả truy vấn không trống
        if($result && $result->num_rows > 0){
            $row = $result->fetch_assoc();

            $this->assertEquals($ten_nha_cc, $row['ten_nha_cc']);
            $this->assertEquals($email_nha_cc, $row['email_nha_cc']);
            $this->assertEquals($sdt_nha_cc, $row['sdt_nha_cc']);
            $this->assertEquals($dia_chi_nha_cc, $row['dia_chi_nha_cc']);
        }else {
            $this->fail('Không tìm thấy nha cung cap với id: '. $id_loai_sp);
        }
    }
    // public function testSuaNhaCungCapKhongThanhCong()
    // {
    //     // Giả lập dữ liệu nhà cung cấp
    //     $id_nha_cc = 999; // ID không tồn tại
    //     $ten_nha_cc = '';
    //     $email_nha_cc = '';
    //     $sdt_nha_cc = '';
    //     $dia_chi_nha_cc= '';

    //     // Gọi hàm sửa nhà cung cấp
    //     $result = $this->suaNhaCungCap($id_nha_cc, $ten_nha_cc, $email_nha_cc, $sdt_nha_cc, $dia_chi_nha_cc);

    //     // Kiểm tra kết quả trả về
    //     $this->assertFalse($result);
    // }

}