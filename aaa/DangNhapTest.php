<?php
require_once './loginHandler.php';
use PHPUnit\Framework\TestCase;

class DangNhapTest extends TestCase
{
    private $loginHandler;

    protected function setUp(): void
    {
        $this->loginHandler = new LoginHandler();
    }

    /**
     * TC1: Nhập user đúng, nhập password đúng
     */
    public function testValidLogin()
    {
        $username = 'huunghia';
        $password = '123456';
        $result = $this->loginHandler->login($username, $password);
        $this->assertTrue($result);
    }

    /**
     * TC2: Nhập user đúng, nhập password sai
     */
    public function testInvalidPassword()
    {
        $username = 'huunghia';
        $password = 'wrongpassword';
        $result = $this->loginHandler->login($username, $password);
        $this->assertFalse($result);
    }

    /**
     * TC3: Nhập user sai, nhập password đúng
     */
    public function testInvalidUsername()
    {
        $username = 'wronguser';
        $password = '123456';
        $result = $this->loginHandler->login($username, $password);
        $this->assertFalse($result);
    }

    /**
     * TC4: Nhập user sai, nhập password sai
     */
    public function testInvalidCredentials()
    {
        $username = 'wronguser';
        $password = 'wrongpassword';
        $result = $this->loginHandler->login($username, $password);
        $this->assertFalse($result);
    }

}