<?php

use PHPUnit\Framework\TestCase;

class SuaSanPhamTest extends TestCase
{
    private $conn;
    public function setUp(): void
    {
        // Thiết lập kết nối với cơ sở dữ liệu
        $this->conn = new mysqli('localhost', 'root', '', 'pj09qlhtk');
    }
    public function tearDown(): void
    {
        // Đóng kết nối với cơ sở dữ liệu
        $this->conn->close();
    }
    private function suaSanPham($id_sp, $ten_sp, $anh_sp, $mota_sp, $loai_sp, $gia_ban_sp, $gia_nhap_sp, $nha_cung_cap_sp, $sl_ton, $sl_ton_toithieu, $ngay_nhap)
    {
        // Mã nguồn của hàm suaSanPham từ file SuaSanPham.php
        include("connect.php");

        $sql = "UPDATE sanpham SET ten_sp='$ten_sp', anh_sp='$anh_sp', mota_sp='$mota_sp', loai_sp='$loai_sp', gia_ban_sp='$gia_ban_sp', gia_nhap_sp='$gia_nhap_sp', nha_cung_cap_sp='$nha_cung_cap_sp', sl_ton='$sl_ton', sl_ton_toithieu='$sl_ton_toithieu', ngay_nhap='$ngay_nhap' WHERE id_sp=$id_sp";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function testSuaSanPhamThanhCong()
    {
        // Giả lập dữ liệu sản phẩm
        $id_sp = 52;
        $ten_sp = 'abc';
        $anh_sp = 'anh_moi.jpg';
        $mota_sp = 'kho';
        $loai_sp = 'cdc';
        $gia_ban_sp = 100;
        $gia_nhap_sp = 80;
        $nha_cung_cap_sp = 'bcnd';
        $sl_ton = 50;
        $sl_ton_toithieu = 10;
        $ngay_nhap = '2023-06-01';

        // Gọi hàm sửa sản phẩm
        $result = $this->suaSanPham($id_sp, $ten_sp, $anh_sp, $mota_sp, $loai_sp, $gia_ban_sp, $gia_nhap_sp, $nha_cung_cap_sp, $sl_ton, $sl_ton_toithieu, $ngay_nhap);

        // Kiểm tra kết quả trả về
        $this->assertTrue($result);

            // Kiểm tra dữ liệu trong cơ sở dữ liệu
        $sql = "SELECT * FROM sanpham WHERE id_sp = $id_sp";
        $result = $this->conn->query($sql);

        // Kiểm tra nếu kết quả truy vấn không trống
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();

            $this->assertEquals($ten_sp, $row['ten_sp']);
            $this->assertEquals($anh_sp, $row['anh_sp']);
            $this->assertEquals($mota_sp, $row['mota_sp']);
            $this->assertEquals($loai_sp, $row['loai_sp']);
            $this->assertEquals($gia_ban_sp, $row['gia_ban_sp']);
            $this->assertEquals($gia_nhap_sp, $row['gia_nhap_sp']);
            $this->assertEquals($nha_cung_cap_sp, $row['nha_cung_cap_sp']);
            $this->assertEquals($sl_ton, $row['sl_ton']);
            $this->assertEquals($sl_ton_toithieu, $row['sl_ton_toithieu']);
            $this->assertEquals($ngay_nhap, $row['ngay_nhap']);
        } else {
            $this->fail('Không tìm thấy sản phẩm với id: ' . $id_sp);
        }
    }
}