<?php
use PHPUnit\Framework\TestCase;

class DangKyWB extends TestCase {

    private $conn;

    protected function setUp(): void {
        // Replace with your actual database connection details
        // $this->conn = new mysqli('localhost', 'username', 'password', 'database');
        // if ($this->conn->connect_error) {
        //     die("Connection failed: " . $this->conn->connect_error);
        // }
        $this->conn = mysqli_connect('localhost', 'root', '', 'pj09qlhtk');
        // Clear the test data before each test
        $this->conn->query("DELETE FROM thanhvien WHERE taikhoan='testuser'");
    }

    protected function tearDown(): void {
        // Clear the test data after each test
        $this->conn->query("DELETE FROM thanhvien WHERE taikhoan='testuser'");
        $this->conn->close();
    }

    private function resetGlobals() {
        $_POST = [];
        $_FILES = [];
    }

    private function includeRegistrationScript() {
        ob_start();
        include __DIR__ . './DangKy.php';
        $output = ob_get_clean();
        return $output;
    }

    public function testAllFieldsFilled() {
        $this->resetGlobals();

        $_POST = [
            'taikhoan' => 'testuser',
            'matkhau' => 'password123',
            'level' => '1',
            'hoten' => 'Test User',
            'namsinh' => '1990',
            'sdt' => '0123456789',
            'diachi' => 'Test Address',
            'btn' => '1'
        ];
        $_FILES['HinhAnh'] = [
            'name' => 'testimage.jpg',
            'tmp_name' => __DIR__ . './images/iphone-x-256gb-black.jpg'
        ];

        $output = $this->includeRegistrationScript();

        // Assertions to check the database and file system
        $result = $this->conn->query("SELECT * FROM thanhvien WHERE taikhoan='testuser'");
        $this->assertEquals(1, $result->num_rows);

        $this->assertTrue(file_exists(__DIR__ . '/../src/images/testimage.jpg'));

        // Clean up uploaded file
        unlink(__DIR__ . '/../src/images/testimage.jpg');
    }
}

// Run the test with the following command:
// vendor/bin/phpunit tests/RegistrationTest.php
?>